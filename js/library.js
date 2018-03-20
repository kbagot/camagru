var libimg = document.querySelectorAll('#libimg'),
    displayimg = document.querySelector('#displayimg'),
    close = document.querySelector('#close'),
    like = document.querySelector('#like'),
    comm = document.querySelector('#comm'),
    delimg = document.querySelector('#delimg'),
    nolog = document.querySelector('#nolog'),
    clicimg = document.getElementById('showimg');

close.addEventListener('click', function () {
    displayimg.style.visibility = 'hidden';
    nolog.style.visibility = 'hidden';
    like.src = 'logo/like.png';
}, false);


if (window.innerWidth < 700) {
    libimg.forEach(function (el) {
        el.style.marginTop = '10%';
    });
}
else {
    libimg.forEach(function (el) {
        el.style.marginTop = '0';
    });
}

window.onresize = function () {
    if (window.innerWidth < 700) {
        libimg.forEach(function (el) {
            el.style.marginTop = '10%';
        })
    } else {
        libimg.forEach(function (el) {
            el.style.marginTop = '0';
        })
    }
};

if (like) {
    var commbox = document.querySelector('#combox');
    like.addEventListener('click', function () {
        var formData = new FormData();
        formData.append('img', clicimg.src);
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function () {
            if (ajax.readyState === XMLHttpRequest.DONE && ajax.status === 200 && ajax.responseText === 'nolog') {
                like.style.visibility = 'hidden';
                comm.style.visibility = 'hidden';
                commbox.style.visibility = 'hidden';
                nolog.style.visibility = 'visible';
                nolog.innerHTML = "Connectez-vous";
            }
            like.src = 'logo/liked.png';
            // console.log(ajax.responseText);
        };
        ajax.open("POST", "action/like.php", true);
        ajax.send(formData);
    }, false);
}

if (delimg) {
    delimg.addEventListener('click', function () {
            var formData = new FormData();
            formData.append('img', clicimg.src);
            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function () {
                if (ajax.readyState === XMLHttpRequest.DONE && ajax.status === 200) {
                    if (libimg.length === 1 && location.search[6] > 0)
                        location.search = '?page=' + (location.search[6] - 1);
                    else
                        location.reload();
                }
                // console.log(ajax.responseText);
            };
            ajax.open("POST", "action/delimg.php", true);
            ajax.send(formData);
        }, false
    );
}

function display_comm(img) {
    var formData = new FormData();
    formData.append('img', img);
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
        if (ajax.readyState === XMLHttpRequest.DONE && ajax.status === 200) {
            if (ajax.responseText === 'nocomm') {
                document.querySelector('#showcomm').innerHTML = "Pas de Commentaires";
            }
            else {
                var res = JSON.parse(ajax.responseText);
                display(res);
            }
        }
    };
    ajax.open("POST", "action/load_comm.php", true);
    ajax.send(formData);

    function display(res) {
        var out = "";
        var i;
        for (i = 0; i < res.length; i++) {
            out += '<span id="commtext"><strong>' + res[i]['u_name'] + ' </strong>' + res[i]['comm'] + '</span></br>';
        }
        document.getElementById("showcomm").innerHTML = out;
    }
}

function isliked(img) {
    var formData = new FormData();
    formData.append('img', img);
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
        if (ajax.readyState === XMLHttpRequest.DONE && ajax.status === 200) {
            if (like && ajax.responseText === 'liked') {
                like.src = 'logo/liked.png';
            }
        }
    };
    ajax.open("POST", "action/load_like.php", true);
    ajax.send(formData);
}

for (var i = 0; i < libimg.length; i++) {
    libimg[i].addEventListener('click', function (ev) {
        displayimg.style.visibility = 'visible';
        display_comm(ev.target.src);
        isliked(ev.target.src);
        clicimg.src = ev.target.src;
    }, false);
}

function sendCom(e) {
    e.preventDefault();
    var formData = new FormData();
    formData.append('comm', e.srcElement[0].value);
    formData.append('img', document.getElementById('showimg').src);
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
        if (ajax.responseText === 'nolog') {
            like.style.visibility = 'hidden';
            comm.style.visibility = 'hidden';
            commbox.style.visibility = 'hidden';
            nolog.style.visibility = 'visible';
            nolog.innerHTML = "Connectez-vous";
        }
        console.log(ajax.responseText);
        display_comm(document.getElementById('showimg').src);
    };
    ajax.open("POST", "action/comm.php", true);
    ajax.send(formData);
}

