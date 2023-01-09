<?php
use App\Libraries\MyClass;
?>
<?php if (MyClass::exists_flash('message')) : ?>
  <?php $message = MyClass::get_flash('message'); ?>
  <div class="alert alert-<?= $message['type']; ?> alert-dismissible fade show" role="alert">
    <strong>Thông báo!</strong> <?= $message['msg']; ?>.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php endif; ?>

