<?php

/**
 * @author Roger Calventus
 */


/**
 * Funció q mostra per pantalla la capçalera d'un arxiu HTML
 * Inclou els links del BootStrap
 * Deixa obert el DOM després de <body> i <div class="container">
 * @param title (String) El titol de la pàgina web
 * 
 */
function get_header_html($title)
{
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title ?></title>
        <!--Bootstrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        
        <style>
            h5 {
                border-bottom: 1px solid #17a2b8;
                padding: 30px 0px 5px 0px;
            }
        </style>
    </head>

    <body>
        <div class="container">
        <?php
        }

        
        /**
         * Funció que tanca l'arxiu HTML obert amb el get_header_html()
         * Tancant el DOM pendent de </div class="container></body></html>
         */
        function get_footer_html()
        {
            ?>
        </div>
    </body>

    </html>
<?php
}

