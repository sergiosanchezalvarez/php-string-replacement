 # ¿Que es string-replacement?


Es una clase PHP que reemplaza palabras o frases dentro de un trozo/cadena HTML con unos enlaces especificados para cada palabra o frase dada.

 # ¿Como funciona?


Tan solo hay que hacer un include del fichero src/string-replacement.php y instanciar el metodo estático:

```
$cadena_salida = StringReplacement::reemplazaEnlaces($cadena_ejemplo, $keywords_reemplazo, $no_reemplazo_en, FALSE, FALSE);
```

Siendo cada uno de los parámetros y por orden:
* **$cadena_ejemplo**: Cadena/HTML donde se buscarán las keywords/frases para reemplazar.
* **$keywords_reemplazo**: Array de la forma $array[keyword] = 'http://url' con todas las keywords que se buscarán y reemplazaran.
* **$no_reemplazo_en**: Array con las entidades HTML excluidas. Ej: array('a', 'li', 'title', 'h3', 'h2', 'h1', 'strong').
* **$una**: TRUE si solo reemplazará una vez cada keyword. FALSE si reemplazará todas las veces.
* **$target**: TRUE si los enlaces reemplazados irán con target _blank. FALSE si no va con esta propiedad.

La cadena/HTML resultante se recoge en este caso en $cadena_salida.