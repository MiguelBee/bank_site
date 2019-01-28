<?php

require_once('../../../private/initialize.php');

require_login();

if(request_is_post()){
    //handle form values sent by new.php
      $admin = [];
      $admin['first_name'] =  $_POST['first_name'] ?? '';
      $admin['last_name'] = $_POST['last_name'] ?? '';
      $admin['email'] = $_POST['email'] ?? '';
      $admin['username'] = $_POST['username'] ?? '';
      $admin['password'] = $_POST['password'] ?? '';
      $admin['confirm_password'] = $_POST['confirm_password'] ?? '';
      
      $result = insert_admin($admin);
      if($result === true){
        $new_id = mysqli_insert_id($db);
        $_SESSION['status_message'] = "You have successfully created an admin";
        redirect_to(url_for('/staff/admins/show.php?id=' . $new_id)); 
      } else {
        $errors = $result;
      }
  } else {
      $admin = [];
      $admin['first_name'] = '';
      $admin['last_name'] = '';
      $admin['email'] = '';
      $admin['username'] = '';
      $admin['password'] = '';
      $admin['confirm_password'] = '';
}

$admin_set = find_all_admins();
$admin_count = mysqli_num_rows($admin_set) + 1;
mysqli_free_result($admin_set);

?>

<?php $page_title = "Create admin"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">&laquo; Back to List</a>

  <div class="admin new">
    <h1>Create Admin</h1>
    
    <?php echo display_errors($errors); ?>

    <!--action is what page the form gets sent to -->
    <form action="<?php echo url_for('/staff/admins/new.php'); ?>" method="post">
        <dt>First Name</dt>
        <dd><input type="text" name="first_name" value="" /></dd>
      </dl>
      <dl>
        <dt>Last Name</dt>
        <dd><input type="text" name="last_name" value="" /></dd>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><input type="text" name="email" value="" /></dd>
      </dl>
      <dl>
        <dt>Username</dt>
        <dd><input type="text" name="username" value="" /></dd>
      </dl>
      <dl>
        <dt>Password</dt>
        <dd><input type="password" name="password" value="" /></dd>
      </dl>
      <dl>
        <dt>Confirm Password</dt>
        <dd><input type="password" name="confirm_password" value=""/></dd>
      </dl>
      <p>
        Passwords should be at least 12 characters and include at least one uppercase letter, lowercase letter, number, and symbol
      </p>
      <div id="operations">
        <input type="submit" value="Create Admin" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>