(function () {
    var libimg = document.querySelectorAll('#libimg'),
        displayimg = document.querySelector('#displayimg'),
        close = document.querySelector('#close'),
        like = document.querySelector('#like'),
        comm = document.querySelector('#comm'),
        clicimg = document.getElementById('showimg');

    close.addEventListener('click', function () {
        displayimg.style.visibility = 'hidden';
    }, false);

    like.addEventListener('click', function () {
        var formData = new FormData();
        formData.append('img', clicimg.src);
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function () {
            if (ajax.responseText == 'nolog') {
                like.style.visibility = 'hidden';
                comm.style.visibility = 'hidden';
                document.querySelector('#nolog').innerHTML = "Connectez-vous";
            }
            console.log(ajax.responseText);
        };
        ajax.open("POST", "php/action/like.php", true);
        ajax.send(formData);
    }, false);

    function display_comm(img) {
        var formData = new FormData();
        formData.append('img', img);
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function () {
            // if (ajax.responseText == 'nocomm') {
            //     document.querySelector('#showcomm').innerHTML = "Pas de Comentaires";
            //     console.log('hum');
            // }
            var res = JSON.parse(ajax.responseText);
            var out = "";
            var i;
            console.log(res);
            for (i = 0; i < res.length; i++) {
                 out += '<span>' + res[i]['u_name'] + '</span><br><span>' + res[i]['comm'] + '</span><br>';
            }
            document.getElementById("showcomm").innerHTML = out;
        };
        ajax.open("POST", "php/action/load_comm.php", true);
        ajax.send(formData);
    };

    for (var i = 0; i < libimg.length; i++) {
        libimg[i].addEventListener('click', function (ev) {
            displayimg.style.visibility = 'visible';
            display_comm(ev.target.src);
            clicimg.src = ev.target.src;
        }, false);
    }
})();

function sendCom(e) {
    e.preventDefault();
    var formData = new FormData();
    formData.append('comm', e.srcElement[0].value);
    formData.append('img', document.getElementById('showimg').src);
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
        if (ajax.responseText == 'nolog') {
            like.style.visibility = 'invisible';
            comm.style.visibility = 'invisible';
            document.querySelector('#nolog').innerHTML = "You should be log to perform this action";
        }
        console.log(ajax.responseText);
    };
    ajax.open("POST", "php/action/comm.php", true);
    ajax.send(formData);
}