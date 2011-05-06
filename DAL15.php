<?php
	//Nuevo SISTEMA DAL15 empezado desde cero
	//La versión 4.3.1 era inestable en cuanto a errores
	//La clave era de 32 bits
	//En esta nueva versión las claves serán de 128 bits
	//Dando así más seguridad y estabilidad al sistema DAL15
	
	//V 5.3.1
	
//CARACTERES-----------------------------------------------------------------------------------

	function caracteres(){
		// Caracteres que se pueden codificar
		return ['vacio', '','a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r','s', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '|', '!', '"', '#', '$', '%', '&', '/', '(', ')', '=', '?', '*', '+', '~', '[', ']', '{','}', '^', '_', '-', '.', ',', ';', ':', '@', ' '];
	}
	function caracteres_ale(){
		//Caracteres aleatorios disponibles
		return ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r','s', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
	}
	
//CONVERSIÓN DE LA CLAVE-----------------------------------------------------------------------------------
	function convClave(&$c){
		// Llamada a los caracteres y caracteres aleatorios
			$cara = array();
			$ale = array();
			$cara = caracteres();
			$ale = caracteres_ale();
		//Conversión de la clave a números enteros (0-9)
			$c_s = array();
			for($b=0;$b<strlen($c);$b++){
				for($a=1;$a<count($cara);$a++){
					//echo "<br>Cara: $b-$a-$c[$b]-".$cara[$a];
					if($c[$b] == $cara[$a]){
						$c_s[] = $a;
						//echo "-SI-<br>";
						break;
					}
				}
			}
			////echo "<br><br>Caracteres de la clave cambiados a: <br>";
			////var_dump($c_s);
			
		//Rellenado de la clave a 16 elementos
			for($a=count($c_s);$a<16;$a++){
				$c_s[$a] = 1;
			}
			////echo "<br>Clave con 16 elementos: <br>";
			//for($a=0;$a<16;$a++)
				////echo $a."-".$c_s[$a]."<br>";
			
		//Conversión de la Clave a 8 elementos
			////echo "<br>Conversión a 8 elementos: <br>";
			$c_8 = array();
			$p = -1; $f = 16;
			for($a=0;$a<8;$a++){
				$p+=1;$f-=1;
				$c_8[$a] = $c_s[$p].$c_s[$f];
				////echo $a."-".$c_8[$a]."<br>";
			}
			////echo "<br>Conversión a 4 elementos: <br>";
			
		//Conversión de la Clave a 4 elementos
			$c_4 = array();
			$p = -1; $f = 8;
			for($a=0;$a<4;$a++){
				$p+=1;$f-=1;
				$c_4[$a] = $c_8[$p].$c_8[$f];
				////echo $a."-".$c_4[$a]."<br>";
			}
			
			////echo "Clave final con 4 elementos (128 bits almacenados en una tabla de cuatro elementos): <br>";
			////var_dump($c_4);
			//De: tabla de 4 elementos a: Matriz de 2x2, cada una de 1 elementos
			$c_m = [
				0 => array($c_4[0], $c_4[1]),
				1 => array($c_4[2], $c_4[3])
			];
			////echo "<br>Matriz de 2x2: <br>";
			////var_dump($c_m);
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
		////echo "<br>Matriz de cifrado/descifrado del mensaje: <br>";
		////var_dump($m_cif_des);
		return $m_cif_des;
	}

//De n elementos a 2xn-----------------------------------------------------------------------------------
	function A_2xn($m_s){
		$m_s["b"]["tot_ele"] = count($m_s["a"]);
		////echo "<br>La tabla Mensaje contiene ".$m_s["b"]["tot_ele"]." elementos<br> y mod 2 es: ".$m_s["b"]["tot_ele"]%2;
		//Repartición de las filas
			if($m_s["b"]["tot_ele"]%2 != 0){
				$m_s["b"]["ele_xfila"] = ($m_s["b"]["tot_ele"]+1)/2;
				$m_s["a"][] = 1;
			}else
				$m_s["b"]["ele_xfila"] = $m_s["b"]["tot_ele"]/2;
			////echo "<br>Nuestra tabla tiene ".count($m_s["a"])." elementos:<br>";
			////var_dump($m_s["a"]);
		//Ciclo para las fila
		$cont = -1;
		$m_m = array();
		for($a=0;$a<2;$a++){
			for($b=0;$b<$m_s["b"]["ele_xfila"];$b++){
				$cont += 1;//Para ir de una mitad a la otra
				$m_m[$a][] = $m_s["a"][$cont];
				////echo "<br>Nuestro cont aqui es: $cont";
			}
		}
		////echo "<br>Matriz de 2x".$m_s["b"]["ele_xfila"]." que contiene el mensaje: <br>";
		////var_dump($m_m);
		return $m_m;
	}
	
//CIFRADO-----------------------------------------------------------------------------------
	function DAL15_ENCODE(&$m, &$c, &$t){
		// Llamada a los caracteres y caracteres aleatorios
			$cara = array();
			$ale = array();
			$cara = caracteres();
			$ale = caracteres_ale();
		//MENSAJE
			//Conversión del mensaje a números enteros (0-9)
				$m_s = array();
				for($b=0;$b<strlen($m);$b++){
					for($a=1;$a<count($cara);$a++){
						//echo "<br>Cara: $b-$a-$m[$b]-".$cara[$a];
						if($m[$b] == $cara[$a]){
							$m_s["a"][] = $a;
							////echo "-SI-<br>";
							break;
						}
					}
				}
				////echo "<br><br>Caracteres del mensaje cambiados a: <br>";
				////var_dump($m_s);
			//Mensaje De: tabla de n elementos a Matriz de 2xn elementos
				$m_m = array();
				$m_m = A_2xn($m_s);
			
		//CLAVE
			$c_m = array();
			$c_m = convClave($c);
		//Cifrado final
			//Multiplicado de las matrices (Mensaje y clave)
				$m_cif = array();
				$m_cif = cif_des($m_m, $c_m);
				
			//Llamada a los tipos de Cifrado (1, 2, 3)
				switch($t){
					case 1: 
						return ENCODE_1($m_cif);
						break;
					case 2: 
						return ENCODE_2($m_cif);
						break;
					case 3: 
						return ENCODE_3($m_cif);
						break;
					default: 
						break;
				}
	}
	
	//CIFRADO 1---------------------------------------------------------------------------------
	function ENCODE_1(&$m_cif){
		//echo "<br>Cifrado tipo 1<br>";
		// Llamada a los caracteres y caracteres aleatorios
			$cara = array();
			$ale = array();
			$cara = caracteres();
			$ale = caracteres_ale();
		
		//Verificado de qué caracteres será intercalados (Únicos)
			$cont=0;
			$pal = "";
			for($b=0;$b<2;$b++){
				foreach($m_cif[$b] as &$elemento){
					//echo "<br>Elemento: ".$elemento."-fila: $b";
					for($a=0;$a<strlen($elemento);$a++){
						if($cont<2){
							$pr = $elemento."";
							//echo "-ele_mento: ".$pr[$a];
							$pal.=$pr[$a];
						}else{
							if($pal>52)
								$pal = $pal[0];
							//echo "<br>-------ale: ".$ale[$pal]." pal: $pal";
							$elemento = $elemento.$ale[$pal];
							$cont=0;$pal="";
							break;
						}
						$cont++;
					}
				}
				unset($elemento);
			}
			//echo "<br>Caracteres únicos intercalados: <br>";
			//var_dump($m_cif);
			
		//Preparado del mensaje cifrado
			$men_cifrado = "";
			for($b=0;$b<2;$b++){
				foreach($m_cif[$b] as $elemento){
					$men_cifrado.= $elemento;
				}
			}
		
		//Retorno del mensaje cifrado
			return ($men_cifrado);
	}
	function ENCODE_2(&$m_cif){
		//echo "<br>Cifrado tipo 2<br>";
		// Llamada a los caracteres y caracteres aleatorios
			$cara = array();
			$ale = array();
			$cara = caracteres();
			$ale = caracteres_ale();
		
		//Verificado de qué caracteres será intercalados (Aleatorios)
			for($b=0;$b<2;$b++){
				foreach($m_cif[$b] as &$elemento){
					$var = rand(0, 51);
					$elemento = $elemento.$ale[$var];
				}
				unset($elemento);
			}
			//echo "<br>Caracteres aleatorios intercalados: <br>";
			//var_dump($m_cif);
			
		//Preparado del mensaje cifrado
			$men_cifrado = "";
			for($b=0;$b<2;$b++){
				foreach($m_cif[$b] as $elemento){
					$men_cifrado.= $elemento;
				}
			}
		
		//Retorno del mensaje cifrado
			return($men_cifrado);
	}
	function ENCODE_3(&$m_cif){
		//echo "hola";
	}
	

//DESCIFRADO-----------------------------------------------------------------------------------
	//DESCIFRADO 1---------------------------------------------------------------------------------
	function DAL15_DECODE(&$m, &$c, &$t){
		// Llamada a los caracteres y caracteres aleatorios
			$cara = array();
			$ale = array();
			$cara = caracteres();
			$ale = caracteres_ale();
			
		//CLAVE
			$c_m = array();
			$c_m = convClave($c);
			
			//INVERSA DE LA CLAVE
				//Determinante
					$c_det = $c_m[0][0]*$c_m[1][1]-$c_m[0][1]*$c_m[1][0];
					if($c_det == 0) $c_det = 1;//Para evitar la disión entre 0
					//echo "<br>Este es det: $c_det <br>";
				//Adjunta
					$c_adj = [
						0 => array(0 => $c_m[1][1]*1, 1 => $c_m[0][1]*-1),
						1 => array(0 => $c_m[1][0]*-1, 1 => $c_m[0][0]*1)
					];
					//echo "<br>Esta es la adj: <br>";
					//var_dump($c_adj);
				//Inversa Final
					$c_inv = [
						0 => array(0 => (1/$c_det)*$c_adj[0][0], 1=> (1/$c_det)*$c_adj[0][1]),
						1 => array(0 => (1/$c_det)*$c_adj[1][0], 1=> (1/$c_det)*$c_adj[1][1])
					];
					//echo "<br>Esta es la inversa: <br>";
					//var_dump($c_inv);
		//MENSAJE
			//Sustitución de los caracteres intercalados
				$m_s = array();
				for($a=0;$a<strlen($m);$a++){
					if($m[$a] != "0" && $m[$a] != "1" && $m[$a] != "2" && $m[$a] != "3" && $m[$a] != "4" && $m[$a] != "5" && $m[$a] != "6" && $m[$a] != "7" && $m[$a] != "8" && $m[$a] != "9"){
						//echo "<br>m_a: ".$m[$a];
						$m[$a] = "-";
					}
				}
				//echo "<br>Esta es la sustitución de caracteres: $m <br>";
			//Separado a una matriz 
				$m_s["a"] = explode("-", $m);
				//echo "<br>Esta es la tabla con los valores del mensaje: <br>";
				//var_dump($m_s);
			//Eliminación del elemento vacío
				unset($m_s["a"][count($m_s["a"])-1]);
				//echo "<br>Tabla del mensaje sin el elemento vacio: <br>";
				//var_dump($m_s);
			
			//Mensaje De: tabla de n elementos a Matriz de 2xn elementos
				$m_m = array();
				$m_m = A_2xn($m_s);
			
			//Multiplicado de las matrices (Mensaje y clave)
				$m_des = array();
				$m_des = cif_des($m_m, $c_inv);
				
				//echo "<br>Descifrado de los caraceres: <br>";
				//var_dump($m_des);
			//Conversión a números enteros
			for($a=0;$a<2;$a++){
				foreach($m_des[$a] as &$elemento){
					$elemento = round($elemento);
				}	
				unset($elemento);
			}
			//echo "<br>Matriz con los números enteros: <br>";
			//var_dump($m_des);
			
			//Cambiado de números a caracteres
				$m_descifrado = "";
				for($a=0;$a<2;$a++){
					for($b=0;$b<count($m_des[$a]);$b++){
						$val = $m_des[$a][$b]."";
						//Aqui se sustituye el numero por un caracter
						if(count($cara)<(int)$val || (int)$val<0)
							$m_descifrado.= "_";
						else
							$m_descifrado.= $cara[$val];
					}
				}
			//Retorno del Mensaje Descifrado
			return($m_descifrado);
	}
	//DESCIFRADO 2---------------------------------------------------------------------------------
?>