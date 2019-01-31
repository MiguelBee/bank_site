<?php

require_once('../../../private/initialize.php'); 

require_login();

?>

<?php

//$_GET automatically decodes from urlencode();
$id = $_GET['id'] ?? '1'; //php > 7.0

$subject = find_subject_by_id($id);
$page_set = find_pages_by_subject_id($id);

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
        
        <hr />
        
        <div class="pages_listings">
        <h2>Pages</h2>
        
        <div class="actions">
            <a class="actions" href="<?php echo url_for('/staff/pages/new.php?subject_id=' . h(u($subject['id']))); ?>">Create New Page</a>
        </div>
        
        <table class="list">
            <tr>
                <th>Id</th>
                <th>Position</th>
                <th>Visible</th>
                <th>Name</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
            
            <?php while($page = mysqli_fetch_assoc($page_set)) { ?>
              <tr>
                <td><?php echo h($page['id']); ?></td>
                <td><?php echo h($page['position']); ?></td>
                <td><?php echo $page['visible'] == 1 ? 'true': 'false' ; ?></td>
                <td><?php echo h($page['menu_name']); ?></td>
                <td><a class="action" href="<?php echo url_for('/staff/pages/show.php?id=' . h(u($page["id"]))); ?>">View</a></td>
                <td><a class="action" href="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($page['id']))); ?>">Edit</a></td>
                <td><a class="action" href="<?php echo url_for('/staff/pages/delete.php?id=' . h(u($page['id'])));?>">Delete</a></td>
              </tr>
            <?php } ?>
        </table>
        <?php mysqli_free_result($page_set); ?>
    </div>
        
    </div>
</div>