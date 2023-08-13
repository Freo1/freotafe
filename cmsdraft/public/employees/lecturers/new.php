<?php
//sanitise below path
require_once('../../../private/initialize.php');
//cmss22 public/employees/lecturers/new.php
if(is_post_request()) {

  $lecturer = [];
  $lecturer['payslips_id'] = $_POST['payslips_id'];
  $lecturer['category'] = $_POST['category'];
  $lecturer['position'] = $_POST['position'];
  $lecturer['visible'] = $_POST['visible'];
  $lecturer['content'] = $_POST['content'];

  $result = insert_lecturer($lecturer);
  if($result === true) {
    $new_id = mysqli_insert_id($db);
    redirect_to(url_for('/employees/lecturers/show.php?id=' . $new_id));
  } else {
    $errors = $result;
  }

} else {

  $lecturer = [];
  $lecturer['payslips_id'] = '';
  $lecturer['category'] = '';
  $lecturer['position'] = '';
  $lecturer['visible'] = '';
  $lecturer['content'] = '';

}

$lecturer_set = find_all_lecturers();
$lecturer_count = mysqli_num_rows($lecturer_set) + 1;
mysqli_free_result($lecturer_set);

?>

<?php $lecturer_title = 'Create lecturer'; ?>
<!--sanitise below path-->
<?php include(SHARED_PATH . '/employee_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/employees/lecturers/index.php'); ?>">&laquo; Back to List</a>

  <div class="lecturer new">
    <h1>Create lecturer</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/employees/lecturers/new.php'); ?>" method="post">
      <dl>
        <dt>payslip</dt>
        <dd>
          <select name="payslips_id">
          <?php
            $payslip_set = find_all_payslips();
            while($payslip = mysqli_fetch_assoc($payslip_set)) {
				//<!--sanitise below data-->
              echo "<option value=\"" . ($payslip['id']) . "\"";
              if($lecturer["payslips_id"] == $payslip['id']) {
                echo " selected";
              }
              echo ">" . ($payslip['category']) . "</option>";
            }
            mysqli_free_result($payslip_set);
          ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Category</dt>
		<!--sanitise below data-->
        <dd><input type="text" name="category" value="<?php echo ($lecturer['category']); ?>" /></dd>
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
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
		  <!--sanitise below data-->
          <input type="checkbox" name="visible" value="1"<?php if($lecturer['payslips_id'] == "1") { echo " checked"; } ?> />
        </dd>
      </dl>
      <dl>
        <dt>Content</dt>
        <dd>
		<!--sanitise below data-->
          <textarea name="content" cols="60" rows="10"><?php echo ($lecturer['content']); ?></textarea>
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create lecturer" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/employee_footer.php'); ?>
