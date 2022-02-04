<?php
function output_lomba_string($lomba)
{
    $output_lomba = "";
    if ($lomba == trim($lomba) && strpos($lomba, ' ') !== false) {
        $explode = explode(" ", strtolower($lomba));
        for ($i = 0; $i < count($explode); $i++) {
            if ($i != count($explode) - 1) {
                $output_lomba .= $explode[$i] . "_";
                continue;
            }
            $output_lomba .= $explode[$i];
        }
    } else {
        $output_lomba .= strtolower($lomba);
    }
    return $output_lomba;
}

function return_form_group($num, $lomba)
{
    $output_lomba = output_lomba_string($lomba);

    $form = '<h3>' . $lomba . '</h3><div class="form-group">
    <label for="nama_lengkap">Nama Tim</label>
    <input type="text" class="form-control" id="nama_lengkap" rows="3" name="nama_tim_' . $output_lomba . '" required>
    <input type="hidden" name="nama_lomba_' . $num . '" value="' . $output_lomba . '">
    <input type="hidden" id="jumlah_peserta_' . $num . '" name="jumlah_peserta_' . $output_lomba . '" value="1">
    </div>
    <div class="form-group">
        <label for="nama_lengkap">Jumlah Anggota</label>
        <div class="row"> 
            <div class="col-sm d-flex justify-content mt-1">
                <button class="btn btn-danger" id="minus_' . $num . '"><strong>-</strong></button>
                <div class="separator2"></div>
                <div class="square_' . $num . '" style="width: 50px;
                height: 50px;
                border-style: solid;
                border-width: 1px;
                border-color: black;
                text-align: center;
                display: inline;
                padding: 10px 0;">1</div>
                <div class="separator2"></div>
                <button class="btn btn-success" id="plus_' . $num . '"><strong>+</strong></button>
            </div>
        </div>
    </div>
    <div class="data-mahasiswa-' . $num . '">
        <div class="data-count">
            <div class="form-group" id="form_1">
                <label for="nama_lengkap">Nama Lengkap Peserta 1</label>
                <input type="text" class="form-control" id="nama_lengkap" rows="3" name="nama_lengkap_' . $output_lomba . '[]" required>
            </div>
            <div class="form-group">
                <label for="id_line">ID Line Peserta 1</label>
                <input type="text" class="form-control" id="id_line" rows="3" name="id_line_' . $output_lomba . '[]" required>
            </div>
            <div class="form-group">
                <label for="no_telp">Nomor Telepon Peserta 1</label>
                <input type="tel" class="form-control" id="no_telp" rows="3" name="no_telp_' . $output_lomba . '[]" placeholder="08xxxxxxxxxx" minlength="11" maxlength="12" required>
            </div>
            <div class="form-group mb-3">
                <label for="nrp">NRP Peserta 1</label>
                <input type="text" class="form-control" id="nrp" rows="3" name="nrp_' . $output_lomba . '[]" maxlength="9" required>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="buat_upload_file"><b>Perhatian</b></label>
            <ul class="list-group mt-2" id="buat_upload_file">
                <li class="list-group-item mb-2">
                    <p style="color:red; text-align: justify;
  text-justify: inter-word;">File cukup 1 file png / jpg / jpeg dengan isi ktm anggota seluruh kelompok</p>
                </li>
            </ul>
    </div>
    <div class="form-group mb-3">
        <label for="upload_ktm_'.$output_lomba.'">Upload KTM / Tanda Pengenal (maksimal 2 MB)</label>
        <div class="separator2"></div>
        <input type="file" class="form-control-file" name="upload_ktm_'.$output_lomba.'" id="upload_ktm_'.$output_lomba.'">
    </div>
    <input type="hidden" id="nama_lomba" name="nama_lomba_' . $output_lomba . '" value="Lomba '.$lomba.'">';
    return $form;
}

function return_form_workout_dance($num, $lomba)
{
    $output_lomba = output_lomba_string($lomba);

    $form = '<h3>' . $lomba . '</h3><div class="form-group">
    <label for="nama_lengkap">Nama Tim</label>
    <input type="text" class="form-control" id="nama_lengkap" rows="3" name="nama_tim_' . $output_lomba . '" required>
    <input type="hidden" name="nama_lomba_' . $num . '" value="' . $output_lomba . '">
    <input type="hidden" id="jumlah_peserta_' . $num . '" name="jumlah_peserta_' . $output_lomba . '" value="1">
    </div>


    <div class="form-group">
        <label for="nama_lengkap">Jumlah Anggota</label>
        <div class="row"> 
            <div class="col-sm d-flex justify-content mt-1">
                <button class="btn btn-danger" id="minus_' . $num . '"><strong>-</strong></button>
                <div class="separator2"></div>
                <div class="square_' . $num . '" style="width: 50px;
                height: 50px;
                border-style: solid;
                border-width: 1px;
                border-color: black;
                text-align: center;
                display: inline;
                padding: 10px 0;">5</div>
                <div class="separator2"></div>
                <button class="btn btn-success" id="plus_' . $num . '"><strong>+</strong></button>
            </div>
        </div>
    </div>
    <div class="data-mahasiswa-' . $num . '">
        <div class="data-count">' .
        '<div class="form-group" id="form_1">' .
        '<label for="nama_lengkap">Nama Lengkap Peserta</label>' .
        '<textarea class="form-control" id="nama_lengkap_workout" maxlength="275"' . 'rows="3" name="nama_lengkap_' . $output_lomba . '[]" required></textarea>' .
        '</div>' .
        '<div class="form-group">' .
        '<label for="id_line">ID Line Peserta</label>' .
        '<textarea class="form-control" id="id_line_workout" rows="3" maxlength="80" name="id_line_' . $output_lomba . '[]" required></textarea>' .
        '</div>' .
        '<div class="form-group">' .
        '<label for="no_telp">Nomor Telepon Peserta</label>' .
        '<textarea class="form-control" id="no_telp_workout" rows="3" name="no_telp_' . $output_lomba . '[]" placeholder="08xxxxxxxxxx" minlength="68" maxlength="73" required></textarea>' .
        '</div>' .
        '<div class="form-group mb-3">' .
        '<label for="nrp">NRP Peserta</label>' .
        '<textarea class="form-control" id="nrp_workout" rows="3" name="nrp_' . $output_lomba . '[]" maxlength="57" required></textarea>' .
        '</div>' .
        '</div>
    </div>
    <div class="form-group">
        <label for="buat_upload_file"><b>Perhatian</b></label>
            <ul class="list-group mt-2" id="buat_upload_file">
                <li class="list-group-item mb-2">
                    <p style="color:red; text-align: justify;
  text-justify: inter-word;">File cukup 1 file pdf dengan isi ktm anggota kelompok</p>
                </li>
            </ul>
    </div>
    <div class="form-group mb-3">
        <label for="upload_ktm_'.$output_lomba.'">Upload KTM / Tanda Pengenal (maksimal 2 MB)</label>
        <div class="separator2"></div>
        <input type="file" class="form-control-file" name="upload_ktm_'.$output_lomba.'" id="upload_ktm_'.$output_lomba.'">
    </div>
    <input type="hidden" id="nama_lomba" name="nama_lomba_' . $output_lomba . '" value="Lomba '.$lomba.'">';
    return $form;
}

function return_form_individual($lomba)
{
    $output_lomba = output_lomba_string($lomba);
    $form2 = '<h3>' . $lomba . '</h3>
    <div class="data_mahasiswa_' . $output_lomba . '">
        <div class="data-count">
            <div class="form-group" id="form_1">
                <label for="nama_lengkap">Nama Lengkap Peserta</label>
                <input type="text" class="form-control" id="nama_lengkap" rows="3" name="nama_lengkap_' . $output_lomba . '" required>
            </div>
            <div class="form-group">
                <label for="id_line">ID Line Peserta</label>
                <input type="text" class="form-control" id="id_line" rows="3" name="id_line_' . $output_lomba . '" required>
            </div>
            <div class="form-group">
                <label for="no_telp">Nomor Telepon Peserta</label>
                <input type="tel" class="form-control" id="no_telp" rows="3" name="no_telp_' . $output_lomba . '" placeholder="08xxxxxxxxxx" minlength="11" maxlength="12" required>
            </div>
            <div class="form-group mb-3">
                <label for="nrp">NRP Peserta</label>
                <input type="text" class="form-control" id="nrp" rows="3" name="nrp_' . $output_lomba . '" maxlength="9" required>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="upload_ktm_'.$output_lomba.'">Upload KTM / Tanda Pengenal (maksimal 2 MB)</label>
        <div class="separator2"></div>
        <input type="file" class="form-control-file" name="upload_ktm_'.$output_lomba.'" id="upload_ktm_'.$output_lomba.'">
    </div>
    <input type="hidden" id="nama_lomba" name="nama_lomba_' . $output_lomba . '" value="Lomba '.$lomba.'">';
    return $form2;
}
