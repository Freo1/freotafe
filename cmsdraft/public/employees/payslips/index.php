<!--sanitize below path-->
<!-- //cmss22 public/employees/payslips/index.php -->

<?php require_once('../../../private/initialize.php'); ?>
<?php

  $payslip_set = find_all_payslips();

?>

<?php $page_title = 'Payslip'; ?>
<!--sanitize below path-->
<?php include(SHARED_PATH . '/employee_header.php'); ?>

<div id="content">
  <div class="payslip listing">
    <h1>Payslips</h1>

    <div class="actions">
	<!--sanitize below path-->
      <a class="action" href="<?php echo ('new.php'); ?>">Create New Payslip</a>
    </div>

  	<table class="list">
  	  <tr>
        <th>ID</th>
        <th>Position</th>
        <th>Visible</th>
  	    <th>Category</th>
  	    <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>

      <?php while($payslip = mysqli_fetch_assoc($payslip_set)) { ?>
        <tr>
		<!--sanitize below data-->
          <td><?php echo ($payslip['id']); ?></td>
		  	<!--sanitize below path-->
          <td><?php echo ($payslip['position']); ?></td>
		  	<!--sanitize below path-->
          <td><?php echo $payslip['visible'] == 1 ? 'true' : 'false'; ?></td>
		  	<!--sanitize below path-->
    	    <td><?php echo ($payslip['category']); ?></td>
			<!--sanitize below data-->
          <td><a class="action" href="<?php echo ('show.php?id=' . $payslip['id']); ?>">View</a></td>
          <td><a class="action" href="<?php echo ('edit.php?id=' . $payslip['id']); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo ('delete.php?id=' . $payslip['id']); ?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

    <?php
      mysqli_free_result($payslip_set);
    ?>
  </div>

</div>
	<!--sanitize below path-->
<?php include(SHARED_PATH . '/employee_footer.php'); ?>
