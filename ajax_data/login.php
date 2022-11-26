<?php
session_start();
$email_input = isset($_POST['email']) ? $_POST['email'] : '';
$pass_input = isset($_POST['pass']) ? $_POST['pass'] : '';

$list_user = ['event@rsudbandungkiwari.or.id', 'operator@rsudbandungkiwari.or.id'];

//check in array
if (!in_array($email_input, $list_user)) {
    $feedback = [
        "status" => 201,
        "title" => "Error",
        "message" => "Email Address tidak terdaftar",
        "icon" => "error"
    ];
    echo json_encode($feedback);
    exit();
} else {
    if ($pass_input != 'telusur') {
        $feedback = [
            "status" => 201,
            "title" => "Error",
            "message" => "Password tidak sesuai",
            "icon" => "error"
        ];
        echo json_encode($feedback);
        exit();
    } else {
        $_SESSION['email'] = $email_input;
        $feedback = [
            "status" => 200,
            "title" => "Login Berhasil!",
            "message" => "redirect to manage service...",
            "icon" => "success",
            "uri" => "_backend"
        ];
        echo json_encode($feedback);
    }
}
