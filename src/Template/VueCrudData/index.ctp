<?php

  $this->assign('title', __('CakePHP + Vue.js + AxiosでCRUDのサンプルプロジェクト'));
 
?>
<p><?= __('これは不特定多数の方が使う「テスト用」なので、最初と最後に<a href="{0}">「全て初期化」</a>をクリックして下さい<br>※他に誰かが操作している場合はエラーが出る場合があります。', $this->Url->build('/init' , true)) ?></p> 

<div id="app">
  <!-- ココにレンダリングされる -->
</div>

<script src="<?= $this->Url->build('/js/app.js' , true)  ?>"></script> 
<script src="<?= $this->Url->build('/js/chunk-vendors.js' , true)  ?>"></script> 