<!DOCTYPE html>
<html lang="en">

<head>
<?php //echo $_headscript; ?>
<?= $this->include('layout/bsa_headscript') ?>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
<?php //echo $_header; ?>
<?= $this->include('layout/bsa_header') ?>
<?php //echo $_left; ?>
<?= $this->include('layout/bsa_left') ?>
  
<?php //echo $_main; ?>
<?php //= $this->include('layout/bsa_main') ?>
<?= $this->renderSection('bsa_main') ?>
<?php //echo $_footer; ?>
<?= $this->include('layout/bsa_footer') ?>
</div>
<!-- ./wrapper -->

<?php //echo $_footscript; ?>
<?= $this->include('layout/bsa_footscript') ?>
</body>
</html>
