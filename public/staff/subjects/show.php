<?php require_once('../../../private/initialize.php'); ?>

<?php

//$_GET automatically decodes from urlencode();
$id = $_GET['id'] ?? '1'; //php > 7.0

echo h($id);

?><br />

<a href="show.php?name=<?php echo u('John Doe'); ?>">Link</a><br />
<a href="show.php?company=<?php echo u('Widgets&More');?>">Link</a><br />
<a href="show.php?query=<?php echo u('!#*?'); ?>">Link</a><br />