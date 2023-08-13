<!-- //cmss22 public/employees/index.php -->

<?php require_once('../../private/initialize.php'); ?>
<?php $page_title = 'Staff Menu'; ?>
<?php include(SHARED_PATH . '/employee_header.php'); ?>

<div id="content">
  <div id="main-menu">
    <h2>Main Menu</h2>
    <ul>
      <li><a href="<?php echo url_for('/employees/payslips/index.php'); ?>">Payslips</a></li>
      <li><a href="<?php echo url_for('/employees/lecturers/index.php'); ?>">Employees</a></li>
    </ul>
  </div>

</div>

<?php include(SHARED_PATH . '/employee_footer.php'); ?>
