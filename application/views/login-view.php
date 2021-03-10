<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Aplikasi Operasional JKC</title>
	<link rel="stylesheet" href="<?php echo base_url('assets')?>/login/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url('assets')?>/login/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
</head>
<style>
body{
	background-color: #0c1433;
background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='736' height='736' viewBox='0 0 800 800'%3E%3Cg fill='none' stroke='%23342a44' stroke-width='1'%3E%3Cpath d='M769 229L1037 260.9M927 880L731 737 520 660 309 538 40 599 295 764 126.5 879.5 40 599-197 493 102 382-31 229 126.5 79.5-69-63'/%3E%3Cpath d='M-31 229L237 261 390 382 603 493 308.5 537.5 101.5 381.5M370 905L295 764'/%3E%3Cpath d='M520 660L578 842 731 737 840 599 603 493 520 660 295 764 309 538 390 382 539 269 769 229 577.5 41.5 370 105 295 -36 126.5 79.5 237 261 102 382 40 599 -69 737 127 880'/%3E%3Cpath d='M520-140L578.5 42.5 731-63M603 493L539 269 237 261 370 105M902 382L539 269M390 382L102 382'/%3E%3Cpath d='M-222 42L126.5 79.5 370 105 539 269 577.5 41.5 927 80 769 229 902 382 603 493 731 737M295-36L577.5 41.5M578 842L295 764M40-201L127 80M102 382L-261 269'/%3E%3C/g%3E%3Cg fill='%23074155'%3E%3Ccircle cx='769' cy='229' r='14'/%3E%3Ccircle cx='539' cy='269' r='14'/%3E%3Ccircle cx='603' cy='493' r='14'/%3E%3Ccircle cx='731' cy='737' r='14'/%3E%3Ccircle cx='520' cy='660' r='14'/%3E%3Ccircle cx='309' cy='538' r='14'/%3E%3Ccircle cx='295' cy='764' r='14'/%3E%3Ccircle cx='40' cy='599' r='14'/%3E%3Ccircle cx='102' cy='382' r='14'/%3E%3Ccircle cx='127' cy='80' r='14'/%3E%3Ccircle cx='370' cy='105' r='14'/%3E%3Ccircle cx='578' cy='42' r='14'/%3E%3Ccircle cx='237' cy='261' r='14'/%3E%3Ccircle cx='390' cy='382' r='14'/%3E%3C/g%3E%3C/svg%3E");
}
</style>
<body> 
	<div id="container" class="bungloon-outline" data-background="<?php echo base_url('assets')?>/login/img/tol.jpg">
		<div class="animate__animated animate__slideInDown box box-sm">
			<div class="logo">
				<span style="color:rgba(255,255,255,.4);">Welcometo</span>
				<h1 style="font-size:32pt;letter-spacing:-3px;">APP<span style="color:yellow">OPERASIONAL</span></h1>
			</div>
			<div class="form">
				<form action="<?php echo base_url('auth/cekLogin')?>" method="POST">
					<div class="form-group">
						<span class="form-icon"><i class="fa fa-user"></i></span>
						<input type="text" class="form-input" placeholder="username" name="npp">
					</div>
					<div class="form-group">
						<span class="form-icon"><i class="fa fa-lock"></i></span>
						<input type="password" class="form-input" placeholder="password" name="password">
					</div>
					<button type="submit" value="submit" class="btn btn-success btn-block" style="color:white;">Sign in</button>
					<div class="form-text">
						<a href="https://iot-lab.tech" target="_blank">&copy2020 - IoT Lab Jasamarga</a>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo base_url('assets')?>/login/plugin/jQuery/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url('assets')?>/login/js/script.js"></script>
</body>
</html>