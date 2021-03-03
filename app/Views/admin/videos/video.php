<div class="col-12">
  <div class="ibox">
      <div class="ibox-head">
          <div class="ibox-title"><?= $title; ?></div>
      </div>
      <div class="ibox-body">
        <a href="<?= base_url('admin/addvideo');?>" class="btn btn-success delete"><i class="ti-plus"></i> Tambah Video</a>
        <p></p>
        <table id="videos" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	        <thead>
	            <tr>
                  <th>No</th>
                  <th>Title</th>
                  <th>Uri</th>
	              <th></th>
	            </tr>
	        </thead>
	    </table>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function (){
    var table = $('#videos').DataTable({
        "processing": true,
        "serverSide": true,
        responsive: true,
        "ajax":{
          "url": "<?= base_url('admin/getvideos') ?>",
         "dataType": "json",
         "type": "POST",
         "data":{'<?= csrf_token(); ?>' : '<?= csrf_hash() ?>' }
      },
      "columns": [
            { "data": "no",
              "searchable": false,
              "orderable":false,
              "width": "10%"
            },
            { "data": "title" },
            { "data": "uri",
            	"orderable":false
        	},
           ],
            columnDefs: [
            {  targets: 3,
               "width": "20%",
               "align":"center",
               render: function (data, type, row, meta) {
                  return '<button class="btn btn-danger delete" id=id-' + meta.row + '/><i class="ti-trash"></i> Delete</button> <button class="btn btn-info edit" id=id-' + meta.row + '/><i class="ti-pencil-alt"></i> Edit</button>';
               }

            }
          ]
      });
    $('#videos tbody').on('click', '.delete', function () {
      var id = $(this).attr("id").match(/\d+/)[0];
      var data = $('#videos').DataTable().row( id ).data();
      Swal.fire({
        title: 'Apakah yakin?',
        text: "Apakah anda ingin menghapus data video "+data.title+" ?",
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
            url : "<?= base_url('admin/deletedvideo')?>",
            dataType:'json',
            data: {<?= csrf_token() ?>: '<?= csrf_hash() ?>' , id:data._id},
            success: function(msg){
              Swal.fire(
                'Terhapus!',
                'Data yang anda pilih telah dihapus.',
                'success'
              )
              table.ajax.reload( null, false );
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
    $('#videos tbody').on('click', '.edit', function () {
      var id = $(this).attr("id").match(/\d+/)[0];
      var data = $('#videos').DataTable().row( id ).data();
      window.location.href="<?= base_url('admin/editvideo')?>/"+data._id;
    });
  });
</script>