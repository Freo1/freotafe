<?php
//sanitise below data-->
require_once('../../../private/initialize.php');
//cmss22 public/employees/payslips/edit.php
if(!isset($_GET['id'])) {
  redirect_to(url_for('/employees/payslips/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {

  // Handle form values sent by new.php

  $payslip = [];
  $payslip['id'] = $id;
  $payslip['category'] = $_POST['category'];
  $payslip['position'] = $_POST['position'];
  $payslip['visible'] = $_POST['visible'];

  $result = update_payslip($payslip);
  if($result === true) {
    redirect_to(url_for('/employees/payslips/show.php?id=' . $id));
  } else {
    $errors = $result;
    //var_dump($errors);
  }

} else {

  $payslip = find_payslip_by_id($id);

}

$payslip_set = find_all_payslips();
$payslip_count = mysqli_num_rows($payslip_set);
mysqli_free_result($payslip_set);

?>

<?php $page_title = 'Edit Payslip'; ?>
<?php include(SHARED_PATH . '/employee_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/employee/payslip/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject edit">
    <h1>Edit Payslip</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/employees/payslips/edit.php?id=' . ($id)); ?>" method="post">
      <dl>
        <dt>Category</dt>
        <dd><input type="text" name="category" value="<?php echo ($payslip['category']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
		  <!--sanitise below data-->
          <?php
            for($i=1; $i <= $payslip_count; $i++) {
              echo "<option value=\"{$i}\"";
              if($payslip["position"] == $i) {
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
          <input type="checkbox" name="visible" value="1"<?php if($payslip['visible'] == "1") { echo " checked"; } ?> />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit Payslip" />
      </div>
    </form>

  </div>

</div>
<!--sanitise below data-->
<?php include(SHARED_PATH . '/employee_footer.php'); ?>
