<?php
//cmss22 private/shared/employee_header.php

  if(!isset($page_title)) { $page_title = 'EMPLOYEE Area'; }
?>

<!doctype html>

<html lang="en">
  <head>
    <title>PAYROLL WEBSITE | <?php echo h($page_title); ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/employee.css'); ?>" />
  </head>

  <body>
    <header>
      <h1>PAYROLL Staff Area</h1>
    </header>

    <navigation>
      <ul>
        <li><a href="<?php echo url_for('/employees/index.php'); ?>">Menu</a></li>
      </ul>
    </navigation>
