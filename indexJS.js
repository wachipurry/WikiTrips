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

    createDivsFullExperiences(textHtml) {
        $("#secundario").html(textHtml);
    }

    setUpClicks(controller) {
        let work=this;
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
    }

    getInputLogIn(controller){
        let nickname=$("#nicknameLogIn").val();
        let password=$("#passwordLogIn").val();
        let textoError = controller.validateFormLogIn(nickname,password);
        if (textoError != "") {
            this.loadDangerAlert("#modalLogInAlert",textoError);
        } else {
            controller.ajaxSubmitLogIn(nickname,password);
        }
    }

    getInputSignIn(controller) {
        let nickname = $("#nickname").val();
        let name = $("#name").val();
        let email = $("#email").val();
        let pass1 = $("#passwordA").val();
        let pass2 = $("#passwordB").val();
        let textoError = controller.validateFormSignIn(nickname, name, email, pass1, pass2);
        if (textoError != "") {
            this.loadDangerAlert("#modalSignInAlert",textoError);
        } else {
            let treatment = $("#treatment").val();
            let surname = $("#surname").val();
            controller.ajaxSubmitSignIn(nickname, name, surname, email, pass1, treatment);
        }
    }

    loadDangerAlert(idModal,textoError){
        $(idModal).removeClass("alert-success");
        $(idModal).addClass("alert alert-danger");
        $(idModal).html("<ul>" + textoError + "</ul>");
        $(idModal).show();
    }

    loadSuccessAlert(idModal){
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
            url: "apiPrueba.php",
            data: {
                apiCode: "101"
            },
            success: function (result) {
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

    //Forma el texto con las experiencias
    createPreviewExperiencesHTML(arrayExperiences) {
        let textHtml = ``;
        for (let i = 0; i < arrayExperiences.length; i++) {
            textHtml += `<div class="col-md-3">`;
            textHtml += `<h2>${arrayExperiences[i].trip_name}</h2>`;
            textHtml += `<img src="${arrayExperiences[i].trip_thumb}" alt="test" > `;
            textHtml += `</div>`;
        }
        return textHtml;
    }

    //Método para hacer peticiones Ajax contra PHP   
    ajaxRequestFullExperiences() {
        let work = this;
        $.ajax({
            type: 'get',
            url: "apiPrueba.php",
            data: {
                apiCode: "102"
            },
            success: function (result) {
                let textoHTML = work.createFullExperiencesHTML(JSON.parse(result));
                work.view.createDivsFullExperiences(textoHTML);
            }
        });

    }

    //Formar el texto con las experiencias completas
    createFullExperiencesHTML(arrayExperiences) {
        let textHtml = ``;
        this.model.updateExperiences(arrayExperiences);
        for (let i = 0; i < arrayExperiences.length; i++) {
            textHtml += `<div class="col-md-3">`;
            textHtml += `<h2>${arrayExperiences[i].trip_name}</h2>`;
            textHtml += `<img src="${arrayExperiences[i].trip_thumb}" alt="test" > `;
            textHtml += `<label>${arrayExperiences[i].trip_resum}</label>`;
            textHtml += `<label>${arrayExperiences[i].trip_date}</label>`;
            textHtml += `<label>${arrayExperiences[i].trip_author}</label>`;
            textHtml += `<label>${arrayExperiences[i].trip_rate}</label>`;
            textHtml += `</div>`;
        }
        return textHtml;
    }

    validateFormSignIn(nickname, name, email, pass1, pass2) {
        let textoError = "";
        nickname = nickname.trim();
        name = name.trim();
        pass1 = pass1.trim();
        pass2 = pass2.trim();
        email=email.trim();
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

    validateFormLogIn(nickname,password){
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



    ajaxSubmitSignIn(nickname,name,surname,email,pass1,treatment){
        let work=this;
        $.ajax({

            type: "get",
            url: "apiPrueba.php",
            data: {
                apiCode: "202",
                nickname:nickname,
                name:name,
                surname:surname,
                email:email,
                password:pass1,
                treatment:treatment
            },
            success: function(result) {
                if(result!=""){
                   work.view.loadDangerAlert("#modalSignInAlert",result);
                }else{
                   work.view.loadSuccessAlert("#modalSignInAlert");
                }
            },
            error: function() {
                console.log("ERROR petición ajax de enviar datos SignIn");
            }
        });
    }

    ajaxSubmitLogIn(nickname,password) {
        let work=this;
        $.ajax({
            type: "get",
            url: "apiPrueba.php",
            data: {
                apiCode: "201",
                uId:nickname,
                uPwd:password
            },
            success: function(result) {
                alert(result);
            /*    if(result!=""){
                   work.view.loadDangerAlert("#modalSignInAlert",result);
                }else{
                   work.view.loadSuccessAlert("#modalSignInAlert");
                }*/
            },
            error: function() {
                console.log("ERROR petición ajax de enviar datos LogIn");
            }
        });
    }




}

//Creacion de toda la estructura MVC con clases
$(document).ready(function () {
    const wikiTrips = new Controller(new Model(this), new View(this));
})