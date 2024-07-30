<?= $this->extend('template/theme'); ?>
<?= $this->section('content'); ?>
<?php if (isset($edit) && $edit == 1) { ?>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="user" method="post">
                <?= csrf_field(); ?>
                <?php
                $inputs = session()->getFlashdata('inputs');
                $errors = session()->getFlashdata('errors');
                if (!empty($errors)) { ?>
                    <div class="alert alert-danger" role="alert">
                        Whoops! Ada kesalahan saat input data, yaitu:
                        <ul>
                            <?php foreach ($errors as $error) : ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php } ?>
                <div class=" form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="<?= $anggota['nama'] ?>">
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">NIK KTP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nik" name="nik" value="<?= $anggota['nik'] ?>">
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $anggota['alamat'] ?>">
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" value="<?= $anggota['email'] ?>">
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">NO HP</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="no_hp" name="no_hp" value="<?= $anggota['no_hp'] ?>">
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline1" name="jenis_kelamin" value="1" class="custom-control-input" <?= ($anggota['jenis_kelamin'] == 1) ? 'checked' : '' ?>>
                            <label class="custom-control-label" for="customRadioInline1">Laki-laki</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline2" name="jenis_kelamin" value="2" class="custom-control-input" <?= ($anggota['jenis_kelamin'] == 2) ? 'checked' : '' ?>>
                            <label class="custom-control-label" for="customRadioInline2">Perempuan</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
                <hr>
            </form>
        </div>
    </div>
<?php } else { ?>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="user" method="post">
                <?= csrf_field(); ?>
                <?php
                $inputs = session()->getFlashdata('inputs');
                $errors = session()->getFlashdata('errors');
                if (!empty($errors)) { ?>
                    <div class="alert alert-danger" role="alert">
                        Whoops! Ada kesalahan saat input data, yaitu:
                        <ul>
                            <?php foreach ($errors as $error) : ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php } ?>
                <div class=" form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">NIK KTP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nik" name="nik">
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="alamat" name="alamat">
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">NO HP</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="no_hp" name="no_hp">
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline1" name="jenis_kelamin" value="1" class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline1">Laki-laki</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline2" name="jenis_kelamin" value="2" class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline2">Perempuan</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
                <hr>
            </form>
        </div>
    </div>
<?php } ?>
<script type='text/javascript'>
    document.addEventListener("DOMContentLoaded", function() {});

    function hitungbunga(id) {
        var kredit = parseInt(document.getElementById("kredit").value);
        var pokok_peminjaman = parseInt(document.getElementById("pokok_peminjaman").value);
        var bunga = parseInt(document.getElementById("bunga").value);
        var pokokcicilan = 0;
        var bungarp = 0;
        var totalbunga = 0;
        var totalcicilan = 0;
        var totalpeminjaman = 0;
        if (bunga) {
            pokokcicilan = (pokok_peminjaman / kredit);
            bungarp = (pokok_peminjaman * (bunga / 100)) / 12;
            totalbunga = bungarp * kredit;
            totalcicilan = pokokcicilan + bungarp;
            totalpeminjaman = (pokokcicilan * kredit) + totalbunga;
            // alert(totalpeminjaman);
            $("#pokok_bunga").val(bungarp);
            $("#pokok_cicilan").val(pokokcicilan);
            $("#total_cicilan").val(totalcicilan);
            $("#total_peminjaman").val(totalpeminjaman);
        }
    }
</script>

<?= $this->endSection(); ?>