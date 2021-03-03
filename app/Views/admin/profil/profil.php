<div class="col-12">
<div class="ibox">
    <div class="ibox-head">
        <div class="ibox-title"><?= $title;?></div>
        <div class="ibox-tools">
            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
        </div>
    </div>
    <div class="ibox-body">
        <form method="post" id="form-users" action="javascript:;" novalidate="novalidate">
            <input type="hidden" name="id" value="<?= $profil['_id']; ?>">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" name="user" id="user" value="<?= $profil['user']; ?>" placeholder="Username" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" name="full_name" id="full_name" value="<?= $profil['full_name']; ?>" placeholder="Nama Lengkap" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" name="email" id="email" value="<?= $profil['email']; ?>" placeholder="Email" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">No. Telp</label>
                <div class="col-sm-6">
                    <input class="form-control" type="number" name="phone" id="phone" value="<?= $profil['phone']; ?>" placeholder="Nomor Telp" autocomplete="off">
                    <span class="span"></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Level User</label>
                <div class="col-sm-4">
                    <select class="form-control" id="select2_level" name="is_level">
                    <option value=""></option>
                    <?php foreach ($level as $row) : ?>
                        <?php if ($profil['is_level'] == $row['_id']) : ?>
                            <option value="<?= $row['_id'];?>" selected="selected"><?= $row['level'];?></option>
                        <?php else : ?>
                            <option value="<?= $row['_id'];?>"><?= $row['level'];?></option>
                        <?php endif ; ?>
                    <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div id="provinsi"></div>
            <div id="kabupaten"></div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-4">
                    <label class="ui-radio ui-radio-inline">
                        <input type="radio" name="is_active" value="1" checked="">
                    <span class="input-span"></span>Active</label>
                    <label class="ui-radio ui-radio-inline">
                        <input type="radio" name="is_active" value="0">
                    <span class="input-span"></span>Non Active</label>
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
        $("#select2_level").select2({
            placeholder: "Select a Level Users",
            allowClear: true
        });
        $('#select2_level').change(function(){
            var value = $(this).val();
            let html ='';
            if (value == 3){
                html += '<div class="form-group row">';
                html += '<label class="col-sm-2 col-form-label">Provinsi</label>';
                html += '<div class="col-sm-4">';
                html += '<select class="form-control" id="select2_provinsi" name="is_prov">';
                html += '<option value=""></option>';
                html += '</select>';
                html += '</div>';
                html += '</div>';
                $('#provinsi').html(html);
                $('#select2_provinsi').select2({
                    placeholder: 'Pilih Provinsi',
                    allowClear: true,
                    ajax: {
                      url: "<?php echo base_url('admin/comboprovinsi');?>",
                      dataType: 'json',
                      delay: 250,
                      processResults: function (data) {
                        return {
                          results: data.result
                        };
                      },
                      cache: false
                    }
                  });
                carikab();
            }else{
                $('#provinsi').html('');
                $('#kabupaten').html('');
            }
        });

        function carikab()
        {
            $('#select2_provinsi').change(function(){
            var value = $(this).val();
            let html ='';
            console.log(value);
            html += '<div class="form-group row">';
            html += '<label class="col-sm-2 col-form-label">Kabupaten</label>';
            html += '<div class="col-sm-4">';
            html += '<select class="form-control" id="select2_kab" name="is_kab">';
            html += '<option value=""></option>';
            html += '</select>';
            html += '</div>';
            html += '</div>';
            $('#kabupaten').html(html);
            $('#select2_kab').select2({
                placeholder: 'Pilih kabupaten Kabupaten',
                allowClear: true,
                ajax: {
                  url: "<?php echo base_url('admin/combokabupaten');?>",
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
        });

        }
        
        $("#form-users").validate({
            rules: {
                user:{
                    required: !0,
                    minlength: 4
                },
                full_name:{
                    required: !0,
                    minlength: 2
                },
                email:{
                    required: !0,
                    email: true,
                    remote:{
                        url:"<?= base_url('admin/getUserByEmail')?>",
                        type:"POST",
                        data: {<?= csrf_token() ?>: '<?= csrf_hash() ?>', 
                            q:function(){
                                return $( "#email" ).val();
                            }
                        },
                        dataType: 'json'
                    }
                },
                is_level:{
                    required: !0,
                },
            },
            messages:{
                user:{
                    required:"Username Harus Diisi",
                    minlength:"Username Minimal 4 Karakter"
                },
                full_name:{
                    required:"Nama Lengkap Harus Diisi",
                    minlength:"Nama Lengkap Minimal 2 Karakter"
                },
                email:{
                    required: "Alamat Email Harus Diisi",
                    email: "Alamat Email Tidak Valid",
                    remote: "Alamat Email Sudah Digunakan, Mohon Diganti."
                },
                is_level:"Level user harus diisi."
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
                var user = $('input[name=user]').val();
                var name = $('input[name=full_name]').val();
                var email = $('input[name=email]').val();
                var phone = $('input[name=phone]').val();
                var level = $('#select2_level').val();
                var radio = $('input[name=is_active]:checked').val();
                var prov = $('#select2_provinsi').val();
                var kab = $('#select2_kab').val();
                if (prov == 'undefined'){
                    prov = 0;
                }
                if (kab == 'undefined'){
                    kab == 0;
                }
                $.ajax({
                    type: "POST",
                    url : "<?= base_url('admin/updateprofil')?>",
                    data: {<?= csrf_token() ?>:'<?= csrf_hash() ?>',id:id, user:user, email:email, full_name: name, phone: phone, is_active: radio, is_level:level, is_prov:prov, is_kab:kab},
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
                              window.location.href="<?= base_url('admin/users')?>";
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
        window.location = location.origin+'/'+pathparts[1].trim('/')+'/users';
    }
</script>