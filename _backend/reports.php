<?php
session_start();
$email = $_SESSION['email'];
$list_user = ['event@rsudbandungkiwari.or.id', 'operator@rsudbandungkiwari.or.id'];
if (!in_array($email, $list_user)) {
    header('location: ../index.php');
    exit();
}
include("../_conf/_conn.php");
$get_kehadiran_pegawai = $db->query("SELECT COUNT(*) as total FROM event_record WHERE page LIKE 'event1'");
$hadir = $get_kehadiran_pegawai->fetch(PDO::FETCH_ASSOC);
$hadir1 = isset($hadir['total']) ? $hadir['total'] : 0;
$get_list_tgl = $db->query("SELECT DISTINCT(SUBSTRING(created_at,1,10)) as tgl FROM event_record");
$list_tgl = $get_list_tgl->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Hindaka Ilman Nafian">
    <title>Report Page</title>

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
                    <h1 class="h2">Report Page</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <select id="tgl" name="tgl" class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <option value="">--Pilih Tanggal--</option>
                            <?php
                            foreach ($list_tgl as $lt) {
                                echo '<option value="' . $lt['tgl'] . '">' . $lt['tgl'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div id="content-data">
                            <h1 id="tgl_content" class="h4"></h1>
                            <div class="row">
                                <div class="col-3">
                                    <div class="card border-info mb-3 text-center" style="max-width: 18rem;">
                                        <div class="card-header">Kehadiran</div>
                                        <div class="card-body text-info">
                                            <h1><span id="kehadiran"></span> <span data-feather="users" class="align-text-middle"></span></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="card border-success mb-3 text-center" style="max-width: 18rem;">
                                        <div class="card-header">Selesai</div>
                                        <div class="card-body text-success">
                                            <h1><span id="lengkap"></span><span data-feather="users" class="align-text-middle"></span></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h1 class="h4">Selesai</h1>
                            <div class="row">
                                <div class="col-3">
                                    <div class="card border-primary mb-3 text-center" style="max-width: 18rem;">
                                        <div class="card-header">Tes K3RS</div>
                                        <div class="card-body text-primary">
                                            <h1><span id="k3rs_val"></span><span data-feather="users" class="align-text-middle"></span></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="card border-primary mb-3 text-center" style="max-width: 18rem;">
                                        <div class="card-header">Tes PPI</div>
                                        <div class="card-body text-primary">
                                            <h1><span id="ppi_val"></span><span data-feather="users" class="align-text-middle"></span></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="card border-primary mb-3 text-center" style="max-width: 18rem;">
                                        <div class="card-header">Tes BHD</div>
                                        <div class="card-body text-primary">
                                            <h1><span id="bhd_val"></span><span data-feather="users" class="align-text-middle"></span></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="card border-primary mb-3 text-center" style="max-width: 18rem;">
                                        <div class="card-header">Tes PMKP</div>
                                        <div class="card-body text-primary">
                                            <h1><span id="pmkp_val"></span><span data-feather="users" class="align-text-middle"></span></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="card border-primary mb-3 text-center" style="max-width: 18rem;">
                                        <div class="card-header">Tes SKP Gabungan</div>
                                        <div class="card-body text-primary">
                                            <h1><span id="skp_val"></span><span data-feather="users" class="align-text-middle"></span></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->
        </div>
        </main>
    </div>
    </div>

    <script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <!-- <script src="js/dashboard.js"></script> -->
    <script>
        $(function() {
            feather.replace({
                'aria-hidden': 'true'
            })
            $('#tgl').on('change', function() {
                let data = $(this).val();
                if (data == '') {
                    //reset content
                    $("#tgl_content").text('');
                    $('#kehadiran').text('');
                    $('#lengkap').text('');
                    $('#k3rs_val').text('');
                    $('#ppi_val').text('');
                    $('#bhd_val').text('');
                    $('#pmkp_val').text('');
                    $('#skp_val').text('');
                    $("#tgl_content").text('');
                } else {
                    $("#tgl_content").text('Report Data ' + data);
                    $.ajax({
                        type: "POST",
                        url: "ajax/check_data.php",
                        data: {
                            "tgl": data
                        },
                        success: function(response) {
                            console.log(response);
                            let res = JSON.parse(response);
                            $('#kehadiran').text(res.total_peserta);
                            $('#lengkap').text(res.lengkap);
                            $('#k3rs_val').text(res.k3rs);
                            $('#ppi_val').text(res.ppi);
                            $('#bhd_val').text(res.bhd);
                            $('#pmkp_val').text(res.pmkp);
                            $('#skp_val').text(res.skp);
                        },
                        error: function(err) {
                            console.log(err);
                        }
                    });
                }
            });
        })
    </script>
</body>

</html>