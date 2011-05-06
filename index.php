<!DOCTYPE HTML>
<html>
	<head>
		<title>Sistema de codificaci&oacute;n DAL15</title>
		<meta sharset="utf-8";>
	</head>
	<body style="font-family:courier new;">
		<form action="" method="POST">
			<?php
				if(isset($_POST['mensaje_codificar'])){
			?>
					<input type="text" name="mensaje_codificar" value="<?=$_POST['mensaje_codificar']?>"/>
					<input type="text" name="claveCO" value="<?=$_POST['claveCO']?>"/>
					<input type="tel" name="tipo" value="<?=$_POST['tipo']?>"/>
			<?php
				}else{
			?>
				<input type="text" name="mensaje_codificar"/>
				<input type="text"name="claveCO"/>
					<input type="tel" name="tipo"/>
			<?php
				}
			?>
			
			<button name="codificar">Codificar</button>
		</form>
		<form action="" method="POST">
			<?php
				if(isset($_POST['mensaje_decodificar'])){
			?>
				<input type="text" name="mensaje_decodificar" value="<?=$_POST['mensaje_decodificar']?>"/>
				<input type="text" name="claveDE" value="<?=$_POST['claveDE']?>"/>
					<input type="tel" name="tipo" value="<?=$_POST['tipo']?>"/>
			<?php
				}else{
			?>
				<input type="text" name="mensaje_decodificar"/>
				<input type="text"name="claveDE"/>
					<input type="tel" name="tipo"/>
			<?php
				}
			?>
			<button name="decodificar">Decodificar</button>
		</form>
		<?php
			include('DAL15_nuevo.php');
			if(isset($_POST['codificar'])){
				$mensaje = $_POST['mensaje_codificar'];//Mensaje CO
				$clave=$_POST['claveCO'];
				$tipo = $_POST['tipo'];
				echo "<textarea>".DAL15_ENCODE($mensaje, $clave, $tipo)."</textarea>";
			}
			if(isset($_POST['decodificar'])){
				$mensaje2 = $_POST['mensaje_decodificar'];//Mensaje DE
				$clave2=$_POST['claveDE'];
				$tipo = $_POST['tipo'];
				echo "<textarea>".DAL15_DECODE($mensaje2, $clave2, $tipo)."</textarea>";
			}
			
		?>
	</body>
</html>