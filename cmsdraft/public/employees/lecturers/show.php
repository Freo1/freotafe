<!--sanitise below path-->
<!-- //cmss22 public/employees/lecturers/show.php -->

<?php require_once('../../../private/initialize.php'); ?>
<?php
// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$id = $_GET['id']; // PHP > 7.0

$lecturer = find_lecturer_by_id($id);

?>

<?php $lecturer_title = 'Show lecturer'; ?>
<?php include(SHARED_PATH . '/employee_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/employees/lecturers/index.php'); ?>">&laquo; Back to List</a>

  <div class="lecturer show">

    <h1>lecturer: <?php echo ($lecturer['category']); ?></h1>

    <div class="attributes">
      <?php $payslip = find_payslip_by_id($lecturer['payslips_id']); ?>
      <dl>
        <dt>Lecturer Category</dt>
		<!--sanitise below data-->
        <dd><?php echo ($lecturer['category']); ?></dd>
      </dl>
      <dl>
        <dt>Category</dt>
		<!--sanitise below data-->
        <dd><?php echo ($lecturer['category']); ?></dd>
      </dl>
      <dl>
        <dt>Position</dt>
		<!--sanitise below data-->
        <dd><?php echo ($lecturer['position']); ?></dd>
      </dl>
      <dl>
        <dt>Visible</dt>
		<!--sanitise below data-->
        <dd><?php echo $lecturer['visible'] == '1' ? 'true' : 'false'; ?></dd>
      </dl>
      <dl>
        <dt>Content</dt>
		<!--sanitise below data-->
        <dd><?php echo ($lecturer['content']); ?></dd>
      </dl>
    </div>


  </div>

</div>
<!--sanitise below path-->
<?php include(SHARED_PATH . '/employee_footer.php'); ?>
