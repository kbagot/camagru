(function () {

    var streaming = false,
        video = document.querySelector('#video'),
        canvas = document.querySelector('#canvas'),
        photo = document.querySelector('#photo'),
        startbutton = document.querySelector('#startbutton'),
        imgfilter = document.querySelectorAll('#imgfilter'),
        suppcap = document.querySelectorAll('#suppcap'),
        filter = new Image(),
        fileinput = document.querySelector('#file'),
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
            canvas.width = video.getBoundingClientRect().width;
            canvas.height = video.getBoundingClientRect().height;
            streaming = true;
        }
    }, false);

    function takepicture(base) {
        startbutton.style.visibility = 'hidden';
        fileinput.style.visibility = 'hidden';
        canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
        canvas.getContext('2d').drawImage(base, 0, 0, canvas.width, canvas.height);
        var data = canvas.toDataURL('image/png');
        var formData = new FormData();
        formData.append("img", data);
        formData.append("filtre", filter.src);
        console.log(filter.width);
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function () {
            if (ajax.readyState === XMLHttpRequest.DONE && ajax.status === 200) {
                var base = document.getElementById("capic").innerHTML;
                document.getElementById("capic").innerHTML = "<div><img id=\"capicimg\" src=\"" + ajax.responseText +
                    "\"><button id=\"suppcap\">supp</button></div>" + base;
            }
        };
        ajax.open("POST", "php/action/upload.php", true);
        ajax.send(formData);
        canvas.getContext('2d').drawImage(filter, canvas.width / 2 - filter.width / 2, -10, filter.width, filter.height);
    }

    startbutton.addEventListener('click', function (ev) {
        takepicture(video);
        ev.preventDefault();
    }, false);

    fileinput.addEventListener('change', function () {
        var reader = new FileReader();
        // if (reader.readyState === 2){
        // console.log(fileinput);
        reader.addEventListener('load', function () {
            // console.log(reader.result);
            var lolilol = new Image();
            lolilol.onload = function () {
                takepicture(lolilol);
                // canvas.getContext('2d').drawImage(lolilol, 0, 0, canvas.width, canvas.height);
            };
            lolilol.src = reader.result;
        }, false);
        reader.readAsDataURL(fileinput.files[0]);
    }, false);

    window.onresize = function () {
        width = video.getBoundingClientRect().right / 3;
        canvas.width = video.getBoundingClientRect().width;
        canvas.height = video.getBoundingClientRect().height;
        // video.videoHeight = video.getBoundingClientRect().videoHeight + 10;
        // if (lastcanvas)
        //     addfilter(lastcanvas);
    };

    function addfilter(ev) {
        filter.src = ev.src;
        filter.width -= 640 - video.getBoundingClientRect().width;
        filter.height -= 480 - video.getBoundingClientRect().height;
        canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
        canvas.getContext('2d').drawImage(filter, canvas.width / 2 - filter.width / 2, -10, filter.width, filter.height);
        startbutton.style.visibility = 'visible';
        fileinput.style.visibility = 'visible';
    }

    for (var i = 0; i < imgfilter.length; i++) {
        imgfilter[i].addEventListener('click', function (ev) {
            addfilter(ev.target);
            ev.preventDefault();
        }, false);
    }

})();