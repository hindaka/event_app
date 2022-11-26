<?php
include("../_conf/_conn.php");
date_default_timezone_set('Asia/Jakarta');
$namalengkap = isset($_POST['namalengkap']) ? trim($_POST['namalengkap']) : '';
$unitkerja = isset($_POST['unitkerja']) ? trim($_POST['unitkerja']) : '';
$page = isset($_POST['page']) ? trim($_POST['page']) : '';
$sign = isset($_POST['sign']) ? trim($_POST['sign']) : '';
$img_data = isset($_POST['img_data']) ? trim($_POST['img_data']) : '';
$today = date('Y-m-d H:i:s');
try {
    //check data
    $get_check = $db->query("SELECT created_at FROM event_record WHERE nama LIKE '" . $namalengkap . "'");
    $check = $get_check->fetch(PDO::FETCH_ASSOC);
    $total_data = $get_check->rowCount();
    $tgl = isset($check['created_at']) ? $check['created_at'] : '';
    if ($total_data == 0) {
        $db->beginTransaction();
        $insert_data = $db->prepare("INSERT INTO `event_record`(`nama`, `unit_kerja`,`page`, `ttd`) VALUES (:nama,:unitkerja,:page,:ttd)");
        $insert_data->bindParam(":nama", $namalengkap, PDO::PARAM_STR);
        $insert_data->bindParam(":unitkerja", $unitkerja, PDO::PARAM_STR);
        $insert_data->bindParam(":page", $page, PDO::PARAM_STR);
        $insert_data->bindParam(":ttd", $sign, PDO::PARAM_STR);
        $insert_data->execute();
        $db->commit();
        $feedback = [
            "status" => "sukses",
            "title" => "Berhasil",
            "msg" => "Data Absensi Berhasil disimpan,\n Terima Kasih telah melakukan absensi",
            "icon" => "success"
        ];
    } else {
        $feedback = [
            "status" => "sukses",
            "title" => "Peringatan",
            "msg" => "Anda sudah melakukan Absen pada tanggal \n " . date('d F Y H:i:s', strtotime($tgl)),
            "icon" => "warning"
        ];
    }
} catch (PDOException $er) {
    $feedback = [
        "status" => "gagal",
        "title" => "Error",
        "msg" => $er->getMessage(),
        "icon" => "error"
    ];
}
echo json_encode($feedback);
