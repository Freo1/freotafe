<?php

require_once('../../../private/initialize.php');
//cmss22 public/employees/lecturers/edit.php
//require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/employees/lecturers/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {

  // Handle form values sent by new.php

  $lecturer = [];
  $lecturer['id'] = $id;
  $lecturer['lecturer_id'] = $_POST['lecturer_id'];
  $lecturer['category'] = $_POST['category'];
  $lecturer['position'] = $_POST['position'];
  $lecturer['visible'] = $_POST['visible'];
  $lecturer['content'] = $_POST['content'];

  $result = update_lecturer($lecturer);
  if($result === true) {
    $_SESSION['message'] = 'The lecturer was updated successfully.';
    redirect_to(url_for('/employees/lecturers/show.php?id=' . $id));
  } else {
    $errors = $result;
  }

} else {

  $lecturer = find_lecturer_by_id($id);

}

$lecturer_set = find_all_lecturers();
$lecturer_count = mysqli_num_rows($lecturer_set);
mysqli_free_result($lecturer_set);

?>

<?php $lecturer_title = 'Edit ORDER'; ?>
<?php include(SHARED_PATH . '/employee_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/employees/lecturers/index.php'); ?>">&laquo; Back to List</a>

  <div class="lecturer edit">
    <h1>Edit LECTURERS</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/employees/lecturers/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>lecturer</dt>
        <dd>
          <select name="lecturer_id">
          <?php
            $payslip_set = find_all_payslips();
			//echo $payslip_set['payslip_id'];
            while($payslip = mysqli_fetch_assoc($payslip_set)) {
              echo "<option value=\"" . h($payslip['id']) . "\"";
              if($lecturer["id"] == $payslip['id']) {
                echo " selected";
              }
              echo ">" . h($payslip['category']) . "</option>";
            }
            mysqli_free_result($payslip_set);
          ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Customer Name</dt>
        <dd><input type="text" name="category" value="<?php echo h($lecturer['category']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <?php
              for($i=1; $i <= $lecturer_count; $i++) {
                echo "<option value=\"{$i}\"";
                if($lecturer["position"] == $i) {
                  echo " selected";
                }
                echo ">{$i}</option>";
              }
            ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>AVAILABLE</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1"<?php if($lecturer['visible'] == "1") { echo " checked"; } ?> />
        </dd>
      </dl>
      <dl>
        <dt>Comment</dt>
        <dd>
          <textarea name="content" cols="60" rows="10"><?php echo h($lecturer['content']); ?></textarea>
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit lecturer" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/employee_footer.php'); ?>

