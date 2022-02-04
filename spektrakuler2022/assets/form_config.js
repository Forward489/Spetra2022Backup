    $(document).ready(function() {
        $('.individual, .group').show();

        //Tampilan Lomba Group / Individu / Semua
        $('[name=lomba]').on('click', function() {
            if ($('[name=lomba]:checked').val() == "Lomba Individu") {
                $('.individual').show();
                $('.group').hide();
            } else if ($('[name=lomba]:checked').val() == "Lomba Group") {
                $('.group').show();
                $('.individual').hide();
            } else if ($('[name=lomba]:checked').val() == "Semua Lomba") {
                $('.individual, .group').show();
            }
        });

        //Mekanisme tambah anggota untuk lomba group
        var total_lomba = parseInt($('[name=hidden]').val());
        var button_available = "";

        var max_peserta_group = [];
        var nama_lomba_group = ['podcast', 'tuan_dan_puan', 'menyanyikan_lagu_daerah', 'dance_workout_tim', 'valorant', 'mobile_legend'];
        var max_peserta_group = [2, 2, 5, 0, 6, 6];

        var x = [];
        var output_lomba_group = [];

        // output_lomba_group adalah associative array untuk tampungan maksimal jumlah anggota dalam suatu lomba
        for (let i = 0; i < nama_lomba_group.length; i++) {
            output_lomba_group[nama_lomba_group[i]] = max_peserta_group[i];
        }

        /*
        Untuk melakukan tracking terhadap tombol yang tersedia, sesuai dengan jumlah lomba.
        Contoh kasus : 
        Input : 2 tipe lomba group
        Output : #minus_1, #plus_1, #minus_2, #plus_2 
        */
        for (let i = 1; i <= total_lomba; i++) {
            button_available += "#minus_" + i + ", #plus_" + i;
            if (i != total_lomba) {
                button_available += ", ";
            }
            x[i] = 1;
        }

        // Fungsi dijalankan ketika tolmbol + atau - pada form dipencet
        $(button_available).on('click', function(e) {
            e.preventDefault();
            for (let i = 1; i <= total_lomba; i++) {
                
                if (this.id == 'plus_' + i) {
                    var output = "";

                    var nama_lomba = $('input:hidden[name="nama_lomba_' + i + '"]').val();

                    if (nama_lomba.includes('valorant')) {
                        output = nama_lomba_group[4];
                    } else if (nama_lomba.includes('mobile_legend')) {
                        output = nama_lomba_group[5];
                    } else {
                        output = nama_lomba;
                    }
                    if (x[i] < output_lomba_group[output]) {
                        x[i]++;
                        $('.data-mahasiswa-' + i).append(
                            '<div class="data-count">' +
                                '<div class="form-group" id="form_' + x[i] + '">' +
                                    '<label for="nama_lengkap">Nama Lengkap Peserta ' + x[i] + '</label>' +
                                    '<input type="text" class="form-control" id="nama_lengkap"' + 'rows="3" name="nama_lengkap_' + nama_lomba + '[]" required>' +
                                '</div>' +
                                '<div class="form-group">' +
                                    '<label for="id_line">ID Line Peserta ' + x[i] + '</label>' +
                                    '<input type="text" class="form-control" id="id_line" rows="3" name="id_line_' + nama_lomba + '[]" required>' +
                                '</div>' +
                                '<div class="form-group">' +
                                    '<label for="no_telp">Nomor Telepon Peserta ' + x[i] + '</label>' +
                                    '<input type="tel" class="form-control" id="no_telp" rows="3" name="no_telp_' + nama_lomba + '[]" placeholder="08xxxxxxxxxx" minlength="11" maxlength="12" required>' +
                                '</div>' +
                                '<div class="form-group mb-3">' +
                                    '<label for="nrp">NRP Peserta ' + x[i] + '</label>' +
                                    '<input type="text" class="form-control" id="nrp" rows="3" name="nrp_' + nama_lomba + '[]"  maxlength="9" required>' +
                                '</div>' +
                            '</div>'
                        );
                    } else if (output_lomba_group[output] == 0) 
                    /*
                    Khusus lomba workout dance di mana peserta harus sama dengan atau lebih dari 5
                    */ {
                        if (x[i] == 1) {
                            x[i] = 6;
                        } else {
                            x[i]++;
                        }
                        
                        nama_length = 50 * x[i] + 25;
                        id_line_length = 13 * x[i] + 25;
                        no_telp_min_length = 11 * x[i] + 13;
                        no_telp_max_length = 12 * x[i] + 13;
                        nrp_max_length = 11 * x[i];

                        $('#nama_lengkap_workout').attr('maxlength', nama_length);
                        $('#id_line_workout').attr('maxlength', id_line_length);
                        $('#no_telp_workout').attr('minlength', no_telp_min_length);
                        $('#no_telp_workout').attr('maxlength', no_telp_max_length);
                        $('#nrp_workout').attr('maxlength', nrp_max_length);
                    }
                } else if (this.id == 'minus_' + i) {
                    var nama_lomba = $('input:hidden[name="nama_lomba_' + i + '"]').val();
                    //Kondisi kalau lomba yang dikurangi adalah lomba workout dance
                    if (nama_lomba == nama_lomba_group[3]) {
                        if (x[i] > 5) {
                            x[i]--;
                        } else {
                            x[i] = 5;
                        }
                        nama_length = 25 * x[i] + 25;
                        id_line_length = 13 * x[i] + 25;
                        no_telp_min_length = 11 * x[i] + 13;
                        no_telp_max_length = 12 * x[i] + 13;
                        nrp_max_length = 11 * x[i] + 2;

                        $('#nama_lengkap').attr('maxlength', nama_length);
                        $('#id_line').attr('maxlength', id_line_length);
                        $('#no_telp').attr('minlength', no_telp_min_length);
                        $('#no_telp').attr('maxlength', no_telp_max_length);
                        $('#nrp').attr('maxlength', nrp_max_length);
                    } else if (x[i] > 1 && nama_lomba != nama_lomba_group[3]) {
                        $('#form_' + x[i]).parent().remove();
                        x[i]--;
                    }
                }
                $('#jumlah_peserta_' + i).val(x[i].toString());
                $('.square_' + i).html(x[i]);
            }
        });
    });