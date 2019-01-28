<?php
require_once('../../../private/initialize.php');

require_login();

if(!isset($_GET['id'])){
    redirect_to(url_for('/staff/admins/index.php'));
}

$id = $_GET['id'];

if(request_is_post()){
    $result = delete_admin($id);
    $_SESSION['status_message'] = "You have successfully deleted the page";
    redirect_to(url_for('/staff/admins/index.php'));
} else {
    $admin = find_admin_by_id($id);
}
?>


<?php $page_title = "Delete Admin"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">&laquo; Back to List</a><br />
    
    <div class="admin delete">
        <h1>Delete Page</h1>
        <p>Are you sure you want to delete this admin?</p>
        <p class="item"><?php echo h($admin['username']); ?></p>
        
        <form action="<?php echo url_for('/staff/admins/delete.php?id=' . h(u($admin['id']))); ?>" method="post">
          <div id="operations">
            <input type="submit" name="commit" value="Delete admin" />
          </div>
        </form>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>