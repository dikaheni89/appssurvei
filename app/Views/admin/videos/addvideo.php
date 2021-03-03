<div class="col-12">
<div class="ibox">
    <div class="ibox-head">
        <div class="ibox-title"><?= $title;?></div>
        <div class="ibox-tools">
            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
        </div>
    </div>
    <div class="ibox-body">
		<form method="post" id="form-validation" action="javascript:;" novalidate="novalidate">
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" name="title" placeholder="Title" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Url Youtube</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" name="uri" placeholder="Url Youtube" autocomplete="off">
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
        $("#form-validation").validate({
            rules: {
                title:{
                    required: !0,
                    minlength: 4
                },
                uri:{
                    required: !0,
                },
            },
            messages:{
                title:{
                    required:"Title Video harus diisi",
                    minlength:"Title Minimal 4 Karakter"
                },
                uri:{
                    required:"Url harus diisi",
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
                var uri = $('input[name=uri]').val();
                $.ajax({
                    type: "POST",
                    url : "<?= base_url('admin/savevideo')?>",
                    data: {<?= csrf_token() ?>:'<?= csrf_hash() ?>',title:title, uri:uri},
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
                              window.location.href="<?= base_url('admin/videos')?>";
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
        window.location = location.origin+'/'+pathparts[1].trim('/')+'/videos';
    }
</script>