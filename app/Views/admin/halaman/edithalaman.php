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
            <input type="hidden" name="id" value="<?= $halaman['_id']; ?>">
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="title" value="<?= $halaman['title']; ?>" placeholder="Title" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-10">
                    <textarea id="summernote" data-plugin="summernote" class="form-control" value="<?= $halaman['deskripsi']; ?>" name="deskripsi"><?= $halaman['deskripsi']; ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file" name="image" id="image" placeholder="Cover Image">
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
        $("#form-validation").validate({
            rules: {
                title:{
                    required: !0,
                    minlength: 4
                }
            },
            messages:{
                title:{
                    required:"Title Image harus diisi",
                    minlength:"Title Minimal 4 Karakter"
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
                var id = $('input[name=id]').val();
                var title = $('input[name=title]').val();
                var deskripsi = $('#summernote').summernote('code');
                var file_data = $('#image').prop('files')[0];
                var form = new FormData();
                form.append('id',id);
                form.append('title',title);
                form.append('deskripsi',deskripsi);
                form.append('image',file_data);
                $.ajax({
                    type: "POST",
                    url : "<?= base_url('admin/updatehalaman')?>",
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
                              window.location.href="<?= base_url('admin/halaman')?>";
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
        window.location = location.origin+'/'+pathparts[1].trim('/')+'/halaman';
    }
</script>