<div class="content">
    <!--  section  -->
    <section class="parallax-section single-par" data-scrollax-parent="true">
        <div class="bg par-elem "  data-bg="<?= base_url('uploads/image.jpg'); ?>" data-scrollax="properties: { translateY: '30%' }"></div>
        <div class="overlay op7"></div>
        <div class="container">
            <div class="section-title center-align big-title">
                <h2><span>Data Statistik Survei</span></h2>
                <span class="section-separator"></span>
            </div>
        </div>
        <div class="header-sec-link">
            <a href="#sec1" class="custom-scroll-link"><i class="fal fa-angle-double-down" style="color: #2e3f6e;"></i></a> 
        </div>
    </section>
    <section>
        <div class="container">
            <!--about-wrap -->
            <div class="about-wrap">
                <div class="row">
                    <div class="col-md-12">
                        <div class="ab_text" style="text-align: justify;">
                            <div class="ibox-body">
                                <!-- <div class="row">
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
                                </div> -->
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
                </div>
            </div>
            <!-- about-wrap end  --> 
        </div>
    </section>

    <section>
        <div class="container">
            <!--about-wrap -->
            <div class="about-wrap">
                <div class="row">
                    <div class="col-md-12">
                        <div class="ab_text" style="text-align: justify;">
                            <div class="ibox-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <figure class="highcharts-figure">
                                            <div id="containerusia"></div>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- about-wrap end  --> 
        </div>
    </section>

    <section>
        <div class="container">
            <!--about-wrap -->
            <div class="about-wrap">
                <div class="row">
                    <div class="col-md-12">
                        <div class="ab_text" style="text-align: justify;">
                            <div class="ibox-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <figure class="highcharts-figure">
                                            <div id="containerkerja"></div>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- about-wrap end  --> 
        </div>
    </section>
    <div class="limit-box fl-wrap"></div>
</div>

<script type="text/javascript">
  $(document).ready(function (){
    searchcart();
  });

  function searchcart(){
      $.ajax({
          url: 'getchartsurveiweb',
          type: "GET",
          dataType: "json",
          success: function(data) {
              piechart(data.chart, data.total, data.drilldown);
          },
          cache: false
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
                  text: 'Total percentase'
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
