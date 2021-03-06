(function () {

    var streaming = false,
        video = document.querySelector('#video'),
        canvas = document.querySelector('#canvas'),
        photo = document.querySelector('#photo'),
        startbutton = document.querySelector('#startbutton'),
        imgfilter = document.querySelectorAll('#imgfilter'),
        filter = new Image(),
        fileinput = document.querySelector('#file'),
        filebutton = document.querySelector('.file'),
        width = video.getBoundingClientRect().right / 3,
        height = 0;

    navigator.mediaDevices.getUserMedia({video: true, audio: false})
        .then(function(stream) {
            if ("srcObject" in video) {
                video.srcObject = stream;
            } else {
                // Avoid using this in new browsers, as it is going away.
                video.src = window.URL.createObjectURL(stream);
            }
            video.onloadedmetadata = function(e) {
                video.play();
            };
        })
        .catch(function(err) {
            console.log("An error occured! " + err);
        });

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
        filebutton.style.visibility = 'hidden';
        canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
        canvas.getContext('2d').drawImage(base, 0, 0, canvas.width, canvas.height);
        var data = canvas.toDataURL('image/png');
        var formData = new FormData();
        formData.append("img", data);
        formData.append("filtre", filter.src);
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function () {
            if (ajax.readyState === XMLHttpRequest.DONE && ajax.status === 200) {
                var base = document.getElementById("capic").innerHTML;
                document.getElementById("capic").innerHTML = "<div><img id=\"capicimg\" src=\"" + ajax.responseText +
                    "\"></div>" + base;
            }
        };
        ajax.open("POST", "action/upload.php", true);
        ajax.send(formData);
        canvas.getContext('2d').drawImage(filter, canvas.width / 2 - filter.width / 2, -10, filter.width, filter.height);

    }

    startbutton.addEventListener('click', function (ev) {
        takepicture(video);
        ev.preventDefault();
    }, false);

    fileinput.addEventListener('change', function () {
        if (fileinput.files[0]) {
            var extension = fileinput.files[0].name.split('.').pop().toLowerCase();
            if (fileinput.files[0].size < 5000000 && extension === 'png') {
                // console.log("name " + fileinput.name);
                var reader = new FileReader();
                // if (reader.readyState === 2){
                // console.log(fileinput);        /
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
            }
            else
                alert('Fichier de type `png` et inferieur a 5 MO');
        }
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

        filter.width = 250 - (250 * ((640 - video.getBoundingClientRect().width) / 640));
        filter.height = 250 - (250 * ((480 - video.getBoundingClientRect().height) / 480));
        // console.log(640 - video.getBoundingClientRect().width);
        canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
        canvas.getContext('2d').drawImage(filter, (canvas.width / 2) - (filter.width / 2), -10, filter.width, filter.height);
        startbutton.style.visibility = 'visible';
        filebutton.style.visibility = 'visible';
    }

    for (var i = 0; i < imgfilter.length; i++) {
        imgfilter[i].addEventListener('click', function (ev) {
            addfilter(ev.target);
            ev.preventDefault();
        }, false);
    }

})();