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
            if (ajax.responseText === 'nolog') {
                like.style.visibility = 'hidden';
                comm.style.visibility = 'hidden';
                document.querySelector('#nolog').innerHTML = "Connectez-vous";
            }
            like.src = 'logo/liked.png';
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
            if (ajax.readyState === XMLHttpRequest.DONE && ajax.status === 200) {
                if (ajax.responseText === 'nocomm') {
                    document.querySelector('#showcomm').innerHTML = "Pas de Comentaires";
                }
                else {
                    var res = JSON.parse(ajax.responseText);
                    display(res);
                }
            }
        };
        ajax.open("POST", "php/action/load_comm.php", true);
        ajax.send(formData);

        function display(res) {
            var out = "";
            var i;
            for (i = 0; i < res.length; i++) {
                out += '</h1><span id="commtext"><strong>' + res[i]['u_name'] + ' </strong>' + res[i]['comm'] + '</span>';
            }
            document.getElementById("showcomm").innerHTML = out;
        }
    }

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
        if (ajax.responseText === 'nolog') {
            var like = document.querySelector('#like');
            like.style.visibility = 'invisible';
            var comm = document.querySelector('#comm');
            comm.style.visibility = 'invisible';
            document.querySelector('#nolog').innerHTML = "You should be log to perform this action";
        }
        console.log(ajax.responseText);
    };
    ajax.open("POST", "php/action/comm.php", true);
    ajax.send(formData);
}