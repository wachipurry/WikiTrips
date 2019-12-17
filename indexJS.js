//Declaracion del modelo
class Model {
    //Constructor que crea lo necesario cuando se declara el modelo
    constructor(controller) {
            console.log("Model creat");
            let experiences = [];
            this.controller = controller;
        }
        /*
            101-> Ver la preview de las experiencias
            102-> Experiencias completas
            201-> Log in
            202-> sign in 
        */

    createDefaultExperiences() {
            let experiencias = [{
                    featureImg: "https://picsum.photos/200",
                    featureTitle: "Prueba 1"
                },
                {
                    featureImg: "https://picsum.photos/200",
                    featureTitle: "Prueba 2"
                },
                {
                    featureImg: "https://picsum.photos/200",
                    featureTitle: "Prueba 3"
                },
                {
                    featureImg: "https://picsum.photos/200",
                    featureTitle: "Prueba 4"
                }
            ];

            return experiencias;
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

    setUpPageAfterLogIn(textNav, texNavBar, textFeature) {
        $("#wt_navbar-right").html(textNav);
        $("#orderNavBar").html(texNavBar);
        $("#featured_box").html(textFeature);
    }

    getInputLogIn(controller) {
        let nickname = $("#nicknameLogIn").val();
        let password = $("#passwordLogIn").val();
        let textoError = controller.validateFormLogIn(nickname, password);
        if (textoError != "") {
            this.loadDangerAlert("#modalLogInAlert", textoError);
        } else {
            console.log("click");
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

    getInputEditProfile() {
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

    getInputAddTrip() {
        let title = $("#tripTitle").val();
        let resume = $("#tripResume").val();
        let description = $("#tripDescription").val();
        let location = $("#tripLocation").val();
        let category = $("#tripCategory").val();
        let img = $("#tripImg").val();
        if (textoError != "") {
            this.loadDangerAlert("#modalAddTripAlert", textoError);
        } else {
            //Hacer update del usuario
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
        this.ajaxRequestPreviewExperiences();
        // this.ajaxRequestFullExperiences();

        console.log("Controlador creado");

    }

    //Método para hacer peticiones Ajax contra PHP   
    ajaxRequestPreviewExperiences() {
        let work = this;
        $.ajax({
            type: 'get',
            //Hay que poner la ruta completa en la url para poder hacer la request
            url: "api.php",
            data: {
                apiCode: "101",
                resultTotal:"4",
                resultPage:"1",
                resultOrder:"last",
                resultWhere:"none",
                resultCondition:"none"
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

    //Forma el texto con las experiencias
    createPreviewExperiencesHTML(arrayExperiences) {
        let textHtml = `<div class="row">`;
        for (let i = 0; i < arrayExperiences.length; i++) {
            textHtml += `<div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card" style="width: auto;">
                    <img src="img/${arrayExperiences[i].trip_thumb}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">${arrayExperiences[i].trip_name}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Autor o ciudad</h6>
                        <p class="card-text">${arrayExperiences[i].trip_resum}</p>
                        <a href="#" class="card-link text-success">+ INFO</a>
                        <a href="#" class="card-link text-warning">REPORTAR</a>
                    </div>
                </div>
            </div> `;
        }
        return textHtml;
    }

    //Método para hacer peticiones Ajax contra PHP   
    ajaxRequestFullExperiences() {
        let work = this;
        $.ajax({
            type: 'get',
            url: "api.php",
            data: {
                apiCode: "102"
            },
            success: function(result) {
                let arrayExperiences = JSON.parse(result);
                let textoHTML = work.createFullExperiencesHTML(arrayExperiences);
                work.view.createDivsExperiences(textoHTML);
            },
            error: function() {

            }
        });

    }

    //Formar el texto con las experiencias completas
    createFullExperiencesHTML(arrayExperiences) {
        console.log(arrayExperiences.length);
        console.log(arrayExperiences);
        let textHtml = `<div class="row">`;
        this.model.updateExperiences(arrayExperiences);
        for (let i = 0; i < arrayExperiences.length; i++) {
            textHtml += `  <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card" style="width: auto;">
                    <img src="img/${arrayExperiences[i].trip_img}" class="card-img-top" alt="${arrayExperiences[i].trip_alt}">
                    <div class="card-body">
                        <h5 class="card-title">${arrayExperiences[i].trip_name}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">${arrayExperiences[i].trip_author}</h6>
                        <h6 class="card-subtitle mb-2 text-muted">${arrayExperiences[i].trip_date}</h6>
                        <p class="card-text">${arrayExperiences[i].trip_text}</p>
                        <a href="#" class="card-link text-success">${arrayExperiences[i].trip_rate}</a>
                        <a href="#" class="card-link text-warning">REPORTAR</a>
                    </div>
                </div>
            </div> `;

        }
        return textHtml += "</div>";
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



    ajaxSubmitSignIn(nickname, name, surname, email, pass1, treatment) {
        let work = this;
        $.ajax({

            type: "get",
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
            type: "get",
            url: "api.php",
            data: {
                apiCode: "201",
                uId: nickname,
                uPwd: password
            },
            success: function(result) {
                if (result == "false") {
                    work.view.loadDangerAlert("#modalLogInAlert", result);
                } else {
                    work.view.loadSuccessAlert("#modalLogInAlert");
                    let textNav = result.textNav;
                    let textOrderNavBar = result.textOrderNavBar;
                    let textFeature = result.textFeature;
                    work.view.setUpPageAfterLogIn(textNav, textOrderNavBar, textFeature);
                    work.ajaxOrderByDate();
                }
            },
            error: function() {
                console.log("ERROR petición ajax de enviar datos LogIn");
            }
        });
    }


    ajaxOrderByDate() {
        let work = this;
        $.ajax({
            type: "get",
            url: "api.php",
            data: {
                apiCode: "103",
                //Seria conveniente enviar un token o algo para confirmar que está registradoS
            },
            success: function(result) {
                if (result == "false") {
                    //Avisar de que no se han podido ordenar
                } else {
                    console.log(result);

                    let arrayExperiences = JSON.parse(result);
                    let textoHTML = work.createFullExperiencesHTML(arrayExperiences);
                    work.view.createDivsExperiences(textoHTML);
                }
            },
            error: function() {
                console.log("ERROR petición ajax de cargar experiencias por fecha");
            }
        });
    }




}

//Creacion de toda la estructura MVC con clases
$(document).ready(function() {
    const wikiTrips = new Controller(new Model(this), new View(this));
})