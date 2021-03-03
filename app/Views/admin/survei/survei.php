<div class="col-12">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title"><?= $title;?></div>
            <div class="ibox-tools">
                <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
            </div>
        </div>
        <div class="ibox-body">
            <table id="kategorisurvei" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th>No</th>
                      <th></th>
                      <th>Kategori Survei</th>
                  </tr>
              </thead>
          </table>
    	</div>
    </div>
</div>
<script type="text/javascript">
  $(document).ready(function (){
    var table = $('#kategorisurvei').DataTable({
        "processing": true,
        "serverSide": true,
        responsive: true,
        "ajax":{
          "url": "<?= base_url('admin/getdatasurvei') ?>",
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
            { "data": "no",
              "searchable": false,
              "orderable":false,
              "width": "10%"
            },
            { "data": "kt_survei"},
           ],
            columnDefs: [
            {  targets: 1,
               "width": "20%",
               "align":"center",
               render: function (data, type, row, meta) {
                  return '<button class="btn btn-info btn-sm detail" id=id-' + meta.row + '/><i class="fas fa-chart-area"></i> Survei</button>';
               }

            }
          ]
      });
    $('#kategorisurvei tbody').on('click', '.detail', function () {
      var id = $(this).attr("id").match(/\d+/)[0];
      var data = $('#kategorisurvei').DataTable().row( id ).data();
      window.location.href="<?= base_url('admin/inputsurvei')?>/"+data._id;
    });
  });
</script>