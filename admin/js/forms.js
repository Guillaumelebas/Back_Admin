function checkAddUserForm() {
    var pass = document.getElementById("password").value;
    var confirm = document.getElementById("password-confirm").value;
    if (pass === confirm) {
        return true;
    } else {
        alert("Le mot de passe et la confirmation ne sont pas identiques");
        return false;
    }
}

function filtre() {
    //alert("coucou");
    document.getElementById("filtre").submit();
}

function checkSize(pNum) {
    var img = document.getElementById("img" + pNum);
    if (img.width > img.height) {
        img.className += "paysage";
    } else {
        img.className += "portrait";
    }
}

function reset() {
    var t = document.getElementsByClassName('div-cat');
    for (var i = 0; i < t.length; i++) {
        t[i].style.display = "block";
    }
}

function filtreCat() {
    reset();
    //alert(document.getElementsByClassName('active'));
    var v, t;
    v = document.getElementById('change-cat').value;
    t = [];
    //console.log(v);
    switch (v) {
        case '0':
            t = document.getElementsByClassName('active');
            break;
        case '1':
            t = document.getElementsByClassName('no-active');
            break;
        case "all":
        default:
            return;
    }
    //console.log(t);
    //
    for (var i = 0; i < t.length; i++) {
        t[i].style.display = "none";
    }

}