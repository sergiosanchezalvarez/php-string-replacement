<?php

    
	class StringReplacement {

        /**
         * A partir de una cadena dada reemplaza las keywords que se le pasan por parámetro con sus respectivos enlaces.
         * @param  String   $cadena     Cadena donde se hará el reemplazo
         * @param  Array    $enlaces    Array de la forma $array[keyword] = 'http://url' con todas las keywords que se buscarán y reemplazaran en $cadena
         * @param  Array    $ex         Array con las entidades HTML excluidas. Ej: array('a', 'li', 'title', 'h3', 'h2', 'h1')
         * @param  boolean  $una        TRUE si solo reemplazará una vez cada keyword. FALSE si reemplazará todas las veces.
         * @param  boolean  $target     TRUE si los enlaces reemplazados irán con target _blank. FALSE si no va con esta propiedad.
         *
         * @return String   Cadena con las keywords reemplazadas por sus respectivos enlaces.
         */
		public static function reemplazaEnlaces($cadena, $enlaces, $ex=NULL, $una=TRUE, $_blank=FALSE)
		{
			global $links, $etiquetas, $excluidas, $suna;

			$links = $enlaces;
			$excluidas = $ex ? array_map('strtolower', $ex) : array();
			$suna = $una;
			$etiquetas = array();
            $target = ($_blank) ? 'target="_blank"' : '';

			$cadena =
			    /*1*/   preg_replace_callback(
			                // Patron de busqueda
			                '/\$(\d+)@;/i',
			                // función de callback (argumentos, codigo)
			                create_function('$matches', '
			                                        global $etiquetas;
			                                        return $etiquetas[$matches[1]-1];'),
			                // array de cadenas a buscar y reemplazar (en este caso es con callbak)
			    /*2*/       preg_replace_callback(
			                    // Patron de busqueda
			                    '/(?<=[^a-zñ]|^)(?:'.implode('|', array_map(create_function('$a', 'return preg_quote($a, \'/\');'), array_keys($links))).')(?=[^a-zñ]|$)/i',
			                    // función de callback (argumentos, codigo)
			                    create_function('$matches', '
			                                            global $links,$suna;
			                                            if(isset($links[strtolower($matches[0])])) {
			                                                $ret=\'<a href="\'.$links[strtolower($matches[0])].\'" title="\'.$matches[0].\'" $target>\'.$matches[0].\'</a>\';
			                                                if($suna)
			                                                    unset($links[strtolower($matches[0])]);
			                                            } else
			                                                $ret=$matches[0];
			                                            return $ret;'),
			    /*3*/           preg_replace_callback(
			                        // Patron de busqueda
			                        array('/\< *?([^<> ]+)[^<>]*?(\/)?(?(2) *?\>|(?:\>[^<>]*?\< *?\/\1 *?\>))/i', '/\<\!\-\-.*?\-\-\>/s', '/href=".*?">/s', '/src=".*?">/s', '/title=".*?">/s', '/id=".*?">/s'),
			                        // función de callback (argumentos, codigo)
			                        create_function('$matches', '
			                                                global $etiquetas,$excluidas;
			                                                if(!isset($matches[1]) || in_array(strtolower($matches[1]), $excluidas)) {
			                                                    $etiquetas[]=$matches[0];
			                                                    return \'$\'.count($etiquetas).\'@;\';
			                                                } else
			                                                    return $matches[0];'),
			                        $cadena)));



			return $cadena;
		}
	}