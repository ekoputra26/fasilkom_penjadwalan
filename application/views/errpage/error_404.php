<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title; ?> | 404 Error</title>
  <link href="<?= base_url()?>assets/backend/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url()?>assets/backend/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="<?= base_url()?>assets/backend/css/animate.css" rel="stylesheet">
  <link href="<?= base_url()?>assets/backend/css/style.css" rel="stylesheet">
</head>

<body class="gray-bg">
  <div class="middle-box text-center animated fadeInDown">
    <h1>404</h1>
    <h3 class="font-bold">Page Not Found</h3>

    <div class="error-desc">
      Maaf, tetapi halaman yang anda minta tidak ditemukan. Coba cek kembali URL halamanan yang anda cari lalu refresh kembali browser anda.
    </div>
    <div class="form-group">
      <br>
      <a onclick="history.back(-1)" class="btn btn-primary text-white">Go Back</a>
    </div>
  </div>
  <script src="<?= base_url()?>assets/backend/js/jquery-3.1.1.min.js"></script>
  <script src="<?= base_url()?>assets/backend/js/popper.min.js"></script>
  <script src="<?= base_url()?>assets/backend/js/bootstrap.js"></script>
</body>
</html>