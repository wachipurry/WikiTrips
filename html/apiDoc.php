    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Wikitrips</title>
        <!--Bootstrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        <!-- Awesome font icons stylesheet-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            h5 {
                border-bottom: 1px solid #17a2b8;
                padding: 30px 0px 5px 0px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h5 class="text-info">manual API de WikiTrips</h5>
            <p class="text-secondary">Faucibus turpis in eu mi bibendum neque. Laoreet non curabitur gravida arcu ac tortor dignissim convallis aenean. Risus in hendrerit gravida rutrum quisque non tellus orci ac. Nunc id cursus metus aliquam eleifend mi in nulla posuere. Fames ac turpis egestas integer. Interdum velit euismod in pellentesque massa placerat duis ultricies. Imperdiet nulla malesuada pellentesque elit eget. Risus in hendrerit gravida rutrum. Pretium viverra suspendisse potenti nullam ac tortor vitae purus faucibus. Quis risus sed vulputate odio ut enim. Est ullamcorper eget nulla facilisi etiam dignissim diam quis. Neque volutpat ac tincidunt vitae semper quis lectus nulla.</p>

            <!--101-->
            <p class="text-seconday"><span class="badge badge-secondary">101</span> Devuelve una lista de trips</p>
            <ul class="alert alert-secondary">
                <li>apiCode=101</li>
                <li>resultTotal -> Un numero (cantidad que se desea recibir) o 'all? para todos</li>
                <li>resultPage -> La página de la consulta (para paginación) (no puede ser 0, minimo 1) <span class="text-info">[no implementado]</span></li>
                <li>resultOrder -> Para especificar el orden ('last' para ultimos primero) ('rate' para mejor valorados primero)</li>
                <li>resultWhere -> Selector de campo (where ...) ('author' para solo un autor) ('category' para solo una categoria)</li>
                <li>resultCondition -> Condición que debe cumplir el where</li>
            </ul>
            <p class="alert alert-info">
                Ej. Ultimos 4 trips ordenados por fecha -> resultTotal=4 & resultPage=1 & resultOrder=<b>last</b> & resultWhere=none & resultCondition=none<br />
                <a href="api.php?apiCode=101&resultTotal=4&resultPage=1&resultOrder=last&resultWhere=none&resultCondition=none" target="_blank">api.php?apiCode=101&resultTotal=4&resultPage=1&resultOrder=last&resultWhere=none&resultCondition=no</a>
            </p>
            <p class="alert alert-info">
                Ej. ultimos 4 trips ordenados por valoracion -> resultTotal=4 & resultPage=1 & resultOrder=<b>rate</b> & resultWhere=none & resultCondition=none<br />
                <a href="api.php?apiCode=101&resultTotal=4&resultPage=1&resultOrder=rate&resultWhere=none&resultCondition=none" target="_blank">api.php?apiCode=101&resultTotal=4&resultPage=1&resultOrder=rate&resultWhere=none&resultCondition=no</a>
            </p>

            <p class="alert alert-info">
                Ej. Todos los trips del autor "capitan" por fecha -> resultTotal=<b>all</b> & resultPage=1 & resultOrder=last & resultWhere=author & resultCondition=capitan<br />
                <a href="api.php?apiCode=101&resultTotal=all&resultPage=1&resultOrder=last&resultWhere=author&resultCondition=capitan" target="_blank">api.php?apiCode=101&resultTotal=all&resultPage=1&resultOrder=last&resultWhere=capitan&resultCondition=capitan</a>
            </p>
            <p class="alert alert-info">
                Ej. Todos los trips de la categoria "A pie" por valoracion -> resultTotal=<b>all</b> & resultPage=1 & resultOrder=rate & resultWhere=category & resultCondition=A_pie<br />
                <a href="api.php?apiCode=101&resultTotal=all&resultPage=1&resultOrder=rate&resultWhere=category&resultCondition=A_pie" target="_blank">api.php?apiCode=101&resultTotal=all&resultPage=1&resultOrder=rate&resultWhere=category&resultCondition=A_pie</a>
            </p>

            <p class="text-seconday"><span class="badge badge-secondary">102</span> Devuelve una lista de los 4 trips con mejor valoración de usuarios (publicos)<br />
                <a href="api.php?apiCode=102">api.php?apiCode=102</a>
            </p>
            <!--102-->
            <p class="text-seconday"><span class="badge badge-secondary">103</span> Devuelve el contenido detallado de un trip (requiere de un id)<br />
                <a href="api.php?apiCode=103&tId=3">api.php?apiCode=103&tId=3</a></p>
            <p class="text-seconday"><span class="badge badge-secondary">104</span> Devuelve una String con la lista de categorias de un trip (requiere de un id)<br />
                <a href="api.php?apiCode=104&tId=3">api.php?apiCode=104&tId=3</a></p>
            <p class="text-seconday"><span class="badge badge-secondary">105</span> Devuelve la valoracón [avg(rate)] de un trip especifio(requiere de un id)<br />
                <a href="api.php?apiCode=105&tId=3">api.php?apiCode=105&tId=3</a></p>

            <p class="text-seconday"><span class="badge badge-info">201</span> Comprobar el password de un usuario dado su nickname</p>
            <p class="text-seconday"><span class="badge badge-info">202</span> Registrar (SignIn) un usuario</p>
            <p class="text-seconday"><span class="badge badge-info">203</span> Editar perfil de un usuario<br />
                <a href="api.php?apiCode=203&user_nickname=marccc&user_treatment=treat&user_name=name&user_surname=sur&user_email=email@email.com&allow_add=yes&user_description=description&user_image=JPG">api.php?apiCode=203&user_nickname=marccc&user_treatment=treat&user_name=name&user_surname=sur&user_email=email@email.com&allow_add=yes&user_description=description&user_image=JPG</a></p>
            <p class="text-seconday"><span class="badge badge-success">301</span> Añadir una experiencia</p>
            <p class="text-seconday"><span class="badge badge-success">302</span> Editar una experiencia</p>
            <p class="text-seconday"><span class="badge badge-success">303</span> Votar una experiencia</p>

            <p class="text-seconday"><span class="badge badge-warning">401</span> Reportar una experiencia</p>
            <p class="text-seconday"><span class="badge badge-warning">402</span> Reportar una usuario</p>


        </div>

    </body>

    </html>
<?php

