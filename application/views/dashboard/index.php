<script src="<?php echo base_url(); ?>assets/admin/vendor/chart/chart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/vendor/chart/utils.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/vendor/chart/analyser.js"></script>

<main role="main" class="dashboard-main">

<!--container-->
<div class="ml-3 mr-3">
  <div class="row pt-5 pb-5">

    <div class="col-md-4 order-md-2 mb-4">
      <h6 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">ÜRÜNLERİM</span>
      </h6>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between lh-condensed border-0">
          <div>
            <h6 class="my-0">YAYINDA</h6>
            <small class="text-muted"><a href="<?php echo site_url('dashboard/products') ?>">Tümünü Gör</a></small>
          </div>
          <span class="text-muted"><?php echo get_user_products_count($user->id); ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between lh-condensed border-0">
          <div>
            <h6 class="my-0">ONAY BEKLEYEN</h6>
            <small class="text-muted"><a href="<?php echo site_url('dashboard/products') ?>">Tümünü Gör</a></small>
          </div>
          <span class="text-muted"><?php echo get_user_pending_products_count($user->id); ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between lh-condensed border-0">
          <div>
            <h6 class="my-0">TASLAK</h6>
            <small class="text-muted"><a href="<?php echo site_url('dashboard/products') ?>">Tümünü Gör</a></small>
          </div>
          <span class="text-muted"><?php echo get_user_drafts_count($user->id); ?></span>
        </li>
      </ul>
    </div>

    <div class="col-md-4 order-md-2 mb-4">
      <h6 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">SİPARİŞLERİM</span>
      </h6>
      
      <ul class="list-group mb-3">
        <!-- <li class="list-group-item d-flex justify-content-between lh-condensed border-0">
            <div id="piechart" style="width: 100%; height: 150px;"></div>
        </li>   -->
        <li class="list-group-item d-flex justify-content-between lh-condensed border-0">
          <div>
            <h6 class="my-0">DEVAM EDEN SİPARİŞLER</h6>
          </div>
          <span class="text-muted text-danger">
            <?php echo $this->dashboard_model->get_vendor_orders_count($user->id); ?>
            <small class="text-muted">
              <a href="<?php echo site_url('dashboard/orders') ?>">Tümünü Gör</a>
            </small>
          </span>
        </li>
        <li class="list-group-item d-flex justify-content-between lh-condensed border-0">
          <div>
            <h6 class="my-0">TAMAMLANAN SİPARİŞLER</h6>
          </div>
          <span class="text-muted text-danger">
          <?php echo $this->dashboard_model->get_vendor_completed_orders_count($user->id); ?>
            <small class="text-muted">
              <a href="<?php echo site_url('dashboard/completed-orders') ?>">Tümünü Gör</a>
            </small>
          </span>
        </li>
        <li class="list-group-item d-flex justify-content-between lh-condensed border-0">
          <div>
            <h6 class="my-0">İPTAL EDİLEN SİPARİŞLER</h6>
          </div>
          <span class="text-muted text-danger">2
            <small class="text-muted">
              <a href="<?php echo site_url('dashboard/canceled-orders') ?>">Tümünü Gör</a>
            </small>
          </span>
        </li>
      </ul>
    </div>

    <div class="col-md-4 order-md-2 mb-4">
      <h6 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">SATICI PUANIM</span>
        
      </h6>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between lh-condensed border-0">
          <div>
            <h6 class="my-0">SATICI PUANI</h6>
            <small class="text-muted">Satıcı puanını yüksek tutmanız gerekmektedir</small>
          </div>
          <span class="text-muted">8.7</span>
        </li>
        <li class="list-group-item d-flex justify-content-between lh-condensed border-0">
          <div>
            <h6 class="my-0">ÇÖZÜM ORTAKLARI</h6>
            <small class="text-muted">Çözüm ortaklarını görmek için tıklayınız</small>
          </div>
          <span class="text-muted">7</span>
        </li>
      </ul>
    </div>

    <div class="col-md-4 order-md-2 bg-light px-4 py-4">
      <div class="index-chart-container" style="height:300px">
          <canvas id="chart_sales"></canvas>
      </div>
    </div>

    <div class="col-md-8 order-md-2 bg-light px-4 py-4">
      <div class="index-chart-container" style="height:300px">
          <canvas id="chart_montly_sales"></canvas>
      </div>
    </div>

    <!--
    <div class="col-md-4 order-md-2 mb-4">
      <h6 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">SATIŞ PERFORMANSIM</span> 
      </h6>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between lh-condensed border-0">
          <div>
            <h6 class="my-0">BUGÜNKÜ SATIŞIM</h6>
          </div>
          <span class="text-muted">500 TL</span>
        </li>
        <li class="list-group-item d-flex justify-content-between lh-condensed border-0">
          <div>
            <h6 class="my-0">SON 1 HAFTALIK SATIŞIM</h6>
          </div>
          <span class="text-muted">230 TL</span>
        </li>
        <li class="list-group-item d-flex justify-content-between lh-condensed border-0">
          <div>
            <h6 class="my-0">SON 30 GÜNLÜK SATIŞIM</h6>
          </div>
          <span class="text-muted">370 TL</span>
        </li>
        <li class="list-group-item d-flex justify-content-between bg-light border-0">
          <div class="text-success">
            <h6 class="my-0">BİR SONRAKİ ALACAĞIM</h6>
          </div>
          <span class="text-success">300 TL</span>
        </li>
      </ul>
    </div>

    <div class="col-md-4 order-md-2 mb-4">
      <h6 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">KALİTE METRİKLERİM</span>
        
      </h6>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between lh-condensed border-0">
          <div>
            <h6 class="my-0">BEKLEYEN SİPARİŞLERİM</h6>
          </div>
          <span class="text-muted">5 ADET</span>
        </li>
        <li class="list-group-item d-flex justify-content-between lh-condensed border-0">
          <div>
            <h6 class="my-0">ORTALAMA KARGOYA TESLİM SÜREM</h6>
          </div>
          <span class="text-muted">2 GÜN</span>
        </li>
        <li class="list-group-item d-flex justify-content-between lh-condensed border-0">
          <div>
            <h6 class="my-0">GECİKEN SİPARİŞLERİM</h6>
          </div>
          <span class="text-muted">3 ADET</span>
        </li>
      </ul>
    </div>

    <div class="col-md-4 order-md-2 mb-4">
      <h6 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">BİLDİRİM MERKEZİ</span>
        <span class="badge badge-pill">Tümünü Gör</span>
      </h6>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between lh-condensed border-0">
          <div>
            <h6 class="my-0">DUYURU</h6>
            <small class="text-muted">Farklı Barkodla Listelenen Ürünler Hakkında</small>
          </div>
        </li>
        <li class="list-group-item d-flex justify-content-between lh-condensed border-0">
          <div>
            <h6 class="my-0">PAZARLAMA ARAÇLARI</h6>
            <small class="text-muted">250 TL Hediye Reklam Bakiyesini Kullanmak İçin SON GÜN! 🎁</small>
          </div>
        </li>
        <li class="list-group-item d-flex justify-content-between lh-condensed border-0">
          <div>
            <h6 class="my-0">AKADEMİ</h6>
            <small class="text-muted">Haftalık Eğitim Takvimi Yayında!</small>
          </div>
        </li>
      </ul>
    </div>
    -->

  </div>
</div>
</div>
<!--container-->

</main>

<!--
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Sipariş', 'İade', 'Kargolanan', 'Hepsi'],
          ['2021/01',  165,      938,         522],
          ['2021/02',  135,      1120,        599],
          ['2021/03',  157,      1167,        587],
          ['2021/04',  139,      1110,        615],
          ['2021/05',  136,      691,         629]
        ]);

        var options = {
          title : '',
          vAxis: {title: 'Sipariş'},
          hAxis: {title: 'İade'},
          seriesType: 'Kargolanan',
          series: {5: {type: 'Hepsi'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>

<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Tümü', 'Hours per Day'],
      ['Kargo Bekleyen', 70],
      ['Bugün Kargolanacak', 30]
    ]);

    var options = {
      title: ''
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
  }
</script>
-->

<?php if (!empty($active_sales_count) || !empty($completed_sales_count)): ?>
    <script>
        //total sales
        var ctx = document.getElementById('chart_sales').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [
                    "<?= trans("active_sales"); ?> (<?= !empty($active_sales_count) ? $active_sales_count : 0; ?>)",
                    "<?= trans("completed_sales"); ?> (<?= !empty($completed_sales_count) ? $completed_sales_count : 0; ?>)"
                ],
                datasets: [{
                    data: [<?= !empty($active_sales_count) ? $active_sales_count : 0; ?>, <?= !empty($completed_sales_count) ? $completed_sales_count : 0; ?>],
                    backgroundColor: [
                        '#1BC5BD',
                        '#6993FF'
                    ],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutoutPercentage: 70,
                tooltips: {
                    callbacks: {
                        label: function (tooltipItem, data) {
                            return data['labels'][tooltipItem['index']];
                        }
                    }
                }
            }
        });
    </script>
<?php endif; ?>
<script>
    //monthly sales
    var months = ["<?= trans("january");?>", "<?= trans("february");?>", "<?= trans("march");?>", "<?= trans("april");?>", "<?= trans("may");?>", "<?= trans("june");?>", "<?= trans("july");?>", "<?= trans("august");?>", "<?= trans("september");?>", "<?= trans("october");?>", "<?= trans("november");?>", "<?= trans("december");?>"];
    var i;
    for (i = 0; i < months.length; i++) {
        months[i] = months[i].substr(0, 3);
    }
    var presets = window.chartColors;
    var utils = Samples.utils;
    var inputs = {
        min: 0,
        max: 100,
        count: 8,
        decimals: 2,
        continuity: 1
    };
    var options = {
        maintainAspectRatio: false,
        spanGaps: false,
        elements: {
            line: {
                tension: 0.000001
            }
        },
        plugins: {
            filler: {
                propagate: false
            }
        },
        scales: {
            x: {
                ticks: {
                    autoSkip: false,
                    maxRotation: 0
                }
            },
            yAxes: [
                {
                    ticks: {
                        beginAtZero: true,
                        callback: function (label, index, labels) {
                            return "<?= $this->default_currency->symbol; ?>" + label;
                        }
                    }
                }
            ]
        },
        tooltips: {
            callbacks: {
                label: function (tooltipItem, data) {
                    return data['labels'][tooltipItem['index']] + ": <?= $this->default_currency->symbol; ?>" + data['datasets'][0]['data'][tooltipItem['index']];
                }
            }
        }
    };
    [false, 'origin', 'start', 'end'].forEach(function () {
        utils.srand(8);
        new Chart('chart_montly_sales', {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    backgroundColor: utils.transparentize("#bfe8e6"),
                    borderColor: "#1BC5BD",
                    data: [<?php for ($i = 1; $i <= 12; $i++) {
                        echo $i > 1 ? ',' : '';
                        $total = 0;
                        if (!empty($sales_sum)):
                            foreach ($sales_sum as $sum):
                                if (isset($sum->month) && $sum->month == $i):
                                    $total = $sum->total_amount;
                                    break;
                                endif;
                            endforeach;
                        endif;
                        echo get_price($total, 'decimal');
                    }?>],
                    label: "<?= trans("sales"); ?> (<?= date("Y") ?>)"
                }]
            },
            options: Chart.helpers.merge(options, {
                title: {
                    display: false
                },
                elements: {
                    line: {
                        tension: 0.4,
                        borderWidth: 2
                    }
                }
            })
        });
    });
</script>
