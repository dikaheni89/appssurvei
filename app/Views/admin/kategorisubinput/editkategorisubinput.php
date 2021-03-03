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
            <input type="hidden" name="id" value="<?= $subinput['_id']; ?>">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pilih Kategori Input</label>
                <div class="col-sm-6">
                    <select class="form-control" id="select2_kategoriinput" name="idinput">
                    <option value=""></option>
                    <?php foreach ($input as $row) : ?>
                        <?php if ($subinput['idinput'] == $row['_id']) : ?>
                            <option value="<?= $row['_id'];?>" selected="selected"><?= $row['nm_input'];?></option>
                        <?php else : ?>
                            <option value="<?= $row['_id'];?>"><?= $row['nm_input'];?></option>
                        <?php endif ; ?>
                    <?php endforeach; ?>
                    </select>
                </div>
            </div>
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Kategori Subinput</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" name="nm_subinput" value="<?= $subinput['nm_subinput']; ?>" autocomplete="off">
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
        $("#select2_kategoriinput").select2({
            placeholder: "Select a Nama Kategori Input",
            allowClear: true
        }); 
        $("#form-validation").validate({
            rules: {
                idinput:{
                    required: !0
                },
                nm_subinput:{
                    required: !0
                },
            },
            messages:{
                idinput:{
                    required:"Pilihan Nama Kategori Input harus diisi"
                },
                nm_subinput:{
                    required:"Nama Kategori Subinput harus diisi"
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
                var nm_subinput = $('input[name=nm_subinput]').val();
                var idinput = $('#select2_kategoriinput').val();
                var id = $('input[name=id]').val();
                $.ajax({
                    type: "POST",
                    url : "<?= base_url('admin/updatekategorisubinput')?>",
                    data: {<?= csrf_token() ?>:'<?= csrf_hash() ?>',nm_subinput:nm_subinput, idinput:idinput, id:id},
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
                              window.location.href="<?= base_url('admin/kategorisubinput')?>";
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
    });
    
    function backButton()
    {
        var pathparts = location.pathname.split('/');
        window.location = location.origin+'/'+pathparts[1].trim('/')+'/kategorisubinput';
    }
</script>