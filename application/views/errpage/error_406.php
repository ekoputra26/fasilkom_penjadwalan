<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title; ?> | Javascript is Not Active</title>
  <link href="<?= base_url()?>assets/backend/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url()?>assets/backend/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="<?= base_url()?>assets/backend/css/animate.css" rel="stylesheet">
  <link href="<?= base_url()?>assets/backend/css/style.css" rel="stylesheet">
</head>

<body class="gray-bg">
  <div class="middle-box text-center animated fadeInDown">
    <h1>406</h1>
    <h3 class="font-bold">Javascript is Not Active</h3>

    <div class="error-desc">
      Maaf, tetapi anda harus mengaktifkan Javascript terlebih dahulu pada browser anda, untuk mendapatkan view terbaik. Jika browser anda tidak mengizinkan penggunaan javascript silahkan menggunakan browser lain.
    </div>
    <div class="form-group">
      <br>
      <a href="<?= base_url(); ?>" class="btn btn-primary text-white">Go Back</a>
    </div>
  </div>
  <script src="<?= base_url()?>assets/backend/js/jquery-3.1.1.min.js"></script>
  <script src="<?= base_url()?>assets/backend/js/popper.min.js"></script>
  <script src="<?= base_url()?>assets/backend/js/bootstrap.js"></script>
</body>
</html>