<!-- Creación del modal de prueba con todas las clases de boostrap para que se parezca -->
<div id="addTripModal" class="addTripModal modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="card-body modal-content">
            <h2>Add trip</h2>

            <div id="modalAddTripAlert" style="display: none;" role="alert">

            </div>
            <form>
                <div class="form-group">
                    <label for="tripTitle">Title</label>
                    <input type="text" class="form-control" id="tripTitle" placeholder="Trip title" >
                </div>
                <div class="form-group">
                    <label for="tripResume">Resume</label>
                    <textarea class="form-control" id="tripResume" rows="2" cols="50"></textarea>
                </div>
                <div class="form-group">
                    <label for="tripDescription">Description</label>
                    <textarea class="form-control" id="tripDescription" rows="4" cols="50"></textarea>
                </div>
                <div class="form-group">
                    <label for="tripLocation">Trip location</label>
                    <input type="text" class="form-control" id="tripLocation" placeholder="Country, city, etc">
                </div>
                <div class="form-group">
                    <label for="tripCategory">Category</label>
                    <select class="form-control" id="tripCategory">
                        <option>Love</option>
                        <option>Adventure</option>
                        <option>Relax</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tripImg">Image</label>
                    <input type="file" class="form-control" id="tripImg" placeholder="Url of trip image">

                </div>

                <button id="submitAddTripButton" type="button" class="btn btn-success">Confirm</button>
                <button id="cancelAddTripButton" type="button" class="btn btn-danger">Cancel</button>

            </form>
        </div>
    </div>
</div>