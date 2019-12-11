<?php

/**
 * @author Roger Calventus
 */

//Importació conexió BD i funcions
require('db_gestor.php');
require('functions.php');

get_header_html('TEST WIKITRIPS');
//Comprovació dades del POST

$datos = select("featured_trips_32");

$pintar = json_decode($datos, true);



// HTML pintar por pantalla tabla con resultados
?>
<table class="table table-hover">
    <thead class="thead-light">
        <tr class="text-info">
            <?php

            // HTML -> pintar cabezera tabla
            foreach ($pintar[0] as $key => $key_value) {
                echo '<th>' . $key . '</th>';
            }
            ?>
            <th></th>
        </tr>
    </thead>
    <?php

    //CONTINGUT DE LA TAULA
    for ($i = 0; $i < count($pintar); $i++) {
        echo '<tr>';
        foreach ($pintar[$i] as $key => $key_value) {
            echo '<td>' . $key_value . '</td>';
        }
        echo '</tr>';
    }
    ?>
</table>
<?php


?>
</div>

<script>
function showHint(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "gethint.php?q="+str, true);
        xmlhttp.send();
    }
}
</script>
</body>

</html>
<?php