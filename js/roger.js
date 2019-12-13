/**
 * ESTO NO ME FUNCIONA DEL TODO, HAY QUE MIRARLO
 * ES EL SCRIPT QUE DEBERIA REDUCIR EL MENU SUPERIOR
 * PERO DEJANDOLO FIJO Y ESAS COSAS DE CSS
 */

window.onscroll = function() { scrollFunction() };

function scrollFunction() {
    if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
        document.getElementById("wt_navbar").style.padding = "20px 10px";
        document.getElementById("wt_logo").style.fontSize = "20px";
    } else {
        document.getElementById("wt_navbar").style.padding = "80px 10px"; //80px antes
        document.getElementById("wt_logo").style.fontSize = "5opx";
    }
}

//Definir ID a obervar
let btn = document.getElementById("roger_login");
//Iniciar escucha del id observado
btn.addEventListener("click", function() {

    //Obtener URL actual
    let url = window.location.href;

    //Quitar los slash
    let str = url.split("/")

    // Vovler a crear URL eliminando ultimo slash
    let full_url = ""
    for (let i = 0; i < (str.length - 1); i++) {
        full_url += str[i] + '/'
    }


    let api_url = full_url + "DDBB/api.php";
    let params = "?apiCode=101";
    let ajax_url = api_url + params;
    console.log('URL de la api que llamaré -> \n' + ajax_url);

    //Crear objeto API request
    let ajax_request = new XMLHttpRequest();

    //Definir parametros del objeto API para la request i enviar
    ajax_request.open("GET", ajax_url, true);
    ajax_request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    ajax_request.send();

    console.log(ajax_request.responseText); //Chivato

    //Mientras la respuesta (estado) de la request no sea devuelta con 4 (finalizado)
    document.getElementById('api_test_01').style.color = 'red'
    document.getElementById('api_test_01').style.textAlign = 'center'
    document.getElementById('api_test_01').innerHTML = '<b> CARGANDO </b>'

    // Esperamos respuesta del request.send()
    ajax_request.onreadystatechange = function() {

        //Mientras la respuesta (estado) de la request no sea 4 (finalizado)

        if (ajax_request.readyState == 4) {
            let jsonObj = JSON.parse(ajax_request.responseText);

            console.log(jsonObj); //Chivato del objeto JSON q recibimos para su tratamiento

            document.getElementById('api_test_01').style.color = '#212529'
            document.getElementById('api_test_01').style.textAlign = 'left'
            document.getElementById('api_test_01').innerHTML = jsonObj[0]['descr']
        }
    }
});