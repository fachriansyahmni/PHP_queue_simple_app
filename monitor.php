<?php
include_once "config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

</head>

<body>
    <div class="audio">
        <audio id="in" src="audio/new/in.wav"></audio>
        <audio id="out" src="audio/new/out.wav"></audio>
        <audio id="suarabel" src="audio/new/Airport_Bell.mp3"></audio>
        <audio id="suarabelnomorurut" src="audio/new/nomor-urut.MP3"></audio>
        <audio id="suarabelsuarabelloket" src="audio/new/konter.MP3"></audio>
        <audio id="belas" src="audio/new/belas.MP3"></audio>
        <audio id="sebelas" src="audio/new/sebelas.MP3"></audio>
        <audio id="puluh" src="audio/new/puluh.MP3"></audio>
        <audio id="sepuluh" src="audio/new/sepuluh.MP3"></audio>
        <audio id="ratus" src="audio/new/ratus.MP3"></audio>
        <audio id="seratus" src="audio/new/seratus.MP3"></audio>
        <audio id="suarabelloket1" src="audio/new/1.MP3"></audio>
        <audio id="suarabelloket2" src="audio/new/2.MP3"></audio>
        <audio id="suarabelloket3" src="audio/new/3.MP3"></audio>
        <audio id="suarabelloket4" src="audio/new/4.MP3"></audio>
        <audio id="suarabelloket5" src="audio/new/5.MP3"></audio>
        <audio id="suarabelloket6" src="audio/new/6.MP3"></audio>
        <audio id="suarabelloket7" src="audio/new/7.MP3"></audio>
        <audio id="suarabelloket8" src="audio/new/8.MP3"></audio>
        <audio id="suarabelloket9" src="audio/new/9.MP3"></audio>
        <audio id="suarabelloket10" src="audio/new/sepuluh.MP3"></audio>
        <audio id="loket" src="audio/new/loket.MP3"></audio>
    </div>

    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 bg-info pl-3 pr-3 pt-2 pb-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">
                            <img src="assets/img/logo.png" width="100px" alt="">
                        </div>
                        <div>
                            <h1 class="">MONITORING ANTRIAN</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 p-1 bg-warning">
                    <marquee behavior="scroll" direction="left">SMK NEGERI 1 CIKARANG UTARA</marquee>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-6" id="img_slde">
                    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner img_slde_inner">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 videoMonitor">
                    <!-- <video src="assets/videos/video.mp4" class="rounded" width="100%" autoplay muted controls>
                    </video> -->
                </div>
            </div>
            <div class="row mt-5">
                <!-- <div class="col-lg-9 col-md-9 row listlokets">
                </div>
                <div class="col-lg-3 col-md-3">

                </div> -->
                <div class="col-lg-12 col-md-12 row listlokets">
                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script>
        $("document").ready(function() {
            var tmp_loket = 0;
            var tmp_img = 0;
            var tmp_video = "";
            setInterval(function() {
                $.ajax({
                    url: 'panggil.php',
                    type: 'post',
                    data: {
                        panggil: true
                    },
                    dataType: 'json',
                    success: function(data) {
                        // data['get'].forEach(tes);
                        if (data.jumlah_panggil > 0) {
                            var urut = data.get.urut;
                            var loket = data.get.loket;
                            for (var i = 0; i < urut.toString().length; i++) {
                                $(".audio").append('<audio id="suarabel' + i + '" src="audio/new/' + urut.toString().substr(i, 1) + '.MP3"></audio>');
                            }
                            mulai(urut, loket);
                            stopPanggil();
                        }
                    }
                });
                $.ajax({
                    url: 'getVideo.php',
                    type: 'post',
                    data: {
                        getVideo: true
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (tmp_video != data['video_src']) {
                            $('.videoMonitor').html("");
                            tmp_video = "";
                        }
                        if (tmp_video == "") {
                            videoShow = '';
                            // if (data["jml_video"] == 1) {
                            videoShow += ' <video  class="rounded" width="100%" muted autoplay loop>' +
                                '<source src="' + data["video_src"] + '" />' +
                                '</video>'
                            // }
                            $('.videoMonitor').html(videoShow);
                            tmp_video = data["video_src"];
                        }
                    }
                });
                $.ajax({
                    url: 'getImagesSlide.php',
                    type: 'post',
                    data: {
                        getImagesSlide: true
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (tmp_img != data['jml_img']) {
                            $('.img_slde_inner').html("");
                            tmp_img = 0;
                        }
                        if (tmp_img == 0) {
                            imageslide = '';
                            for (var i = 1; i <= data["jml_img"]; i++) {
                                if (i == 1) {
                                    imageslide += '<div class="carousel-item active">' +
                                        '<img src="' + data["img_src"][i] + '" class="d-block w-100" alt="...">' +
                                        '</div>';
                                } else {
                                    imageslide += '<div class="carousel-item">' +
                                        '<img src="' + data["img_src"][i] + '" class="d-block w-100" alt="...">' +
                                        '</div>';
                                }
                            }
                            $('.img_slde_inner').html(imageslide);
                            tmp_img = data["jml_img"];
                        }
                    }
                });
                $.ajax({
                    url: 'getLokets.php',
                    type: 'post',
                    data: {
                        getlokets: true
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (tmp_loket != data['jml_loket']) {
                            $(".col-lg-4").remove();
                            tmp_loket = 0;
                        }

                        if (tmp_loket == 0) {
                            for (var i = 1; i <= data['jml_loket']; i++) {
                                loket = '<div class="col-lg-3 mb-2">' +
                                    '<div class="card">' +
                                    '<div class="card-body text-center justify-content-center align-items-center d-flex" style="min-height: 100px;">' +
                                    '<span class="h1 urut' + i + '">' +
                                    data['urut'][i] +
                                    '</span>' +
                                    '</div>' +
                                    '<div class="card-footer text-center">' +
                                    '<h2 class="text-uppercase" style="font-weight: 700; color:deepskyblue">' +
                                    'LOKET ' + i +
                                    '</h2>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>';
                                $(".listlokets").append(loket);
                            }
                            tmp_loket = data['jml_loket'];
                        }
                        for (var i = 1; i <= data['jml_loket']; i++) {
                            $('.urut' + i).text(data['urut'][i]);
                        }
                    }
                });
            }, 1000);
            //change
        });

        function stopPanggil() {
            $.ajax({
                url: 'panggil.php',
                type: 'post',
                data: {
                    stop: true
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data.msg)
                }
            });
        }

        function mulai(urut, loket) {
            var totalwaktu = 8568.163;
            document.getElementById('in').pause();
            document.getElementById('in').currentTime = 0;
            document.getElementById('in').play();
            totalwaktu = document.getElementById('in').duration * 1000;
            setTimeout(function() {
                document.getElementById('suarabelnomorurut').pause();
                document.getElementById('suarabelnomorurut').currentTime = 0;
                document.getElementById('suarabelnomorurut').play();
            }, totalwaktu);
            totalwaktu = totalwaktu + 1000;
            if (urut < 10) {
                setTimeout(function() {
                    document.getElementById('suarabel0').pause();
                    document.getElementById('suarabel0').currentTime = 0;
                    document.getElementById('suarabel0').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('loket').pause();
                    document.getElementById('loket').currentTime = 0;
                    document.getElementById('loket').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('suarabelloket' + loket + '').pause();
                    document.getElementById('suarabelloket' + loket + '').currentTime = 0;
                    document.getElementById('suarabelloket' + loket + '').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    for (var i = 0; i < urut.toString().length; i++) {
                        $("#suarabel" + i + "").remove();
                    };
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
            } else if (urut == 10) {
                setTimeout(function() {
                    document.getElementById('sepuluh').pause();
                    document.getElementById('sepuluh').currentTime = 0;
                    document.getElementById('sepuluh').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('loket').pause();
                    document.getElementById('loket').currentTime = 0;
                    document.getElementById('loket').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('suarabelloket' + loket + '').pause();
                    document.getElementById('suarabelloket' + loket + '').currentTime = 0;
                    document.getElementById('suarabelloket' + loket + '').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    for (var i = 0; i < urut.toString().length; i++) {
                        $("#suarabel" + i + "").remove();
                    };
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
            } else if (urut == 11) {
                setTimeout(function() {
                    document.getElementById('sebelas').pause();
                    document.getElementById('sebelas').currentTime = 0;
                    document.getElementById('sebelas').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('loket').pause();
                    document.getElementById('loket').currentTime = 0;
                    document.getElementById('loket').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('suarabelloket' + loket + '').pause();
                    document.getElementById('suarabelloket' + loket + '').currentTime = 0;
                    document.getElementById('suarabelloket' + loket + '').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    for (var i = 0; i < urut.toString().length; i++) {
                        $("#suarabel" + i + "").remove();
                    };
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
            } else if (urut < 20) {
                setTimeout(function() {
                    document.getElementById('suarabel1').pause();
                    document.getElementById('suarabel1').currentTime = 0;
                    document.getElementById('suarabel1').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('belas').pause();
                    document.getElementById('belas').currentTime = 0;
                    document.getElementById('belas').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('loket').pause();
                    document.getElementById('loket').currentTime = 0;
                    document.getElementById('loket').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('suarabelloket' + loket + '').pause();
                    document.getElementById('suarabelloket' + loket + '').currentTime = 0;
                    document.getElementById('suarabelloket' + loket + '').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    for (var i = 0; i < urut.toString().length; i++) {
                        $("#suarabel" + i + "").remove();
                    };
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
            } else if (urut < 100) {
                setTimeout(function() {
                    document.getElementById('suarabel0').pause();
                    document.getElementById('suarabel0').currentTime = 0;
                    document.getElementById('suarabel0').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('puluh').pause();
                    document.getElementById('puluh').currentTime = 0;
                    document.getElementById('puluh').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('suarabel1').pause();
                    document.getElementById('suarabel1').currentTime = 0;
                    document.getElementById('suarabel1').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('loket').pause();
                    document.getElementById('loket').currentTime = 0;
                    document.getElementById('loket').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('suarabelloket' + loket + '').pause();
                    document.getElementById('suarabelloket' + loket + '').currentTime = 0;
                    document.getElementById('suarabelloket' + loket + '').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    for (var i = 0; i < urut.toString().length; i++) {
                        $("#suarabel" + i + "").remove();
                    };
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
            } else if (urut == 100) {
                setTimeout(function() {
                    document.getElementById('seratus').pause();
                    document.getElementById('seratus').currentTime = 0;
                    document.getElementById('seratus').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('loket').pause();
                    document.getElementById('loket').currentTime = 0;
                    document.getElementById('loket').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('suarabelloket' + loket + '').pause();
                    document.getElementById('suarabelloket' + loket + '').currentTime = 0;
                    document.getElementById('suarabelloket' + loket + '').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    for (var i = 0; i < urut.toString().length; i++) {
                        $("#suarabel" + i + "").remove();
                    };
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
            } else if (urut < 110) {
                setTimeout(function() {
                    document.getElementById('seratus').pause();
                    document.getElementById('seratus').currentTime = 0;
                    document.getElementById('seratus').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('suarabel2').pause();
                    document.getElementById('suarabel2').currentTime = 0;
                    document.getElementById('suarabel2').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('loket').pause();
                    document.getElementById('loket').currentTime = 0;
                    document.getElementById('loket').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('suarabelloket' + loket + '').pause();
                    document.getElementById('suarabelloket' + loket + '').currentTime = 0;
                    document.getElementById('suarabelloket' + loket + '').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    for (var i = 0; i < urut.toString().length; i++) {
                        $("#suarabel" + i + "").remove();
                    };
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
            } else if (urut == 110) {
                setTimeout(function() {
                    document.getElementById('seratus').pause();
                    document.getElementById('seratus').currentTime = 0;
                    document.getElementById('seratus').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('sepuluh').pause();
                    document.getElementById('sepuluh').currentTime = 0;
                    document.getElementById('sepuluh').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('loket').pause();
                    document.getElementById('loket').currentTime = 0;
                    document.getElementById('loket').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('suarabelloket' + loket + '').pause();
                    document.getElementById('suarabelloket' + loket + '').currentTime = 0;
                    document.getElementById('suarabelloket' + loket + '').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    for (var i = 0; i < urut.toString().length; i++) {
                        $("#suarabel" + i + "").remove();
                    };
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
            } else if (urut == 111) {
                setTimeout(function() {
                    document.getElementById('seratus').pause();
                    document.getElementById('seratus').currentTime = 0;
                    document.getElementById('seratus').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('sebelas').pause();
                    document.getElementById('sebelas').currentTime = 0;
                    document.getElementById('sebelas').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('loket').pause();
                    document.getElementById('loket').currentTime = 0;
                    document.getElementById('loket').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('suarabelloket' + loket + '').pause();
                    document.getElementById('suarabelloket' + loket + '').currentTime = 0;
                    document.getElementById('suarabelloket' + loket + '').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    for (var i = 0; i < urut.toString().length; i++) {
                        $("#suarabel" + i + "").remove();
                    };
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
            } else if (urut < 120) {
                setTimeout(function() {
                    document.getElementById('seratus').pause();
                    document.getElementById('seratus').currentTime = 0;
                    document.getElementById('seratus').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('suarabel2').pause();
                    document.getElementById('suarabel2').currentTime = 0;
                    document.getElementById('suarabel2').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('belas').pause();
                    document.getElementById('belas').currentTime = 0;
                    document.getElementById('belas').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('loket').pause();
                    document.getElementById('loket').currentTime = 0;
                    document.getElementById('loket').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('suarabelloket' + loket + '').pause();
                    document.getElementById('suarabelloket' + loket + '').currentTime = 0;
                    document.getElementById('suarabelloket' + loket + '').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    for (var i = 0; i < urut.toString().length; i++) {
                        $("#suarabel" + i + "").remove();
                    };
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
            } else if (urut == 120) {
                setTimeout(function() {
                    document.getElementById('seratus').pause();
                    document.getElementById('seratus').currentTime = 0;
                    document.getElementById('seratus').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('suarabel1').pause();
                    document.getElementById('suarabel1').currentTime = 0;
                    document.getElementById('suarabel1').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('puluh').pause();
                    document.getElementById('puluh').currentTime = 0;
                    document.getElementById('puluh').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('loket').pause();
                    document.getElementById('loket').currentTime = 0;
                    document.getElementById('loket').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('suarabelloket' + loket + '').pause();
                    document.getElementById('suarabelloket' + loket + '').currentTime = 0;
                    document.getElementById('suarabelloket' + loket + '').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    for (var i = 0; i < urut.toString().length; i++) {
                        $("#suarabel" + i + "").remove();
                    };
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
            } else if (urut < 200) {
                setTimeout(function() {
                    document.getElementById('seratus').pause();
                    document.getElementById('seratus').currentTime = 0;
                    document.getElementById('seratus').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('suarabel1').pause();
                    document.getElementById('suarabel1').currentTime = 0;
                    document.getElementById('suarabel1').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('puluh').pause();
                    document.getElementById('puluh').currentTime = 0;
                    document.getElementById('puluh').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;

                if (urut % 10 != 0) {
                    setTimeout(function() {
                        document.getElementById('suarabel2').pause();
                        document.getElementById('suarabel2').currentTime = 0;
                        document.getElementById('suarabel2').play();
                    }, totalwaktu);
                    totalwaktu = totalwaktu + 1000;
                }

                setTimeout(function() {
                    document.getElementById('loket').pause();
                    document.getElementById('loket').currentTime = 0;
                    document.getElementById('loket').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('suarabelloket' + loket + '').pause();
                    document.getElementById('suarabelloket' + loket + '').currentTime = 0;
                    document.getElementById('suarabelloket' + loket + '').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    for (var i = 0; i < urut.toString().length; i++) {
                        $("#suarabel" + i + "").remove();
                    };
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
            } else if (urut == 200) {
                setTimeout(function() {
                    document.getElementById('suarabel0').pause();
                    document.getElementById('suarabel0').currentTime = 0;
                    document.getElementById('suarabel0').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('ratus').pause();
                    document.getElementById('ratus').currentTime = 0;
                    document.getElementById('ratus').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('loket').pause();
                    document.getElementById('loket').currentTime = 0;
                    document.getElementById('loket').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('suarabelloket' + loket + '').pause();
                    document.getElementById('suarabelloket' + loket + '').currentTime = 0;
                    document.getElementById('suarabelloket' + loket + '').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    for (var i = 0; i < urut.toString().length; i++) {
                        $("#suarabel" + i + "").remove();
                    };
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
            } else if (urut < 999) {
                setTimeout(function() {
                    document.getElementById('suarabel0').pause();
                    document.getElementById('suarabel0').currentTime = 0;
                    document.getElementById('suarabel0').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                if (urut.toString().substr(1, 1) == 0 && urut.toString().substr(2, 1) == 0) { // 200 300 400 ..
                    setTimeout(function() {
                        document.getElementById('ratus').pause();
                        document.getElementById('ratus').currentTime = 0;
                        document.getElementById('ratus').play();
                    }, totalwaktu);
                    totalwaktu = totalwaktu + 1000;
                } else if (urut.toString().substr(1, 1) == 0 && urut.toString().substr(2, 1) != 0) { // 201 304 405 506
                    setTimeout(function() {
                        document.getElementById('ratus').pause();
                        document.getElementById('ratus').currentTime = 0;
                        document.getElementById('ratus').play();
                    }, totalwaktu);
                    totalwaktu = totalwaktu + 1000;
                    setTimeout(function() {
                        document.getElementById('suarabel2').pause();
                        document.getElementById('suarabel2').currentTime = 0;
                        document.getElementById('suarabel2').play();
                    }, totalwaktu);
                    totalwaktu = totalwaktu + 1000;
                } else if (urut.toString().substr(1, 1) != 0 && urut.toString().substr(2, 1) == 0) { //210 250 230
                    if (urut.toString().substr(1, 1) == 1) { //210
                        setTimeout(function() {
                            document.getElementById('ratus').pause();
                            document.getElementById('ratus').currentTime = 0;
                            document.getElementById('ratus').play();
                        }, totalwaktu);
                        totalwaktu = totalwaktu + 1000;
                        setTimeout(function() {
                            document.getElementById('sepuluh').pause();
                            document.getElementById('sepuluh').currentTime = 0;
                            document.getElementById('sepuluh').play();
                        }, totalwaktu);
                        totalwaktu = totalwaktu + 1000;
                    } else {
                        setTimeout(function() {
                            document.getElementById('ratus').pause();
                            document.getElementById('ratus').currentTime = 0;
                            document.getElementById('ratus').play();
                        }, totalwaktu);
                        totalwaktu = totalwaktu + 1000;
                        setTimeout(function() {
                            document.getElementById('suarabel1').pause();
                            document.getElementById('suarabel1').currentTime = 0;
                            document.getElementById('suarabel1').play();
                        }, totalwaktu);
                        totalwaktu = totalwaktu + 1000;
                        setTimeout(function() {
                            document.getElementById('puluh').pause();
                            document.getElementById('puluh').currentTime = 0;
                            document.getElementById('puluh').play();
                        }, totalwaktu);
                        totalwaktu = totalwaktu + 1000;
                    }
                } else if (urut.toString().substr(1, 1) != 0 && urut.toString().substr(2, 1) != 0) {
                    if (urut.toString().substr(1, 1) == 1) {
                        if (urut.toString().substr(2, 1) == 1) { // 211 311 411 511
                            setTimeout(function() {
                                document.getElementById('ratus').pause();
                                document.getElementById('ratus').currentTime = 0;
                                document.getElementById('ratus').play();
                            }, totalwaktu);
                            totalwaktu = totalwaktu + 1000;
                            setTimeout(function() {
                                document.getElementById('sebelas').pause();
                                document.getElementById('sebelas').currentTime = 0;
                                document.getElementById('sebelas').play();
                            }, totalwaktu);
                            totalwaktu = totalwaktu + 1000;
                        } else { //212 215 219
                            setTimeout(function() {
                                document.getElementById('ratus').pause();
                                document.getElementById('ratus').currentTime = 0;
                                document.getElementById('ratus').play();
                            }, totalwaktu);
                            totalwaktu = totalwaktu + 1000;
                            setTimeout(function() {
                                document.getElementById('suarabel2').pause();
                                document.getElementById('suarabel2').currentTime = 0;
                                document.getElementById('suarabel2').play();
                            }, totalwaktu);
                            totalwaktu = totalwaktu + 1000;
                            setTimeout(function() {
                                document.getElementById('belas').pause();
                                document.getElementById('belas').currentTime = 0;
                                document.getElementById('belas').play();
                            }, totalwaktu);
                            totalwaktu = totalwaktu + 1000;
                        }
                    } else {
                        setTimeout(function() {
                            document.getElementById('ratus').pause();
                            document.getElementById('ratus').currentTime = 0;
                            document.getElementById('ratus').play();
                        }, totalwaktu);
                        totalwaktu = totalwaktu + 1000;
                        setTimeout(function() {
                            document.getElementById('suarabel1').pause();
                            document.getElementById('suarabel1').currentTime = 0;
                            document.getElementById('suarabel1').play();
                        }, totalwaktu);
                        totalwaktu = totalwaktu + 1000;
                        setTimeout(function() {
                            document.getElementById('puluh').pause();
                            document.getElementById('puluh').currentTime = 0;
                            document.getElementById('puluh').play();
                        }, totalwaktu);
                        totalwaktu = totalwaktu + 1000;
                        if (urut % 10 != 0) {
                            setTimeout(function() {
                                document.getElementById('suarabel2').pause();
                                document.getElementById('suarabel2').currentTime = 0;
                                document.getElementById('suarabel2').play();
                            }, totalwaktu);
                            totalwaktu = totalwaktu + 1000;
                        }
                    }
                }

                setTimeout(function() {
                    document.getElementById('loket').pause();
                    document.getElementById('loket').currentTime = 0;
                    document.getElementById('loket').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    document.getElementById('suarabelloket' + loket + '').pause();
                    document.getElementById('suarabelloket' + loket + '').currentTime = 0;
                    document.getElementById('suarabelloket' + loket + '').play();
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
                setTimeout(function() {
                    for (var i = 0; i < urut.toString().length; i++) {
                        $("#suarabel" + i + "").remove();
                    };
                }, totalwaktu);
                totalwaktu = totalwaktu + 1000;
            }

            setTimeout(function() {
                document.getElementById('out').pause();
                document.getElementById('out').currentTime = 0;
                document.getElementById('out').play();
            }, totalwaktu);
            totalwaktu = totalwaktu + 1000;
            setTimeout(function() {
                // $.post("../apps/monitoring-daemon-result.php", {
                //     id: urut
                // }, function(data) {
                //     if (!data.status) {
                //         console.log(data.status);
                //     }
                // }, 'json');

                stopPanggil();
            }, totalwaktu);
            totalwaktu = totalwaktu + 1000;
        }
    </script>
</body>

</html>