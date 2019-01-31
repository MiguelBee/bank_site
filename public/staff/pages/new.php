<?php

require_once('../../../private/initialize.php');

require_login();

if(request_is_post()){
    //handle form values sent by new.php
      $page = [];
      $page['subject_id'] =  $_POST['subject_id'] ?? '';
      $page['menu_name'] = $_POST['menu_name'] ?? '';
      $page['position'] = $_POST['position'] ?? '';
      $page['content'] = $_POST['content'] ?? '';
      $page['visible'] = $_POST['visible'] ?? '';
      
      $result = insert_page($page);
      if($result === true){
        $new_id = mysqli_insert_id($db);
        $_SESSION['status_message'] = "You have successfully created a page";
        redirect_to(url_for('/staff/pages/show.php?id=' . $new_id)); 
      } else {
        $errors = $result;
      }
  } else {
      $page = [];
      $page['subject_id'] = $_GET['subject_id'] ?? '1';
      $page['menu_name'] = '';
      $page['position'] = '';
      $page['content'] = '';
      $page['visible'] = '';
}

$page_count = count_pages_by_subject_id($page['subject_id']) + 1;

?>

<?php $page_title = "Create Page"; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/subjects/show.php?id=' . h(u($page['subject_id']))); ?>">&laquo; Back to Subject Page</a>

  <div class="page new">
    <h1>Create Page</h1>
    
    <?php echo display_errors($errors); ?>

    <!--action is what page the form gets sent to -->
    <form action="<?php echo url_for('/staff/pages/new.php'); ?>" method="post">
      <dl>
        <dt>Subject</dt>
        <dd>
          <select name="subject_id">
            <?php
              $subject_set = find_all_subjects();
              while($subject = mysqli_fetch_assoc($subject_set)){
                echo "<option value=\"" . h($subject['id']) . "\"";
                if($page["subject_id"] == $subject['id']){
                  echo " selected";
                }
                echo ">" . h($subject['menu_name']) . "</option>";
              }
              mysqli_free_result($subject_set);
            ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <?php
              for($i = 1; $i <= $page_count; $i ++){
                echo "<option value=\"{$i}\"";
                if($page["position"] == $i){
                  echo " selected";
                }
                echo ">{$i}</option>";
              }
            ?>
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
      <dl>
      <dt>Content</dt>
        <dd>
          <textarea name="content" cols="60" rows="10"></textarea>
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Page" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>