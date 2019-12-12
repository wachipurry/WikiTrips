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
    let system_url = "http://localhost:1002/roger/WT/"
    let api_url = "api.php";
    let params = "?apiCode=101";
    let ajax_url = system_url + api_url + params;

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

    console.log(ajax_url)
    let ajax_request = new XMLHttpRequest();

    ajax_request.open("GET", ajax_url, true);
    ajax_request.send();

    console.log(ajax_request.responseText);
    ajax_request.onreadystatechange = function() {
        console.log(ajax_request.readyState)

        if (ajax_request.readyState == 4) {
            console.log("hola")
            let jsonObj = JSON.parse(ajax_request.responseText);
            console.log(jsonObj);
            document.getElementById('api_test_01').innerHTML = jsonObj[0]['trip_name']
        }


    }




});