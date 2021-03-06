<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

  <link rel="apple-touch-icon" sizes="57x57" href="img/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="img/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="img/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="img/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="img/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="img/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="img/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="img/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="img/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="img/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
  <link rel="manifest" href="img/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="img/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">

  <title>Rol ve Yetenek Uygulaması</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/materialdesignicons.min.css">
  <link rel="stylesheet" type="text/css" href="css/datatables.min.css"/>
  <link rel="stylesheet" type="text/css" href="css/datatables.bootstrap4.min.css"/>
  <link rel="stylesheet" type="text/css" href="css/bootstrap-datetimepicker.min.css">
  <link rel="stylesheet" type="text/css" href="css/mCustomScrollbar.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap-select.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.min.css">

  <script src="js/jquery.min.js"></script>
  <script src="js/chart.bundle.min.js"></script>
  <script type="text/javascript">
    // Toast Notification
    function ToastBuilder(options) {
      // options are optional
      var opts = options || {};

      // setup some defaults
      opts.defaultText = opts.defaultText || 'Toast boş';
      opts.displayTime = opts.displayTime || 3000;
      opts.target = opts.target || 'body';

      return function (text) {
        $('<div/>').addClass('toast').prependTo($(opts.target)).text(text || opts.defaultText).queue(function (next) {
          $(this).css({
            'opacity': 1
          });
          var topOffset = 10;
          $('.toast').each(function () {
            var $this = $(this);
            var height = $this.outerHeight();
            var offset = 15;
            $this.css('top', topOffset + 'px');

            topOffset += height + offset;
          });
          next();
        }).delay(opts.displayTime).queue(function (next) {
          var $this = $(this);
          var height = $this.outerHeight() + 20;
          $this.css({
            'top': '-' + height + 'px',
            'opacity': 0
          });
          next();
        }).delay(600).queue(function (next) {
          $(this).remove();
          next();
        });
      };
    }
    var showtoast = new ToastBuilder();
  </script>
</head>
<body>
