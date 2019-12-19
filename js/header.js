window.onscroll = function() { scrollFunction() };

function scrollFunction() {
    if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
        document.getElementById("wt_navbar").style.padding = "30px";
        //document.getElementById("wt_logo").style.fontSize = "20px";
    } else {
        document.getElementById("wt_navbar").style.padding = "70px"; //80px antes
        //document.getElementById("wt_logo").style.fontSize = "5opx";
    }
}