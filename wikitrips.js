//Declaracion del modelo
class Model {
    //Constructor que crea lo necesario cuando se declara el modelo
    constructor(controller) {
        let experiences = [];
        this.controller = controller;
        this.nickname = "";
        this.token = "";
        console.log("Model creat");

    }


    //Actualiza las experiencias en local
    updateExperiences(newExperiences) {
        if (this.experiences = newExperiences) {
            return true;
        }
        return false;
    }

    //Descarga el array de experiencias
    downloadExperiences() {
        return this.experiences;
    }

    getToken() {
        return this.token;
    }

    setToken(token) {
        if (this.token = token) {
            return true;
        }
        return false;
    }

    issetToken() {
        if (this.token != "") {
            return true;
        }
        return false;
    }

    setNickname(nickname) {
        if (this.nickname = nickname) {
            return true;
        }
        return false;
    }

    getNickname() {
        return this.nickname;
    }

    issetNickname() {
        if (this.nickname != "") {
            return true;
        }
        return false;
    }
}
//Declaracion de la vista
class View {
    //Constructor que crea lo necesario cuando se declara la vista
    constructor(controller) {
        console.log("Vista creada");
    }

    //inner text en el div principal con las experiencias preview
    createDivsExperiences(textHtml) {
        $("#featured_box").html(textHtml);
    }

    setUpClicks(controller) {
        let work = this;
        $("#submitSignInButton").click(
            function() {
                work.getInputSignIn(controller);
            }
        );
        $("#submitLogInButton").click(
            function() {
                work.getInputLogIn(controller);
            }
        );

    }

    setUpClicksAfterLogIn(controller) {
        let work = this;
        $("#submitAddTripButton").click(
            function() {
                work.getInputAddTrip(controller);
            }
        );
        $("#submitEditProfileButton").click(
            function() {
                work.getInputEditProfile(controller);
            }
        );
        $("#filterDate").click(
            function() {
                controller.ajaxOrderByDate();
            }
        );
        $("#filterRate").click(
            function() {
                controller.ajaxOrderByRate();
            }
        );
        $("#filterCategory").change(
            function() {
                let category = $("#filterCategory").val();
                controller.ajaxOrderByCategory(category);
            }
        );
        $('#featured_box').on('click', 'a', function(e) {
            let tripId = e.target.id;
            tripId = tripId.replace("trip", "");
            controller.ajaxFullExperiences(tripId);
        });
    }

    setUpPageAfterLogIn(textNav, texNavBar, textModalAddTrip, textModalEditProfile, controller) {
        $("#wt_navbar-right").html(textNav);
        $("#tripsFilter").html(texNavBar);
        $("#aux1").html(textModalAddTrip);
        $("#aux2").html(textModalEditProfile);

        this.setUpClicksAfterLogIn(controller);
    }

    openModalFullExperiences(textoHtml) {
        $("#aux3").html(" ");
        $("#aux3").html(textoHtml);
        $("#viewFullTrip").modal("show");
    }

    getInputLogIn(controller) {
        let nickname = $("#nicknameLogIn").val();
        let password = $("#passwordLogIn").val();
        let textoError = controller.validateFormLogIn(nickname, password);
        if (textoError != "") {
            this.loadDangerAlert("#modalLogInAlert", textoError);
        } else {
            controller.ajaxSubmitLogIn(nickname, password);
        }
    }

    getInputSignIn(controller) {
        let nickname = $("#nickname").val();
        let name = $("#name").val();
        let email = $("#email").val();
        let pass1 = $("#passwordA").val();
        let pass2 = $("#passwordB").val();
        let textoError = controller.validateFormUser(nickname, name, email, pass1, pass2);
        if (textoError != "") {
            this.loadDangerAlert("#modalSignInAlert", textoError);
        } else {
            let treatment = $("#treatment").val();
            let surname = $("#surname").val();
            controller.ajaxSubmitSignIn(nickname, name, surname, email, pass1, treatment);
        }
    }

    getInputEditProfile(controller) {
        let nickname = $("#nicknameEdit").val();
        let name = $("#nameEdit").val();
        let surname = $("#surnameEdit").val();
        let email = $("#newEmaillEdit").val();
        let password = $("#newPassword").val();
        let passwordRepeat = $("#newPasswordRepeat").val();
        let textoError = controller.validateFormUser(nickname, name, email, password, passwordRepeat);
        if (textoError != "") {
            this.loadDangerAlert("#modalEditProfileAlert", textoError);
        } else {
            //Hacer update del usuario
        }

    }

    getInputAddTrip(controller) {
        let title = $("#tripTitle").val();
        let resume = $("#tripResume").val();
        let description = $("#tripDescription").val();
        let location = $("#tripLocation").val();
        let category = $("#tripCategory").val();
        console.log(title, resume, description, location, category); //ROGER
        let textoError = controller.validateFormAddTrip(title, resume, description, location, category);
        if (textoError != "") {
            this.loadDangerAlert("#modalAddTripAlert", textoError);
        } else {
            console.log("Petición de ajax add trip enviada");
            //Te olvidaste meter los parametros cuando llamas al controlador XD !! ARREGLADO!!
            controller.ajaxAddTrip(title, resume, description, category);
        }
    }

    loadDangerAlert(idModal, textoError) {
        $(idModal).removeClass("alert-success");
        $(idModal).addClass("alert alert-danger");
        $(idModal).html("<ul>" + textoError + "</ul>");
        $(idModal).show();
    }

    loadSuccessAlert(idModal) {
        $(idModal).removeClass("alert-danger");
        $(idModal).addClass("alert alert-success");
        $(idModal).html("Success !");
        $(idModal).show();
    }
}

class Controller {
    constructor(model, view) {
        this.model = model;
        this.view = view;
        this.view.setUpClicks(this);
        //Peticion de ajax al cargar el controlador con las experiencias previas
        this.ajaxOrderByDate();
        console.log("Controlador creado");

    }

    ajaxOrderByDate() {
        if (this.model.issetToken()) {
            this.ajaxOrderBy("all", 1, "last", "none", "none");
        } else {
            this.ajaxOrderBy(4, 1, "last", "none", "none");
        }
        console.log("Ordenado por fecha");
    }

    ajaxOrderByRate() {
        this.ajaxOrderBy("all", 1, "rate", "none", "none");
        console.log("Ordenado por valoración");
    }

    ajaxOrderByCategory(category) {
        this.ajaxOrderBy("all", 1, "last", "category", category);
        console.log("Ordenado por categoria " + category);
    }

    //Método para hacer peticiones Ajax para ordenar los trips contra PHP   
    ajaxOrderBy(resultTotal, resultPage, resultOrder, resultWhere, resultCondition) {
            let work = this;
            $.ajax({
                type: 'post',
                //Hay que poner la ruta completa en la url para poder hacer la request
                url: "api.php",
                data: {
                    apiCode: "101",
                    resultTotal: resultTotal,
                    resultPage: resultPage,
                    resultOrder: resultOrder,
                    resultWhere: resultWhere,
                    resultCondition: resultCondition
                },
                beforeSend: function() {
                    $('#loadModal').modal('show');
                    setTimeout(function() {
                        $('#loadModal').modal('hide');
                    }, 2000);

                },
                success: function(result) {
                    console.log(result);
                    let arrayExperiences = JSON.parse(result);
                    //Actualizar modelo
                    work.model.updateExperiences(arrayExperiences);
                    //Cargar texto de las experiencias
                    let textoHTML = work.createPreviewExperiencesHTML(arrayExperiences);
                    //Insertar texto en la página
                    work.view.createDivsExperiences(textoHTML);

                },
                error: function() {
                    console.log("Error en la petición AJAX preview");
                }
            });
        }
        //Forma el texto con las experiencias del HOME (HE TOCADO CSS)
    createPreviewExperiencesHTML(arrayExperiences) {
        let textHtml = `<div class="row">`;
        for (let i = 0; i < arrayExperiences.length; i++) {
            textHtml += `<div  class="col-lg-6 col-md-12 col-sm-12">
                <div class="card" style="background-color: rgba(250,250,250,0.8);margin: 10px -10px;">
                    <!--<img src="img/${arrayExperiences[i].trip_thumb}" class="card-img-top" alt="...">-->
                    <div class="card-body">
                        <h5 class="card-title">${arrayExperiences[i].trip_name}</h5>
                        <!--<h6 class="card-subtitle mb-2 text-muted">Autor o ciudad</h6>-->
                        <p class="card-text text-muted">${arrayExperiences[i].trip_resum}</p>
                        <div class="row"=>
                            <div class="col-6 text-left">
                                <a id="trip${arrayExperiences[i].trip_id}"  href="#" class="btn btn-block btn-outline-warning text-secondary">Saber Mas</a>
                            </div>
                        <div class="col-6 text-right">`;
            for (let j = 0; j < 5; j++) {
                if (j < arrayExperiences[i].trip_rate) {
                    textHtml += `<span class="text-warning"><i class="fa fa-star" aria-hidden="true"></i></span>`;
                } else {
                    textHtml += `<span class="text-secondary"><i class="fa fa-star" aria-hidden="true"></i></span>`;
                }

            }
            textHtml += `<!--<a href="#" class="card-link text-warning">REPORTAR</a>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div> `;
        }
        return textHtml;
    }

    createModalFullTrip(trip) {
        console.log(trip);
        let textHtml = `<div id="viewFullTrip" class="viewFullTrippModal modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
            <div class="card-body modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-warning">${trip[0].trip_name}</h5>
                </div>
                <div class="modal-body">
                    <p class="text-secondary">${trip[0].trip_text}</p>
                    <p class="text-secondary text-left">
                        <a class="text-secondary">`;
        if (trip[0].trip_author == 'aussias') {
            textHtml += `anonimo`;
        } else {
            textHtml += trip[0].trip_author;
        }
        textHtml += `</a><br />
                        ${trip[0].trip_date}</p>
                        <div class="col-6 text-right">`;
        for (let j = 0; j < 5; j++) {
            if (j < trip[0].trip_rate) {
                textHtml += `<span class="text-warning"><i class="fa fa-star" aria-hidden="true"></i></span>`;
            } else {
                textHtml += `<span class="text-secondary"><i class="fa fa-star" aria-hidden="true"></i></span>`;
            }

        }
        textHtml += ` <div class="modal-footer">
                        <form>
                            <!--ANTES-->
                            <div class="input-group input-group-sm mt-3 mb-3">
    
                                <!--selector-->
                                <select class="form-control-sm" id="sel1">
                                    <option>5</option>
                                    <option>4</option>
                                    <option>3</option>
                                    <option>2</option>
                                    <option>2</option>
    
                                </select>
                                <!--BOTONES-->
                                <div class="input-group-append input-group-sm">
                                    <button class="btn btn-outline-secondary" type="button">VOTAR</button>
                                    <button class="btn btn-outline-warning" type="button" data-dismiss="modal">CERRAR</button>
    
                                </div>
                            </div>
                        </form>
    
                    </div>
                </div>
            </div>
        </div>
    </div>`;
        return textHtml;
    }

    validateFormUser(nickname, name, email, pass1, pass2) {
        let textoError = "";
        nickname = nickname.trim();
        name = name.trim();
        pass1 = pass1.trim();
        pass2 = pass2.trim();
        email = email.trim();
        if (nickname == "") {
            textoError += "<li>Empty nickname</li>";
        }
        if (name == "") {
            textoError += "<li>Empty name</li>";
        }
        if (pass1 == "") {
            textoError += "<li>Empty password</li>";
        }
        if (pass2 != pass1) {
            textoError += "<li>Password discrepancy</li>"
        }
        if (email == "") {
            textoError += "<li>Email empty</li>"
        }
        return textoError;

    }

    validateFormLogIn(nickname, password) {
        let textoError = "";
        nickname = nickname.trim();
        password = password.trim();
        if (nickname == "") {
            textoError += "<li>Empty nickname</li>";
        }
        if (password == "") {
            textoError += "<li>Empty password</li>";
        }

        return textoError;
    }

    validateFormAddTrip(title, resume, description, location, category) {
        title = title.trim();
        resume = resume.trim();
        description = description.trim();
        location = location.trim()
        category = category.trim();
        let textoError = "";
        if (title == "") {
            textoError += "<li>Empty title</li>";
        }
        if (resume == "") {
            textoError += "<li>Empty resume</li>";
        }
        if (description == "") {
            textoError += "<li>Empty description</li>";
        }
        if (location == "") {
            textoError += "<li>Empty location</li>";
        }
        if (category == "") {
            textoError += "<li>Empty category</li>";
        }
        if (title.length > 50) {
            textoError += "<li>The Title is to large</li>";
        }
        if (resume.length < 100 || resume.length > 150) {
            textoError += "<li>The Resume could be between 100 and 150 characters</li>";
        }
        if (description > 300) {
            textoError += "<li>The Description is to large</li>";
        }
        return textoError;
    }

    ajaxSubmitSignIn(nickname, name, surname, email, pass1, treatment) {
        let work = this;
        $.ajax({

            type: "post",
            url: "api.php",
            data: {
                apiCode: "202",
                nickname: nickname,
                name: name,
                surname: surname,
                email: email,
                password: pass1,
                treatment: treatment
            },
            success: function(result) {
                if (result != "") {
                    work.view.loadDangerAlert("#modalSignInAlert", result);
                } else {
                    work.view.loadSuccessAlert("#modalSignInAlert");
                }
            },
            error: function() {
                console.log("ERROR petición ajax de enviar datos SignIn");
            }
        });
    }

    ajaxSubmitLogIn(nickname, password) {
        let work = this;
        $.ajax({
            type: "post",
            url: "api.php",
            data: {
                apiCode: "201",
                uId: nickname,
                uPwd: password
            },
            success: function(result) {
                //Añadir validación de result
                if (result != "false") {
                    //work.view.loadSuccessAlert("#modalLogInAlert");
                    let obj = JSON.parse(result);
                    let textNav = obj.html_textNav;
                    let textFilterNav = obj.filter;
                    let textModalAddTrip = obj.html_modalAddTrip;
                    let textModalEditProfile = obj.html_modalEditProfile;
                    console.log(obj);
                    let token = obj.token;
                    let nickname = obj.username;
                    work.model.setToken(token);
                    work.model.setNickname(nickname);
                    work.view.setUpPageAfterLogIn(textNav, textFilterNav, textModalAddTrip, textModalEditProfile, work);
                    work.ajaxOrderByDate();
                } else {
                    work.view.loadDangerAlert("#modalLogInAlert", "Ha fallado el Log In");

                }
            },
            error: function() {
                console.log("ERROR petición ajax de enviar datos LogIn");
            }
        });
    }


    ajaxFullExperiences(tripId) {
        let work = this;
        let nickname = this.model.getNickname();
        let token = this.model.getToken();
        console.log(nickname + "  " + token);
        $.ajax({
            type: "post",
            url: "api.php",
            data: {
                apiCode: "102",
                username: nickname,
                token: token,
                tripId: tripId
            },
            success: function(result) {
                //Añadir validación de result
                if (result != "false") {
                    console.log(result); //ROGER
                    let obj = JSON.parse(result); // ROGER -> te olvidaste el PARSE
                    let textoHtml = work.createModalFullTrip(obj);
                    work.view.openModalFullExperiences(textoHtml);
                } else {

                }
            },
            error: function() {
                console.log("ERROR petición ajax de ver en detalle el trip");
            }
        });
    }

    ajaxAddTrip(title, resume, description, category) {
        let work = this;
        let nickname = this.model.getNickname();
        let token = this.model.getToken();
        $.ajax({
            type: "post",
            url: "api.php",
            data: {
                apiCode: "301",
                username: nickname,
                token: token,
                title: title,
                resume: resume,
                description: description,
                category: category

            },
            success: function(result) {
                //Añadir validación de result
                if (result != "false") {
                    console.log(result);
                } else {
                    console.log(result);
                }
            },
            error: function() {
                console.log("ERROR petición ajax de ver en detalle el trip");
            }
        });
    }

}





//Creacion de toda la estructura MVC con clases
$(document).ready(function() {
    const wikiTrips = new Controller(new Model(this), new View(this));
})