<?php
session_start();
$email = $_SESSION['email'];
$list_user = ['event@rsudbandungkiwari.or.id', 'operator@rsudbandungkiwari.or.id'];
if (!in_array($email, $list_user)) {
    header('location: ../index.php');
    exit();
}
include("../_conf/_conn.php");
$get_pegawai = $db->query("SELECT COUNT(*) as total FROM pegawai WHERE status NOT IN('Cleaning Service','CS','Satpam','SECURITY') AND aktif='y'");
$peg = $get_pegawai->fetch(PDO::FETCH_ASSOC);
$total1 = isset($peg['total']) ? $peg['total'] : 0;
$get_kehadiran_pegawai = $db->query("SELECT COUNT(*) as total FROM event_record WHERE page LIKE 'event1'");
$hadir = $get_kehadiran_pegawai->fetch(PDO::FETCH_ASSOC);
$hadir1 = isset($hadir['total']) ? $hadir['total'] : 0;
//get pegawai lainnya base on csv
if (($open = fopen("../_conf/custom_list.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($open, 2000, ";")) !== FALSE) {
        $group_name[] = $data;
    }
    fclose($open);
}
$get_kehadiran_pegawai2 = $db->query("SELECT COUNT(*) as total FROM event_record WHERE page LIKE 'event1_custom'");
$hadir_lainnya = $get_kehadiran_pegawai2->fetch(PDO::FETCH_ASSOC);
$hadir2 = isset($hadir_lainnya['total']) ? $hadir_lainnya['total'] : 0;
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Hindaka Ilman Nafian">
    <title>Manage Service</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/dashboard/">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Favicons -->
    <!-- <link rel="apple-touch-icon" href="/docs/5.2/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.2/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.2/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.2/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.2/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
    <link rel="icon" href="/docs/5.2/assets/img/favicons/favicon.ico"> -->
    <meta name="theme-color" content="#712cf9">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
</head>

<body>
    <?php include("header.php"); ?>


    <div class="container-fluid">
        <div class="row">
            <?php include("menu.php"); ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard Telusur Individu</h1>
                    <!-- <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                            <span data-feather="calendar" class="align-text-bottom"></span>
                            This week
                        </button>
                    </div> -->
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="card border-dark mb-3 text-center" style="max-width: 18rem;">
                            <div class="card-header">Pegawai</div>
                            <div class="card-body text-dark">
                                <h1><?= $total1; ?> <span data-feather="users" class="align-text-middle"></span></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card border-info mb-3 text-center" style="max-width: 18rem;">
                            <div class="card-header">Kehadiran Pegawai</div>
                            <div class="card-body text-info">
                                <h1><?= $hadir1 ?> <span data-feather="users" class="align-text-middle"></span></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card border-dark mb-3 text-center" style="max-width: 18rem;">
                            <div class="card-header">THL, CS & SECURITY</div>
                            <div class="card-body text-dark">
                                <h1><?php echo count($group_name); ?> <span data-feather="users" class="align-text-middle"></span></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card border-warning mb-3 text-center" style="max-width: 18rem;">
                            <div class="card-header">Kehadiran THL, CS & SECURITY</div>
                            <div class="card-body text-warning">
                                <h1><?=$hadir2;?> <span data-feather="users" class="align-text-middle"></span></h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->
        </div>
        </main>
    </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="js/dashboard.js"></script>
</body>

</html>