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
                    <label for="inputEmail3" class="col-sm-2 col-form-label">ID Anggota</label>
                    <div class="col-sm-10">
                        <input type="hidden" class="form-control" id="id_anggota" name="id_anggota" value="<?= $cicil['id_anggota'] ?>" readonly>
                        <input type="hidden" class="form-control" id="id_pinjam" name="id_pinjam" value="<?= $cicil['id_pinjam'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Pembayaran</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="tgl_pembayaran" name="tgl_pembayaran" value="<?= date('Y-m-d'), strtotime($cicil['tgl_pembayaran']) ?>">
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Pembayaran Ke-</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="kredit" name="kredit" value="<?= $cicil['kredit'] ?>">
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Nominal Pembayaran</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="nominal" name="nominal" onchange="hitungsisa()" value="<?= $cicil['nominal'] ?>">
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Total Angsuran</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="saldo" name="saldo" readonly value="<?= ($cicil['saldo']) ?>">
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Sisa Angsuran</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="sisa" name="sisa" readonly value="<?= $cicil['sisa'] ?>">
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
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">ID Anggota</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="id_anggota" name="id_anggota" value="<?= $anggota['id'] ?>" readonly>
                        <input type="hidden" class="form-control" id="id_pinjam" name="id_pinjam" value="<?= $pinjam['id'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Anggota</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="tgl_peminjaman" name="tgl_peminjaman" value="<?= $anggota['nama'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Pembayaran</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="tgl_pembayaran" name="tgl_pembayaran" value="<?= date('Y-m-d') ?>">
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Pembayaran Ke-</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="kredit" name="kredit" value="<?= $bayar + 1 ?>">
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Nominal Pembayaran</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="nominal" name="nominal" onchange="hitungsisa()" value="<?= $pinjam['total_cicilan'] ?>">
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Total Peminjaman</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="total" name="total" readonly value="<?= $pinjam['total_peminjaman'] ?>">
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Total Angsuran</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="saldo" name="saldo" readonly value="<?= ($pinjam['total_cicilan'] * $bayar) ?>">
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Sisa Angsuran</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="sisa" name="sisa" readonly>
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
    document.addEventListener("DOMContentLoaded", function() {
        hitungSisa();
    });

    function hitungSisa() {
        var kredit = parseInt(document.getElementById("kredit").value);
        var nominal = parseInt(document.getElementById("nominal").value);
        var saldo = parseInt(document.getElementById("saldo").value);
        var total = parseInt(document.getElementById("total").value);
        var sisa = 0;
        var angsuran = 0;
        if (nominal && nominal > 0) {
            $angsuran = (kredit * nominal);
            sisa = total - angsuran - saldo;
            // alert(totalpeminjaman);
            $("#sisa").val(sisa);
            // alert(saldo);
        }
    }
</script>

<?= $this->endSection(); ?>