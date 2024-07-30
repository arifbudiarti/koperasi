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
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Anggota</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="id_anggota" name="id_anggota" value="<?= $simpan['id_anggota'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Transaksi</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="tgl_transaksi" name="tgl_transaksi" value="<?= date('Y-m-d', strtotime($simpan['tgl_transaksi'])) ?>">
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Nominal Simpan</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="nominal" name="nominal" value="<?= $simpan['nominal'] ?>">
                    </div>
                </div>
                <div class=" form-group row">
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
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Anggota</label>
                    <div class="col-sm-10">
                        <select class="custom-select" name="id_anggota">
                            <option selected> -- Pilih Anggota -- </option>
                            <?php foreach ($anggota as $key) : ?>
                                <option value="<?= $key['id'] ?>"><?= $key['nama'] ?> (<?= $key['no_anggota'] ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Transaksi</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="tgl_transaksi" name="tgl_transaksi" value="<?= date('Y-m-d') ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Nominal Simpan</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="nominal" name="nominal">
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

<?= $this->endSection(); ?>