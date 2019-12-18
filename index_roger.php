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
    <div id="editProfileModal" class="editProfileModal modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="card-body modal-content">
                <div id="modalEditProfileAlert" style="display: none;" role="alert">
                </div>
            </div>
        </div>
    </div>


    <!-- MODAL OCULTO Y VACIO PARA AÑADIR UNA EXPERIENCIA -->
    <div id="addTripModal" class="addTripModal modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="card-body modal-content">

                <div id="modalAddTripAlert" style="display: none;" role="alert">

                </div>
                <div class="modal-header">
                    <h5 class="modal-title text-warning">Comparte con el mundo tus Trips !!</h5>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="tripTitle">Título</label>
                            <input type="text" class="form-control" id="tripTitle" placeholder="es un título, no escribas mas de 50 caracteres ;)">
                        </div>
                        <div class="form-group">
                            <label for="tripResume">Resumen</label>
                            <textarea class="form-control" id="tripResume" rows="2" placeholder="escribe aqui una breve resumen de tu experiència (de 100 a 150 carácteres)"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="tripDescription">Descricónion</label>
                            <textarea class="form-control" id="tripDescription" rows="5" cols="50" placeholder="cuentanoslo todo !"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="tripLocation">Ubicación</label>
                            <input type="text" class="form-control" id="tripLocation" placeholder="País, ciudad, ruta, ...">
                        </div>
                        <div class="form-group">
                            <label for="tripCategory">Categoria</label>
                            <select class="form-control" id="tripCategory">
                                <option>Love</option>
                                <option>Adventure</option>
                                <option>Relax</option>
                            </select>
                        </div>
                        <!--SAQUEMOSNOS DE ENCIMA EL TEMA IMAGEN POR SU COMPLEJIDAD -->
                        <!--<div class="form-group">
                    <label for="tripImg">Image</label>
                    <input type="file" class="form-control" id="tripImg" placeholder="Url of trip image">
                </div>-->
                    </div>
                    <div class="modal-footer">
                        <button id="submitAddTripButton" type="button" class="btn btn-outline-warning text-secondary">CONFIRMAR</button>
                        <button id="cancelAddTripButton" type="button" class="btn btn-outline-danger text-secondary">CANCELAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<!-- Creación del modal de prueba con todas las clases de boostrap para que se parezca --
<div id="viewFullTrip" class="fullTripModal modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="card-body modal-content">
            <h2>Edit profile</h2>

            <div id="modalFullTripAlert" style="display: none;" role="alert">
            </div>
            <div class="modal-header">
                <h5 class="modal-title text-warning">Ayudanos a saber un poco mas de ti !!</h5>
            </div>
            <form>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="treatment">Como podemos dirigirnos a ti?</label>
                        <select class="form-control" id="treatment">
                            <option>Sr.</option>
                            <option>Sra.</option>
                            <option>Don</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nameEdit">Nombre</label>
                        <input type="text" class="form-control" id="nameEdit" placeholder="escribe aquí tu nombre">
                    </div>
                    <div class="form-group">
                        <label for="surnameEdit">Apellido</label>
                        <input type="text" class="form-control" id="surnameEdit" placeholder="escribe aqui tu apellido">
                    </div>
                    <div class="form-group">
                        <label for="userDescriptionEdit">Cuentanos algo sobre ti</label>
                        <textarea type="text" class="form-control" rows="4" id="userDescriptionEdit" placeholder="escribe aqui tu apellido">
                    </div>
                    <div class="form-group">
                        <label for="newEmail">Nueva dirección email</label>
                        <input type="newEmail" class="form-control" id="newEmail" placeholder="hola@wikitrips.cat">
                    </div>
                    <div class="form-group">
                        <label for="publicityEdit">Quieres que te informemos de las ultimas novedades en la web?</label>
                        <select class="form-control" id="publicityEdit">
                            <option>Si</option>
                            <option>No.</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button id="submitEditProfileButton" type="button" class="btn btn-outline-warning text-secondary">CONFIRMAR</button>
                    <button id="cancelEditProfileButton" type="button" class="btn btn-outline-danger text-secondary">CANCELAR</button>
                </div>
            </form>
        </div>
    </div>
</div>-->



<?php
    include('html/footer.php'); // Pie de página


