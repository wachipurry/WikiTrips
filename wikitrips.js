//Declaracion del modelo
/**
 * Objeto Modelo para almacenar variables temporales en JavaScript
 */
class Model {
    /**
     * Constructor del Modelo donde se inicializa una array de experiencias {experiences}, nombre del usuario {nickname} y token {token}
     */
    //Constructor que crea lo necesario cuando se declara el modelo
    constructor() {
        let experiences = [];
        this.nickname = "";
        this.token = "";
        console.log("Model creat");

    }

    /**
     * Actualiza las experiencias
     * @param {Nuevas experiencias} newExperiences 
     */
    //Actualiza las experiencias en local
    updateExperiences(newExperiences) {
        if (this.experiences = newExperiences) {
            return true;
        }
        return false;
    }

    /**
     * Devuelve el array de experiencias
     */
    //Descarga el array de experiencias
    downloadExperiences() {
        return this.experiences;
    }

    /**
     * Devuelve el token
     */
    getToken() {
        return this.token;
    }

    /**
     * Actualiza el token
     * @param {Token de la session de php} token 
     */
    setToken(token) {
        if (this.token = token) {
            return true;
        }
        return false;
    }

    /**
     * Comprueba la existencia de token
     */
    issetToken() {
        if (this.token != "") {
            return true;
        }
        return false;
    }

    /**
     * Actualiza el nombre de usuario 
     * @param {Nombre de usuario} nickname 
     */
    setNickname(nickname) {
        if (this.nickname = nickname) {
            return true;
        }
        return false;
    }

    /**
     * Devuelve el nombre de usuario
     */
    getNickname() {
        return this.nickname;
    }

    /**
     * Comprueba la existencia de nombre de usuario
     */
    issetNickname() {
        if (this.nickname != "") {
            return true;
        }
        return false;
    }
}
/**
 * Objeto para controlar las vistas de JavaScript
 */
//Declaracion de la vista
class View {
    /**
     * No hay inicialización de variables para la vista 
     */
    //Constructor que crea lo necesario cuando se declara la vista
    constructor() {
        console.log("Vista creada");
    }

    /**
     * Inserta en el div featured_box las experiencias
     * @param {Texto html con los divs de las experiencias} textHtml 
     */
    //inner text en el div principal con las experiencias preview
    createDivsExperiences(textHtml) {
        $("#featured_box").html(textHtml);
    }

    /**
     * Despliega los listenners de JQuery para el usuario sin registrar
     * @param {controlador} controller 
     */
    setUpClicks(controller) {
        let work = this;
        $("#submitSignInButton").click(
            function () {
                work.getInputSignIn(controller);
            }
        );
        $("#submitLogInButton").click(
            function () {
                work.getInputLogIn(controller);
            }
        );

        $("#sigInModal").on('keypress', function (e) {
            if (e.which == 13) {
                work.getInputSignIn(controller);
            }
        });

        $("#logInModal").on('keypress', function (e) {
            if (e.which == 13) {
                work.getInputLogIn(controller);
            }
        });

        $('#featured_box').on('click', 'a', function (e) {
           $("#logInButton").click();
        });
      
    }
    
    /**
     * Despliega los listenners de JQuery para el usuario registrado
     * @param {controlador} controller 
     */
    setUpClicksAfterLogIn(controller) {
        let work = this;

        //Elimina los listenners anteriores de los enlaces en featured_box
        $('#featured_box').off('click', 'a');
        
        $("#submitAddTripButton").click(
            function () {
                work.getInputAddTrip(controller);
            }
        );
        $("#submitEditProfileButton").click(
            function () {
                work.getInputEditProfile(controller);
            }
        );

        $("#addTripModal").on('keypress', function (e) {
            if (e.which == 13) {
                work.getInputAddTrip(controller);
            }
        });

        $("#editProfileModal").on('keypress', function (e) {
            if (e.which == 13) {
                work.getInputEditProfile(controller);
            }
        });

        $("#filterDate").click(
            function () {
                controller.ajaxOrderByDate();
            }
        );
        $("#filterRate").click(
            function () {
                controller.ajaxOrderByRate();
            }
        );
        $("#filterCategory").change(
            function () {
                let category = $("#filterCategory").val();
                controller.ajaxOrderByCategory(category);
            }
        );

        //Listenner de los enlaces que ejecutan la petición ajax para ver la experiencia completa
        $('#featured_box').on('click', 'a', function (e) {
            let tripId = e.target.id;
            tripId = tripId.replace("trip", "");
            controller.ajaxFullExperiences(tripId);
        });
    }

    /**
     * Carga la vista del usuario una vez hecho LogIn
     * @param {Texto html con botones de añadir experiencias y editar perfil} textNav 
     * @param {Texto html con los filtros de experiencias} texNavBar 
     * @param {Texto html con el modal de añadir experiencias} textModalAddTrip 
     * @param {Texto html con el modal de editar perfil} textModalEditProfile 
     * @param {controlador} controller 
     */
    setUpPageAfterLogIn(textNav, texNavBar, textModalAddTrip, textModalEditProfile, controller) {
        $("#wt_navbar-right").html(textNav);
        $("#tripsFilter").html(texNavBar);
        $("#aux1").html(textModalAddTrip);
        $("#aux2").html(textModalEditProfile);

        this.setUpClicksAfterLogIn(controller);
    }

    /**
     * Muestra un modal con la experiencia completa
     * @param {Texto html con la experiencia en detalle} textoHtml 
     */
    openModalFullExperiences(textoHtml) {
        $("#aux3").html(" ");
        $("#aux3").html(textoHtml);
        $("#viewFullTrip").modal("show");
    }

    /**
     * Recoge los datos del formulario de LogIn, los valida y carga los datos de usuario registrado 
     * @param {controlador} controller 
     */
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

    /**
     * Recoge los datos del formulario de SignIn, los valida y inserta el usuario
     * @param {controller} controller 
     */
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

    /**
     * Recoge los datos del formulario de Editar Perfil y los valida
     * @param {controller} controller 
     */
    getInputEditProfile(controller) {
        let nickname = $("#nicknameEdit").val();
        let name = $("#nameEdit").val();
        let surname = $("#surnameEdit").val();
        let email = $("#newEmail").val();
        //let password = $("#newPassword").val();
        //let passwordRepeat = $("#newPasswordRepeat").val();
        let textoError = controller.validateFormUser(nickname, name, email, "none", "none");
        if (textoError != "") {
            this.loadDangerAlert("#modalEditProfileAlert", textoError);
        } else {
            //Hacer update del usuario
        }

    }

    /**
     * Recoge los datos del formulario de añadir perfil, lo valida y inserta
     * @param {controller} controller 
     */
    getInputAddTrip(controller) {
        let title = $("#tripTitle").val();
        let resume = $("#tripResume").val();
        let description = $("#tripDescription").val();
        let location = $("#tripLocation").val();
        let category = $("#tripCategory").val();
        let textoError = controller.validateFormAddTrip(title, resume, description, location, category);
        if (textoError != "") {
            this.loadDangerAlert("#modalAddTripAlert", textoError);
        } else {
            console.log("Petición de ajax add trip enviada");
            controller.ajaxAddTrip(title, resume, description, category);
        }
    }

    /**
     * Muestra un modal de Danger
     * @param {Id del modal a mostrar} idModal 
     * @param {Texto a mostrar} textoError 
     */
    loadDangerAlert(idModal, textoError) {
        $(idModal).removeClass("alert-success");
        $(idModal).addClass("alert alert-danger");
        $(idModal).html("<ul>" + textoError + "</ul>");
        $(idModal).show();
    }

    /**
     * Muestra un modal de Success
     * @param {Id del modal a mostrar} idModal 
     * @param {Tetxo a mostrar} texto 
     */
    loadSuccessAlert(idModal, texto) {
        $(idModal).removeClass("alert-danger");
        $(idModal).addClass("alert alert-success");
        $(idModal).html(texto);
        $(idModal).show();
    }
}

/**
 * Objeto Controller y el principal que une la View y el Model
 */
class Controller {
    /**
     * Declaración de modelo, vista y variables de entorno además de preparar los listenners y mostrar experiencias
     * @param {Modelo} model 
     * @param {Vista} view 
     */
    constructor(model, view) {
        this.model = model;
        this.view = view;
        this.view.setUpClicks(this);
        //Peticion de ajax al cargar el controlador con las experiencias previas
        this.ajaxOrderByDate();
        console.log("Controlador creado");

    }

    /**
     * Petición de ajax para mostrar experiencias ordenadas por fecha (se utiliza por defecto)
     */
    ajaxOrderByDate() {
        if (this.model.issetToken()) {
            this.ajaxOrderBy("all", 1, "last", "none", "none");
        } else {
            this.ajaxOrderBy(4, 1, "last", "none", "none");
        }
        console.log("Ordenado por fecha");
    }

    /**
     * Petición de ajax para mostrar experiencias ordenadas por valoración
     */
    ajaxOrderByRate() {
        this.ajaxOrderBy("all", 1, "rate", "none", "none");
        console.log("Ordenado por valoración");
    }

    /**
     * Petición de ajax para mostrar experiencias ordenadas por categoria
     * @param {Categoria de la experiencia} category 
     */
    ajaxOrderByCategory(category) {
        this.ajaxOrderBy("all", 1, "last", "category", category);
        console.log("Ordenado por categoria " + category);
    }

    /**
     * Petición de ajax general para mostrar experiencias
     * @param {Número de resultados a mostrar} resultTotal 
     * @param {1 para mostrar datos} resultPage 
     * @param { Para especificar el orden ('last' para ultimos primero) ('rate' para mejor valorados primero)} resultOrder 
     * @param {Selector de campo (('author' para solo un autor) ('category' para solo una categoria)} resultWhere 
     * @param {Condición que debe cumplir} resultCondition 
     */
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
            //Antes de enviar muestra un modal como cargando
            beforeSend: function () {
                $('#loadModal').modal('show');
                setTimeout(function () {
                    $('#loadModal').modal('hide');
                }, 2000);

            },
            success: function (result) {
                console.log(result);
                let arrayExperiences = JSON.parse(result);
                //Actualizar modelo
                work.model.updateExperiences(arrayExperiences);
                //Cargar texto de las experiencias
                let textoHTML = work.createPreviewExperiencesHTML(arrayExperiences);
                //Insertar texto en la página
                work.view.createDivsExperiences(textoHTML);

            },
            error: function () {
                console.log("Error en la petición AJAX preview");
            }
        });
    }
    /**
     * Crea el texto html con la vista simplificada de las experiencias
     * @param {Array de experiencias} arrayExperiences 
     */
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
                                <a id="trip${arrayExperiences[i].trip_id}"  href="#"  class="btn btn-block btn-outline-warning text-secondary">Saber Mas</a>
                            </div>
                        <div class="col-6 text-right">`;
            for (let j = 0; j < 5; j++) {
                if (j < arrayExperiences[i].trip_rate) {
                    textHtml += `<span class="text-warning"><i class="fa fa-star star" aria-hidden="true"></i></span>`;
                } else {
                    textHtml += `<span class="text-secondary"><i class="fa fa-star star" aria-hidden="true"></i></span>`;
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
    /**
     * Crea el texto html del modal de la experiencia completa
     * @param {Objeto experiencia} trip 
     */
    createModalFullTrip(trip) {
        console.log(trip);
        let textHtml = `<div id="viewFullTrip" class="viewFullTrippModal modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md " role="document">
            <div class="card-body modal-content">
            <div id="modalViewFullTripAlert" style="display: none;" role="alert">

            </div>
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
        let date = trip[0].trip_date.split(" ");
        textHtml += `</a><br /><small>${date[0]}</small></p>`;
        for (let j = 0; j < 5; j++) {
            if (j < trip[0].trip_rate) {
                textHtml += `<span class="text-warning"><i id="rate-star" class="fa fa-star star" aria-hidden="true"></i></span>`;
            } else {
                textHtml += `<span class="text-secondary"><i id="rate-star" class="fa fa-star star" aria-hidden="true"></i></span>`;
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

    /**
     * Validación simple de los formularios de crear perfil y editar
     * @param {Nombre usuario} nickname 
     * @param {Nombre real de usuario} name 
     * @param {Correo} email 
     * @param {Contraseña} pass1 
     * @param {Contraseña repetida} pass2 
     */
    validateFormUser(nickname, name, email, pass1, pass2) {
        let textoError = "";
        nickname = nickname.trim();
        name = name.trim();
        pass1 = pass1.trim();
        pass2 = pass2.trim();
        email = email.trim();
        if (nickname == "") {
            textoError += "<li>Nickname vacío</li>";
        }
        if (name == "") {
            textoError += "<li>Nombre vacío</li>";
        }
        if (pass1 == "") {
            textoError += "<li>Contraseña vacía</li>";
        }
        if (pass2 != pass1) {
            textoError += "<li>Discrepanacia de contraseñas</li>"
        }
        if (email == "") {
            textoError += "<li>Email vacío</li>"
        }
        return textoError;

    }

    /**
     * Validación simple del formulario de LogIn
     * @param {Nombre de usuario} nickname 
     * @param {Contraseña} password 
     */
    validateFormLogIn(nickname, password) {
        let textoError = "";
        nickname = nickname.trim();
        password = password.trim();
        if (nickname == "") {
            textoError += "<li>Nickname vacío</li>";
        }
        if (password == "") {
            textoError += "<li>Contraseña vacía</li>";
        }

        return textoError;
    }

    /**
     * Validación simple del formulario de añadir una experiencia
     * @param {Titulo de la experiencia} title 
     * @param {Resumen de la experiencia} resume 
     * @param {Descripción de la experiencia} description 
     * @param {Localización de la experiencia} location 
     * @param {Categoria de la experiencia} category 
     */
    validateFormAddTrip(title, resume, description, location, category) {
        title = title.trim();
        resume = resume.trim();
        description = description.trim();
        location = location.trim()
        category = category.trim();
        let textoError = "";
        if (title == "") {
            textoError += "<li>Título vacío</li>";
        }
        if (resume == "") {
            textoError += "<li>Resumen vacío</li>";
        }
        if (description == "") {
            textoError += "<li>Descripción vacía</li>";
        }
        if (location == "") {
            textoError += "<li>Localización vacía</li>";
        }
        if (category == "") {
            textoError += "<li>Categoría vacía</li>";
        }
        if (title.length > 50) {
            textoError += "<li>El título es muy largo</li>";
        }
        if (resume.length < 100 || resume.length > 150) {
            textoError += "<li>El resumen debe contener entre 100 y 150 caracteres</li>";
        }
        if (description.length < 150 || description.length > 300) {
            textoError += "<li>La descripción debe contener entre 150 y 300 caracteres</li>";
        }
        return textoError;
    }

    /**
     * Petición ajax de registro de usuario
     * @param {Nombre de usuario} nickname 
     * @param {Nombre real de usuario} name 
     * @param {Apellidos} surname 
     * @param {Correo} email 
     * @param {Contraseña} pass1 
     * @param {Tratamiento} treatment 
     */
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
            success: function (result) {
                if (result != "") {
                    work.view.loadDangerAlert("#modalSignInAlert", result);
                } else {
                    work.view.loadSuccessAlert("#modalSignInAlert", "Bienvenido al club !\nYa puedes hacer Log In y empezar a compartir tus trips");
                }
            },
            error: function () {
                console.log("ERROR petición ajax de enviar datos SignIn");
            }
        });
    }
    /**
     * Petición ajax para Iniciar Sesión
     * @param {Nombre de usuario} nickname 
     * @param {Contraseña} password 
     */
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
            success: function (result) {
                //Añadir validación de result
                if (result != "false") {
                    let obj = JSON.parse(result);
                    let textNav = obj.html_textNav;
                    let textFilterNav = obj.filter;
                    let textModalAddTrip = obj.html_modalAddTrip;
                    let textModalEditProfile = obj.html_modalEditProfile;
                    let token = obj.token;
                    let nickname = obj.username;
                    work.model.setToken(token);
                    work.model.setNickname(nickname);
                    work.view.setUpPageAfterLogIn(textNav, textFilterNav, textModalAddTrip, textModalEditProfile, work);
                    work.ajaxOrderByDate();
                    work.view.loadSuccessAlert("#modalLogInAlert", "Ya estás logeado.\nBienvenido de nuevo !!");
                } else {
                    work.view.loadDangerAlert("#modalLogInAlert", "Ups! Algo ha fallado\nRevisa los datos por favor");

                }
            },
            error: function () {
                console.log("ERROR petición ajax de enviar datos LogIn");
            }
        });
    }

    /**
     * Petición ajax para recoger los datos completos de la experiencia
     * @param {Id de la experiencia} tripId 
     */
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
            success: function (result) {
                //Añadir validación de result
                if (result != "false") {
                    console.log(result); //ROGER
                    let obj = JSON.parse(result); // ROGER -> te olvidaste el PARSE
                    let textoHtml = work.createModalFullTrip(obj);
                    work.view.openModalFullExperiences(textoHtml);
                } else {

                }
            },
            error: function () {
                console.log("ERROR petición ajax de ver en detalle el trip");
            }
        });
    }

    /**
     * Petición ajax para añadir una experiencia
     * @param {Titulo de la experiencia} title 
     * @param {Resumen de la experiencia} resume 
     * @param {Descripción de la experiencia} description 
     * @param {Categoria de la experiencia} category 
     */
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
            success: function (result) {
                //Añadir validación de result
                if (result != "false") {
                    console.log(result);
                    work.view.loadSuccessAlert("#modalAddTripAlert", "En breve publicaremos tu trip.\nGracias por compartirlo !!");

                } else {
                    work.view.loadDangerAlert("#modalAddTripAlert", ":(  Algo ha fallad0!");
                    console.log(result);
                }
            },
            error: function () {
                console.log("ERROR petición ajax de añadir una experiencia");
            }
        });
    }

}




/**
 * Creación de toda la estructura MVC con clases 
 */
$(document).ready(function () {
    const wikiTrips = new Controller(new Model(), new View());
})