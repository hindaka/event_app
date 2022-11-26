<?php
session_start();
$email = $_SESSION['email'];
$list_user = ['event@rsudbandungkiwari.or.id', 'operator@rsudbandungkiwari.or.id'];
if (!in_array($email, $list_user)) {
    header('location: ../index.php');
    exit();
}
include("../_conf/_conn.php");
$get_kehadiran_pegawai = $db->query("SELECT id_event,created_at,nama,unit_kerja,ttd,lengkap,k3rs,ppi,bhd,pmkp,skp,created_at FROM event_record");
$hadir = $get_kehadiran_pegawai->fetchAll(PDO::FETCH_ASSOC);
$total_data = $get_kehadiran_pegawai->rowCount();

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
    <link href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
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
                    <h1 class="h2">Data Kehadiran Telusur Individu</h1>
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
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="myTable" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Absensi</th>
                                        <th>NAMA LENGKAP</th>
                                        <th>UNIT KERJA</th>
                                        <th>Tanda Tangan</th>
                                        <th>K3RS</th>
                                        <th>BHD</th>
                                        <th>PPI</th>
                                        <th>PMKP</th>
                                        <th>SKP</th>
                                        <th>LENGKAP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($total_data > 0) {
                                        $i = 1;
                                        foreach ($hadir as $row) {
                                            $id_event = isset($row['id_event']) ? $row['id_event'] : 0;
                                            $img = '<img src="' . $row['ttd'] . '" width="100px" height="75px">';
                                            $k3rs = isset($row['k3rs']) ? $row['k3rs'] : NULL;
                                            if ($k3rs == NULL) {
                                                $text_k3 = '<button id="id_k3_' . $id_event . '" onclick="checkin(this)" data-id="' . $id_event . '" data-tipe="k3rs" class="btn btn-sm btn-outline-danger">Belum Test</button>';
                                            } else {
                                                $text_k3 = '<label class="badge text-bg-success">check in</label>';
                                            }
                                            $bhd = isset($row['bhd']) ? $row['bhd'] : NULL;
                                            if ($bhd == NULL) {
                                                $text_bhd = '<button id="id_bh_' . $id_event . '" onclick="checkin(this)" data-id="' . $id_event . '" data-tipe="bhd" class="btn btn-sm btn-outline-danger">Belum Test</button>';
                                            } else {
                                                $text_bhd = '<label class="badge text-bg-success">check in</label>';
                                            }
                                            $ppi = isset($row['ppi']) ? $row['ppi'] : NULL;
                                            if ($ppi == NULL) {
                                                $text_ppi = '<button id="id_pp_' . $id_event . '" onclick="checkin(this)" data-id="' . $id_event . '" data-tipe="ppi" class="btn btn-sm btn-outline-danger">Belum Test</button>';
                                            } else {
                                                $text_ppi = '<label class="badge text-bg-success">check in</label>';
                                            }
                                            $pmkp = isset($row['pmkp']) ? $row['pmkp'] : NULL;
                                            if ($pmkp == NULL) {
                                                $text_pmkp = '<button id="id_pm_' . $id_event . '" onclick="checkin(this)" data-id="' . $id_event . '" data-tipe="pmkp" class="btn btn-sm btn-outline-danger">Belum Test</button>';
                                            } else {
                                                $text_pmkp = '<label class="badge text-bg-success">check in</label>';
                                            }
                                            $skp = isset($row['skp']) ? $row['skp'] : NULL;
                                            if ($skp == NULL) {
                                                $text_skp = '<button id="id_sk_' . $id_event . '" onclick="checkin(this)" data-id="' . $id_event . '" data-tipe="skp" class="btn btn-sm btn-outline-danger">Belum Test</button>';
                                            } else {
                                                $text_skp = '<label class="badge text-bg-success">check in</label>';
                                            }
                                            $lengkap = isset($row['lengkap']) ? $row['lengkap'] : NULL;
                                            if ($lengkap == NULL) {
                                                $text_lengkap = '<button id="id_bl_' . $id_event . '" onclick="checkin(this)" data-id="' . $id_event . '" data-tipe="lengkap" class="btn btn-sm btn-outline-danger">Belum Lengkap</button>';
                                            } else {
                                                $text_lengkap = '<label class="badge text-bg-success">Lengkap</label>';
                                            }
                                            echo '<tr>
                                                <td>' . $i++ . '</td>
                                                <td>' . $row['created_at'] . '</td>
                                                <td>' . $row['nama'] . '</td>
                                                <td>' . $row['unit_kerja'] . '</td>
                                                <td>' . $img . '</td>
                                                <td>' . $text_k3 . '</td>
                                                <td>' . $text_bhd . '</td>
                                                <td>' . $text_ppi . '</td>
                                                <td>' . $text_pmkp . '</td>
                                                <td>' . $text_skp . '</td>
                                                <td>' . $text_lengkap . '</td>
                                            </tr>';
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

        </div>
        </main>
    </div>
    </div>

    <script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="../plugins/sweetalert/sweetalert.min.js"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="js/dashboard.js"></script>
    <script>
        function checkin(ele) {
            let id = ele.id;
            let id_event = $('#' + id).data('id');
            let tipe = $('#' + id).data('tipe');
            $.ajax({
                type: "POST",
                url: "ajax/update_status.php",
                data: {
                    "id_event": id_event,
                    "tipe": tipe,
                },
                success: function(response) {
                    console.log(response);
                    let res = JSON.parse(response);
                    if (res.status == 200) {
                        swal(res.title, res.message, res.icon).then((_val) => {
                            location.reload();
                        });
                    } else {
                        swal(res.title, res.message, res.icon);
                        return false;
                    }
                },
                error: function(err) {
                    console.error(err);
                }
            });
        }
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>