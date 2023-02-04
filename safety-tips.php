<?php

require_once __DIR__ . "/../config/index.php";

if (isset($_SESSION['uid']) && ($_SESSION['role'] == '1' || $_SESSION['role'] == '2')) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php
        include_once "parts/meta.html";
        include_once "parts/icons.html";
        include_once "parts/stylesheets.html";
        ?>

        <title>Admin Safety Tip Videos</title>

        <!-- Custom Style -->
        <link rel="stylesheet" href="css/photoviewer.min.css">
        <style>
            .error {
                color: var(--bs-danger);
                font-size: smaller;
            }
        </style>

        <!-- Commonly used javascript libraries and scripts -->
        <?php include_once "parts/scripts.html"; ?>
        <script src="js/photoviewer.min.js"></script>

        <!-- UUID4 JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/uuid/8.2.0/uuidv4.min.js"></script>

        <!-- Script for validation -->
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>

    </head>

    <body class="bg-light">
        <?php include_once "parts/header.php"; ?>

        <div class="container-fluid">
            <div class="row">

                <?php include_once "parts/sidebar.php"; ?>

                <!-- Main content -->
                <main class="col-md-9 ms-sm-auto col-lg-10 px-0">

                    <div class="mw-750px mx-auto px-2 px-lg-5 px-md-4 mb-4 py-5 d-grid gap-4">
                        <div class="bg-white container p-4 rounded shadow d-grid gap-4">
                            <div class="d-grid">
                                <h3 class="fw-semibold mb-0 lh-1">Manage Youtube Links</h3>
                                <span class="text-muted text-xs">Compose a feed to show to your residents of your barangay. These posts will viewed by registered residents only.</span>
                            </div>
                            <form method="POST" id="form_safety_tip_videos" spellcheck="false">
                                <div class="row g-4">
                                    <div class="col-12 d-grid">
                                        <div class="alert alert-info alert-dismissible fade show text-sm d-none" role="alert">
                                            The videos in <a href="<?= ROOT . USER_PATH . USER_PAGES['_tips'] ?>" class="alert-link" target="_blank">Disaster Preparedness Safety Tips</a> are embedded via <a href="https://www.youtube.com" class="link-danger fw-bold">YouTube</a> for a reason is to improve streaming performance and reduce traffics on the website.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        <div class="alert alert-info d-none" role="alert">
                                            <span class="text-xs lh-sm"> Get the links of your videos in Youtube. Once you click proceed, these links will be converted to Youtube embed links. The following formats below are accepted:<br><span class="fw-semibold">https://www.youtube.com/watch?v=XXXXXXXX</span><br><span class="fw-semibold">https://youtu.be/XXXXXXXX</span></span>
                                        </div>
                                        <div class="progress d-none mb-2">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success fw-semibold" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div id="error_message_no_data"></div>
                                        <div class="row">
                                            <div class="col-12 d-grid">
                                                <form action="safety-tips.php" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="type" value="earthquake">
                                                    <label for="link_1" class="form-label text-sm fw-semibold mb-0">Earthquake <span class="fw-bold text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text bg-light text-darkbrown" id="link_1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor" class="w-20px h-20px">
                                                                <defs>
                                                                    <style>
                                                                        .fa-secondary {
                                                                            opacity: .4
                                                                        }
                                                                    </style>
                                                                </defs>
                                                                <path class="fa-primary" d="M416 101.5V64C416 46.33 430.3 32 448 32H480C497.7 32 512 46.33 512 64V185.5L565.1 231.9C578.4 243.6 579.7 263.8 568.1 277.1C556.4 290.4 536.2 291.7 522.9 280.1L288 74.52L53.07 280.1C39.77 291.7 19.56 290.4 7.918 277.1C-3.72 263.8-2.372 243.6 10.93 231.9L266.9 7.918C278.1-2.639 297-2.639 309.1 7.918L416 101.5z" />
                                                                <path class="fa-secondary" d="M64.07 448L64.02 270.5L288 74.52L512.1 270.6L512.5 447.9C512.6 483.3 483.9 512 448.5 512H326.4L288 448L368.8 380.7C376.6 374.1 376.5 362.1 368.5 355.8L250.6 263.2C235.1 251.7 216.8 270.1 227.8 285.2L288 368L202.5 439.2C196.5 444.3 194.1 452.1 199.1 459.8L230.4 512H128.1C92.74 512 64.09 483.4 64.07 448V448z" />
                                                            </svg>
                                                        </span>
                                                        <input type="file" name="earthquake" id="earthquake_link" class="form-control" placeholder="Choose Video for Earthquake Disaster" aria-describedby="link_1" accept="video/*" required>
                                                        <button class="upload-video-btn btn btn-success" type="button">Upload</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-12">
                                                <form action="safety-tips.php" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="type" value="fire">
                                                    <label for="link_2" class="form-label text-sm fw-semibold mb-0">Fire <span class="fw-bold text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text bg-light text-red" id="link_2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" fill="currentColor" class="w-20px h-20px">
                                                                <defs>
                                                                    <style>
                                                                        .fa-secondary {
                                                                            opacity: .4
                                                                        }
                                                                    </style>
                                                                </defs>
                                                                <path class="fa-primary" d="M433.8 163.7C439.4 158.7 447.1 158.8 453.5 163.8C473.3 181.6 491.8 200.7 509 221.5C516.9 211.6 525.8 200.8 535.5 191.1C541.1 186.9 549.9 186.9 555.5 192C580.2 214.7 601.1 244.7 615.8 273.2C630.4 301.2 640 329.9 640 350.1C640 437.9 568.7 512 480 512C390.3 512 320 437.8 320 350.1C320 323.7 332.7 291.5 352.4 259.5C372.4 227.2 400.5 193.4 433.8 163.7V163.7zM480.1 448C499 448 515 442.1 530 432.1C560 412 568 370 550 336.1C548 332.1 546 328.1 543 324.1L507 366.1C507 366.1 448.1 292.1 444.1 287.1C415 324.1 400 346 400 370C400 418.1 436 448 480.1 448z" />
                                                                <path class="fa-secondary" d="M256 352C238.3 352 224 366.3 224 384V472C224 494.1 206.1 512 184 512H128.1C126.6 512 125.1 511.9 123.6 511.8C122.4 511.9 121.2 512 120 512H104C81.91 512 64 494.1 64 472V360C64 359.1 64.03 358.1 64.09 357.2V287.6H32.05C14.02 287.6 0 273.5 0 255.5C0 246.5 3.004 238.5 10.01 231.5L266.4 8.016C273.4 1.002 281.4 0 288.4 0C295.4 0 303.4 2.004 309.5 7.014L447.3 128.1C434.9 127.2 422.3 131.1 412.5 139.9C377.1 171.5 346.9 207.6 325.2 242.7C304.3 276.5 288 314.9 288 350.1C288 350.7 288 351.4 288 352H256z" />
                                                            </svg>
                                                        </span>
                                                        <input type="file" name="fire" id="fire_link" class="form-control" placeholder="Choose Video for Fire Disaster" aria-describedby="link_2" accept="video/*" required>
                                                        <button class="upload-video-btn btn btn-success" type="button">Upload</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-12">
                                                <form action="safety-tips.php" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="type" value="tsunami">
                                                    <label for="link_3" class="form-label text-sm fw-semibold mb-0">Tsunami <span class="fw-bold text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text bg-light text-blue" id="link_3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor" class="w-20px h-20px">
                                                                <defs>
                                                                    <style>
                                                                        .fa-secondary {
                                                                            opacity: .4
                                                                        }
                                                                    </style>
                                                                </defs>
                                                                <path class="fa-primary" d="M428.8 46.43C440.2 37.88 455.8 37.9 467.2 46.47L562.7 118.4C570.7 124.5 575.4 133.9 575.5 143.9L575.8 287.9C575.8 290.8 575.4 293.6 574.7 296.3C569.8 293.6 564.3 291.5 558.5 290.1C545.4 287.1 531.8 280.3 521.2 271.5C499 252.8 466.9 251.4 443.2 268.1C425.2 280.5 403 288.5 384 288.5C364.4 288.5 343.2 280.8 324.8 268.1C323.3 267 321.7 265.1 320 265V143.1C320 133.9 324.7 124.4 332.8 118.4L428.8 46.43z" />
                                                                <path class="fa-secondary" d="M184.4 96C207.4 96 229.3 101.1 248.1 110.3C264.1 117.7 271.9 136.8 264.4 152.8C256.1 168.8 237.9 175.7 221.9 168.3C210.6 162.1 197.9 160 184.4 160C135.5 160 95.1 199.5 95.1 248C95.1 287 121.6 320.2 157.1 331.7C167.1 334.5 179.7 336 192 336C219.5 336 247 325.4 269.5 309.9C280.6 302 295.4 302 306.5 309.9C328.1 325.4 356.5 336 384 336C410.9 336 439.4 325.2 461.4 309.9L461.5 309.9C473.4 301.4 489.5 302.1 500.7 311.6C515 323.5 533.2 332.6 551.3 336.8C568.5 340.8 579.2 358.1 575.2 375.3C571.2 392.5 553.1 403.2 536.7 399.2C512.2 393.4 491.9 382.6 478.5 374.2C449.5 389.7 417 400 384 400C352.1 400 323.4 390.1 303.6 381.1C297.7 378.5 292.5 375.8 288 373.4C283.5 375.8 278.3 378.5 272.4 381.1C252.6 390.1 223.1 399.1 192.1 400C192.1 400 192 400 192 400C190.2 400 188.3 399.1 186.5 399.9C185.8 399.1 185.1 400 184.4 400C169.8 400 155.6 397.9 142.2 394.1C53.52 372.1 .0006 291.6 .0006 200C.0006 87.99 95.18 0 209 0C232.8 0 255.8 3.823 277.2 10.9C294 16.44 303.1 34.54 297.6 51.32C292 68.1 273.9 77.21 257.2 71.67C242.2 66.72 225.1 64 209 64C152.6 64 104.9 93.82 80.81 136.5C108 111.4 144.4 96 184.4 96H184.4zM461.4 421.9L461.5 421.9C473.4 413.4 489.5 414.1 500.7 423.6C515 435.5 533.2 444.6 551.3 448.8C568.5 452.8 579.2 470.1 575.2 487.3C571.2 504.5 553.1 515.2 536.7 511.2C512.2 505.4 491.9 494.6 478.5 486.2C449.5 501.7 417 512 384 512C352.1 512 323.4 502.1 303.6 493.1C297.7 490.5 292.5 487.8 288 485.4C283.5 487.8 278.3 490.5 272.4 493.1C252.6 502.1 223.9 512 192 512C158.1 512 126.5 501.7 97.5 486.2C84.12 494.6 63.79 505.4 39.27 511.2C22.06 515.2 4.853 504.5 .8422 487.3C-3.169 470.1 7.532 452.8 24.74 448.8C42.84 444.6 60.96 435.5 75.31 423.6C86.46 414.1 102.6 413.4 114.5 421.9L114.6 421.9C136.7 437.2 165.1 448 192 448C219.5 448 247 437.4 269.5 421.9C280.6 414 295.4 414 306.5 421.9C328.1 437.4 356.5 448 384 448C410.9 448 439.4 437.2 461.4 421.9H461.4z" />
                                                            </svg>
                                                        </span>
                                                        <input type="file" name="tsunami" id="tsunami_link" class="form-control" placeholder="Choose Video for Tsunami Disaster" aria-describedby="link_3" accept="video/*" required>
                                                        <button class="upload-video-btn btn btn-success" type="button">Upload</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-12">
                                                <form action="safety-tips.php" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="type" value="flood">
                                                    <label for="link_4" class="form-label text-sm fw-semibold mb-0">Flood <span class="fw-bold text-danger">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text bg-light text-darkbrown" id="link_4">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="currentColor" class="w-20px h-20px">
                                                                <defs>
                                                                    <style>
                                                                        .fa-secondary {
                                                                            opacity: .4
                                                                        }
                                                                    </style>
                                                                </defs>
                                                                <path class="fa-primary" d="M549.8 445.7c-31.23-5.719-46.84-20.06-47.13-20.31c-12.22-12.19-32.31-12.09-44.91-.375c-1.062 .9062-25.17 23-73.77 23s-72.73-22.06-73.38-22.62c-12.22-12.25-32.31-12.12-44.89-.375c-1.031 .9062-25.14 23-73.73 23s-72.73-22.06-73.38-22.62c-12.22-12.25-32.28-12.16-44.89-.3438c-.6562 .5938-16.28 14.94-47.5 20.66c-17.39 3.188-28.89 19.84-25.72 37.22c3.203 17.41 19.8 29.09 37.27 25.69c25.31-4.594 44.7-13.28 58.17-21.19C115.4 498.9 147.4 512 192 512c44.55 0 76.44-13.06 95.95-24.59c19.5 11.47 51.52 24.58 96.12 24.58s76.48-13.11 95.09-24.64c13.47 7.938 32.86 16.62 58.19 21.25c18.41 3.375 34.91-8.312 38.11-25.72S567.2 448.9 549.8 445.7z" />
                                                                <path class="fa-secondary" d="M565.1 231.9l-255.1-223.1c-6.029-5.283-13.55-7.92-21.08-7.92c-6.199 0-14.15 1.85-21.08 7.92l-255.1 223.1C-11.25 251.3 2.604 287.1 32 287.1h32.02v100.9c8.527-7.877 19.54-12.51 31.35-12.51c40.88 0 34.45 39.62 97.04 39.62c64.52 0 53.23-39.66 95.32-40.02c42.2 .3652 31.4 40.02 95.9 40.02c62.63 0 55.89-39.62 97.04-39.62c11.79 0 22.8 4.617 31.32 12.47V287.1H544c17.73 0 31.1-14.4 31.1-32C575.1 246.9 572.2 238.1 565.1 231.9zM352 298.6c0 11.88-9.625 21.38-21.38 21.38H245.4c-11.75 0-21.38-9.625-21.38-21.38V213.4c0-11.88 9.625-21.38 21.38-21.38h85.25c11.75 0 21.38 9.5 21.38 21.38V298.6z" />
                                                            </svg>
                                                        </span>
                                                        <input type="file" name="flood" id="flood_link" class="form-control" placeholder="Choose Video for Flood Disaster" aria-describedby="link_4" accept="video/*" required>
                                                        <button class="upload-video-btn btn btn-success" type="button">Upload</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- <div class="col-12 d-grid justify-content-end">
                                <button type="submit" id="post_videos_btn" class="create-post-btn btn w-max px-3 py-2 text-uppercase btn-primary shadow fw-semibold text-center">Update</button>
                            </div> -->
                        </div>

                    </div>

                    <?php include_once "parts/footer.php"; ?>
                </main>
            </div>
        </div>


        <!-- Message Modal -->
        <div class="modal fade" id="modalMessage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalMessageLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="border-0 modal-content shadow">
                    <div class="modal-body pb-3 py-5">
                        <div class="container text-center">
                            <div class="align-items-center d-flex flex-column fs-4 fw-semibold gap-2" id="modal_message"></div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex align-items-center justify-content-center border-0 overflow-hidden">
                        <button type="button" class="btn btn-lg btn-primary flex-grow-1 m-0 fw-semibold" data-bs-dismiss="modal">Okay</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery Validation -->
        <script>
            $(document).ready(function() {
                const minlen_title = 8;
                const minlen_content = 12;
                $("#minlen_title").text(minlen_title);
                $("#minlen_content").text(minlen_content);
                $("#form_newsfeed").validate({
                    rules: {
                        title: {
                            required: true,
                            minlength: minlen_title
                        },
                        content: {
                            required: true,
                            minlength: minlen_content
                        }
                    },
                    messages: {
                        title: {
                            required: "Please enter a title name",
                            minlength: "Your title must be at least 8 characters long"
                        },
                        content: {
                            required: "Please write a content",
                            minlength: "Your content must be at least 12 characters long"
                        }
                    }
                });
            });
        </script>

        <!-- Embed Youtube Links -->
        <!-- <script>
            $.ajax({
                url: 'process/show_video_links.php',
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {
                    $("#earthquake_link").empty().val(data.earthquake);
                    $("#fire_link").empty().val(data.fire);
                    $("#flood_link").empty().val(data.flood);
                    $("#tsunami_link").empty().val(data.tsunami);
                }
            });

            $(document).on("click", "#post_videos_btn", function() {
                var formData = $("#form_safety_tip_videos").serialize();
                $(this).addClass("disabled").html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...'
                );
                $.ajax({
                    url: 'process/post_video_links.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'JSON',
                    success: function(data) {
                        $("#modalMessage").modal("show");
                        $("#modal_message").html(data.message);
                    },
                    complete: function() {
                        $("#post_videos_btn").removeClass("disabled").html(
                            'Proceed'
                        );
                        $.ajax({
                            url: 'process/show_video_links.php',
                            type: 'GET',
                            dataType: 'JSON',
                            success: function(data) {
                                $("#earthquake_link").empty().val(data.earthquake);
                                $("#fire_link").empty().val(data.fire);
                                $("#flood_link").empty().val(data.flood);
                                $("#tsunami_link").empty().val(data.tsunami);
                            }
                        });
                    }
                });

            });
        </script> -->

        <!-- Upload Videos -->
        <script>
            $(document).ready(function() {
                $(document).on("submit", "form", function(event) {
                    var $this = $(this);
                    var file = $this.find("input[type=file]").files[0];
                    console.log(file);
                    if (file && file.size > 30 * 1024 * 1024) {
                        $("#modalMessage").modal("show");
                        $("#modal_message").empty().html("Unable to upload video. Either it is not valid or file size is greater than 30MB");
                        event.preventDefault();
                    } else {
                        event.preventDefault();
                        var formData = new FormData($this[0]);

                        $.ajax({
                            xhr: function() {
                                var xhr = new window.XMLHttpRequest();
                                xhr.upload.addEventListener("progress", function(evt) {
                                    if (evt.lengthComputable) {
                                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                                        if (percentComplete < 100) {
                                            setTimeout(function() {
                                                $('.progress-bar').css({
                                                    'width': percentComplete + '%'
                                                });
                                                $('.progress-bar').html(percentComplete + '%');
                                            }, 2000);
                                        } else {
                                            $('.progress-bar').css({
                                                'width': percentComplete + '%'
                                            });
                                            $('.progress-bar').html(percentComplete + '%');
                                        }
                                    }
                                }, false);
                                return xhr;
                            },
                            type: "POST",
                            url: "safety-tips.php",
                            data: formData,
                            contentType: false,
                            processData: false,
                            beforeSend: function() {
                                $this.find(".upload-video-btn").empty().html(`<div class="d-flex align-items-center gap-2 lh-1"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span>Uploading</span></div>`);
                                $(".progress").toggleClass("d-none");
                            },
                            success: function() {
                                $("#modalMessage").modal("show");
                                $("#modal_message").empty().html("Video has been uploaded");
                                $this.find(".upload-video-btn").empty().html(`Upload`);
                                $(".progress").toggleClass("d-none");
                                $('.progress-bar').css({
                                    'width': '0%'
                                });
                                $('.progress-bar').html('0%');
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                $("#modalMessage").modal("show");
                                $("#modal_message").empty().html("Uploading file has been failed. " + errorThrown);
                            }
                        });
                    }
                });
            });
        </script>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $target_dir = __DIR__ . "/../app/videos/";
            switch ($_POST['type']) {
                case 'earthquake':
                    $fixed_filename = "earthquake";
                    $video_file = $_FILES["earthquake"]["name"];
                    $extension = pathinfo($video_file, PATHINFO_EXTENSION);
                    break;

                case 'fire':
                    $fixed_filename = "fire";
                    $video_file = $_FILES["fire"]["name"];
                    $extension = pathinfo($video_file, PATHINFO_EXTENSION);
                    break;

                case 'flood':
                    $fixed_filename = "flood";
                    $video_file = $_FILES["flood"]["name"];
                    $extension = pathinfo($video_file, PATHINFO_EXTENSION);
                    break;

                case 'tsunami':
                    $fixed_filename = "tsunami";
                    $video_file = $_FILES["tsunami"]["name"];
                    $extension = pathinfo($video_file, PATHINFO_EXTENSION);
                    break;

                default:
                    break;
            }
            $target_file = $target_dir . $fixed_filename . "." . $extension;
            if (move_uploaded_file($_FILES["earthquake"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["earthquake"]["name"]) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        ?>


    </body>

    </html>
<?php
} else {
    header('location:index.php');
}
// end of isset session
?>