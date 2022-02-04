            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Competition Registration</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <?php
                                $count = 0;
                                foreach ($_SESSION['temp'] as $temp) : ?>
                                    <ul class="list-group mt-2">
                                        <li class="list-group-item mb-2"><?= $temp ?></li>
                                    </ul>
                                    <?php //$count++; 
                                    ?>
                                <?php endforeach; ?>
                            </div>
                            <div class="form-group">
                                <h4 style="text-align:center;">Perhatian</h4>

                                <ul class="list-group mt-2" id="perhatian_ktm">
                                    <li class="list-group-item mb-2">
                                        <h5 style="color:red; text-align: justify;
                                        text-justify: inter-word;">Bagi Mahasiswa UK Petra yang BELUM MEMILIKI atau KEHILANGAN Student ID atau Kartu Tanda Mahasiswa (KTM) dapat melampirkan screenshot biodata dari SIM atau aplikasi Petra Mobile.</h5>
                                    </li>
                                </ul>
                            </div>
                            <form action="../../spektrakuler2022/data_submission.php" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <?php
                                    $x = 0;
                                    $count = 1;
                                    // var_dump($_SESSION['category']);
                                    foreach ($_SESSION['temp'] as $temp) {
                                        while (!isset($_SESSION['category'][$x])) {
                                            $x++;
                                        }
                                        if ($_SESSION['category'][$x] == "Group") {
                                            echo return_form_group($count++, $temp);
                                        } elseif ($_SESSION['category'][$x] == "Individual") {
                                            echo return_form_individual($temp);
                                        } elseif ($_SESSION['category'][$x] == "Group Dance") {
                                            echo return_form_workout_dance($count++, $temp);
                                        }
                                        $x++;
                                    }
                                    $x = 0;
                                    ?>
                                    <input type="hidden" name="hidden" value=<?= $count - 1 ?>>

                                    
                                    <div class="form-group">
                                        <label for="disabledTextInput">Total harga</label>
                                        <?php
                                        // var_dump($_SESSION['bolong_1']);
                                        // var_dump($_SESSION['bolong_2']); ?>
                                        
                                        <?php if ( $_SESSION['bolong'] ):?>
                                            <h3 style="text-align :center;"><?= getHarga($_SESSION['denda']) ?></h3>
                                        <?php else: ?>
                                            <h3 style="text-align :center;"><?= getHarga() ?></h3>
                                        <?php endif; ?>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="upload_bukti_tf">Bukti Transfer</label>
                                        <div class="separator2"></div>
                                        <input type="file" class="form-control-file" name="upload_bukti_tf" id="upload_bukti_tf">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="register_lomba" value="">Register</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>