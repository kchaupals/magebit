<?php
if (!isset($_SESSION)) {
    session_start();
} ?>
<?php require APPROOT  . '/views/inc/header.php'; ?>
<div class='wrapper'>
    <div class='content-box <?php if ($_SESSION['valid'] == true) echo 'success-c' ?>' id='s-con'>
        <img class='success' id='s-img' style='<?php if ($_SESSION['valid'] == true) echo 'display:block;'; ?>' src='<?php echo URLROOT; ?>/img/success.svg' />
        <h2 class='head <?php if ($_SESSION['valid'] == true) echo 'success-h'; ?>' id='s-msg'><span>Subscribe to newsletter</h2>
        <p class='after-head <?php if ($_SESSION['valid'] == true) echo 'success-p' ?>' id='s-info'><span>
                Subscribe to our newsletter and get 10% discount on pineapple
                glasses.</span>
        </p>

        <?php require APPROOT  . '/views/inc/form.php'; ?>
        <hr />
        <?php require APPROOT  . '/views/inc/socials.php'; ?>
    </div>
</div>
<?php require APPROOT  . '/views/inc/footer.php'; ?>
<?php
session_destroy();
?>