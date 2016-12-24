<?php include "header.php"; ?>

  <div class="wrapper">
    <?php include "sidebar.php"; ?>
    <div class="page-content">
      <?php include "navbar.php"; ?>
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <a href="course-create.php" class="btn btn-info"><i class="mdi mdi-book-open-page-variant"></i>Eğitim Oluştur</a>
          </div>
          <div class="card-block">
            <form method="post">
              <table class="table" id="dataTable-course">
                <thead>
                <tr>
                  <th>Eğitim Adı</th>
                  <th>Eğitmen</th>
                  <th>Eğitim Salonu</th>
                  <th>Başlangıç Tarihi</th>
                  <th>Bitiş Tarihi</th>
                  <th>Durum</th>
                  <th>Eğitim Detayı</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  include "dbsettings.php";
                  $sql  = 'SELECT T_EDUCATION.PK,T_EDUCATION.EDUCATION_SUBJECT AS SUBJECT,T_EDUCATOR.EDUCATOR_NAME AS EDCTR_NAME, T_EDUCATION.PLANNED_DATE AS PLND_DTE,T_EDUCATION.COMPLETE_DATE AS CMPLT_DTE,INITCAP(T_EDUCATION.CURRENT_STATE) AS CRR_STT,INITCAP(T_LOUNGE.LOUNGE_NAME) AS LNG_NAME
                    FROM T_LOUNGE,T_EDUCATION
                    LEFT JOIN T_EDUCATOR ON T_EDUCATION.EDUCATOR_FK = T_EDUCATOR.PK
                    WHERE T_EDUCATION.LOUNGE_FK = T_LOUNGE.PK';
                  $stmt = oci_parse($conn, $sql);
                  $r    = oci_execute($stmt);
                  while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                    $date          = DateTime::createFromFormat("d#M#y H#i#s*A", $row["PLND_DTE"]);
                    $started_date  = $date->format('d/m/Y - H:i');
                    $date          = DateTime::createFromFormat("d#M#y H#i#s*A", $row["CMPLT_DTE"]);
                    $complete_date = $date->format('d/m/Y - H:i');
                    echo '<tr>';
                    echo '<td>'.$row['SUBJECT'].'</td>';
                    echo '<td>'.$row['EDCTR_NAME'].'</td>';
                    echo '<td>'.$row['LNG_NAME'].'</td>';
                    echo '<td>'.$started_date.'</td>';
                    echo '<td>'.$complete_date.'</td>';
                    echo '<td>'.$row['CRR_STT'].'</td>';
                    echo '
                    <td class="text-xs-center">
                      <a href="course-detail.php?course_id='.$row['PK'].'" class="btn btn-table" rel="tooltip"><i class="mdi mdi-magnify"></i></a>
                    </td>
                       ';
                    echo '</tr>';
                  }
                ?>
                </tbody>
              </table>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include "footer.php"; ?>