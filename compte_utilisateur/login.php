<?php
session_start();
require_once './includes/header.php';
?>
<?php if (isset($_SESSION['flash'])): ?>
    <?php foreach ($_SESSION['flash'] as $type => $message): ?>
        <div class="alert alert-<?= $type?>">
            <?= $message ?>
        </div>
    <?php endforeach; ?>
    <?php unset($_SESSION['flash']) ?>
<?php endif; ?>
<div class="col-md-8 col-md-offset-2">
        <h1 style="color: #fff;"> Cet utilisateur n'existe pas </h1>
</div>
<?php
        require_once './includes/footer.php';

?>