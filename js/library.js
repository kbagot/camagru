(function () {
    var libimg = document.querySelectorAll('#libimg'),
        displayimg = document.querySelector('#displayimg'),
        close = document.querySelector('#close'),
        fuu = document.getElementById('showimg');

    close.addEventListener('click', function () {
        displayimg.style.visibility = 'hidden';
    }, false);

    for (var i = 0; i < libimg.length; i++) {
        libimg[i].addEventListener('click', function (ev) {
            displayimg.style.visibility = 'visible';
            fuu.src = ev.target.src;
        }, false);
    }
})();