<div class="col-12">
  <div class="ibox">
      <div class="ibox-head">
          <div class="ibox-title"><?= $title; ?></div>
      </div>
      <div class="ibox-body">
        <p></p>
        <table id="survei" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	        <thead>
	            <tr>
                <th>No</th>
                <th>Kategori Survei</th>
                <th>Nama Survei</th>
                <th>Inputan Survei</th>
                <th>Subinput Survei</th>
                <th>Jumlah</th>
                <th>Tanggal Survei</th>
	            </tr>
	        </thead>
	    </table>
  </div>
</div>

<div class="col-lg-12">
  <div class="ibox">
      <div class="ibox-head">
          <div class="ibox-title">Chart Data Pelaporan Survei</div>
      </div>
      <div class="ibox-body">
        <div class="row">
            <div class="col-sm-3">
                <div id="filter_tgl" class="input-group" style="display: inline;">
                    <button class="btn btn-default" id="daterange-btn" style="line-height:16px;border:1px solid #ccc">
                        <i class="fa fa-calendar"></i> <span id="reportrange"><span> Pilih Tanggal</span></span>
                        <i class="fa fa-caret-down"></i>
                    </button>
                </div>
            </div>
            <div class="col-sm-6 pull-right">
                <a href="javascript:void(0);" id="btn_serachasync" class="btn btn-success m-r-5" onclick="requestData()">
                  <i class="ti-search"></i> Search
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <figure class="highcharts-figure">
                    <div id="container"></div>
                </figure>
            </div>
        </div>
      </div>
  </div>
</div>
<script type="text/javascript">
  var startdate='';
  var enddate='';
  $(document).ready(function (){
    fm_filter_tgl();
    searchcart(startdate,enddate);

    var table = $('#survei').DataTable({
        "processing": true,
        "serverSide": true,
        responsive: true,
        "ajax":{
          "url": "<?= base_url('admin/getsurvei') ?>",
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
             { "data": "kt_survei"},
             { "data": "nm_survei"},
             { "data": "nm_input"},
             { "data": "nm_subinput"},
             { "data": "jumlah"},
             { "data": "tgl_survei"},
           ],
      });
  });

  function searchcart(){
      $.ajax({
          url: 'getchartsurvei',
          type: "POST",
          data:{<?= csrf_token() ?>:'<?= csrf_hash() ?>',start:startdate,end:enddate},
          dataType: "json",
          success: function(data) {
              piechart(data.chart, data.total, data.drilldown);
          },
          cache: false
      });
  }

    function fm_filter_tgl() {
        $('#daterange-btn').daterangepicker({
            ranges: {
                'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
                'Bulan kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                'Tahun ini': [moment().startOf('year').startOf('month'), moment().endOf('year').endOf('month')],
                'Tahun kemarin': [moment().subtract(1 , 'year').startOf('year').startOf('month'), moment().subtract(1 , 'year').endOf('year').endOf('month')]
            },
            showDropdowns: true,
            format: 'YYYY-MM-DD',
            startDate: moment().startOf('year').startOf('month'),
            endDate: moment().endOf('year').endOf('month')
        },
    
        function(start, end) {
            $('#reportrange span').html(start.format('D MMM YYYY') + ' - ' + end.format('D MMM YYYY'));
            startdate=$('input[name=daterangepicker_start]').val();
            enddate=$('input[name=daterangepicker_end]').val();
            console.log(startdate);
            searchcart(startdate,enddate);
        });
    }

  function piechart(data,total,drilldown)
  {
      Highcharts.chart('container', {
          chart: {
              type: 'column'
          },
          title: {
              text: 'Data Pelaporan Survei'
          },
          subtitle: {
              text: ''
          },
          accessibility: {
              announceNewData: {
                  enabled: true
              }
          },
          xAxis: {
              type: 'category'
          },
          yAxis: {
              title: {
                  text: 'Total percent market share'
              }

          },
          legend: {
              enabled: false
          },
          plotOptions: {
              series: {
                  borderWidth: 0,
                  dataLabels: {
                      enabled: true,
                      format: '{point.y}'
                  }
              }
          },

          tooltip: {
              headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
              pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> of total<br/>'
          },

          series: [{
                  name: "Value",
                  colorByPoint: true,
                  data: data
              }],
          drilldown: {
              series: drilldown
          }
      });
  }
</script>