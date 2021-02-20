<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1">
<meta name="robots" content="noindex, nofollow">
<meta name="keywords" content="<?= $this->fetch('keywords') ?>">
<meta name="description" content="<?= $this->fetch('description') ?>">
<meta name="csrf-token" content="<?= $this->request->getParam('_csrfToken')?>">
<meta http-equiv="Cache-Control" content="no-cache">
<title><?= $this->fetch('title') ?></title>
<link rel="stylesheet" media="all" href="<?= $this->Url->build('/css/bootstrap.min.css', true); ?>">
<link href="<?= $this->Url->build('/favicon.ico', true); ?>" type="image/x-icon" rel="icon">
<link href="<?= $this->Url->build('/favicon.ico', true); ?>" type="image/x-icon" rel="shortcut icon">
</head>
<body>

<!-- ヘッダ -->
<nav class="navbar navbar-expand-md navbar-light bg-primary">
  <div class="navbar-brand text-white">
    <?= __('CakePHP + Vue.js + AxiosでCRUDのサンプルプロジェクト') ?>
  </div>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" style="color:#fff;" href="<?= $this->Url->build('/init', true); ?>"><?= __('初期化') ?></a>
    </li>
  </ul>  
</nav>

<div class="container">

  <!-- フラッシュ -->
  <?= $this->Flash->render() ?>   
  
  <!-- メイン -->
  <div>
    <?= $this->fetch('content') ?>
  </div>
  
  <!-- フッタ -->
  <nav class="container bg-primary p-2 text-center">
    <div class="text-center text-white">
      <?= __(' Vue "CRUD" Sample') ?><br>
      Takeshi Okamoto wrote the code.
      <p></p>
    </div>
  </nav>   
</div>
</body>
</html>
