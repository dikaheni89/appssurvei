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
            <div class="row">
                <div id="dynamic_field" class="col-sm-10">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Pilih Usia</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="select2_usia" name="idusia[]">
                            <option value=""></option>
                            <?php foreach ($usia as $row) : ?>
                                <option value="<?= $row['_id'];?>"><?= $row['usia'];?> Tahun</option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
        			<div class="form-group row">
                        <label class="col-sm-2 col-form-label">Jumlah Laki-Laki</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="jml_pria[]" id="jml_pria" placeholder="Jumlah Laki-Laki" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Jumlah Perempuan</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="jml_perempuan[]" id="jml_perempuan" placeholder="Jumlah Perempuan" autocomplete="off">
                        </div>
                    </div>
                </div>
                <hr/>
            </div>

            <div class="row">
                <div class="col-sm-10">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <a href="javascript:void(0);" id="add" name="add" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Survei</a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tanggal Survei</label>
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
        $("#select2_usia").select2({
            placeholder: "Select a Usia",
            allowClear: true
        });      
    });

    var i=1;
    $(function() {  
          $('#add').click(function(){  
               i++;  
               $('#dynamic_field').append('<div id="child'+i+'">'+
                        '<div class="form-group row">'+
                        '<label class="col-sm-2 col-form-label">Pilih Usia</label>'+
                        '<div class="col-sm-4">'+
                            '<select class="form-control" id="select2_usia" name="idusia[]">'+
                            '<option value=""></option>'+
                            <?php foreach ($usia as $row) : ?>
                            '<option value="<?= $row['_id'];?>"><?= $row['usia'];?> Tahun</option>'+
                            <?php endforeach; ?>
                            '</select>'+
                        '</div>'+
                        '</div>'+
                        '<div class="form-group row">'+
                            '<label class="col-sm-2 col-form-label">Jumlah Laki-Laki</label>'+
                            '<div class="col-sm-6">'+
                                '<input class="form-control" type="text" name="jml_pria[]" id="jml_pria" placeholder="Jumlah Laki-Laki" autocomplete="off">'+
                            '</div>'+
                        '</div>'+
                        '<div class="form-group row">'+
                            '<label class="col-sm-2 col-form-label">Jumlah Perempuan</label>'+
                            '<div class="col-sm-6">'+
                                '<input class="form-control" type="text" name="jml_perempuan[]" id="jml_perempuan" placeholder="Jumlah Perempuan" autocomplete="off">'+
                            '</div>'+
                        '</div>'+
                        '<div class="form-group row">'+
                            '<label class="col-sm-2 col-form-label"></label>'+
                            '<div class="col-sm-10">'+
                                '<a href="javascript:void(0);" id="'+i+'" name="remove" class="btn btn-danger btn_remove"><i class="fa fa-close"></i> Hapus</a>'+
                            '</div>'+
                            
                        '</div>'+
                '<hr>'+
            '</div></div>');  
          });
      });

    $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#child'+button_id+'').remove();  
      });
    
    $(function() {
        $("#tgl_survei").datepicker({ 
            format: "yyyy-mm-dd",
            autoclose:true
        });
    });

    $("#form-validation").validate({
            rules: {
                'jml_pria[]':{
                    required: !0
                },
                'jml_perempuan[]':{
                    required: !0
                },
                'idusia[]':{
                    required: !0,
                },
            },
            messages:{
                'jml_pria[]':{
                    required:"Jumlah survei Pria Harus Diisi"
                },
                'jml_perempuan[]':{
                    required:"Jumlah Survei Perempuan Harus Diisi"
                },
                'idusia[]':{
                    required: "Usia Harus Dipilih"
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
                    url : "<?= base_url('admin/savesurveiusia')?>",
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
                              window.location.href="<?= base_url('admin/inputsurveipenduduk')?>";
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