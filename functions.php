<?php

/**
 * @author Roger Calventus
 */


/**
 * Funció q mostra per pantalla la capçalera d'un arxiu HTML
 * Inclou els links del BootStrap
 * Obre el BODY y el primer <div class="container">
 * @param title (String) El titol de la pàgina web
 * 
 */
function get_header_html($title)
{
    ?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title ?></title>
        <!--Bootstrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        <!-- linkS provisionales para tests -->
        <link rel="stylesheet" href="css/roger.css">
        <!--<script src="js/roger.js"></script>-->
        <!--<script src="https://unpkg.com/axios/dist/axios.min.js"></script>-->

        <style>
            h5 {
                border-bottom: 1px solid #17a2b8;
                padding: 30px 0px 5px 0px;
            }
        </style>
    </head>

    <body class="bg">
        <div id="wt_navbar">
        <div class="container">

            <a href="#default" id="wt_logo">
                <img src="img/wikitrips_01.png">
            </a>
            <div id="wt_navbar-right">
                <button id="roger_login" class="btn btn-outline-success bg-light">LOGIN</button>
                <button id="roger_logout" class="btn bg-light btn-outline-warning">SALIR</button>
            </div>
        </div>
    </div>
    <?php
    }


    /**
     * Funció que tanca l'arxiu HTML obert amb el get_header_html()
     * Tancant el DOM pendent de </div class="container></body></html>
     */
    function get_footer_html()
    {
        ?>
        <div class="footer">
        <p><img class="minilogo" src="img/wikitrips_02_left.png"> AJR digital design studio ©</p>
        </div>
        <script src="js/roger.js"></script>

    </body>

    </html>
<?php
}
