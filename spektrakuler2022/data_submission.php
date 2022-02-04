<?php
session_start();
$category = "";
$temp_result = [];
$count_array = 0;
$nama_lomba_individu = [
    "catur",
    "karya_seni",
    "kerajinan_tangan",
    "workout",
    "essay"
];
$nama_lomba_x = [
    "podcast",
    "tuan_dan_puan",
    "menyanyikan_lagu_daerah",
    "dance_workout_tim",
    "valorant",
    "mobile_legends"
];
// include_once "confidential/reference.php";
include "confidential/configuration.php";
include "confidential/reference.php";
// include "confidential/functions.php";


if (isset($_POST['register_lomba'])) {
    destroyRegistration();
    var_dump($_POST);
    var_dump($_FILES);

    // add($_POST);
}

//Buat masukin ke database nanti

if (isset($_POST['no_aggree'])) {
    $_SESSION['harga'] = 0;
    $_SESSION['temp'] = [];
    $_SESSION['daftar'] = [];
    for ($i = 0; $i < 11; $i++) {
        $_SESSION['daftar'][] = false;
    }
    $_SESSION['cabor_valorant'] = 0;
    $_SESSION['cabor_mobile_legend'] = 0;
    $_SESSION['category'] = [];
    $_SESSION['bsb'] = 0;
    $_SESSION['bom'] = 0;
    $_SESSION['bim'] = 0;
    $_SESSION['tuan_puan'] = 0;
    $_SESSION['bolong'] = false;
    $_SESSION['denda'] = 0;

    header("Location: ../spektrakuler2022/index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Submission</title>
    <?php
    include_once "assets/bootsandjquery.php";
    ?>
</head>

<body>
    <form action="" method="post">
        <button class="btn btn-primary" type="submit" name="no_agree">Back</button>
    </form>
    

</body>

</html>