<section class="content">
  <div class="container-fluid">
      <div class="row">
        <div class="col-4">
          <div class="ibox">
              <div class="ibox-head">
                  <div class="ibox-title"><?= $title; ?></div>
              </div>
              <div class="ibox-body">
                  <form role="form">
                      <div class="card-body">
                        <div class="form-group row">
                          <div class="col-sm-12">
                            <input class='form-control' type="text" id="label" placeholder="Nama Menu" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-12">
                            <input type="radio" id="radio1" name='from' value='link' checked> From Link &nbsp; 
                            <input type="radio" id="radio2" name='from' value='page'> From Page &nbsp; 
                            <input type="radio" id="radio3" name='from' value='kategori'> From Berita
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-12">
                            <input class='form-control link' type="text" id="link" placeholder="http://domain.com/page" autocomplete='off' required>
                            <select class='form-control page' type="text" id="page" required>
                                <option value=''>- Page -</option>
                                <?php 
                                foreach ($halaman as $row) {
                                    echo "<option value='/website/profil/$row[seo]'>$row[title]</option>";
                                }
                                ?>
                            </select>
                            <select class='form-control kategori' type="text" id="kategori" required>
                                <option value=''>- Kategori Berita -</option>
                                <?php 
                                foreach ($kategori as $row) {
                                    echo "<option value='/website/beritadetail/$row[seo]'>$row[title]</option>";
                                }
                                ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                      </div>
                  </form>
              </div>
          </div>
        </div>
        <div class="col-8">
          <div class="ibox">
              <div class="ibox-head">
                  <div class="ibox-title">Struktur Menu Website</div>
              </div>
              <div class="ibox-body">
                  <p>Geser (Drag and Drop) masing-masing menu sesuai urutan yang Anda inginkan. Klik kotak merah atau abu-abu di bagian kiri masing-masing item untuk memindahkan/geser. Kotak merah artinya Top Menu, dan warna Abu-abu Bottom Menu.</p>
                  <input type="hidden" id="id">
                  <div class="dd" id="nestable">
                    <?php
                      $ref   = [];
                      $items = [];
                      foreach ($record as $data) {
                          $thisRef = &$ref[$data->_id];
                          $thisRef['_parent'] = $data->_parent;
                          $thisRef['title'] = $data->title;
                          $thisRef['uri'] = $data->uri;
                          $thisRef['_id'] = $data->_id;

                      if($data->_parent == 0) {
                              $items[$data->_id] = &$thisRef;
                      } else {
                              $ref[$data->_parent]['child'][$data->_id] = &$thisRef;
                      }

                      }
                      function get_menu($items,$class = 'dd-list') {
                          $html = "<ol class=\"".$class."\" id=\"menu-id\">";
                          foreach($items as $key => $value) {
                              $html.= '<li class="dd-item dd3-item" data-id="'.$value['_id'].'" >
                                          <div style="cursor:move" class="dd-handle dd3-handle">Drag</div>
                                          <div class="dd3-content"><span id="label_show'.$value['_id'].'">'.$value['title'].'</span> 
                                              <span class="span-right">/<span id="link_show'.$value['_id'].'">'.$value['uri'].'</span> &nbsp;&nbsp;  
                                                  <a class="edit-button" id="'.$value['_id'].'" label="'.$value['title'].'" link="'.$value['uri'].'" ><i class="fa fa-edit"></i></a>  &nbsp; 
                                                  <a class="del-button" id="'.$value['_id'].'"><i class="fa fa-trash"></i></a></span> 
                                          </div>';
                              if(array_key_exists('child',$value)) {
                                  $html .= get_menu($value['child'],'child');
                              }
                                  $html .= "</li>";
                          }
                          $html .= "</ol>";
                          return $html;
                      }
                      print get_menu($items);
                    ?>
                  </div>
                  <input type="hidden" id="nestable-output">
                </div>
              </div>
          </div>
        </div>
      </div>
</section>
<script type="text/javascript">
  $(document).ready(function(){
    $('.link').show();
        $('.page').hide();
        $('.kategori').hide();
        $('#radio1').change(function(){
            if(this.checked)
            $('.link').fadeIn('slow');
            $('.page').fadeOut('slow').val("");
            $('.kategori').fadeOut('slow').val("");
        });

        $('#radio2').change(function(){
            if(this.checked)
            $('.page').fadeIn('slow');
            $('.link').fadeOut('slow').val("");
            $('.kategori').fadeOut('slow').val("");
        });

        $('#radio3').change(function(){
            if(this.checked)
            $('.kategori').fadeIn('slow');
            $('.page').fadeOut('slow').val("");
            $('.link').fadeOut('slow').val("");
        });
  });

  $(document).ready(function(){
        var updateOutput = function(e){
            var list   = e.length ? e : $(e.target),
                output = list.data('output');
            if (window.JSON) {
                output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
            } else {
                output.val('JSON browser support required for this demo.');
            }
        };

        // activate Nestable for list 1
        $('#nestable').nestable({
            group: 1
        })
        .on('change', updateOutput);

        // output initial serialised data
        updateOutput($('#nestable').data('output', $('#nestable-output')));
        $('#nestable-menu').on('click', function(e){
            var target = $(e.target),
                action = target.data('action');
            if (action === 'expand-all') {
                $('.dd').nestable('expandAll');
            }
            if (action === 'collapse-all') {
                $('.dd').nestable('collapseAll');
            }
        });
    });
</script>

<script type="text/javascript">
  $(document).ready(function(){
      $("#load").hide();
      $("#submit").click(function(){
          $("#load").show();

          var dataString = { 
                  label : $("#label").val(),
                  link : $("#link").val(),
                  page : $("#page").val(),
                  kategori : $("#kategori").val(),
                  id : $("#id").val()
              };

          $.ajax({
              type: "POST",
              url: "<?= base_url(); ?>/admin/save_menuwebsite",
              data: dataString,
              dataType: "json",
              cache : false,
              success: function(data){
                  if(data.type == 'add'){
                      $("#menu-id").append(data.menu);
                  } else if(data.type == 'edit'){
                      $('#label_show'+data.id).html(data.label);
                      $('#link_show'+data.id).html(data.link);
                      $('#page_show'+data.id).html(data.page);
                      $('#kategori_show'+data.id).html(data.kategori);
                  }
                  $('#label').val('');
                  $('#link').val('');
                  $('#page').val('');
                  $('#kategori').val('');
                  $('#id').val('');
                  $("#load").hide();
              } ,error: function(xhr, status, error) {
                  alert(error);
              },
          });
      });

      $('.dd').on('change', function() {
          $("#load").show();
              var dataString = $("#nestable-output").val();

          $.ajax({
              type: "POST",
              url: "<?= base_url(); ?>/admin/savedragmenu",
              data: {data:dataString},
              cache : false,
              success: function(data){
                  $("#load").hide();
              } ,error: function(xhr, status, error) {
                  alert(error);
              },
          });
          console.log(dataString);
      });

      $(document).on("click",".del-button",function() {
          var id = $(this).attr('id');
            Swal.fire({
              title: 'Apakah yakin?',
              text: "Apakah anda ingin menghapus data ?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              cancelButtonText:'Tidak',
              confirmButtonText: 'Ya, Hapus Sekarang',
            }).then((result) => {
              if (result.isConfirmed) {
                $.ajax({
                  type: "POST",
                  url: "<?php echo base_url(); ?>/admin/deletemenu",
                  dataType:'json',
                  data: { id : id },
                  cache : false,
                  success: function(data){
                    $("li[data-id='" + id +"']").remove();
                    Swal.fire(
                      'Terhapus!',
                      'Data yang anda pilih telah dihapus.',
                      'success'
                    )
                  },
                  error: function(){
                    Swal.fire(
                      'Gagal',
                      'Data yang anda pilih gagal terhapus.',
                      'error'
                    )
                  }
                });
              }
            })
      });

      $(document).on("click",".edit-button",function() {
          var id = $(this).attr('id');
          var label = $(this).attr('label');
          var link = $(this).attr('link');
          $("#id").val(id);
          $("#label").val(label);
          $("#link").val(link);
      });

      $(document).on("click","#reset",function() {
          $('#label').val('');
          $('#link').val('');
          $('#id').val('');
      });
  });
</script>