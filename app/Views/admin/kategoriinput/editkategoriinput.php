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
            <input type="hidden" name="id" value="<?= $input['_id']; ?>">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pilih Nama Survei</label>
                <div class="col-sm-6">
                    <select class="form-control" id="select2_namasurvei" name="idnmsurvei">
                    <option value=""></option>
                    <?php foreach ($nmsurvei as $row) : ?>
                        <?php if ($input['idnmsurvei'] == $row['_id']) : ?>
                            <option value="<?= $row['_id'];?>" selected="selected"><?= $row['nm_survei'];?></option>
                        <?php else : ?>
                            <option value="<?= $row['_id'];?>"><?= $row['nm_survei'];?></option>
                        <?php endif ; ?>
                    <?php endforeach; ?>
                    </select>
                </div>
            </div>
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Kategori Input</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" name="nm_input" value="<?= $input['nm_input']; ?>" autocomplete="off">
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
        $("#select2_namasurvei").select2({
            placeholder: "Select a Nama Survei",
            allowClear: true
        }); 
        $("#form-validation").validate({
            rules: {
                idnmsurvei:{
                    required: !0
                },
                nm_input:{
                    required: !0
                },
            },
            messages:{
                idnmsurvei:{
                    required:"Pilihan Nama survei harus diisi"
                },
                nm_input:{
                    required:"Nama Kategori Input harus diisi"
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
                var nm_input = $('input[name=nm_input]').val();
                var idnmsurvei = $('#select2_namasurvei').val();
                var id = $('input[name=id]').val();
                $.ajax({
                    type: "POST",
                    url : "<?= base_url('admin/updatekategoriinput')?>",
                    data: {<?= csrf_token() ?>:'<?= csrf_hash() ?>',nm_input:nm_input, idnmsurvei:idnmsurvei, id:id},
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
                              window.location.href="<?= base_url('admin/kategoriinput')?>";
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
        window.location = location.origin+'/'+pathparts[1].trim('/')+'/kategoriinput';
    }
</script>