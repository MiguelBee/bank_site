<?php require_once('../../../private/initialize.php');

    require_login();

    $admin_set = find_all_admins();
?>

<?php $page_title = "Admins"; ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <div class="admins listing">
        <h1>Admins</h1>
    </div>
    
    <a class="action" href="<?php echo url_for('/staff/admins/new.php'); ?>">Create New Admin</a>
    
    <table class="list">
        <tr>
            <th>Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>E-Mail</th>
            <th>Username</th>
        </tr>
        
        <?php while($admin = mysqli_fetch_assoc($admin_set)) { ?>
        <tr>
            <th><?php echo $admin['id']; ?></th>
            <th><?php echo $admin['first_name']; ?></th>
            <th><?php echo $admin['last_name']; ?></th>
            <th><?php echo $admin['email']; ?></th>
            <th><?php echo $admin['username']; ?></th>
            <th><a class="action" href="<?php echo url_for('/staff/admins/show.php?id=' . h(u($admin['id']))); ?>">View</a></th>
            <th><a class="action" href="<?php echo url_for('/staff/admins/edit.php?id=' . h(u($admin['id']))); ?>">Edit</a></th>
            <th><a class="action" href="<?php echo url_for('/staff/admins/delete.php?id=' . h(u($admin['id']))); ?>">Delete</a></th>
        </tr>
        <?php } ?>
    </table>
    <?php mysqli_free_result($admin_set); ?>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>