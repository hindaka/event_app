<?php
include("../_conf/_conn.php");
//get variable send from select2 param
$q = isset($_GET['q']) ? $_GET['q'] : '';
//query data pasien by medrek
$data_pegawai = $db->query("SELECT nama FROM pegawai WHERE aktif='y' AND nama LIKE '%" . $q . "%'");
$all_data = $data_pegawai->fetchAll(PDO::FETCH_ASSOC);
// get total data count
$total_data = $data_pegawai->rowCount();
$data_feedback = [
    "incomplete_results" => false,
    "items" => [],
    "total_count" => $total_data,
];
$j = 0;
foreach ($all_data as $row) {
    $nama = isset($row['nama']) ? $row['nama'] : '';
    $data_feedback["items"][$j] = [
        "id" => $nama,
        "text" => $nama
    ];
    $j++;
}
echo json_encode($data_feedback);
