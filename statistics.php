<?php include 'header.php' ?>
  <div class="wrapper">
    <?php include "sidebar.php"; ?>
    <div class="page-content">
      <?php include "navbar.php"; ?>
      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12">
            <div class="card">
              <div class="card-header">
                <div class="card-title">İstatistikler</div>
              </div>
              <div class="card-block">
                <div class="row">
                  <div class="col-xs-12 col-lg-6 mb-3">
                    <div class="card-title">Yıllık Personel Dağılımı</div>
                    <div class="chart-block">
                      <canvas id="lineChart" height="300px"></canvas>
                      <script>
                        var dynamicColors = function() {
                          var r = Math.floor(Math.random() * 255);
                          var g = Math.floor(Math.random() * 255);
                          var b = Math.floor(Math.random() * 255);
                          return "rgb(" + r + "," + g + "," + b + ")";
                        };
                        Chart.defaults.global.animation.easing = "linear";
                        Chart.defaults.global.animation.duration = 1000;
                        Chart.defaults.global.responsive = true;
                        Chart.defaults.global.maintainAspectRatio = false;
                        Chart.defaults.global.defaultFontFamily = "Roboto";
                        Chart.defaults.global.tooltips.cornerRadius = 3;
                        Chart.defaults.global.tooltips.yPadding = 8;
                        Chart.defaults.global.tooltips.backgroundColor = "rgba(0,0,0,0.7)";

                        var ctx = document.getElementById("lineChart");
                        var lineChart = new Chart(ctx, {
                          type: 'line',
                          data: {
                            labels: ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"],
                            datasets: [
                              {
                                label: "Aylara Göre Personel Dağılımı",
                                data: [30, 34, 80, 81, 56, 55, 40, 80, 81, 56, 55, 40],
                                lineTension: 0.4,
                                backgroundColor: "rgba(158,205,205,.5)",
                                borderColor: "#B7E6E6",
                                pointBorderColor: "#4BC0C0",
                                pointBackgroundColor: "#fff",
                                pointBorderWidth: 5,
                                pointHoverRadius: 5,
                                pointHoverBorderWidth: 3,
                                pointRadius: 1,
                                pointHitRadius: 30
                              }
                            ]
                          },
                          options: {
                            scales: {
                              yAxes: [{
                                ticks: {
                                  beginAtZero: true
                                }
                              }]
                            },
                            legend: {
                              display: false
                            },
                            tooltips: {
                              callbacks: {
                                label: function(tooltipItem) {
                                  return "Çalışan sayısı: "+Number(tooltipItem.yLabel);
                                }
                              }
                            }
                          }
                        });

                      </script>
                    </div>
                  </div>
                  <div class="col-xs-12 col-lg-6 mb-3">
                    <div class="card-title">Yıllık Eğitim Dağılımı</div>
                    <div class="chart-block">
                      <canvas id="lineChart2" height="300px"></canvas>
                      <script>
                        var ctx = document.getElementById("lineChart2");
                        var lineChart2 = new Chart(ctx, {
                          type: 'line',
                          data: {
                            labels: ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"],
                            datasets: [
                              {
                                label: "Eğitimler",
                                data: [1, 3, 0, 0, 2, 1, 4, 0, 0, 0, 0, 2],
                                lineTension: 0.4,
                                backgroundColor: "rgba(223,141,0,.5)",
                                borderColor: "#F8A610",
                                pointBorderColor: "#C57300",
                                pointBackgroundColor: "#fff",
                                pointBorderWidth: 5,
                                pointHoverRadius: 5,
                                pointHoverBorderWidth: 3,
                                pointRadius: 1,
                                pointHitRadius: 30
                              }
                            ]
                          },
                          options: {
                            scales: {
                              yAxes: [{
                                ticks: {
                                  beginAtZero: true
                                }
                              }]
                            },
                            legend: {
                              display: false
                            },
                            tooltips: {
                              callbacks: {
                                label: function(tooltipItem) {
                                  return "Eğitim Sayısı: "+Number(tooltipItem.yLabel);
                                }
                              }
                            }
                          }
                        });
                      </script>
                    </div>
                  </div>
                  <div class="col-xs-12 col-lg-6 mb-3">
                    <div class="card-title">Departmanlar</div>
                    <div class="chart-block">
                      <canvas id="pieChart" height="300px"></canvas>
                      <script>
                        var ctx = document.getElementById("pieChart");
                        var pieChart = new Chart(ctx,{
                          type: 'pie',
                          data: {
                            labels: [
                              "Bilişim Departmanı",
                              "İnsan Kaynakları Departmanı",
                              "Mali İşler Departmanı"
                            ],
                            datasets: [
                              {
                                data: [42, 20, 15],
                                backgroundColor: [
                                  dynamicColors(),
                                  dynamicColors(),
                                  dynamicColors()
                                ]
                              }]
                          }
                        });
                      </script>
                    </div>
                  </div>
                  <div class="col-xs-12 col-lg-6 mb-3">
                    <div class="card-title">Birimler</div>
                    <div class="chart-block">
                      <canvas id="pieChart2" height="300px"></canvas>
                      <script>
                        var ctx = document.getElementById("pieChart2");
                        var pieChart = new Chart(ctx,{
                          type: 'pie',
                          data: {
                            labels: [
                              "Yazılım Birimi",
                              "Ağ Birimi",
                              "Muhasebe Birimi"
                            ],
                            datasets: [
                              {
                                data: [22, 11, 5],
                                backgroundColor: [
                                  dynamicColors(),
                                  dynamicColors(),
                                  dynamicColors()
                                ]
                              }]
                          }
                        });
                      </script>
                    </div>
                  </div>
                  <div class="col-xs-12 col-lg-6 mb-3">
                    <div class="card-title">Roller</div>
                    <div class="chart-block">
                      <canvas id="pieChart3" height="300px"></canvas>
                      <script>
                        var ctx = document.getElementById("pieChart3");
                        var pieChart3 = new Chart(ctx,{
                          type: 'bar',
                          data: {
                            labels: [
                              "Ağ Uzmanı",
                              "Android Developer",
                              "Database Specialist",
                              "Java Developer"
                            ],
                            datasets: [
                              {
                                label: "Rol Dağılımı",
                                data: [2, 1, 3, 5],
                                backgroundColor: [
                                  dynamicColors(),
                                  dynamicColors(),
                                  dynamicColors(),
                                  dynamicColors()
                                ]
                              }]
                          },
                          options: {
                            scales: {
                              xAxes: [{stacked: true}],
                              yAxes: [{stacked: true}]
                            },
                            tooltips: {
                              callbacks: {
                                label: function(tooltipItem) {
                                  return Number(tooltipItem.yLabel)+" Kişi";
                                }
                              }
                            }
                          }
                        });
                      </script>
                    </div>
                  </div>
                  <div class="col-xs-12 col-lg-6">
                    <div class="card-title">Yetenekler</div>
                    <div class="chart-block">
                      <canvas id="barChart" height="300px"></canvas>
                      <script>
                        var ctx = document.getElementById("barChart");
                        var barChart = new Chart(ctx,{
                          type: 'bar',
                          data: {
                            labels: [
                              "Java",
                              "Android",
                              "IOS",
                              "SQL",
                              "PHP",
                              "HTML",
                              "CSS",
                              "Javascript",
                              "Ajax",
                              "C#",
                              "C++",
                              "C",
                              "ASP.NET",
                              "PYTHON",
                              "RUBY",
                              "XML"
                            ],
                            datasets: [
                              {
                                label: "Yetenek Dağılımı",
                                data: [2, 1, 3, 5, 1, 3, 9, 6, 3, 7, 1, 3, 4, 1, 10, 12],
                                backgroundColor: [
                                  dynamicColors(),
                                  dynamicColors(),
                                  dynamicColors(),
                                  dynamicColors(),
                                  dynamicColors(),
                                  dynamicColors(),
                                  dynamicColors(),
                                  dynamicColors(),
                                  dynamicColors(),
                                  dynamicColors(),
                                  dynamicColors(),
                                  dynamicColors(),
                                  dynamicColors(),
                                  dynamicColors(),
                                  dynamicColors(),
                                  dynamicColors()
                                ]
                              }]
                          },
                          options: {
                            scales: {
                              xAxes: [{stacked: true}],
                              yAxes: [{stacked: true}]
                            },
                            tooltips: {
                              callbacks: {
                                label: function(tooltipItem) {
                                  return Number(tooltipItem.yLabel)+" Kişi";
                                }
                              }
                            }
                          }
                        });
                      </script>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include 'footer.php' ?>