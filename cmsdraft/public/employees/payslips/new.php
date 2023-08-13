<!--sanitise below data-->
<?php
//cmss22 public/employees/payslips/new.php
require_once('../../../private/initialize.php');

if(is_post_request()) {

  $payslip = [];
  $payslip['category'] = $_POST['category'];
  $payslip['position'] = $_POST['position'];
  $payslip['visible'] = $_POST['visible'];

  $result = insert_payslip($payslip);
  if($result === true) {
    $new_id = mysqli_insert_id($db);
    redirect_to(url_for('/employees/payslips/show.php?id=' . $new_id));
  } else {
    $errors = $result;
  }

} else {
  // display the blank form
  $payslip = [];
  $payslip["category"] = '';
  $payslip["position"] = '';
  $payslip["visible"] = '';
}

$payslip_set = find_all_payslips();
$payslip_count = mysqli_num_rows($payslip_set) + 1;
mysqli_free_result($payslip_set);

?>

<?php $page_title = 'Create Payslip'; ?>
<?php include(SHARED_PATH . '/employee_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/employees/payslips/index.php'); ?>">&laquo; Back to List</a>

  <div class="payslip new">
    <h1>Create Payslip</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/employees/payslips/new.php'); ?>" method="post">
      <dl>
        <dt>Category</dt>
		<!--sanitise below data-->
        <dd><input type="text" name="category" value="<?php echo $payslip['category']; ?>" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
		<!--sanitise below data-->
          <select name="position">
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
          <input type="checkbox" name="visible" value="1"<?php echo $payslip['visible']; ?> />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Payslip" />
      </div>
    </form>

  </div>

</div>
<!--sanitise below data-->
<?php include(SHARED_PATH . '/employee_footer.php'); ?>
