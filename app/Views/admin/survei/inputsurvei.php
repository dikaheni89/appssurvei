<div class="col-12">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title"><?= $title;?></div>
            <div class="ibox-tools">
                <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
            </div>
        </div>
        <div class="ibox-body">
    		<form method="post" id="form-validation" action="javascript:;" enctype="multipart/form-data" novalidate="novalidate">
            <?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= $id; ?>" />
            <div class="row">
                <div id="dynamic_field" class="col-sm-10">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Pilih Nama Survei</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="select2_namasurvei" name="idnmsurvei">
                            <option value=""></option>
                            <?php foreach ($nmsurvei as $row) : ?>
                                <option value="<?= $row['_id'];?>"><?= $row['nm_survei'];?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div id="inputdata"></div>
                    <div id="subinputdata"></div>
        			<div class="form-group row">
                        <label class="col-md-2 col-form-label">Jumlah</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="number" name="jumlah" id="jumlah" placeholder="Jumlah" autocomplete="off">
                        </div>
                    </div>
                </div>
                <hr/>
            </div>

            <div class="row">
                <div class="col-sm-10">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Tanggal Survei</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="tgl_survei" id="tgl_survei" placeholder="Tanggal Survei" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 ml-sm-auto">
                        	<a href="javascript:void(0)" class="btn btn-warning" onclick="backButton()"><i class="fa fa-history"></i> Back</a>
                            <button class="btn btn-info submit" type="botton" name="submit"> <i class="fa fa-save"></i> Submit</button>
                        </div>
                    </div>
                </div>
            </div>
    		</form>
    	</div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function (){  
        $("#select2_namasurvei").select2({
            placeholder: "Select a Nama Survei",
            allowClear: true
        });

        $("#select2_inputdata").select2({
            placeholder: "Select a Data Input",
            allowClear: true
        }); 

        $("#select2_subinputdata").select2({
            placeholder: "Select a Data Subinput",
            allowClear: true
        }); 

        $('#select2_namasurvei').change(function(){
            var value = $(this).val();
            let html ='';
            $('#inputdata').html('');
            $('#subinputdata').html('');
            html += '<div class="form-group row">';
            html += '<label class="col-md-2 col-form-label">Pilih Input Kategori</label>';
            html += '<div class="col-sm-6">';
            html += '<select class="form-control" id="select2_inputdata" name="idinput">';
            html += '<option value=""></option>';
            html += '</select>';
            html += '</div>';
            html += '</div>';
            $('#inputdata').html(html);
            $("#select2_inputdata").select2({
                placeholder: 'Pilih Input Kategori',
                allowClear: true,
                ajax: {
                  url: "<?php echo base_url('admin/comboinput');?>",
                  dataType: 'json',
                  type:'POST',
                  data:{<?= csrf_token() ?>: '<?= csrf_hash() ?>', id:value},
                  delay: 250,
                  processResults: function (data) {
                    return {
                      results: data.result
                    };
                  },
                  cache: false
                }
            });
            $('#select2_inputdata').change(function(){
                var input = $(this).val();
                console.log(input);
                let htmlsub = '';
                if (input == ''){
                    $('#subinputdata').html('');
                }else{
                    htmlsub += '<div class="form-group row">';
                    htmlsub += '<label class="col-md-2 col-form-label">Pilih Subinput Kategori</label>';
                    htmlsub += '<div class="col-sm-6">';
                    htmlsub += '<select class="form-control" id="select2_subinputdata" name="idsubinput">';
                    htmlsub += '<option value=""></option>';
                    htmlsub += '</select>';
                    htmlsub += '</div>';
                    htmlsub += '</div>';
                    $('#subinputdata').html(htmlsub);
                    $('#select2_subinputdata').select2({
                        placeholder: 'Pilih Subinput Kategori',
                        allowClear: true,
                        ajax: {
                          url: "<?php echo base_url('admin/combosubinput');?>",
                          dataType: 'json',
                          type:'POST',
                          data:{<?= csrf_token() ?>: '<?= csrf_hash() ?>', id:input},
                          delay: 250,
                          processResults: function (data) {
                            return {
                              results: data.result
                            };
                          },
                          cache: false
                        }
                      });
                }
            });
        });     
    });
    
    $(function() {
        $("#tgl_survei").datepicker({ 
            format: "yyyy-mm-dd",
            autoclose:true
        });
    });

    $("#form-validation").validate({
            rules: {
                'jumlah':{
                    required: !0
                },
            },
            messages:{
                'jumlah':{
                    required:"Jumlah survei Harus Diisi"
                },
            },
            errorClass: "help-block error",
            highlight: function(e) {
                $(e).closest(".form-group.row").addClass("has-error")
            },
            unhighlight: function(e) {
                $(e).closest(".form-group.row").removeClass("has-error")
            },
            submitHandler:function(form){
                var formdata=$('#form-validation').serialize();
                $.ajax({
                    type: "POST",
                    url : "<?= base_url('admin/savesurvei')?>",
                    data: formdata,
                    success: function(msg){
                        var msg = eval('('+msg+')');
                        if (msg.errorMsg){
                            Swal.fire(
                                'Error!',
                                ''+msg.errorMsg+'.',
                                'error'
                              )
                        } else {
                            Swal.fire(
                                'Sukses!',
                                ''+msg.message+'.',
                                'success'
                              )
                            window.setTimeout(function(){
                              window.location.href="<?= base_url('admin/inputsurvei/'.$id)?>";
                            },1000);
                        }
                    },
                    error:function(msg)
                    {
                        console.log(msg);
                    }
                }); 
            }
        });

    function backButton()
    {
        var pathparts = location.pathname.split('/');
        window.location = location.origin+'/'+pathparts[1].trim('/')+'/';
    }
</script>