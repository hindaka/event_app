<?php
$arr_list = ["PEMULASARAN JENAZAH", "SECURITY", "CLEANING SERVICE", "KESLING", "AMBULANCE", "LAUNDRY", "GUDANG UMUM", "FASMED", "K3RS", "IPSRS", "B3", "GIZI", "PARKIR", "PELAYANAN PELANGAN", "ADMISI PENDAFTARAN", "IGD", "LABORATORIUM", "RADIOLOGI", "INSEMINASI", "FARMASI", "POLIKLINIK", "ADMISI RAWAT JALAN & KASIR", "POLI EKSEKUTIF", "HEMODIALISA", "REHABILITASI MEDIK", "ICU", "PICU", "HCU", "NICU", "CSSD", "IBS", "GUDANG FARMASI", "PERKANTORAN - MANAJEMEN & DIREKSI", "JKN - MEDREK", "RUANG BERSALIN(VK)", "PERINATOLOGI", "RANAP LT.8", "RANAP LT.9", "RANAP LT.10", "RANAP LT.11", "RANAP LT.12"];
if (($open = fopen("_conf/custom_list.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($open, 2000, ";")) !== FALSE) {
        $group_name[] = $data;
    }
    fclose($open);
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Hindaka Ilman nafian">
    <title>Event App</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/checkout/">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="plugins/select2_4.1.0/dist/css/select2.min.css">
    <!-- Favicons -->
    <!-- <link rel="apple-touch-icon" href="/docs/5.2/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.2/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.2/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.2/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.2/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
    <link rel="icon" href="/docs/5.2/assets/img/favicons/favicon.ico"> -->
    <meta name="theme-color" content="#712cf9">

    <style>
        .signature-pad {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            font-size: 10px;
            width: 100%;
            height: 300px;
            max-width: 700px;
            max-height: 460px;
            border: 1px solid #e8e8e8;
            background-color: #fff;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.27), 0 0 40px rgba(0, 0, 0, 0.08) inset;
            border-radius: 4px;
            padding: 16px;
        }

        .signature-pad::before,
        .signature-pad::after {
            position: absolute;
            z-index: -1;
            content: "";
            width: 40%;
            height: 10px;
            bottom: 10px;
            background: transparent;
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.4);
        }

        .signature-pad::before {
            left: 20px;
            -webkit-transform: skew(-3deg) rotate(-3deg);
            transform: skew(-3deg) rotate(-3deg);
        }

        .signature-pad::after {
            right: 20px;
            -webkit-transform: skew(3deg) rotate(3deg);
            transform: skew(3deg) rotate(3deg);
        }

        .signature-pad--body {
            position: relative;
            -webkit-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
            border: 1px solid #f4f4f4;
        }

        .signature-pad--body canvas {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            border-radius: 4px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.02) inset;
        }

        .signature-pad--footer {
            color: #C3C3C3;
            text-align: center;
            font-size: 1.2em;
            margin-top: 8px;
        }

        .signature-pad--actions {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            margin-top: 8px;
        }
    </style>
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
    <link href="form-validation.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container">
        <main>
            <div class="py-5 text-center">
                <img class="d-block mx-auto mb-4" src="_images/rsud_bk.png" alt="image rsud bk" width="150" height="75">
                <h2>ABSENSI TELUSUR INDIVIDU</h2>
                <p class="lead">dibawah ini merupakan form absensi kegiatan telusur individu untuk THL, Security & Cleaning Service</p>
            </div>

            <div class="row g-5">
                <div class="col-md-12 col-lg-12">
                    <!-- <h4 class="mb-3">Form Isian</h4> -->
                    <form class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-sm-12">
                                <label for="namalengkap" class="form-label">Nama Lengkap <span style="color:red">*</span></label>
                                <select name="namalengkap" id="namalengkap" class="form-select nama" width="100%" required>
                                    <option value=""></option>
                                    <?php
                                    for ($i = 0; $i < count($group_name); $i++) {
                                        echo '<option value="' . $group_name[$i][0] . '">' . $group_name[$i][0] . '</option>';
                                    }
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    Nama Lengkap tidak valid.
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="unitkerja" class="form-label">Unit Kerja <span style="color:red">*</span></label>
                                <select class="form-select" id="unitkerja" name="unitkerja" width="100%" required>
                                    <option value=""></option>
                                    <?php
                                    for ($i = 0; $i < count($arr_list); $i++) {
                                        echo '<option value="' . $arr_list[$i] . '">' . $arr_list[$i] . '</option>';
                                    }
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    Unit Kerja / Instalasi tidak valid.
                                </div>
                            </div>
                            <h4 class="mb-3">Tanda Tangan</h4>
                            <hr class="my-4">
                            <div class="col-12 text-center">
                                <div id="signature-pad" class="signature-pad">
                                    <div class="signature-pad--body">
                                        <canvas></canvas>
                                    </div>
                                    <div class="signature-pad--footer">
                                        <div class="description">Tanda Tangan diatas</div>

                                        <div class="signature-pad--actions">
                                            <div>
                                                <button type="button" class="button clear" data-action="clear">Clear</button>
                                                <button type="button" class="button" data-action="change-color-black">Black Pen</button>
                                                <button type="button" class="button" data-action="change-color-blue">Blue Pen</button>
                                                <!-- <button type="button" class="button save" data-action="save-jpg-test">Save as JPG</button> -->
                                            </div>
                                            <!-- <div>
										          <button type="button" class="button save" data-action="save-png">Save as PNG</button>
										          <button type="button" class="button save" data-action="save-jpg-test">Save as JPG</button>
										          <button type="button" class="button save" data-action="save-svg">Save as SVG</button>
										        </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- <hr class="my-4">
                        <h4 class="mb-3">Validasi Captcha</h4> -->
                        <hr class="my-4">
                        <button id="simpanDataBtn" class="w-100 btn btn-primary btn-lg" type="button">Simpan Kehadiran</button>
                    </form>
                </div>
            </div>
        </main>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">&copy; 2022-<?= date('Y') ?><br>Event App - UNIT IT RSUD BANDUNG KIWARI</p>
            <!-- <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul> -->
        </footer>
    </div>
    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="plugins/select2_4.1.0/dist/js/select2.full.min.js"></script>
    <script src="_js/form-validation.js"></script>
    <script src="plugins/signature_pad-master/docs/js/signature_pad.umd.js"></script>
    <script src="plugins/signature_pad-master/docs/js/custom_sign.js"></script>
    <script src="plugins/sweetalert/sweetalert.min.js"></script>
    <script>
        $(function() {
            $('#simpanDataBtn').on("click", function(e) {
                e.preventDefault();
                let namalengkap = $('#namalengkap').val();
                let unitkerja = $('#unitkerja').val();
                if (signaturePad.isEmpty()) {
                    alert("Silahkan Tanda Tangan Terlebih Dahulu");
                    return false;
                } else {
                    var sign = signaturePad.toDataURL("image/jpeg");
                    var img_data = sign.replace('data:image/jpeg;base64,', "");
                }
                $.ajax({
                    type: "POST",
                    url: "ajax_data/save_data.php",
                    data: {
                        "page": "event1_custom",
                        "namalengkap": namalengkap,
                        "unitkerja": unitkerja,
                        "sign": sign,
                        "img_data": img_data,
                    },
                    success: function(response) {
                        let res = JSON.parse(response);
                        swal(res.title, res.msg, res.icon).then((_val) => {
                            location.reload();
                        })
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            })
            $(".nama").select2({
                placeholder: "Masukan Nama Petugas",
                allowClear: true,
                width: 'resolve'
            });

            $('#unitkerja').select2({
                placeholder: "Pilih Unit Kerja",
                width: 'resolve',
                allowClear: true,
                tags: true,
            });
        });
    </script>
</body>

</html>