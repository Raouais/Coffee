
<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title><?= App::getInstance()->title;?></title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">


    <!-- Custom styles for this template -->

  </head>
  <body class="d-flex flex-column h-100">
  <header>
  </header>

<!-- Begin page content -->

<div class="container" style="padding-top:90px;">
    <?= $content;?>
</div>

<footer class="footer mt-auto py-3">
  <div class="container">
    <span class="text-muted"></span>
  </div>
</footer>
<!-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> -->
</html>
