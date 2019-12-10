//Declaracion del modelo
class Model {
    //Constructor que crea lo necesario cuando se declara el modelo
    constructor(){
        console.log("Model creat");
    }   

    /*
        101-> Ver la preview de las experiencias
        102-> Experiencias completas
        201-> Log in
        202-> Sig in
    */
  /*  loadCodes(){
        let codes=[
            {
                name:"previewExperiences",
                code:101
            },
            {
                name:"fullExperiences",
                code:102
            },
            {
                name:"logIn",
                code:201
            },
            {
                name:"sigIn",
                code:202
            }
        ];
        return codes;
    }*/

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
}

class Controller{
    constructor(model,view){
        this.model = model;
        this.view = view;
        //Peticion de ajax al cargar el controlador con las experiencias previas
        this.ajaxRequestPreviewExperiences();
        console.log("Controlador creado");

    }

    //Método para hacer peticiones Ajax contra PHP   
    ajaxRequestPreviewExperiences(){
       /* $.ajax(
            {
                url:"api.php",
                success:function(result){
                    let textHtml=createPreviewExperiences(result);
                    view.createDivsExperiences(textHtml);
                }
            }
        );*/
        let result =this.model.createDefaultExperiences();
        let textHtml=this.createPreviewExperiences(result);
        this.view.createDivsExperiences(textHtml);
    }

    //Forma el texto con las experiencias
    createPreviewExperiences(arrayExperiences){
        let textHtml=``;
        for(let i=0;i<arrayExperiences.length;i++){
            textHtml+=`<div class="col-md-3">`;
            textHtml+=`<img src="${arrayExperiences[i].featureImg}" alt="test" > `;
            textHtml+=`<h2>${arrayExperiences[i].featureTitle}</h2>`;
            textHtml+=`</div>`;
        }
        return textHtml;
    }

    


    

}

//Creacion de toda la estructura MVC con clases
const wikiTrips = new Controller(new Model(), new View());
