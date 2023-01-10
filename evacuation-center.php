<?php
require_once __DIR__ . "/../config/index.php";
require_once __DIR__ . "/../functions/index.php";

if (isset($_SESSION['uid']) && ($_SESSION['role'] == '2')) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php
        include_once "parts/meta.html";
        include_once "parts/icons.html";
        include_once "parts/stylesheets.html";
        ?>

        <title><?= SITE_NAME ?> - Admin Evacuation Centers</title>

        <!-- Custom style for the admin profile page -->

        <!-- Commonly used javascript libraries and scripts -->
        <?php include_once "parts/scripts.html"; ?>

        <!-- Set session ID to session Storage -->
        <script>
            sessionStorage.setItem('suid', '{$_SESSION[\'uid\']}');
        </script>

    </head>

    <body>
        <div class="main">

            <!-- main header ng page -->
            <?php include_once "parts/header.php"; ?>

            <div class="container-fluid">
                <div class="row">

                    <!-- Sidebar -->
                    <?php include_once "parts/sidebar.php"; ?>

                    <main class="col-md-9 ms-sm-auto col-lg-10 px-0">
                        <div class="container p-4 p-md-5">
                            <div class="row h-100">
                                <div class="col">
                                    <div class="d-flex flex-column gap-4 h-100">
                                        <div class="d-grid d-md-flex justify-content-between">
                                            <div class="d-grid gap-1 text-sm">
                                                <h5 class="m-0 fw-bold">Evacuation Centers</h5>
                                                <p class="text-muted mw-500px text-wrap">All locations set as evacuation centers within your area. Manage this list to add or remove certain location within your barangay.</p>
                                            </div>
                                            <div class="d-flex gap-2 align-items-center">
                                                <a href="add-center.php" class="btn btn-primary btn-lg d-flex align-items-center gap-2 shadow w-max">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="20" height="20">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <span class="text-sm text-nowrap">Add New</span>
                                                </a>
                                                <div class="dropdown">
                                                    <a class="align-items-center border-opacity-25 border-secondary btn btn-light caret-none d-flex dropdown-toggle justify-content-center p-2 rounded-circle shadow-sm w-max has-tooltip tooltip-bottom position-relative" data-tooltip="More Options" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="16" height="16">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                    <ul class="dropdown-menu border-0 shadow-sm">
                                                        <li>
                                                            <h6 class="border-bottom border-light fw-bold pb-1 px-3 text-sm">
                                                                More
                                                                Actions</h6>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="dropdown-item d-flex gap-1 align-items-center link-danger" type="button" data-bs-toggle="modal" data-bs-target="#resetMapModal">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="16" height="16">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99">
                                                                    </path>
                                                                </svg>
                                                                <span class="text-sm">Remove All</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="centers" class="">
                                            <div class="d-grid gap-4 show-centers">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <?php include_once "parts/footer.php"; ?>

                    </main>
                </div>
            </div>
        </div>

        <!-- AJAX Remove Center -->
        <script src="js/ec.min.js" defer></script>

    </body>

    </html>
<?php
} else {
    header('location:index.php');
}
?>
