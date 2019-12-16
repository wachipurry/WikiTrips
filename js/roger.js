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
