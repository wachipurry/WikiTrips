window.onscroll = function() { scrollFunction() };

function scrollFunction() {
    if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
        document.getElementById("wt_navbar").style.padding = "30px 10px";
        //document.getElementById("wt_logo").style.fontSize = "25px";
    } else {
        document.getElementById("wt_navbar").style.padding = "80px 10px"; //80px antes
        //document.getElementById("wt_logo").style.fontSize = "35px";
    }
}


let btn = document.getElementById("roger_login");
btn.addEventListener("click", function() {

    //Obtener URL actual
    let url = window.location.href;
    console.log('url -> ' + url);

    //Quitar los slash
    let str = url.split("/")
    console.log("str ->" + str)
    console.log(str.length)

    // Vovler a crear URL eliminando ultimo slash
    let full_url = ""
    for (let i = 0; i < (str.length - 1); i++) {
        full_url += str[i] + '/'
    }
    console.log('full_url -> ' + full_url);


    let api_url = full_url + "api.php";
    let params = "?apiCode=101";
    let ajax_url = api_url + params;
    console.log('URL de la api que llamaré -> \n' + ajax_url);

    /* JAVI 

    $.ajax({
        type: 'GET',
        url: "../api.php",
        data: {
            apiCode: "101"
        },
        success: function(result) {
            console.log(result);
        },

        //createPreviewExperiencesHTML(result),
        error: function() {
            console.log("mal");
        }
    });

*/

    /* A.PEREZ
        axios.get('http://localhost:1002/roger/WT/api.php?apiCode=101', {

            })
            .then(function(response) {
                console.log(response.data);
            })
            .catch(function(error) {
                console.log(error);
            })
            .finally(function() {
                // always executed
            });
        */
    let ajax_request = new XMLHttpRequest();

    ajax_request.open("GET", ajax_url, true);
    ajax_request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    ajax_request.send();

    console.log(ajax_request.responseText);
    ajax_request.onreadystatechange = function() {
        //console.log(ajax_request.readyState)

        if (ajax_request.readyState == 4) {
            console.log("hola")
                //console.log(ajax_request.responseText);
            let jsonObj = JSON.parse(ajax_request.responseText);
            console.log(jsonObj);
            document.getElementById('api_test_01').innerHTML = jsonObj[0]['descr']
        }


    }




});