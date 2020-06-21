function yonlendir3(url) {
    setTimeout(
        function() {
            window.location.href=url;
        }, 3000);
    
}

function yonlendir2(url) {
    setTimeout(
        function() {
            window.location.href=url;
        }, 2000);
    
}

function yonlendir(url) {
    window.location.href=url;
}

function geriGit() {
    history.back();
}

function ileriGit() {
    history.forward();
}

function mesajKutusu(baslik, mesaj) {
    document.getElementById("mesajTitle").innerHTML = baslik;
    document.getElementById("mesajBody").innerHTML = mesaj;
    document.getElementById("mesajButton").click();
}

function onayKutusu(baslik, mesaj, func) {
    document.getElementById("onayTitle").innerHTML = baslik;
    document.getElementById("onayBody").innerHTML = mesaj;
    document.getElementById("jaButton").onclick = func;
    document.getElementById("onayButton").click();
}