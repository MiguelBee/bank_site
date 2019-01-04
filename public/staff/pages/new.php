<?php

require_once('../../../private/initialize.php');

$test = $_GET['test'] ?? '';

if(request_is_post()){
    //handle form values sent by new.php
    $menu_name = $_POST['menu_name'] ?? '';
    $position = $_POST['position'] ?? '';
    $visible = $_POST['visible'] ?? '';
    
    echo "Form parameters<br />";
    echo "Menu name: " . $menu_name . "<br />";
    echo "Position: " . $position . "<br ?>";
    echo "Visible: " . $visible . "<br />";
}

?>

<?php echo $page_title = "Create Page"; ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>
<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

  <div class="page new">
    <h1>Create Page</h1>

    <!--action is what page the form gets sent to -->
    <form action="<?php echo url_for('/staff/pages/new.php'); ?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo h($menu_name); ?>" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <option value="1"<?php if($position == "1"){ echo "selected"; } ?>>1</option>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1" />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Page" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>