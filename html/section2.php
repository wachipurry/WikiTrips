<!-- SECCION SEGUNDA -->
<section id="roger_02">
    <div class="container">
        <div class="row">
        </div>
        <p class="text-warning">Faucibus turpis in eu mi bibendum neque. Laoreet non curabitur gravida arcu ac tortor dignissim convallis aenean. Risus in hendrerit gravida rutrum quisque non tellus orci ac. Nunc id cursus metus aliquam eleifend mi in nulla posuere. Fames ac turpis egestas integer. Interdum velit euismod in pellentesque massa placerat duis ultricies. Imperdiet nulla malesuada pellentesque elit eget. Risus in hendrerit gravida rutrum. Pretium viverra suspendisse potenti nullam ac tortor vitae purus faucibus. Quis risus sed vulputate odio ut enim. Est ullamcorper eget nulla facilisi etiam dignissim diam quis. Neque volutpat ac tincidunt vitae semper quis lectus nulla.</p>

        <p class="text-warning">Sit amet justo donec enim diam vulputate ut pharetra. Pretium viverra suspendisse potenti nullam ac tortor vitae purus. Mattis rhoncus urna neque viverra. Nisl suscipit adipiscing bibendum est ultricies integer. Fames ac turpis egestas maecenas. Ac turpis egestas integer eget aliquet. Venenatis lectus magna fringilla urna porttitor rhoncus. Quis risus sed vulputate odio ut enim blandit volutpat. Habitant morbi tristique senectus et. Bibendum arcu vitae elementum curabitur vitae nunc sed velit dignissim. Nec ullamcorper sit amet risus nullam. Eu mi bibendum neque egestas congue quisque. Consequat mauris nunc congue nisi vitae. Eget velit aliquet sagittis id. Scelerisque felis imperdiet proin fermentum. Diam maecenas ultricies mi eget mauris pharetra.</p>
    </div>
</section>



<form>
    <div class="modal-body">
        <div class="form-group">
            <label for="tripTitle">Título</label>
            <input type="text" class="form-control" id="tripTitle" placeholder="es un título, no escribas mas de 50 caracteres ;)">
        </div>
        <div class="form-group">
            <label for="tripResume">Resumen</label>
            <textarea class="form-control" id="tripResume" rows="2" cols="50" placeholder="escribe aqui una breve resumen de tu experiència (de 100 a 150 carácteres)"></textarea>
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