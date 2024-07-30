<?= $this->extend('template/theme'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-xl-12 col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-body">
                <?php
                if (!empty(session()->getFlashdata('success'))) { ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo session()->getFlashdata('success'); ?>
                    </div>
                <?php } ?>
                <?php if (!empty(session()->getFlashdata('warning'))) { ?>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <div class="alert alert-warning">
                        <?php echo session()->getFlashdata('warning'); ?>
                    </div>
                <?php } ?>
                <?php if (session()->get('logged_in') == TRUE && session()->get('admin') == TRUE) : ?>
                    <a href="<?php echo base_url('anggota/new'); ?>" class="btn btn-success btn-icon-split" style="margin-bottom: 25px;">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah Anggota</span>
                    </a>
                <?php endif; ?>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Anggota</th>
                                <th>Nama Anggota</th>
                                <th>Email</th>
                                <th>No HP</th>
                                <th>Kelamin</th>
                                <th>Status</th>
                                <?php if (session()->get('logged_in') == TRUE && session()->get('admin') == TRUE) : ?>
                                    <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($anggota as $key => $row) : ?>
                                <tr>
                                    <td><?= $key + 1; ?></td>
                                    <td><?= $row['no_anggota']; ?></td>
                                    <td><?= $row['nama']; ?></td>
                                    <td><?= $row['email']; ?></td>
                                    <td><?= $row['no_hp']; ?></td>
                                    <td><?= ($row['jenis_kelamin'] && $row['jenis_kelamin'] == 1) ? 'Laki-Laki' : 'Perempuan'; ?></td>
                                    <td><?= ($row['status'] && $row['status'] == 1) ? 'Aktif' : 'Tidak Aktif'; ?></td>
                                    <?php if (session()->get('logged_in') == TRUE && session()->get('admin') == TRUE) : ?>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="<?php echo base_url('anggota/' . $row['id'] . '/edit'); ?>" class="btn btn-primary btn-circle">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="<?php echo base_url('anggota/' . $row['id'] . '/delete'); ?>" class="btn btn-danger btn-circle" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>