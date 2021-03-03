<div class="col-lg-3 col-md-6">
    <div class="ibox bg-success color-white widget-stat">
        <div class="ibox-body">
            <h2 class="m-b-5 font-strong"><?= number_format($survei, 0); ?></h2>
            <div class="m-b-5">Total Survei</div><i class="ti-bar-chart widget-stat-icon"></i>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="ibox bg-info color-white widget-stat">
        <div class="ibox-body">
            <h2 class="m-b-5 font-strong"><?= number_format($video, 0); ?></h2>
            <div class="m-b-5">Total Video</div><i class="ti-video-clapper widget-stat-icon"></i>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="ibox bg-warning color-white widget-stat">
        <div class="ibox-body">
            <h2 class="m-b-5 font-strong"><?= number_format($berita, 0); ?></h2>
            <div class="m-b-5">Total Berita</div><i class="ti-rss widget-stat-icon"></i>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="ibox bg-danger color-white widget-stat">
        <div class="ibox-body">
            <h2 class="m-b-5 font-strong"><?= number_format($user, 0); ?></h2>
            <div class="m-b-5">Users</div><i class="ti-user widget-stat-icon"></i>
        </div>
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
    });

    function searchcart(){
        $.ajax({
            url: 'admin/getchartsurvei',
            type: "POST",
            data:{start:startdate,end:enddate},
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
                'Bulan kemarin': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')],
                'Tahun ini': [moment().startOf('year').startOf('month'), moment().endOf('year').endOf('month')],
                'Tahun kemarin': [moment().subtract('year', 1).startOf('year').startOf('month'), moment().subtract('year', 1).endOf('year').endOf('month')]
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