<?php
//sanitise below path
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/employees/lecturers/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {

  $result = delete_page($id);
  redirect_to(url_for('/employees/lecturers/index.php'));

} else {
  $lecturer = find_lecturer_by_id($id);
}

?>

<?php $page_title = 'Delete Lecturer'; ?>
<!--sanitise below path-->
<?php include(SHARED_PATH . '/employee_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/employees/lecturers/index.php'); ?>">&laquo; Back to List</a>

  <div class="lecturer delete">
    <h1>Delete Lecturer</h1>
    <p>Are you sure you want to delete this lecturer?</p>
    <p class="item"><?php echo ($lecturer['category']); ?></p>
<!--sanitise below data-->
    <form action="<?php echo url_for('/employees/lecturers/delete.php?id=' . ($lecturer['id'])); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Lecturer" />
      </div>
    </form>
  </div>

</div>
<!--sanitise below path-->
<?php include(SHARED_PATH . '/employee_footer.php'); ?>
