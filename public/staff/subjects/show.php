<?php require_once('../../../private/initialize.php'); ?>

<?php

//$_GET automatically decodes from urlencode();
$id = $_GET['id'] ?? '1'; //php > 7.0

$subject = find_subject_by_id($id);

?><br />

<?php $page_title = "Show Subject"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a><br />
    
    <div class="subject show">
        Subject: <?php echo h($subject['menu_name']); ?>
        
        <div class="attributes">
            <dl>
                <dt>Menu Name</dt>
                <dd><?php echo h($subject['menu_name']); ?></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd><?php echo h($subject['position']); ?></dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd><?php echo $subject['visible'] == '1' ? 'true' : 'false'; ?></dd>
            </dl>
        </div>
        
    </div>
</div>