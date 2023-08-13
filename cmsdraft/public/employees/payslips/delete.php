<!--sanitise below data-->
<?php
//cmss22 public/employees/payslips/delete.php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/employees/payslips/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {

  $result = delete_payslip($id);
  redirect_to(url_for('/employees/payslips/index.php'));

} else {
  $payslip = find_payslip_by_id($id);
}

?>

<?php $page_title = 'Delete Payslip'; ?>
<?php include(SHARED_PATH . '/employee_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/employees/payslips/index.php'); ?>">&laquo; Back to List</a>

  <div class="payslip delete">
    <h1>Delete Payslip</h1>
    <p>Are you sure you want to delete this payslip?</p>
    <p class="item"><?php echo h($payslip['category']); ?></p>
<!--sanitise below data-->
    <form action="<?php echo url_for('/employees/payslips/delete.php?id=' . ($payslip['id'])); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Payslip" />
      </div>
    </form>
  </div>

</div>
<!--sanitise below data-->
<?php include(SHARED_PATH . '/employee_footer.php'); ?>
