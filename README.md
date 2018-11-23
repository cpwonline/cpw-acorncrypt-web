¡Hola! Gracias por descargar Acorn DAL15

	Acorn DAL15 es un sistema de cifrado/descifrado de datos.
	Este sistema está fundamentado en la utilización de un mensaje y una clave, lo cual lo hacer ser un cifrado simétrico.
	El cifrado simétrico corresponde a un mensaje cifrado/descifrado con una clave pública.
	El mensaje se cifra con una clave de 128 bits para una correcta ocultación del mensaje.
	
	Contenido
		El contenido que trae el repositorio (si usó GIT) o archivo comprimido es el siguiente:
		-README: este mismo archivo
		-DAL15.php: el archivo principal y el único que necesita para realizar los cifrados/descifrados
		-index.php: una página para que usted pueda probar el sistema desde su servidor local (recuerde tenerlo instalado, 
			puede ser WAMP, XAMPP, LAMP, MAMP, LEMP, entre otros)
	
	Sintaxis básica
		Para poder cifrar o descifrar lo que debe hacer es por medio del objeto $DAL15 acceder a el método main() y establecer
		los parámetros correspondientes:
			<?php
				$resultado = $DAL15->main(Mensaje, Clave, Tipo, CIF/DES);
			?>
			
			Explicación:
				-$resultado: variable en la cual se almacena el valor dado por el retorno de la función main()
				-$DAL15: objeto que permite el acceso hacia el sistema Acorn DAL15
				-main: función principal que administra los procesos necesarios para un correcto cifrado/descifrado
					La función main() contiene los siguientes parámetros:
					
						-Mensaje
							El mensaje puede tener cualquier longitud (mientras más grandes más durará la conversión). Pueden ser 		
							cualquier caracter alfanumérico e incluso símbolos especiales.
							
						-Clave
							La clave es de 128 bits para un cifrado seguro. El sistema solo tomará 16 caracteres de la clave, si hay 
							más el sistema los ignorará; si no hay 16 caracteres el sistema los reemplazará por otros (estos no afectan).
							Pueden ser cualquier caracter alfanumérico e incluso símbolos especiales.
							
						-Tipo
							hay 3 tipos de cifrado/descifrado: 1, 2 y 3 (Todos deben expresarse en número enteros)
								1)Este cifrado/descifrado hace que el resultado cifrado contenga los caracteres alfabeticos 
									estáticos. Si usted prueba a cifrar/descifrar el mismo mensaje, varias veces, con la misma clave tipo 
									1, obtendrá siempre el mismo resultado.
									
								2)Este cifrado/descifrado hace que el resultado cifrado/descifrado contenga los caracteres alfabeticos
								 aleatorios. Si usted prueba a cifrar/descifrar el mismo mensaje, varias veces, con la misma clave tipo 2, 
								 obtendrá siempre diferentes resultados.
								
								3)Este cifrado/descifrado es el más complejo y hace que el resultado cifrado/descifrado contenga no solo
									caracteres aleatorios sino que también los números cambien de lugar. Si usted prueba a cifrar/descifrar
									el mismo mensaje, varias veces, obtendrá resultados casi totalmente diferentes.
	
						-CIF/DES
							hay 2 tipos: 1 y -1 (Números enteros)
								1)Indica que el mensaje debe cifrarse
								-1)Indica que el mensaje debe descifrarse
		
	Instalación
		Desde cualquier página de su sitio web usted puede llamar al sistema DAL15 mediante:
		<?php
			include('DAL15.php');
		?>
		Es el único archivo que usted necesita para poder cifrar/descifrar
		
		Ejemplo de una estructura básica:
			-css
			-img
			-js
			-articulos
			-index.php
			-mysqli.php
			-DAL15.php
			
		Usted podría acceder al archivo DAL15 desde su index de manera sencilla con la anterior estructura de su web 
		en un servidor. 
		
	Ejemplos de uso de Acorn DAL15
		
		1) Para el registro de un usuario
			Código:
				<?php
					//Variables principales
						$nombreDeUsuario = "CPW Online";
						$claveDeUsuario = "1234567";
						$tipo = 1;
					
					//Obtenemos el nombre de usuario cifrado
						$NUCifrado = $DAL15->main($nombreDeUsuario, $claveDeUsuario, $tipo, 1);
				
					//Obtenemos la clave del usuario cifrada
						$CUCifrada = $DAL15->main($claveDeUsuario, $claveDeUsuario, $tipo, 1);
				
					//Ahora las dos variables $NUCifrado y $CUCifrada usted debe guardarlas en su base de datos
					//Según los métodos que usted implemente.
				?>
			Fin Código
			
			Explicación.
				-Las dos variables principales son el nombre de usuario y la clave que su sitio web necesitará para el futuro inicio
				de sesión de su usuario. Usted puede usar cualquier método para recoger esos datos (Javascript, POST, GET, 
					entre otros).
				-Ahora ciframos el nombre de usuario, ¿Con qué clave? Con la clave del usuario y la guardamos en una variable.
				-Ahora ciframos la clave del usuario, ¿Con qué clave? Con la misma clave usada anteriormente y la guardamos 
					en una variable.
				-Habiendo cifrado los datos se procede a guardarlos en una base de datos.
				-Tenga en cuenta que el nombre o clave del usuario al ser guardados en la base de datos es IMPOSIBLE (relativamente
					ya que en la informática casi nada lo es) que puedan ser descifrados sin tener la clave del usuario, ya que
					con esta se realizó el cifrado, ¿Cómo descifrarla? con la clave del usuario, ¿en caso de olvido? Se debe crear una
					nueva cuenta, ya que con el nombre de usuario cifrado en la base de datos, entonces ¿Cómo reconocerlo? No 
					se puede.
				
				
		2) Para el incio de sesión de un usuario
			Código:
				<?php
					//Variables principales
						$nombreDeUsuario = "CPW Online";
						$claveDeUsuario = "1234567";
						$tipo = 1;
					
					//Obtenemos el nombre de usuario cifrado
						$NUCifrado = $DAL15->main($nombreDeUsuario, $claveDeUsuario, $tipo, 1);
				
					//Obtenemos la clave del usuario cifrada
						$CUCifrada = $DAL15->main($claveDeUsuario, $claveDeUsuario, $tipo, 1);
				
					//Ahora las dos variables $NUCifrado y $CUCifrada usted debe comprobar (puede ser una consulta SQL o el método 
					//que usted implemente) que ese usuario y contraseña corresponde a un mismo usuario. Podría usarse:
						if($con = $mysqli->query("SELECT usuario, clave FROM usuarios WHERE usuario = '".$NUCifrado."' AND clave = '".$CUCifrada."' "))
							echo "Usuario válido, usted puede iniciar sesión.";
						else
							echo "Usuario o clave incorrectos";
				?>
			Fin Código
			
				
		3) Para el guardado de datos sencillo
			Código:
				<?php
					//Variables principales
						$mensaje = "Clave de misiles de lanzamiento! :D";
						$clave = "cualquier clave";
						$tipo = 3;
					
					//Obtenemos el mensaje cifrado
						$MCifrado = $DAL15->main($mensaje, $clave, $tipo, 1);
				
					//Ahora la variable $MCifrado tiene el mensaje cifrado y ya puede guardarlo en su base de datos. 
					
					//Ahora vamos a descifrar el mensaje y mostrarlo
					
					//Obtenemos el mensaje descifrado
						$MDescifrado = $DAL15->main($MCifrado, $clave, $tipo, -1);
				
						if($mensaje == $MDescifrado)
							echo "Descifrado correcto. El mensaje descifrado es idéntico al mensaje.";
						else
							echo "Si ocurre un error, reporte un bug. ¡Sería de gran ayuda!";
				?>
			Fin Código
			
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
