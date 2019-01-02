<?php require_once('../../../private/initialize.php'); ?>


<?php
//$_GET automatically decodes from urlencode
$id = $_GET['id'] ?? '1'; //null coalesce operator
?>

<?php $page_title = "Show Page"; ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    
    <strong>Page ID: <?php echo h($id); ?></strong><br />

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>

