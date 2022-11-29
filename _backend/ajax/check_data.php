<?php
session_start();
$email = $_SESSION['email'];
$list_user = ['event@rsudbandungkiwari.or.id', 'operator@rsudbandungkiwari.or.id'];
if (!in_array($email, $list_user)) {
    header('location: ../index.php');
    exit();
}
include("../../_conf/_conn.php");
$tgl = isset($_POST['tgl']) ? $_POST['tgl'] : '';
//kehadiran
$get_kehadiran = $db->query("SELECT COUNT(*) as kehadiran FROM event_record WHERE created_at LIKE '%" . $tgl . "%'");
$hadir = $get_kehadiran->fetch(PDO::FETCH_ASSOC);
$total_peserta = isset($hadir['kehadiran']) ? $hadir['kehadiran'] : 0;
//check lengkap
$check_lengkap = $db->query("SELECT SUM(lengkap) as lengkap,SUM(k3rs) as k3rs,SUM(ppi) as ppi,SUM(bhd) as bhd,SUM(pmkp) as pmkp, SUM(skp) as skp FROM `event_record` WHERE created_at LIKE '" . $tgl . "%'");
$check = $check_lengkap->fetch(PDO::FETCH_ASSOC);
$lengkap = isset($check['lengkap']) ? $check['lengkap'] : 0;
$k3rs = isset($check['k3rs']) ? $check['k3rs'] : 0;
$ppi = isset($check['ppi']) ? $check['ppi'] : 0;
$bhd = isset($check['bhd']) ? $check['bhd'] : 0;
$pmkp = isset($check['pmkp']) ? $check['pmkp'] : 0;
$skp = isset($check['skp']) ? $check['skp'] : 0;
$feedback = [
    "total_peserta" => $total_peserta,
    "lengkap" => $lengkap,
    "k3rs" => $k3rs,
    "ppi" => $ppi,
    "bhd" => $bhd,
    "pmkp" => $pmkp,
    "skp" => $skp,
];
echo json_encode($feedback);
