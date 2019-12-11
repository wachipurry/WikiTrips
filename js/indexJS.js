//Declaracion del modelo
class Model {
    //Constructor que crea lo necesario cuando se declara el modelo
    constructor(){
        console.log("Model creat");
        let experiences=[];
    }   
    /*
        101-> Ver la preview de las experiencias
        102-> Experiencias completas
        201-> Log in
        202-> Sig in
    */

    createDefaultExperiences(){
        let experiencias=[
            {
                featureImg:"https://picsum.photos/200",
                featureTitle:"Prueba 1"
            },
            {
                featureImg:"https://picsum.photos/200",
                featureTitle:"Prueba 2"
            },
            {
                featureImg:"https://picsum.photos/200",
                featureTitle:"Prueba 3"
            },
            {
                featureImg:"https://picsum.photos/200",
                featureTitle:"Prueba 4"
            }
        ];

        return experiencias;
    }
    //Actualiza las experiencias en local
    updateExperiences(newExperiences){
        if(this.experiences=newExperiences){
            return true;
        }
        return false;
    }

    //Descarga el array de experiencias
    downloadExperiences(){
        return this.experiences;
    }
    
}
//Declaracion de la vista
class View{
    //Constructor que crea lo necesario cuando se declara la vista
    constructor(){
        console.log("Vista creada");
    }

    //inner text en el div principal con las experiencias preview
    createDivsExperiences(textHtml){
        $("#principal").html(textHtml);
    }

    createDivsFullExperiences(textHtml){
        $("#secundario").html(textHtml);
    }
}

class Controller{
    constructor(model,view){
        this.model = model;
        this.view = view;
        //Peticion de ajax al cargar el controlador con las experiencias previas
        this.ajaxRequestPreviewExperiences();
        this.ajaxRequestFullExperiences();

        console.log("Controlador creado");

    }

    //Método para hacer peticiones Ajax contra PHP   
    ajaxRequestPreviewExperiences(){
        $.ajax(
            {
                type: 'POST',
                url:"api.php",
                 data:{
                    apiCode: "101"
                },
                success:function(result){
                    let textHtml=createPreviewExperiencesHTML(result);
                    view.createDivsExperiences(textHtml);
                }
            }
        );

        //Para probar que se muestran datos de prueba sin AJAX
       /* let result =this.model.createDefaultExperiences();
        let textHtml=this.createPreviewExperiencesHTML(result);
        this.view.createDivsExperiences(textHtml);*/
    }

    //Método para hacer peticiones Ajax contra PHP   
    ajaxRequestFullExperiences(){
        $.ajax(
            {
                type: 'POST',
                url:"api.php",
                data:{
                    apiCode: "102"
                },
                success:function(result){
                    let textHtml=createFullExperiencesHTML(result);
                    view.createDivsFullExperiences(textHtml);
                }
            }
        );
    }

    ajaxRequestSigIn(){
        
    }

    ajaxRequestLogIn(){

    }

    //Formar el texto con las experiencias completas
    createFullExperiencesHTML(arrayExperiences){
        let textHtml=``;
        this.model.updateExperiences(arrayExperiences);
        for(let i=0;i<arrayExperiences.length;i++){
            textHtml+=`<div class="col-md-3">`;
            textHtml+=`<h2>${arrayExperiences[i].trip_name}</h2>`;
            textHtml+=`<img src="${arrayExperiences[i].trip_thumb}" alt="test" > `;
            textHtml+=`<label>${arrayExperiences[i].trip_resum}</label>`;
            textHtml+=`<label>${arrayExperiences[i].trip_date}</label>`;
            textHtml+=`<label>${arrayExperiences[i].trip_author}</label>`;
            textHtml+=`<label>${arrayExperiences[i].trip_rate}</label>`;
            textHtml+=`</div>`;
        }
        return textHtml;
    }
    //Forma el texto con las experiencias
    createPreviewExperiencesHTML(arrayExperiences){
        let textHtml=``;
        for(let i=0;i<arrayExperiences.length;i++){
            textHtml+=`<div class="col-md-3">`;
            textHtml+=`<h2>${arrayExperiences[i].trip_name}</h2>`;
            textHtml+=`<img src="${arrayExperiences[i].trip_thumb}" alt="test" > `;
            textHtml+=`</div>`;
        }
        return textHtml;


        

    }

    


    

}

//Creacion de toda la estructura MVC con clases
$( document ).ready(function() {
    const wikiTrips = new Controller(new Model(), new View());
})
