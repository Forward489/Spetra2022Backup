<?php
$denda = 0;
if (!isset($_SESSION['temp']) && !isset($_SESSION['harga']) && !isset($_SESSION['daftar'])) {
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
    
}

if (isset($_POST['submit'])) {
    if ($_POST['submit'] == "Podcast") {
        $_SESSION['harga'] += 90000;
        $_SESSION['daftar'][0] = true;
        $_SESSION['category'][] = "Group";
        $_SESSION['bim']++;
    } elseif ($_POST['submit'] == "Essay") {
        $_SESSION['harga'] += 50000;
        $_SESSION['daftar'][1] = true;
        $_SESSION['category'][] = "Individual";
        $_SESSION['bim']++;
    } elseif ($_POST['submit'] == "Karya Seni") {
        $_SESSION['harga'] += 45000;
        $_SESSION['daftar'][2] = true;
        $_SESSION['category'][] = "Individual";
        $_SESSION['bsb']++;
    } elseif ($_POST['submit'] == "Kerajinan Tangan") {
        $_SESSION['harga'] += 45000;
        $_SESSION['daftar'][3] = true;
        $_SESSION['category'][] = "Individual";
        $_SESSION['bsb']++;
    } elseif ($_POST['submit'] == "Tuan dan Puan") {
        $_SESSION['harga'] += 70000;
        $_SESSION['daftar'][4] = true;
        $_SESSION['category'][] = "Group";
        $_SESSION['tuan_puan']++;
    } elseif ($_POST['submit'] == "Menyanyikan Lagu Daerah") {
        $_SESSION['harga'] += 100000;
        $_SESSION['daftar'][5] = true;
        $_SESSION['category'][] = "Group";
        $_SESSION['bsb']++;
    } elseif ($_POST['submit'] == "Workout") {
        $_SESSION['harga'] += 30000;
        $_SESSION['daftar'][6] = true;
        $_SESSION['category'][] = "Individual";
        $_SESSION['bom']++;
    } elseif ($_POST['submit'] == "Dance Workout Tim") {
        $_SESSION['harga'] += 50000;
        $_SESSION['daftar'][7] = true;
        $_SESSION['category'][] = "Group Dance";
        $_SESSION['bom']++;
    } elseif ($_POST['submit'] == "Catur") {
        $_SESSION['harga'] += 25000;
        $_SESSION['daftar'][8] = true;
        $_SESSION['category'][] = "Individual";
        $_SESSION['bom']++;
    } elseif ($_POST['submit'] == "Valorant") {
        $_SESSION['cabor_valorant']++;

        $_POST['submit'] .= " tim #" . $_SESSION['cabor_valorant'];

        if ($_SESSION['cabor_valorant'] == 2) {
            $_SESSION['daftar'][9] = true;
        }
        $_SESSION['harga'] += 100000;
        $_SESSION['category'][] = "Group";
        $_SESSION['bom']++;
    } elseif ($_POST['submit'] == "Mobile Legends") {
        $_SESSION['cabor_mobile_legend']++;

        $_POST['submit'] .= " tim #" . $_SESSION['cabor_mobile_legend'];

        if ($_SESSION['cabor_mobile_legend'] == 2) {
            $_SESSION['daftar'][10] = true;
        }
        $_SESSION['harga'] += 100000;
        $_SESSION['category'][] = "Group";
        $_SESSION['bom']++;
    }
    $_SESSION['temp'][] = $_POST['submit'];
    header("Location: index.php");
}

if (isset($_POST['session_destroy'])) {
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
}

if (isset($_POST['temp_regist'])) {
    $value = $_POST['temp_regist'];
    $temp = $_SESSION['temp'][$value];
    unset($_SESSION['temp'][$value]);
    unset($_SESSION['category'][$value]);
    if ($temp == "Podcast") {
        $_SESSION['harga'] -= 90000;
        $_SESSION['daftar'][0] = false;
        $_SESSION['bim']--;
    } elseif ($temp == "Essay") {
        $_SESSION['harga'] -= 50000;
        $_SESSION['daftar'][1] = false;
        $_SESSION['bim']--;
    } elseif ($temp == "Karya Seni") {
        $_SESSION['harga'] -= 45000;
        $_SESSION['daftar'][2] = false;
        $_SESSION['bsb']--;
    } elseif ($temp == "Kerajinan Tangan") {
        $_SESSION['harga'] -= 45000;
        $_SESSION['daftar'][3] = false;
        $_SESSION['bsb']--;
    } elseif ($temp == "Tuan dan Puan") {
        $_SESSION['harga'] -= 70000;
        $_SESSION['daftar'][4] = false;
        $_SESSION['tuan_puan']--;
    } elseif ($temp == "Menyanyikan Lagu Daerah") {
        $_SESSION['harga'] -= 100000;
        $_SESSION['daftar'][5] = false;
        $_SESSION['bsb']--;
    } elseif ($temp == "Workout") {
        $_SESSION['harga'] -= 30000;
        $_SESSION['daftar'][6] = false;
        $_SESSION['bom']--;
    } elseif ($temp == "Dance Workout Tim") {
        $_SESSION['harga'] -= 50000;
        $_SESSION['daftar'][7] = false;
        $_SESSION['bom']--;
    } elseif ($temp == "Catur") {
        $_SESSION['harga'] -= 25000;
        $_SESSION['daftar'][8] = false;
        $_SESSION['bom']--;
    } elseif (strpos($temp, "Valorant") !== false) {
        $_SESSION['cabor_valorant']--;
        if ($_SESSION['cabor_valorant'] < 2) {
            $_SESSION['daftar'][9] = false;
        }
        $_SESSION['harga'] -= 100000;
        $_SESSION['bom']--;
    } elseif (strpos($temp, "Mobile Legend") !== false) {
        $_SESSION['cabor_mobile_legend']--;
        if ($_SESSION['cabor_mobile_legend'] < 2) {
            $_SESSION['daftar'][10] = false;
        }
        $_SESSION['harga'] -= 100000;
        $_SESSION['bom']--;
    }

    header("Location: index.php");
}

$count = 0;
if (isset($_SESSION['temp'])) {
    $tes = array_keys($_SESSION['temp']);
}

function getHarga($denda = 0)
{
    $tempHarga = $_SESSION['harga'] + $denda;
    $rupiah = "Rp. " . number_format($tempHarga, 0, ".", ".");
    return $rupiah;
}

function getDenda()
{
    $rupiah = "Rp. " . number_format($_SESSION['denda'], 0, ".", ".");
    return $rupiah;
}

function destroyRegistration()
{
    $unset = ['harga', 'temp', 'daftar', 'cabor_valorant', 'cabor_mobile_legend', 'category'];

    foreach ($unset as $unset) {
        unset($_SESSION[$unset]);
    }

    // $_SESSION['harga'] = 0;
    // $_SESSION['temp'] = [];
    // $_SESSION['daftar'] = [];
    // $_SESSION['cabor_valorant'] = 0;
    // $_SESSION['cabor_mobile_legend'] = 0;
    // $_SESSION['category'] = [];
}
