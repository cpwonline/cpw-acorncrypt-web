# StarFly

## Introducción 🚀

Desarrollado, diseñado y creado por el **Equipo de Desarrolladores Web de CPW Online** | [CPW Online](https://github.com/cpwonline/)

¡Hola! Gracias por utilizar este software, desarrollado con mucho esfuerzo y cariño para la comunidad del Software libre.

## Introduction 🚀

Developed, designed and made by the **Web Developers Team of CPW Online** | [CPW Online](https://github.com/cpwonline/)

Hello! Thank you for using this software, developed with a lot of effort and affection for the Free Software community.

### ¿Qué es Acorn DAL15?

_Acorn DAL15 es un sistema de cifrado/descifrado de datos._

Este sistema está fundamentado en la utilización de un mensaje y una clave, lo cual lo hace ser un cifrado simétrico._
	
_El cifrado simétrico corresponde a un mensaje cifrado/descifrado con una clave pública._

_El mensaje se cifra con una clave de 128 bits para una correcta ocultación del mensaje._

### What's Acorn DAL15?

__

## Características 🎁

* Cuenta con 3 diferentes tipos de cifrado y descifrado
* Sistemas de cifrados complejos
* Puedes cifrar cuantas veces quieras, el resultado descifrado será el correcto
* Seguro y confiable
* No tenemos diccionarios de resultados como los hay para MD5
* Cifrar una sola vez te puede dar diferentes resultados (Depende del tipo de cifrado)



## Features 🎁

* 

### Requerimientos 📋

* 

### Requirements 📋

* 

### Instalación 🔧

_Pasos para instalar Acorn DAL15:_

* 1. Descargar o clonar el repositorio de [Acorn DAL15](https://github.com/cpwonline/acorndal15.git)

* 2. Ahora debe copiar el directorio (si lo descargó debe descomprimirlo primero) en el directorio
donde se encuentra su sitio web local (O remoto)

* 3. En el archivo principal de su sitio web (sea index, index.html o index.php), usted deberá
tener anexado el archivo de su main.js y los archivos de la carpeta starfly, agregue
las siguientes líneas de código en su *head*:

```HTML
	<!--Archivos principales de StarFly-->
		<link rel="stylesheet" href="starfly/css/estilo-gen.css"/>
		<script src="starfly/js/func-gen.js"/></script>
	<!--Fin Archivos principales de StarFly-->
```

### Instalation

_Steps to install Acorn DAL15:_

* 1. Download or clone the repository of [Acorn DAL15](https://github.com/cpwonline/acorndal15.git)

* 2. Now you must copy the directory (if you downloaded it you must unzip it first) in the directory
where is your local website (or remote)

* 3. In the main file of your website (be it index, index.html or index.php), you must
have attached the file of your main.js and the files of the folder starfly, add
The following lines of code in your **head**:

```HTML
	<!--StarFly main files-->
		<link rel="stylesheet" href="starfly/css/estilo-gen.css"/>
		<script src="starfly/js/func-gen.js"/></script>
	<!--End StarFly main files-->
```

## Cómo usar StarFly

Es fácil, hay tres tipos de notificaciones:

* 1. _Not. que desaparece al presionar 'Ok'_

Para mostrar esta notificación, añada las siguientes líneas de código a su *main.js*:

```Js
	//Inicio de código
		//Datos
			var titulo = "Alerta"
			var mensaje = "Usted ha ingresado una clave incorrecta."
		//Notificación
			starFly(titulo, mensaje, 0, 0, "question");
	//Fin de código
```

* 2. _Not. que desaparece automáticamente en determinados segundos_

Para mostrar esta notificación, añada las siguientes líneas de código a su main.js:

```Js
	//Inicio de código
		//Datos
			var titulo = "Alerta"
			var mensaje = "Usted ha ingresado una clave incorrecta."
		//Notificación
			starFly(titulo, mensaje, 1, 5000, "security");
	//Fin de código
```

* _Nota: En el código anterior la notificación desaparecerá al cumplirse 5 segundos (5000 milisegundos)._

* 3. _Not. que desaparece sólo con código_

Para mostrar esta notificación, añada las siguientes líneas de código a su main.js:

```Js
	//Inicio de código
		//Datos
			var titulo = "Alerta"
			var mensaje = "Usted ha ingresado una clave incorrecta."
		//Notificación
			//Se crea
				ob_sF = starFly(titulo, mensaje, 2, 0, "question");
			//Se borra
				borrarElemento_starFly(ob_sF, 1, 'xT');
	//Fin de código
```


* _Extra. También puede editar el mensaje (Solo para la notificación que desaparece con código)_

Para mostrar esta notificación, añada las siguientes líneas de código a su main.js:

```Js
	//Inicio de código
		//Datos
			var titulo = "Alerta"
			var mensaje = "Usted ha ingresado una clave incorrecta."
		//Notificación
			//Se crea
				ob_sF = starFly(titulo, mensaje, 2, 5000, "question");
			//Editamos el mensaje
				nuevoMsj_starFly('Usted ha sido bloqueado', ob_sF);
			//Se borra
				borrarElemento_starFly(ob_sF, 1, 'xT');
	//Fin de código
```

* _Extra. Algunos iconos disponibles para su notificación:_

1. **good**: Icono que indica una afirmación o que algo se realizó correctamente.

2. **settings**: Icono que indica que se ha realizado un ajuste

3. **question**: Icono que indica que ha sucedido un error desconocido

4. **delete**: Icono que indica que se ha eliminado algo

5. **cancel**: Icono que indica que ha sucedido un error en específico

6. **information**: Icono que indica que lo que se muestra es informativo

7. **security**: Icono que indica que lo que se muestra es privado, información importante o restringida

* Extra. Si usted tiene un archivo *.js* (código fuente de JavaScript) usted puede editar ese archivo y
agregar las siguientes líneas de código (Desde "Inicio copiado" hasta "Fin copiado", nada más) para cambiar el
diseño de StarFly:

```Js
		//Inicio copiado
		//Variables generales de StarFly
			//De estilo
				estiloContenedor = "background:hsla(0, 0%, 30%, .9);padding:.2cm;margin-bottom:.1cm;overflow:hidden;text-align:right;border-radius:.1cm;-webkit-border-radius:.1cm;-moz-border-radius:.1cm;-o-border-radius:.1cm;transition:.3s all;-webkit-transition:.3s all;-moz-transition:.3s all;-o-transition:.3s all;";
				estiloIcono = "width:16px;height:16px;display:inline-block;";
				estiloTitulo = "display:inline-block;font-size:12pt;color:#CCC;margin-bottom:.1cm;padding:.25cm;";
				estiloCerrar = "cursor:pointer;display:inline-block;float:right;padding:.4cm;color:#fff;text-align:center;width:10%;";
				estiloMensaje = "font-size:10pt;color:#FFF;";
				estiloBoton = "btn-gen";//Debes elegir una clase de estilo
		//De personalización
				textoBotonGen = "Ok";
		//Fin variables generales de StarFly
		//Fin copiado
```

_Si usted no tiene algún archivo .js, deberá crear un archivo llamado *"main.js"* (Puede ser
el nombre que usted desee) y agregar las líneas de código anteriores._


## How to use StarFly

_It's easy, there are three types of notifications:_

* 1. _Not. that disappears when pressing 'Ok'_

To display this notification, add the following lines of code to your main.js:

```Js
	//Start code
		//Data
			var title = "Alert"
			var message = "You have entered an incorrect password."
		//Notification
			starFly(title, message, 0, 0, "security");
	//End code
```

* 2. _Not. that disappears automatically in certain seconds_

To display this notification, add the following lines of code to your main.js:

```Js
	//Start code
		//Data
			var title = "Alert"
			var message = "You have entered an incorrect password."
		//Notification
			starFly(title, message, 1, 5000, "security");
	//End code
```

* _Note: In the previous code the notification will disappear after 5 seconds (5000 milliseconds)._

* 3. _Not. that disappears only with code_

To display this notification, add the following lines of code to your *main.js*:

```Js
	//Start code
		//Data
			var title = "Alert"
			var message = "You have entered an incorrect password."
		//Notification
			//It's created
				ob_sF = starFly(title, message, 2, 0, "question");
			//It's erased
				borrarElemento_starFly(ob_sF, 1, 'xT');
	//End code
```

* _Extra. You can also edit the message (Only for notification that disappears with code)_

To display this notification, add the following lines of code to your main.js:

```Js
	//Start code
		//Data
			var title = "Alert"
			var message = "You have entered an incorrect password."
		//Notification
			//It's created
				ob_sF = starFly(title, message, 2, 5000, "question");
			//We edit the message
				nuevoMsj_starFly('You have been blocked', ob_sF);
			//It's erased
				borrarElemento_starFly(ob_sF, 1, 'xT');
	//End code
```

* _Extra. Some icons available for notification:_

1. **good**: Icon that indicates an affirmation or that something was done correctly.

2. **settings**: Icon that indicates that an adjustment has been made

3. **question**: Icon indicating that an unknown error has occurred

4. **delete**: Icon that indicates that something has been deleted

5. **cancel**: Icon indicating that a specific error has occurred

6. **information**: Icon that indicates that what is shown is informative

7. **security**: Icon that indicates that what is shown is private, important or restricted information

* _Extra. If you have a .js file (JavaScript source code) you can edit that file and
add the following lines of code (From "Start copied" to "End copied", nothing else) to change the StarFly design:_

```Js
	// Start copied
	// StarFly general variables
		// Of style
			estiloContenedor = "background:hsla(0, 0%, 30%, .9);padding:.2cm;margin-bottom:.1cm;overflow:hidden;text-align:right;border-radius:.1cm;-webkit-border-radius:.1cm;-moz-border-radius:.1cm;-o-border-radius:.1cm;transition:.3s all;-webkit-transition:.3s all;-moz-transition:.3s all;-o-transition:.3s all;";
			estiloIcono = "width:16px;height:16px;display:inline-block;";
			estiloTitulo = "display:inline-block;font-size:12pt;color:#CCC;margin-bottom:.1cm;padding:.25cm;";
			estiloCerrar = "cursor:pointer;display:inline-block;float:right;padding:.4cm;color:#fff;text-align:center;width:10%;";
			estiloMensaje = "font-size:10pt;color:#FFF;";
			estiloBoton = "Your-style";//You must choose a style class
		//Of personalization
			textoBotonGen = "Ok";
	// End StarFly general variables
	// End copied
```

_If you do not have any .js file, you should create a file called *"main.js"* (It can be
the name you want) and add the previous lines of code._


## Documentación

Por los momentos no contamos con documentación en línea, ¡pero trabajamos en ello!

## Documentation

At the moment we do not have online documentation, but we work on it!

## Donaciones

_Si usted quiere ayudarnos financieramente nosotros aceptamos sus donaciones usando 
Paypal y realizando los siguientes pasos:_

* 1. Acceda desde su navegador a la siguiente URL: [PayPal - CPW Online](paypal.me/cpwonline)

* 2. Déjese llevar ;)

## Donations

_If you want to help us financially we accept your donations using
Paypal and performing the following steps:_

* 1. Access the following URL from your browser: [PayPal - CPW Online]( paypal.me/cpwonline)

* 2. Let yourself go ;)

### Contacto

_Si usted desea ponerse en contacto con nosotros es sencillo:_

* **GitHub**: [@cpwonline](https://www.github.com/cpwonline/starfly.git)
* **Web**: [CPW Online](https://www.cpwonline.com.ve/contacto)
* **Email**: [CPW Online](support@cpwonline.com.ve)
* **Facebook**: [@CPWOnline](https://facebook.com/CPWOnline)
* **Instagram**: [@cpwonline](https://instagram.com/cpwonline)

### Contact

_If you wish to contact us, it is simple:_

* **GitHub**: [@cpwonline](https://www.github.com/cpwonline/starfly.git)
* **Web**: [CPW Online](https://www.cpwonline.com.ve/contacto)
* **Email**: [CPW Online](support@cpwonline.com.ve)
* **Facebook**: [@CPWOnline](https://facebook.com/CPWOnline)
* **Instagram**: [@cpwonline](https://instagram.com/cpwonline)

## Licencia 📄

_Este proyecto está bajo la Licencia [Apache License 2.0](http://www.apache.org/licenses/LICENSE-2.0) - mira el archivo [LICENSE](LICENSE) para más detalles_

## Licence 📄

_This project is under licence [Apache License 2.0](http://www.apache.org/licenses/LICENSE-2.0) - see file [LICENSE](LICENSE) for more details_

¡Hola! Gracias por descargar Acorn DAL15
	
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
			
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
