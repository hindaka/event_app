<?php
session_start();
$email = $_SESSION['email'];
$list_user = ['event@rsudbandungkiwari.or.id', 'operator@rsudbandungkiwari.or.id'];
if (!in_array($email, $list_user)) {
    header('location: ../index.php');
    exit();
}
include("../../_conf/_conn.php");
$id_event = isset($_POST['id_event']) ? $_POST['id_event'] : 0;
$tipe = isset($_POST['tipe']) ? $_POST['tipe'] : NULL;
if ($tipe == 'k3rs') {
    $qy = "`k3rs`='1'";
} elseif ($tipe == 'bhd') {
    $qy = "`bhd`='1'";
} elseif ($tipe == 'ppi') {
    $qy = "`ppi`='1'";
} elseif ($tipe == 'pmkp') {
    $qy = "`pmkp`='1'";
} elseif ($tipe == 'skp') {
    $qy = "`skp`='1'";
} else {
    $qy = "`k3rs`='1',`bhd`='1',`ppi`='1',`pmkp`='1',`skp`='1',`lengkap`='1'";
}
$stmt = $db->prepare("UPDATE `event_record` SET $qy WHERE `id_event`=:id");
$stmt->bindParam(":id", $id_event);
$stmt->execute();
$feedback = [
    "status" => 200,
    "title" => "Berhasil!",
    "message" => "Update Data berhasil dilakukan!",
    "icon" => "success"
];
echo json_encode($feedback);
