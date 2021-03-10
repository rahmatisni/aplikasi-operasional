<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Aplikasi Operasional CSJ</title>
  <?= $include ?>
</head>
<style>
.swal2-popup {
  font-size: 1.6rem !important;
}

.select2-default { width: auto !important; }

</style>
<body class="body">
<style>
  .thead-dark {
  
      color: white;
      background-color: black;
      border-color: white;
  }
</style>
	<div class="container-fluid" id="wrapper">
    <?= $sidebar ?>

		<div id="content">
			<div class="content-nav">
       			 <?= $navbar ?>
			</div>
        	<?= $content ?>
		</div>
	</div>
</body>

</html>