<?php

include('html/head.php'); // Cabezera HTML
include('html/navbar.php'); // Primer div con pastilla header y menu navegacion
include('html/section1.php'); //Seccion primera y principal
include('html/section2.php'); // Sección segunda, para texto legal o algo

// Se podrian añadir tantas secciones como sea necessario con estio 1 o 2

include('html/modalLogIn.php'); // Modal oculto LogIn
include('html/modalSignIn.php'); // Modal oculto SigIn

?>

    <!-- MODAL OCULTO Y VACIO PARA EDITAR EL PERFIL DE UN USUARIO. LO LLENA AJAX DESPUES DE LOGIN -->
   <!-- <div id="editProfileModal" class="editProfileModal modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="card-body modal-content">
                <div id="modalEditProfileAlert" style="display: none;" role="alert">
                </div>
            </div>
        </div>
    </div>


     MODAL OCULTO Y VACIO PARA AÑADIR UNA EXPERIENCIA 
    <div id="addTripModal" class="addTripModal modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="card-body modal-content">

                <div id="modalAddTripAlert" style="display: none;" role="alert">

                </div>

            </div>
        </div>
    </div> -->


<!-- MODAL OCULTO Y VACIO PARA VISTA DETALADA DE UN TRIP -->
<!--<div id="viewFullTrip" class="viewFullTrippModal modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="card-body modal-content">

        </div>
    </div>
</div>-->



<?php
    include('html/footer.php'); // Pie de página


