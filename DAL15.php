<?php

	//Sistema Acorn DAL15 (Data - Absoluteness - Latent | Información - Absoluta - Oculta)

namespace DAL15{
	class DAL15_gen{
		#Propiedades
			private $mensaje, $clave, $tipo, $resultado;

		#Métodos
			/*FUNCIONES-----------------------*/
				//Llamada a los caracteres
					function llama_caracteres($r1, $r2, $tipo){
						// Llamada a los caracteres y caracteres aleatorios
							$cara = array();
							$ale = array();
							$cara = $this->caracteres();
							$ale = $this->caracteres_ale();
							
					}
					
				//CARACTERES-----------------------------------------------------------------------------------
					function caracteres(){
						// Caracteres que se pueden cifrar
						return ['vacio', '','a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r','s', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '|', '!', '"', '#', '$', '%', '&', '/', '(', ')', '=', '?', '*', '+', '~', '[', ']', '{','}', '^', '_', '-', '.', ',', ';', ':', '@', ' '];
					}

					function caracteres_ale(){
						//Caracteres aleatorios disponibles
						return ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r','s', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
					}

				//Llenado y separado de los cubos
					function llenaCubo($m_ll){
						$vertices_cubo = count($m_ll);
						$cubos = $vertices_cubo / 8;
						$cubo = array();
						$a = 0;$cont = 0;
						while($a < $cubos){
							for($b = 0; $b < 8; $b++){
								if($cont >= $vertices_cubo){
									$cubo[$a][$b] = 0;
								}else{
									$cubo[$a][$b] = $m_ll[$cont];
									$cont++;
								}
							}
							$a++;
						}
						return $cubo;
				}

				//CONVERSIÓN DE LA CLAVE-----------------------------------------------------------------------------------
					function convClave(&$c){
						// Llamada a los caracteres y caracteres aleatorios
							$cara = array();
							$ale = array();
							$cara = $this->caracteres();
							$ale = $this->caracteres_ale();

						//Conversión de la clave a números enteros (0-9)
							$c_s = array();
							for($b=0;$b<strlen($c);$b++){
								for($a=1;$a<count($cara);$a++){
									if($c[$b] == $cara[$a]){
										$c_s[] = $a;
										break;
									}
								}
							}
							
						//No deshacemos de combinaciones que puedan hacer al determinante igual a cero
							if($c_s[0] == $c_s[2] && $c_s[1] == $c_s[3]){
								$a = $c_s[0];
								$c_s[0] = $c_s[1];
								$c_s[1] = $a;
							}
							if($c_s[0] == $c_s[1] && $c_s[2] == $c_s[3]){
								$a = $c_s[0];
								$c_s[0] = $c_s[2];
								$c_s[2] = $a;
							}
							if($c_s[0] == $c_s[1] && $c_s[0] == $c_s[2] && $c_s[0] == $c_s[3]){
								$c_s[0] = 2;$c_s[1] = 6;$c_s[2] = 1;$c_s[3] = 5;
							}

						//Rellenado de la clave a 16 elementos
							for($a=count($c_s);$a<16;$a++){
								$c_s[$a] = 1;
							}
							
						//Conversión de la Clave a 8 elementos
							$c_8 = array();
							$p = -1; $f = 16;
							for($a=0;$a<8;$a++){
								$p+=1;$f-=1;
								$c_8[$a] = $c_s[$p].$c_s[$f];
							}
							
						//Conversión de la Clave a 4 elementos
							$c_4 = array();
							$p = -1; $f = 8;
							for($a=0;$a<4;$a++){
								$p+=1;$f-=1;
								$c_4[$a] = $c_8[$p].$c_8[$f];
							}
							
							
						//De: tabla de 4 elementos a: Matriz de 2x2, cada una de 1 elementos
							$c_m = [
								0 => array($c_4[0], $c_4[1]),
								1 => array($c_4[2], $c_4[3])
							];
							$this->imp_array($c_m, 2);
							return ($c_m);
					}
				//MULTIPLICACIÓN DE LAS MATRICES-----------------------------------------------------------------------------------
					function cif_des(&$m_m, &$c_m){
						$m_cif_des = array(array(), array());
						for($b=0;$b<2;$b++){
							for($a=0;$a<count($m_m[0]);$a++){
								if($b==0)
									$m_cif_des[$b][] = $c_m[$b][0]*$m_m[$b][$a] + $c_m[$b][1]*$m_m[$b+1][$a];
								elseif($b==1)
									$m_cif_des[$b][] = $c_m[$b][0]*$m_m[$b-1][$a] + $c_m[$b][1]*$m_m[$b][$a];
							}
						}
						
						return $m_cif_des;
					}
				//De n elementos a 2xn-----------------------------------------------------------------------------------
					function A_2xn($m_s){
						$m_s["b"]["tot_ele"] = count($m_s["a"]);
						
						//Repartición de las filas
							if($m_s["b"]["tot_ele"]%2 != 0){
								$m_s["b"]["ele_xfila"] = ($m_s["b"]["tot_ele"]+1)/2;
								$m_s["a"][] = 1;
							}else
								$m_s["b"]["ele_xfila"] = $m_s["b"]["tot_ele"]/2;
								
						//Re-indexar el array para evitar desbordamientos
							$m_s["a"] = array_values($m_s["a"]);
							
						//Ciclo para las fila
							$cont = -1;
							$m_m = array();
							for($a=0;$a<2;$a++){
								for($b=0;$b<$m_s["b"]["ele_xfila"];$b++){
									$cont += 1;//Para ir de una mitad a la otra
									$m_m[$a][] = $m_s["a"][$cont];
								}
							}
							return $m_m;
					}

				//Conversión de caracteres especiales a entidades HTML-------------------------------------------------------------------
					function conv_cHTML($men){
						$a = htmlentities($men);
						return $a;
					}

				//Funcion para imprimir (ordenadamente) los elementos de un array
					function imp_array($array, $dimension){
						switch ($dimension) {
							case 1:
								foreach($array as $key => $elemento){
									echo $key.":".$elemento."<br>";
								}
								break;
							case 2:
								foreach($array as $i => $elemento){
									echo "<br>Fila ".$i."<br>";
									for($a = 0; $a < count($elemento); $a++) {
										if(isset($elemento[$a]))
											echo "---".$a.":".$elemento[$a]."<br>";
									}
								}
								break;
						}
					}

				//Girado y desgirado del cubo
					function giradoDelCubo($cubo, $vueltas, $simbolo){
						$reemplazo = array();
						$vueltas *= $simbolo;
						foreach ($cubo as $i => &$value) {
							foreach($value as $key => $valor){
								$reemplazo[$key] = $valor;
							}

							for($a= 0; $a < 8; $a++){
								//Calculo de nKey
									$nKey = $a + $vueltas;
									if($nKey >= 8)
										$nKey -= 8;
									elseif($nKey < 0)
										$nKey += 8;

								//Rotado del elemento según el nKey
									$value[$nKey] = $reemplazo[$a];
							}
						}
						unset($value);
						return $cubo;
					}

		/*CIFRADO-----------------------*/
			function DAL15_ENCODE(){
				//Pedimos los valores
					$m = $this->darValores("m");
					$c = $this->darValores("c");
					$t = $this->darValores("t");

				// Llamada a los caracteres y caracteres aleatorios
					$cara = array();
					$ale = array();
					$cara = $this->caracteres();
					$ale = $this->caracteres_ale();

				//MENSAJE
					//Conversión del mensaje con caracteres especiales a entidades de HTML
						$m = $this->conv_cHTML($m);

					//Conversión del mensaje a números enteros (0-9)
						$m_s = array();
						for($b=0;$b<strlen($m);$b++){
							//Comprobar si exite el numero indicado en el array
								if(in_array($m[$b], $cara, true)){
									$m_s["a"][] = array_search($m[$b], $cara);
								}
						}
						
					//Mensaje De: tabla de n elementos a Matriz de 2xn elementos
						$m_m = array();
						$m_m = $this->A_2xn($m_s);
					
				//CLAVE
					//Conversión de la clave con caracteres especiales a entidades de HTML
						$c = $this->conv_cHTML($c);
						
					//Conversión de la clave a 128 bits
						$c_m = array();
						$c_m = $this->convClave($c);

					//Cifrado final
						//Multiplicado de las matrices (Mensaje y clave)
							$m_cif = array();
							$m_cif = $this->cif_des($m_m, $c_m);
							
				//Llamada a los tipos de Cifrado (1, 2, 3)
					switch($t){
						case 1: 
							$this->ENCODE_1($m_cif);
							break;
						case 2: 
							$this->ENCODE_2($m_cif);
							break;
						case 3: 
							$this->ENCODE_3($m_cif);
							break;
						default: 
							$this->ENCODE_1($m_cif);
							break;
					}
			}
			
			//CIFRADO 1---------------------------------------------------------------------------------
				function ENCODE_1($m_cif){
					// Llamada a los caracteres y caracteres aleatorios
						$cara = array();
						$ale = array();
						$cara = $this->caracteres();
						$ale = $this->caracteres_ale();
					
					//Verificado de qué caracteres será intercalados (Únicos)
						$cont=0;
						$pal = "";
						for($b=0;$b<2;$b++){
							foreach($m_cif[$b] as &$elemento){
								for($a=0;$a<strlen($elemento);$a++){
									if($cont<2){
										$pr = $elemento."";
										$pal.=$pr[$a];
									}else{
										if($pal>count($ale)-1)
											$pal = $pal[0];
											
										$elemento = $elemento.$ale[$pal];
										$cont=0;$pal="";
										break;
									}
									$cont++;
								}
							}
							unset($elemento);
						}
						
					//Preparado del mensaje cifrado
						$men_cifrado = "";
						for($b=0;$b<2;$b++){
							foreach($m_cif[$b] as $elemento){
								$men_cifrado.= $elemento;
							}
						}
					
					//Retorno del mensaje cifrado
						$this->recibirResultado($men_cifrado);
				}
			//CIFRADO 2---------------------------------------------------------------------------------
				function ENCODE_2(&$m_cif){
					// Llamada a los caracteres y caracteres aleatorios
						$cara = array();
						$ale = array();
						$cara = $this->caracteres();
						$ale = $this->caracteres_ale();
					
					//Verificado de qué caracteres será intercalados (Aleatorios)
						for($b=0;$b<2;$b++){
							foreach($m_cif[$b] as &$elemento){
								$var = rand(0, 51);
								$elemento = $elemento.$ale[$var];
							}
							unset($elemento);
						}
						
					//Preparado del mensaje cifrado
						$men_cifrado = "";
						for($b=0;$b<2;$b++){
							foreach($m_cif[$b] as $elemento){
								$men_cifrado.= $elemento;
							}
						}
					
					//Retorno del mensaje cifrado
						$this->recibirResultado($men_cifrado);
				}
			//CIFRADO 3---------------------------------------------------------------------------------
				function ENCODE_3(&$m_cif){
					// Llamada a los caracteres y caracteres aleatorios
						$cara = array();
						$ale = array();
						$cara = $this->caracteres();
						$ale = $this->caracteres_ale();
					
					//Cubo de cifrado
						//Convertimos el mensaje en una lista de 1xn
							$m_cif2 = array();$cont = 0;
							foreach($m_cif as $tabla){
								foreach($tabla as $elemento){
									$m_cif2[$cont] = $elemento;
									$cont++;
								}
							}
							
						//Verificamos si la lista es multiplo de 8 (un cubo)
							if(count($m_cif2) % 8 != 0){
								$a = count($m_cif2);
								while(count($m_cif2) % 8 != 0){
									$m_cif2[$a] = 0;
									$a++;
								}
							}
							
						//Preparación y llenado del cubo de cifrado
							$cubo = $this->llenaCubo($m_cif2);

						//Número de vueltas del cubo (Aleatorio)
							$vueltas = rand(1, 6);

						//Girado del cubo
							$cubo = $this->giradoDelCubo($cubo, $vueltas, 1);

						//Creación del mensaje cifrado
							//Le agregamos el número de vueltas para el posterior descifrado
								$cubo[][] = $vueltas;
								
							//Pasamos los elementos a una cadena
								$m_cif = "";
								foreach ($cubo as $valor) {
									for($a = 0; $a < count($valor); $a++) {
										$var = rand(0, 51);
										$m_cif .= $valor[$a].$ale[$var];
									}
								}
						//Retornamos el mensaje cifrado
							$this->recibirResultado($m_cif);
				}
				
		/*DESCIFRADO-----------------------*/
			function DAL15_DECODE(){
				//Pedimos los valores
					$m = $this->darValores("m");
					$c = $this->darValores("c");
					$t = $this->darValores("t");

				// Llamada a los caracteres y caracteres aleatorios
					$cara = array();
					$ale = array();
					$cara = $this->caracteres();
					$ale = $this->caracteres_ale();
					
				//CLAVE
					//Conversión de la clave con caracteres especiales a entidades de HTML
						$c = $this->conv_cHTML($c);

					//Conversión de la clave a 128 bits
						$c_m = array();
						$c_m = $this->convClave($c);
						
					//INVERSA DE LA CLAVE
						//Determinante
							$c_det = $c_m[0][0]*$c_m[1][1]-$c_m[0][1]*$c_m[1][0];
							if($c_det == 0) $c_det = 1;//Para evitar la disión entre 0
							echo "<br>Este es det: $c_det <br>";
						//Adjunta
							$c_adj = [
								0 => array(0 => $c_m[1][1]*1, 1 => $c_m[0][1]*-1),
								1 => array(0 => $c_m[1][0]*-1, 1 => $c_m[0][0]*1)
							];
							
						//Inversa Final
							$c_inv = [
								0 => array(0 => (1/$c_det)*$c_adj[0][0], 1=> (1/$c_det)*$c_adj[0][1]),
								1 => array(0 => (1/$c_det)*$c_adj[1][0], 1=> (1/$c_det)*$c_adj[1][1])
							];
							
				//Llamado al tipo de cifrado
					switch($t){
						case 1:
							$this->DECODE_1($m, $c_inv);
							break;
						case 2:
							$this->DECODE_1($m, $c_inv);
							break;
						case 3:
							$this->DECODE_3($m, $c_inv);
							break;
						default:
							$this->DECODE_1($m, $c_inv);
							break;
					}
			}
			//DESCIFRADO 1 y 2 (parte final del 3) ---------------------------------------------------------------------------------
				function DECODE_1(&$m, &$c_inv){
					// Llamada a los caracteres y caracteres aleatorios
						$cara = array();
						$ale = array();
						$cara = $this->caracteres();
						$ale = $this->caracteres_ale();
						
					//MENSAJE
						//Sustitución de los caracteres intercalados
							$m_s = array();
							for($a=0;$a<strlen($m);$a++){
								if($m[$a] != "0" && $m[$a] != "1" && $m[$a] != "2" && $m[$a] != "3" && $m[$a] != "4" && $m[$a] != "5" && $m[$a] != "6" && $m[$a] != "7" && $m[$a] != "8" && $m[$a] != "9"){
									$m[$a] = "-";
								}
							}
							
						//Separado a una matriz 
							$m_s["a"] = explode("-", $m);
							
						//Eliminación de elementos vacíos
							unset($m_s["a"][count($m_s["a"])-1]);
							if(in_array("", $m_s["a"])){
								$ind = array_search("", $m_s["a"]);
								$m_s["a"][$ind] = 0;
							}

						//Llamada al descifrado general
							$this->DECODE_GEN($m_s, $c_inv);
				}

			//DESCIFRADO 3 ---------------------------------------------------------------------------------
				function DECODE_3(&$m, &$c_inv){
					//MENSAJE
						//Sustitución de los caracteres intercalados
							$m_s = array();
							for($a=0;$a<strlen($m);$a++){
								if($m[$a] != "0" && $m[$a] != "1" && $m[$a] != "2" && $m[$a] != "3" && $m[$a] != "4" && $m[$a] != "5" && $m[$a] != "6" && $m[$a] != "7" && $m[$a] != "8" && $m[$a] != "9"){
									$m[$a] = "-";
								}
							}
							
						//Separado a una matriz 
							$m_s["a"] = explode("-", $m);
							
						//Eliminación de elementos vacíos
							unset($m_s["a"][count($m_s["a"])-1]);
							if(in_array("", $m_s["a"])){
								$ind = array_search("", $m_s["a"]);
								$m_s["a"][$ind] = 0;
							}
							
						//Recogida del número de vueltas
							$vueltas = $m_s["a"][count($m_s["a"])-1];
							echo "<br>Numero de vueltas: ".$vueltas;

						//Eliminado del numero de vueltas del mensaje
							unset($m_s["a"][count($m_s["a"])-1]);
							$m_ll = array();
							$m_ll = $m_s["a"];

						//Preparación y llenado del cubo de descifrado
							$cubo = $this->llenaCubo($m_ll);

						//Desgirado del cubo
							$cubo2 = $this->giradoDelCubo($cubo, $vueltas, -1);
							$cubo3 = array();$cubo4 = array();

						//Eliminado de elementos con "ceros"
							foreach ($cubo2 as $key => $value) {
								for($a = 0; $a < count($value); $a++){
									if($value[$a] != "0")
										$cubo3[$key][] = $value[$a];
								}
							}
							
						//Llamada al descifrado general
							//Creamos un solo array
								$m_des = array();
								foreach ($cubo3 as $valor) {
									for($a = 0; $a < count($valor); $a++){
										$m_des["a"][] = $valor[$a];
									}
								}
								$this->DECODE_GEN($m_des, $c_inv);
				}
				function DECODE_GEN($m_s, $c_inv){
					// Llamada a los caracteres y caracteres aleatorios
						$cara = array();
						$ale = array();
						$cara = $this->caracteres();
						$ale = $this->caracteres_ale();
						
					//Mensaje De: tabla de n elementos a Matriz de 2xn elementos
						$m_m = array();
						$m_m = $this->A_2xn($m_s);
						$this->imp_array($c_inv, 2);

					//Multiplicado de las matrices (Mensaje y clave)
						$m_des = array();
						$m_des = $this->cif_des($m_m, $c_inv);
						
					//Conversión a números enteros
					for($a=0;$a<2;$a++){
						foreach($m_des[$a] as &$elemento){
							$elemento = round($elemento);
						}	
						unset($elemento);
					}
					
					//Cambiado de números a caracteres
						$m_descifrado = "";
						for($a=0;$a<2;$a++){
							for($b=0;$b<count($m_des[$a]);$b++){
								$val = $m_des[$a][$b];
								//Aqui se sustituye el numero por un caracter
								$val_2 = (int)$val + 1;
								if(count($cara) < $val_2 || (int)$val<0)
									$m_descifrado.= "_";
								else
									$m_descifrado.= $cara[$val];
							}
						}

					//Retornamos el mensaje descifrado
						$this->recibirResultado($m_descifrado);
				}

		/*PRINCIPAL-----------------------*/
			public function asignarValores($m, $c, $t){
				$this->mensaje = $m;
				$this->clave = $c;
				$this->tipo = $t;
			}
			public function darValores($cual){
				switch ($cual) {
					case 'm':
						return $this->mensaje;
						break;
					case 'c':
						return $this->clave;
						break;
					case 't':
						return $this->tipo;
						break;
					default:
						exit;
						break;
				}
			}
			public function recibirResultado($r){
				$this->resultado = $r;
			}
			public function darResultado(){
				return $this->resultado;
			}
			public function main($m, $c, $t, $cod){
				switch ($cod) {
					case 1:
						//Asignar valores
							$this->asignarValores($m, $c, $t);
						//Llamar al cifrado 
							$this->DAL15_ENCODE();
						//Retornar resultado
							return $this->resultado;
						break;
					case -1:
						//Asignar valores
							$this->asignarValores($m, $c, $t);
						//Llamar al cifrado 
							$this->DAL15_DECODE();
						//Retornar resultado
							return $this->resultado;
						break;
					default:
						exit;
						break;
				}
			}
	}
	$DAL15 = new DAL15_gen();
}
?>