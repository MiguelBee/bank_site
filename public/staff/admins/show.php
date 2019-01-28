<?php 
require_once('../../../private/initialize.php'); 

require_login();

?>



<?php
//$_GET automatically decodes from urlencode
$id = $_GET['id'] ?? '1'; //null coalesce operator

$admin = find_admin_by_id($id);

?><br />

<?php $page_title = "Show Admin"; ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">&laquo; Back to List</a><br />

    <div class="admin show">
        <h1>Admin: <?php echo h($admin['username']); ?></h1>
    
        <div class="attributes">
            
            <dl>
                <dt>First Name</dt>
                <dd><?php echo h($admin['first_name']); ?></dd>
            </dl>
            <dl>
                <dt>Last Name</dt>
                <dd><?php echo h($admin['last_name']); ?></dd>
            </dl>
            <dl>
                <dt>E-mail</dt>
                <dd><?php echo $admin['email']; ?></dd>
            </dl>
            <dl>
                <dt> Username</dt>
                <dd><?php echo h($admin['username']); ?></dd>
            </dl>
            <dl>
                <dt>Password</dt>
                <dd><?php echo $subject['hashed_password']; ?></dd>
            </dl>
        </div>
    
    </div>
    

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>

