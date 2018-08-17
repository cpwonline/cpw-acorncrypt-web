<!DOCTYPE HTML>
<html>
	<head>
		<title>Sistema de codificaci&oacute;n DAL15</title>
		<meta sharset="utf-8";>
		<style>
			*{padding:0;margin:0;}
			body{padding:2cm 0 2cm 0;font-family:sans-serif;text-align:center;}
			h3{font-size:20pt;float:none;color:#00cc00}
			h4{font-size:14pt;display:inline-block;float:none;color:#777;margin-bottom:.7cm;}
			form.cifrado, form.descifrado{;padding:.8cm;margin-bottom:.5cm;}
			form.cifrado input,
			form.descifrado input{
				background:none;
				border:none;
				padding:10px 15px;
				border-bottom: 1px solid #00cc00;
				border-top: 1px solid #fff;
				border-right: 1px solid #fff;
				border-left: 1px solid #fff;
				color:#00cc00;
			}
			form.cifrado input:hover,form.descifrado input:hover{border:1px solid #00cc00;}
			form.cifrado button,
			form.descifrado button{
				padding:5px 10px;
				background:none;
				border:1px solid #00cc00;
				color:#00cc00;
				cursor:pointer;
			}
			form.cifrado button:hover,
			form.descifrado button:hover{
				color:#fff;
				background:#00cc00
			}
			section.results{text-align:center;}
			textarea.result{padding:.3cm;width:90%;float:none;border:none;border:1px solid #00cc00;height:7cm;}
		</style>
	</head>
	<body>
		<h3>¡Hola! Bienvenido a DAL15</h3>
		<h4>El sistema que le ayudar&aacute; a tener sus datos seguros</h3>
		<form action="" method="POST" class="cifrado">
			<?php
				if(isset($_POST['mensaje_cifrar'])){
			?>
					<input placeholder="Mensaje" type="text" name="mensaje_cifrar" value="<?=$_POST['mensaje_cifrar']?>"/>
					<input placeholder="Clave" type="text" name="claveCO" value="<?=$_POST['claveCO']?>"/>
					<input placeholder="Tipo" type="tel" name="tipo" value="<?=$_POST['tipo']?>"/>
			<?php
				}else{
			?>
				<input placeholder="Mensaje" type="text" name="mensaje_cifrar"/>
				<input placeholder="Clave" type="text"name="claveCO"/>
					<input placeholder="Tipo" type="tel" name="tipo"/>
			<?php
				}
			?>
			
			<button name="cifrar">cifrar</button>
		</form>
		<form action="" method="POST" class="descifrado">
			<?php
				if(isset($_POST['mensaje_descifrar'])){
			?>
				<input placeholder="Mensaje" type="text" name="mensaje_descifrar" value="<?=$_POST['mensaje_descifrar']?>"/>
				<input placeholder="Clave" type="text" name="claveDE" value="<?=$_POST['claveDE']?>"/>
					<input placeholder="Tipo" type="tel" name="tipo" value="<?=$_POST['tipo']?>"/>
			<?php
				}else{
			?>
				<input placeholder="Mensaje" type="text" name="mensaje_descifrar"/>
				<input placeholder="Clave" type="text"name="claveDE"/>
					<input placeholder="Tipo" type="tel" name="tipo"/>
			<?php
				}
			?>
			<button name="descifrar">descifrar</button>
		</form>
		<section class="results">
		<?php
			include('DAL15.php');
			if(isset($_POST['cifrar'])){
				$mensaje = $_POST['mensaje_cifrar'];//Mensaje CO
				$clave=$_POST['claveCO'];
				$tipo = $_POST['tipo'];
				echo "<textarea class='result'>".DAL15_ENCODE($mensaje, $clave, $tipo)."</textarea>";
			}
			if(isset($_POST['descifrar'])){
				$mensaje2 = $_POST['mensaje_descifrar'];//Mensaje DE
				$clave2=$_POST['claveDE'];
				$tipo = $_POST['tipo'];
				echo "<textarea class='result'>".DAL15_DECODE($mensaje2, $clave2, $tipo)."</textarea>";
			}
			
		?>
		</section>
	</body>
</html>