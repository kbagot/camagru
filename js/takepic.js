(function () {

    var streaming = false,
        video = document.querySelector('#video'),
        canvas = document.querySelector('#canvas'),
        photo = document.querySelector('#photo'),
        startbutton = document.querySelector('#startbutton'),
        imgfilter = document.querySelectorAll('#imgfilter'),
        sfilter = document.querySelector('#filter'),
        lastcanvas = null,
        width = video.getBoundingClientRect().right / 3,
        height = 0;

    navigator.getMedia = ( navigator.getUserMedia ||
        navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia ||
        navigator.msGetUserMedia);

    navigator.getMedia(
        {
            video: true,
            audio: false
        },
        function (stream) {
            if (navigator.mozGetUserMedia) {
                video.mozSrcObject = stream;
            } else {
                var vendorURL = window.URL || window.webkitURL;
                video.src = vendorURL.createObjectURL(stream);
            }
            video.play();
        },
        function (err) {
            console.log("An error occured! " + err);
        }
    );

    video.addEventListener('canplay', function () {
        if (!streaming) {
            height = video.videoHeight / (video.videoWidth / width);
            streaming = true;
        }
    }, false);

    function takepicture() {
        canvas.height = height;
        canvas.getContext('2d').drawImage(video, 0, 0, width, height);
        var data = canvas.toDataURL('image/png');
        var formData = new FormData();
        formData.append("img", data);
        formData.append("filtre", sfilter.src);
        var ajax = new XMLHttpRequest();
        ajax.open("POST", "php/action/upload.php", true);
        // ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send(formData);
        // console.log(data);
        // console.log(formData[img]);
        // photo.setAttribute('src', data);
    }

    startbutton.addEventListener('click', function (ev) {
        takepicture();
        ev.preventDefault();
    }, false);

    window.onresize = function () {
        width = video.getBoundingClientRect().right / 3;
        addfilter(lastcanvas);
    };

    function addfilter(ev) {
        sfilter.style.right = video.getBoundingClientRect().right / 2 + "px";
        sfilter.width = width;
        sfilter.height = height;
        // canvas.getContext('2d').drawImage(ev, 0, 0, width, height);
        sfilter.src = ev.src;
        startbutton.style.visibility = 'visible';
    }

    for (var i = 0; i < imgfilter.length; i++) {
        imgfilter[i].addEventListener('click', function (ev) {
            lastcanvas = ev.target;
            addfilter(ev.target);
            ev.preventDefault();
        }, false);
    }

})();