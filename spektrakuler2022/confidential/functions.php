<?php
$conn = mysqli_connect("localhost", "root", "", "sptera22");
$category = "";
$nama_lomba_individu = [
    "catur",
    "karya_seni",
    "kerajinan_tangan",
    "workout",
    "essay"
];
$nama_lomba_group = [
    "podcast",
    "tuan_dan_puan",
    "menyanyikan_lagu_daerah",
    "dance_workout_tim",
    "valorant",
    "mobile_legends"
];

function get_keyword($data, $teks)
{
    $temp2 = "nama_lengkap_" . $teks;
    if (array_key_exists($temp2, $data)) {
        return "_" . $teks;
    } elseif (array_key_exists($temp2, $data)) {
        return "_" . $teks;
    } elseif (array_key_exists($temp2 . '_tim_#1', $data)) {
        return "_" . $teks . "_tim_#1";
    } elseif (array_key_exists($temp2 . '_tim_#2', $data)) {
        return "_" . $teks . "_tim_#2";
    } else {
        return "none";
    }
}

function explode_valorant_ml($lomba)
{
    $temp = explode(" ", $lomba);
    $string = "";
    for ($i = 0; $i < count($temp) - 2; $i++) {
        if ($i != count($temp) - 3) {
            $string .= $temp[$i] . " ";
            continue;
        }
        $string .= $temp[$i];
    }
    return $string;
}

function query($value)
{
    global $conn;
    $result = mysqli_query($conn, $value);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function add($data)
{
    global $conn;
    global $nama_lomba_group;
    global $nama_lomba_individu;
    foreach ($nama_lomba_individu as $lomba) {
        $for_upload = get_keyword($data, $lomba);
        if ($for_upload != "none") {
            $nama_lengkap = htmlspecialchars($data['nama_lengkap' . $for_upload]);
            $id_line = htmlspecialchars($data['id_line' . $for_upload]);
            $no_telp = htmlspecialchars($data['no_telp' . $for_upload]);
            $nrp = htmlspecialchars($data['nrp' . $for_upload]);
            $nama_lomba = htmlspecialchars($data['nama_lomba' . $for_upload]);
            $ktm = upload_ktm($for_upload);
            $bukti_tf = upload_bukti_tf();

            $id_lomba = 'SELECT id FROM lomba WHERE nama_Lomba LIKE "%'.$nama_lomba.'%"';
            query($id_lomba);
            $id_lomba = $id_lomba[0]['id'];
            $id_hima = rand(1, 18);

            $query = "INSERT INTO daftar_lomba_hima
              VALUES ('', '$nama_lengkap', '$id_line', '$no_telp', '$nrp', '$ktm', '$bukti_tf', '$id_hima', '$id_lomba', '1', '')";
            mysqli_query($conn, $query);
            if (mysqli_affected_rows($conn) > 0) {
                echo "Query Berhasil !";
            } else {
                echo "Query Gagal !";
                echo "<br>";
                echo mysqli_error($conn);
            }
        }
    }
    foreach ($nama_lomba_group as $lomba2) {
        $for_upload = get_keyword($data, $lomba2);
        if ($for_upload != "none") {
            $nama_tim = htmlspecialchars($data['nama_tim' . $for_upload]);
            $jumlah_peserta = htmlspecialchars($data['jumlah_peserta' . $for_upload]);
            $nama_lengkap = htmlspecialchars(serialize($data['nama_lengkap' . $for_upload]));
            $id_line = htmlspecialchars(serialize($data['id_line' . $for_upload]));
            $no_telp = htmlspecialchars(serialize($data['no_telp' . $for_upload]));
            $nrp = htmlspecialchars(serialize($data['nrp' . $for_upload]));

            if (strpos($for_upload, 'valorant') !== false || strpos($for_upload, 'mobile_legends') !== false) {
                $nama_lomba = htmlspecialchars(explode_valorant_ml($data['nama_lomba' . $for_upload]));
            } else {
                $nama_lomba = htmlspecialchars($data['nama_lomba' . $for_upload]);
            }

            $ktm = upload_ktm($for_upload);
            $bukti_tf = upload_bukti_tf();

            $id_lomba = 'SELECT id FROM lomba WHERE nama_Lomba LIKE "%'.$nama_lomba.'%"';
            query($id_lomba);
            $id_lomba = $id_lomba[0]['id'];
            $id_hima = rand(1, 18);

            $query = "INSERT INTO daftar_lomba_hima
              VALUES ('', '$nama_lengkap', '$id_line', '$no_telp', '$nrp', '$ktm', '$bukti_tf', '$id_hima', '$id_lomba', '$jumlah_peserta', '$nama_tim')";
            mysqli_query($conn, $query);
            if (mysqli_affected_rows($conn) > 0) {
                echo "Query Berhasil !";
            } else {
                echo "Query Gagal !";
                echo "<br>";
                echo mysqli_error($conn);
            }
        }
    }

    return mysqli_affected_rows($conn);
}

function upload_ktm($for_upload)
{
    $fileName = $_FILES['upload_ktm' . $for_upload]['name'];
    $fileSize = $_FILES['upload_ktm' . $for_upload]['size'];
    $error = $_FILES['upload_ktm' . $for_upload]['error'];
    $tmpName = $_FILES['upload_ktm' . $for_upload]['tmp_name'];

    if ($error === 4) {
        echo "<script>alert('Pick a picture first')</script>";
        return false;
    }
    $valid_format = ['jpg', 'jpeg', 'png'];
    $pic_extension = explode('.', $fileName);
    $pic_extension = strtolower(end($pic_extension));

    if (!in_array($pic_extension, $valid_format)) {
        echo "<script>alert('The format isn't valid, valid formats are .jpg, .jpeg, and .png')</script>";
        return false;
    }

    if ($fileSize > 1000000) {
        echo "<script>alert('The file is too large')</script>";
        return false;
    }

    $new_file_name = uniqid();
    $new_file_name = $new_file_name . '.' . $pic_extension;

    move_uploaded_file($tmpName, 'temp_pics_ktm/' . $new_file_name);
    return $new_file_name;
}

function upload_bukti_tf()
{
    $fileName = $_FILES['upload_bukti_tf']['name'];
    $fileSize = $_FILES['upload_bukti_tf']['size'];
    $error = $_FILES['upload_bukti_tf']['error'];
    $tmpName = $_FILES['upload_bukti_tf']['tmp_name'];

    if ($error === 4) {
        echo "<script>alert('Pick a picture first')</script>";
        return false;
    }
    $valid_format = ['jpg', 'jpeg', 'png'];
    $pic_extension = explode('.', $fileName);
    $pic_extension = strtolower(end($pic_extension));

    if (!in_array($pic_extension, $valid_format)) {
        echo "<script>alert('The format isn't valid, valid formats are .jpg, .jpeg, and .png')</script>";
        return false;
    }

    if ($fileSize > 1000000) {
        echo "<script>alert('The file is too large')</script>";
        return false;
    }

    $new_file_name = uniqid();
    $new_file_name = $new_file_name . '.' . $pic_extension;

    move_uploaded_file($tmpName, 'temp_pics_bukti_tf/' . $new_file_name);
    return $new_file_name;
}

function delete($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM listmobil WHERE id = $id ");

    return mysqli_affected_rows($conn);
}

function update($data)
{
    global $conn;
    $id = $data["id"];
    $serial = htmlspecialchars($data["serial"]);
    $nama = htmlspecialchars($data["nama"]);
    $vendor = htmlspecialchars($data["vendor"]);
    $origin = htmlspecialchars($data["origin"]);
    $prev_pic = htmlspecialchars($data["gambarLama"]);

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $prev_pic;
    } else {
        $gambar = upload();
    }

    // $gambar = htmlspecialchars($data["gambar"]);

    $query = "UPDATE listmobil
              SET 
              nama='$nama',
              serial='$serial',
              vendor='$vendor',
              origin='$origin',
              gambar='$gambar'
              WHERE id = $id";
    mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn) > 0) {
        echo "Query Berhasil !";
    } else {
        echo "Query Gagal !";
        echo "<br>";
        echo mysqli_error($conn);
    }
    return mysqli_affected_rows($conn);
}

function search($keyword)
{
    $query = "SELECT * FROM listmobil WHERE nama LIKE '%$keyword%' OR 
    serial LIKE '%$keyword%' OR 
    vendor LIKE '%$keyword%' OR 
    origin LIKE '%$keyword%'";
    return query($query);
}
