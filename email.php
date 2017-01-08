<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
  <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
  <title>Roleaby Yazılım Yeni Şifre</title>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&subset=latin-ext' rel='stylesheet' type='text/css'>

  <!-- CSS Reset -->
  <style>
    html,
    body {
      margin: 0 auto !important;
      padding: 0 !important;
      height: 100% !important;
      width: 100% !important;
      font-family: 'Roboto Condensed', sans-serif;
    }

    /* What it does: Stops email clients resizing small text. */
    * {
      -ms-text-size-adjust: 100%;
      -webkit-text-size-adjust: 100%;
    }

    /* What is does: Centers email on Android 4.4 */
    div[style*="margin: 16px 0"] {
      margin: 0 !important;
    }

    /* What it does: Stops Outlook from adding extra spacing to tables. */
    table,
    td {
      mso-table-lspace: 0pt !important;
      mso-table-rspace: 0pt !important;
    }

    /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
    table {
      border-spacing: 0 !important;
      border-collapse: collapse !important;
      table-layout: fixed !important;
      margin: 0 auto !important;
    }

    table table table {
      table-layout: auto;
    }

    /* What it does: Uses a better rendering method when resizing images in IE. */
    img {
      -ms-interpolation-mode: bicubic;
    }

    /* What it does: A work-around for iOS meddling in triggered links. */
    .mobile-link--footer a,
    a[x-apple-data-detectors] {
      color: inherit !important;
      text-decoration: underline !important;
    }

    a {
      text-decoration: none;
      color: #fff !important;
    }

    a:hover {
      text-decoration: underline;
    }

    /* Media Queries */
    @media screen and (max-width: 600px) {
      .email-container {
        width: 100% !important;
        margin: auto !important;
      }
    }
  </style>
</head>
<body width="100%" style="margin: 0; mso-line-height-rule: exactly;">
<div style="width: 100%;">
  <div style="display:none;font-size:1px;line-height:1px;max-height:0;max-width:0;opacity:0;overflow:hidden;mso-hide:all;">
    <?php
      if (isset($_POST["create-user"]) || isset($_POST["forgot-password"])) {
        echo 'Selam '.$f_name.' , Roleaby uygulamamızda adına açılmış olan hesap için...';
      }
      else if (isset($_POST["send-education-mails"])) {
        echo 'Değerli Kullanıcılarımız...';
      }
    ?>
  </div>
  <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="background-color: #F3F5F7;" class="email-container">
    <tr>
      <td style="padding: 20px 0; text-align: center; color: #9C9B9D; font-size: 20px;">
        Roleaby Yazılım
      </td>
    </tr>
  </table>
  <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto;" class="email-container">
    <tr>
      <td bgcolor="#ffffff" style="padding: 40px 40px 20px; font-size: 15px; line-height: 20px; color: #555555;">
        <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="left" style="width: 100%;">
          <tr>
            <?php
              if (isset($_POST["create-user"]) || isset($_POST["forgot-password"])) {
                echo '<td style="font-weight: 700;">Selam '.$f_name.',</td>';
              }
              else if (isset($_POST["send-education-mails"])) {
                echo '<td style="font-weight: 700;">Değerli Kullanıcılarımız...</td>';
              }
            ?>
          </tr>
          <tr>
            <?php
              if (isset($_POST["create-user"])) {
                echo '<td style="color: #9C9B9D; padding: 20px 0;">Roleaby uygulamamızda adına açılmış olan hesap için aşağıdaki oluşturulmuş kullanıcı adı ve şifreni giriş yapmak için kullanabilirsin. Giriş yaptıktan sonra şifreni değiştirmen tavsiye edilir.</td>';
              }
              else if (isset($_POST["send-education-mails"])) {
                echo '<td style="color: #9C9B9D; padding: 20px 0;">Aşağıda eğitim bilgilerinizi bulabilirsiniz.</td>';
              }
              else if (isset($_POST["forgot-password"])) {
                echo '<td style="color: #9C9B9D; padding: 20px 0;">Talebin üzerine gönderilen şifre sıfırlama linkine tıklayarak yeni şifreni oluşturabilirsin.</td>';
              }
            ?>
          </tr>
        </table>
        <br><br>
        <?php
          if (isset($_POST["create-user"])) {
            echo '        
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto">
              <tr>
                <td style="padding-right: 10px;">Kullanıcı Adı:</td>
                <td style="border-radius: 3px; text-align: center; background-color: #66BB6A; color: #fff; font-weight: 700; font-size: 20px; padding: 10px 40px;">
                  '.$user_id.'
                </td>
              </tr>
              <tr>
                <td style="padding: 5px 0;"></td>
              </tr>
              <tr>
                <td style="padding-right: 10px;">Şifre:</td>
                <td style="border-radius: 3px; text-align: center; background-color: #66BB6A; color: #fff; font-weight: 700; font-size: 20px; padding: 10px 40px;">
                  '.$r_pw.'
                </td>
              </tr>
            </table>';
          }
          else if (isset($_POST["send-education-mails"])) {
            echo '
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto">
              <tr>
                <td style="padding-right: 10px;">Eğitimin Konusu:</td>
                <td style="border-radius: 3px; text-align: center; background-color: #66BB6A; color: #fff; font-weight: 700; font-size: 20px; padding: 10px 40px;">
                  '.$education_subject.'
                </td>
              </tr>
              <tr>
                <td style="padding: 5px 0;"></td>
              </tr>
              <tr>
                <td style="padding-right: 10px;">Eğitimci Adı:</td>
                <td style="border-radius: 3px; text-align: center; background-color: #66BB6A; color: #fff; font-weight: 700; font-size: 20px; padding: 10px 40px;">
                  '.$educator_name.'
                </td>
              </tr>
              <tr>
                <td style="padding: 5px 0;"></td>
              </tr>
              <tr>
                <td style="padding-right: 10px;">Eğitim Yeri:</td>
                <td style="border-radius: 3px; text-align: center; background-color: #66BB6A; color: #fff; font-weight: 700; font-size: 20px; padding: 10px 40px;">
                  '.$lounge_name.'
                </td>
              </tr>
              <tr>
                <td style="padding: 5px 0;"></td>
              </tr>
              <tr>
                <td style="padding-right: 10px;">Başlangıç Zamanı:</td>
                <td style="border-radius: 3px; text-align: center; background-color: #66BB6A; color: #fff; font-weight: 700; font-size: 20px; padding: 10px 40px;">
                  '.$started_date.'
                </td>
              </tr>
            </table>';
          }
          else if (isset($_POST["forgot-password"])) {
            echo '
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto">
            <tr>
              <td style="border-radius: 3px; text-align: center; background-color: #66BB6A; color: #fff; font-weight: 700; font-size: 20px; padding: 10px 40px;">
                <a href="http://'.$pwrurl.'"><font color="#ffffff">Şifrenizi değiştirmek için tıklayınız</font></a>
              </td>
            </tr>
            </table>
            ';
          }
        ?>
      </td>
    </tr>
    <tr>
      <td bgcolor="#ffffff" style="padding: 0 40px 40px; font-size: 15px; line-height: 20px;">
        <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto">
          <tr>
            <td style="color: #9C9B9D; padding: 0 0 20px 0;">
              Eğer bu e-mail'in yanlışlıkla gelmiş olabileceğini düşünüyorsan görmezden gelebilir ya da bize bildirebilirsin.
            </td>
          </tr>
          <tr>
            <td style="color: #9C9B9D; padding: 5px 0;">Teşekkürler,</td>
          </tr>
          <tr>
            <td style="color: #9C9B9D; padding: 5px 0;">Roleaby Yazılım</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</div>
</body>
</html>