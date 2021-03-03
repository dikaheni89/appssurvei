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
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" name="title" placeholder="Title" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kategori Berita</label>
                <div class="col-sm-6">
                    <select class="form-control" id="select2_kategori" name="kategorimenu_id">
                    <option value=""></option>
                    <?php foreach ($kategori as $row) : ?>
                        <option value="<?= $row['_id'];?>"><?= $row['title'];?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Headlines</label>
                <div class="col-sm-6">
                    <select class="form-control" id="select2_headline" name="headline">
                    <option value=""></option>
                        <option value="1">Ya</option>
                        <option value="2">Tidak</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Photo Berita</label>
                <div class="col-sm-6">
                    <input class="form-control" type="file" name="image" id="image" placeholder="Cover Image">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-6">
                    <textarea id="summernote" data-plugin="summernote" class="form-control" name="deskripsi"></textarea>
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-sm-10 ml-sm-auto">
                	<a href="javascript:void(0)" class="btn btn-warning" onclick="backButton()"><i class="fa fa-history"></i> Back</a>
                    <button class="btn btn-info submit" type="botton" name="submit"> <i class="fa fa-save"></i> Submit</button>
                </div>
            </div>
		</form>
	</div>
</div>
</div>
<script type="text/javascript">

    $(document).ready(function (){
        $('#summernote').summernote();
        $("#select2_kategori").select2({
            placeholder: "Select a Kategori Berita",
            allowClear: true
        });
        $("#select2_headline").select2({
            placeholder: "Select a Headline",
            allowClear: true
        });
        $("#form-validation").validate({
            rules: {
                title:{
                    required: !0,
                    minlength: 4
                },
                headline:{
                    required: !0,
                },
                kategorimenu_id:{
                    required: !0,
                },
                image:{
                    required: !0,
                },
            },
            messages:{
                title:{
                    required:"Title Berita harus diisi",
                    minlength:"Title Minimal 4 Karakter"
                },
                headline:{
                    required:"Headline Berita harus diisi",
                },
                kategorimenu_id:{
                    required:"Pilih Kategori Berita Tidak Boleh Kosong",
                },
                image:{
                    required:"Image harus diisi"
                }
            },
            errorClass: "help-block error",
            highlight: function(e) {
                $(e).closest(".form-group.row").addClass("has-error")
            },
            unhighlight: function(e) {
                $(e).closest(".form-group.row").removeClass("has-error")
            },
            submitHandler:function(form){
                var title = $('input[name=title]').val();
                var deskripsi = $('#summernote').summernote('code');
                var kategori = $('#select2_kategori').val();
                var headline = $('#select2_headline').val();
                var file_data = $('#image').prop('files')[0];
                var form = new FormData();
                form.append('kategorimenu_id',kategori);
                form.append('title',title);
                form.append('headline',headline);
                form.append('deskripsi',deskripsi);
                form.append('image',file_data);
                $.ajax({
                    type: "POST",
                    url : "<?= base_url('admin/saveberita')?>",
                    async:false,
                   enctype: 'multipart/form-data',
                   processData: false,
                   contentType: false,
                    data: form,
                    headers: {
                       'X-CSRF-TOKEN': '<?= csrf_hash() ?>' 
                    },
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
                              window.location.href="<?= base_url('admin/berita')?>";
                            },1000);
                        }
                    },
                    error:function(msg)
                    {
                      Toast.fire({
                      	type: 'error',
                      	title: ''+msg+'.'
                      })
                    }
                }); 
            }
        });
    });
    
    function backButton()
    {
        var pathparts = location.pathname.split('/');
        window.location = location.origin+'/'+pathparts[1].trim('/')+'/berita';
    }
</script>