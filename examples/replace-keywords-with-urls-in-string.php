<?php
    
    include '../src/string-replacement.php';

    $cadena_ejemplo = '
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam pharetra neque dui, sed malesuada libero consectetur non. 
            Fusce eget lacus nec eros pretium dictum. Phasellus elementum consectetur gravida. Phasellus feugiat vulputate ante eget mattis. 
            Vivamus sed tempor risus, et dignissim velit. Suspendisse potenti. Maecenas elit nisl, pulvinar ac fermentum quis, ultrices quis mauris. 
            Suspendisse dolor diam, lacinia ac lacinia eu, volutpat sit amet <strong>libero</strong>. 
            Duis ac convallis urna. Ut pulvinar, nibh ac pulvinar volutpat, enim tortor vulputate nisi, id rutrum diam sem suscipit tellus. 
            Ut tempor aliquam lacus id dapibus. Pellentesque molestie lacus eget facilisis malesuada.</p>

        <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nisi mi, malesuada sit amet lacinia sed, 
        consequat et lacus. Pellentesque ullamcorper lorem nunc, a luctus tortor placerat eget. Nam id nunc id turpis vestibulum convallis ac vitae nisl. 
        Fusce libero justo, pharetra id elementum ut, porttitor mollis leo. Donec vulputate massa sit amet leo blandit, non posuere lectus pulvinar. 
        Cras nec pretium metus. Morbi ac ante ut risus luctus cursus.</p>';

    // Keyword con su url de reemplazo.
    $keywords_reemplazo = array(
        'neque' => 'http://google.es',
        'libero' => 'http://amazon.com',
        'enim tortor' => 'http://twitter.com');

    // Etiquetas donde no queremos que se reemplace.
    $no_reemplazo_en = array('strong');

    // Reemplazamos las keywords incluidas en $keywords_reemplazo en la cadena $cadena_ejemplo. 
    // Sin embargo no nos reemplazará en la cadena dentro de la etiqueta <strong>.
    $cadena_salida = StringReplacement::reemplazaEnlaces($cadena_ejemplo, $keywords_reemplazo, $no_reemplazo_en);


    echo $cadena_salida;

