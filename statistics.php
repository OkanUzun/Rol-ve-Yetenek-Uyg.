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
                        var dynamicColors = function () {
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
                                label: function (tooltipItem) {
                                  return "Çalışan sayısı: " + Number(tooltipItem.yLabel);
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
                                label: function (tooltipItem) {
                                  return "Eğitim Sayısı: " + Number(tooltipItem.yLabel);
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
                    <?php

                      include "dbsettings.php";
                      $sql = 'SELECT T_DEPARTMENT.PK, INITCAP(T_DEPARTMENT.DEPARTMENT_NAME) AS DEP_NAME,COUNT(T_USER.PK) AS X
                    FROM T_DEPARTMENT
                    LEFT JOIN T_USER ON T_USER.DEPARTMENT_FK = T_DEPARTMENT.PK
                    GROUP BY T_DEPARTMENT.PK,T_DEPARTMENT.DEPARTMENT_NAME';

                      $stmt            = oci_parse($conn, $sql);
                      $r               = oci_execute($stmt);
                      $array_dep       = array();
                      $array_usr_count = array();
                      while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                        array_push($array_dep, $row["DEP_NAME"]);
                        array_push($array_usr_count, $row["X"]);
                      }
                    ?>
                    <div class="chart-block">
                      <canvas id="pieChart" height="300px"></canvas>
                      <script>
                        var ctx = document.getElementById("pieChart");
                        var pieChart = new Chart(ctx, {
                          type: 'pie',
                          data: {
                            labels: [
                              <?php echo '"'.implode('","', $array_dep).'"';?>
                            ],
                            datasets: [
                              {
                                data: [
                                  <?php echo implode(",", $array_usr_count);?>
                                ],
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
                    <?php

                      include "dbsettings.php";
                      $sql = 'SELECT T_UNIT.PK AS PK,INITCAP(T_UNIT.UNIT_NAME) AS UNT_NAME,COUNT(T_USER.PK) AS X
                      FROM T_UNIT
                      LEFT JOIN T_USER ON T_UNIT.PK = T_USER.UNIT_FK
                      GROUP BY T_UNIT.PK,T_UNIT.UNIT_NAME';

                      $stmt            = oci_parse($conn, $sql);
                      $r               = oci_execute($stmt);
                      $array_unit      = array();
                      $array_usr_count = array();
                      while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                        array_push($array_unit, $row["UNT_NAME"]);
                        array_push($array_usr_count, $row["X"]);
                      }
                    ?>
                    <div class="chart-block">
                      <canvas id="pieChart2" height="300px"></canvas>
                      <script>
                        var ctx = document.getElementById("pieChart2");
                        var pieChart = new Chart(ctx, {
                          type: 'pie',
                          data: {
                            labels: [
                              <?php echo '"'.implode('","', $array_unit).'"';?>
                            ],
                            datasets: [
                              {
                                data: [
                                  <?php echo implode(",", $array_usr_count);?>
                                ],
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
                    <?php

                      include "dbsettings.php";
                      $sql = 'SELECT T_ROLE.PK,T_ROLE.ROLE_NAME AS RLE_NAME,COUNT(T_USER.PK) AS X
                    FROM T_ROLE
                    LEFT JOIN T_USER ON T_USER.ROLE_FK = T_ROLE.PK
                    GROUP BY T_ROLE.PK,T_ROLE.ROLE_NAME
                    ORDER BY T_ROLE.ROLE_NAME';

                      $stmt            = oci_parse($conn, $sql);
                      $r               = oci_execute($stmt);
                      $array_role      = array();
                      $array_usr_count = array();
                      while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                        array_push($array_role, $row["RLE_NAME"]);
                        array_push($array_usr_count, $row["X"]);
                      }
                    ?>
                    <div class="chart-block">
                      <canvas id="pieChart3" height="300px"></canvas>
                      <script>
                        var ctx = document.getElementById("pieChart3");
                        var pieChart3 = new Chart(ctx, {
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
                                label: function (tooltipItem) {
                                  return Number(tooltipItem.yLabel) + " Kişi";
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
                        var barChart = new Chart(ctx, {
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
                                label: function (tooltipItem) {
                                  return Number(tooltipItem.yLabel) + " Kişi";
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