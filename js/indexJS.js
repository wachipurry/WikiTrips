//Declaracion del modelo
class Model {
    //Constructor que crea lo necesario cuando se declara el modelo
    constructor(){
        console.log("Model creat");
    }   


    
    
}
//Declaracion de la vista
class View{
    //Constructor que crea lo necesario cuando se declara la vista
    constructor(){
        console.log("Vista creada");
    }

    //Funcion que anade al boton la peticion ajax
    setUpListener(controller){
        $("#botonPrueba").click(function(){
            //Funcion del controlador AJAX
            controller.ajaxRequest();
        });
    }

    createDivsExperiences(){
        
    }
}

class Controller{
    constructor(model,view){
        this.model = model;
        this.view = view;
        this.view.setUpListener(this);
        console.log("Controlador creada");

    }

    //Método para hacer peticiones Ajax contra PHP   
    ajaxRequest(){
        $.ajax(
            {
                //URL de prueba
                url: "https://randomuser.me/api/", 
                success: function(result){
                    console.log(result);
                }
            }
        );
    }
    

}

//Creacion de toda la estructura MVC con clases
const wikiTrips = new Controller(new Model(), new View());
