<?php require_once('../../../private/initialize.php'); ?>

<?php
//$_GET automatically decodes from urlencode
$id = $_GET['id'] ?? '1'; //null coalesce operator

$page = find_page_by_id($id);

?><br />

<?php $page_title = "Show Page"; ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a><br />

    <div class="page show">
        Page: <?php echo h($page['menu_name']); ?>
    
        <div class="attributes">
            
            <?php $subject = find_subject_by_id($page['subject_id']); ?>
            
            <div class="actions">
                <a class="action" href="<?php echo url_for('/index.php?id=' . h(u($page['id'])) . '&preview=true'); ?>" target="_blank">Preview</a>
            </div>
            
            <dl>
                <dt>Menu Name</dt>
                <dd><?php echo h($page['menu_name']); ?></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd><?php echo h($page['position']); ?></dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd><?php echo $page['visible'] == '1' ? 'true' : 'false'; ?></dd>
            </dl>
            <dl>
                <dt> Content</dt>
                <dd><?php echo h($page['content']); ?></dd>
            </dl>
            <dl>
                <dt>Subject</dt>
                <dd><?php echo $subject['menu_name']; ?></dd>
            </dl>
        </div>
    
    </div>
    

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>

