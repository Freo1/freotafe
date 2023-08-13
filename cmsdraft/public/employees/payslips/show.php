<!--sanitise below data-->
<!-- //cmss22 public/employees/payslips/show.php -->

<?php require_once('../../../private/initialize.php'); ?>

<?php
// $id = isset($_GET['id']) ? $_GET['id'] : '1';
//$id = $_GET['id'] ?? '1'; // PHP > 7.0
$id = $_GET['id']; // PHP > 7.0
$payslip = find_payslip_by_id($id);

?>

<?php $page_title = 'Show Payslip'; ?>
<?php include(SHARED_PATH . '/employee_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/employees/payslips/index.php'); ?>">&laquo; Back to List</a>

  <div class="payslip show">
<!--sanitise below data-->
    <h1>Payslip: <?php echo ($payslip['category']); ?></h1>

    <div class="attributes">
      <dl>
        <dt>Menu Name</dt>
		<!--sanitise below data-->
        <dd><?php echo ($payslip['category']); ?></dd>
      </dl>
      <dl>
        <dt>Position</dt>
		<!--sanitise below data-->
        <dd><?php echo ($payslip['position']); ?></dd>
      </dl>
      <dl>
        <dt>Visible</dt>
		<!--sanitise below data-->
        <dd><?php echo $payslip['visible'] == '1' ? 'true' : 'false'; ?></dd>
      </dl>
    </div>

  </div>

</div>
