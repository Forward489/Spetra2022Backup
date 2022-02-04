<?php
session_start();
include_once "confidential/reference.php";
include_once "confidential/configuration.php";
include_once "card/form_group.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concept</title>

    <?php include_once "assets/bootsandjquery.php"; ?>


    <link href="assets/style.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-3">
        <h2>Checklist Lomba Spektrakuler HIMA 2022</h2>
        <div class="row">
            <div class="col-4">
                <form action="" method="post">
                    <button type="submit" name="session_destroy" class="btn btn-primary mb-3">Restart Session</button>
                </form>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm d-flex justify-content-center">
                <input type="radio" class="btn-check mr-3" name="lomba" id="danger-outlined" autocomplete="off" value="Lomba Individu">
                <label class="btn btn-outline-danger" for="danger-outlined">Lomba Individu</label>

                <div class="separator"></div>

                <input type="radio" class="btn-check" name="lomba" id="warning-outlined" autocomplete="off" value="Semua Lomba" checked>
                <label class="btn btn-outline-warning" for="warning-outlined">Semua Lomba</label>

                <div class="separator"></div>

                <input type="radio" class="btn-check" name="lomba" id="success-outlined" autocomplete="off" value="Lomba Group">
                <label class="btn btn-outline-success" for="success-outlined">Lomba Group</label>

            </div>
        </div>

        <?php 
        // var_dump($_SESSION['denda']);
        // var_dump($_SESSION['bsb']);
        // var_dump($_SESSION['bom']);
        // var_dump($_SESSION['bsb']);
        ?>

        <!-- Untuk menampung daftar harga sementara -->
        <?php if (!empty($_SESSION['temp'])) : ?>
            <?php foreach ($_SESSION['temp'] as $temp) : ?>
                <ul class="list-group">
                    <li class="list-group-item mb-2"><?= $temp ?>
                        <form action="" method="post"><button type="submit" class="badge bg-warning text-dark" name="temp_regist" value=<?= $tes[$count++] ?>>Delete Data</button></form>
                    </li>
                </ul>
            <?php endforeach; ?>
            <h2 style="text-align:center;">Price Summary : <?= getHarga() ?></h2>

            <?php if ($_SESSION['bom'] > 0 && $_SESSION['bim'] > 0 && $_SESSION['bsb'] > 0 && $_SESSION['tuan_puan'] > 0) : ?>

                <?php
                $_SESSION['bolong'] = false; ?>
                <!-- Button trigger modal -->
                <button type="button" id="registration" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Register
                </button>
            <?php else : ?>

                <?php if ($_SESSION['bom'] == 0 || $_SESSION['bim'] == 0 || $_SESSION['bsb'] == 0 || $_SESSION['tuan_puan'] == 0) : ?>
                    <button type="button" class="btn btn-primary" id="registration" data-bs-toggle="modal" data-bs-target="#form_tidak_lengkap_2">
                        Register
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="form_tidak_lengkap_2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Perhatian</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <?php
                                $_SESSION['bolong'] = true; ?>
                                <div class="modal-body">
                                    <h5>Anda belum melakukan checklist minimal 1 (satu) lomba di:</h5>
                                    <h5 style="text-align:center">
                                    <?php $_SESSION['denda'] = 0; ?>
                                        <?php if ($_SESSION['bom'] == 0) : ?>
                                            <strong>Bidang Olahraga Mahasiswa</strong>
                                            <div class="separator2"></div>
                                            <?php $_SESSION['denda'] += 75000; ?>
                                        <?php endif; ?>
                                        <?php if ($_SESSION['bim'] == 0) : ?>
                                            <strong>Bidang Inspirasi Mahasiswa</strong>
                                            <div class="separator2"></div>
                                            <?php $_SESSION['denda'] += 75000; ?>
                                        <?php endif; ?>
                                        <?php if ($_SESSION['bsb'] == 0) : ?>
                                            <strong>Bidang Seni Budaya</strong>
                                            <div class="separator2"></div>
                                            <?php $_SESSION['denda'] += 75000; ?>
                                        <?php endif; ?>
                                        <?php if ($_SESSION['tuan_puan'] == 0) : ?>
                                            <strong>Tuan dan Puan</strong>
                                            <div class="separator2"></div>
                                            <?php $_SESSION['denda'] += 75000; ?>
                                        <?php endif; ?>

                                    </h5>
                                    <h5>Anda akan dikenakan denda sebesar <?= getDenda() ?> apabila tidak berpartisipasi pada minimal 1 (satu) lomba pada bidang yang sudah disebutkan di atas.

                                        <div class="red" style="color:red">Apakah Anda bersedia untuk dikenakan denda?</div>
                                        Keputusan yang telah dibuat tidak dapat diubah kembali!</h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Disagree</button>
                                    <a data-bs-dismiss="modal" data-bs-toggle="modal" href="#staticBackdrop"><button type="button" class="btn btn-primary">Agree</button></a>
                                </div>
                            </div>
                        </div>
                    </div>


                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Untuk tampilan lomba individual -->
        <div class="individual">
            <h3>Lomba Individual</h3>
            <div class="row">
                <?php
                /*
                essay
                karya seni 
                kerajinan tangan
                workout
                catur  
                */
                $i = 1;
                while (file_exists("card/lomba_individual_" . $i . ".php")) {
                    include_once "card/lomba_individual_" . $i . ".php";
                    $i++;
                }
                ?>
            </div>
        </div>

        <!-- Untuk tampilan lomba group -->
        <div class="group">
            <h3>Lomba Group</h3>
            <div class="row">
                <?php
                /*
                podcast
                tuan dan puan
                menyanyikan lagu daerah
                dance workout tim
                valorant
                mobile legend
                */
                $i = 1;
                while (file_exists("card/lomba_group_" . $i . ".php")) {
                    include_once "card/lomba_group_" . $i . ".php";
                    $i++;
                }
                ?>
            </div>
        </div>

        <!-- Ditaruh di bawah karena file ini diload setelah semua proses load kartu dan hasil sementara dijalankan -->
        <?php if (!empty($_SESSION['temp'])) {
            include_once "card/form.php";
        } ?>

    </div>
</body>
<script src="assets/form_config.js"></script>

</html>