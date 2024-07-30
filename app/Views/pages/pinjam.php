<?= $this->extend('template/theme'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <!-- Pie Chart -->
    <div class="col-xl-12 col-lg-8">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Peminjaman</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="row">
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Bulan <?= date('F') ?></div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($dashboard[0]['pinjam_bulan']); ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Annual) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Total</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($dashboard[0]['pinjam_total']); ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
                <?php //if (session()->get('logged_in') == TRUE && session()->get('admin') == TRUE) : 
                ?>
                <a href="<?php echo base_url('pinjam/new'); ?>" class="btn btn-success btn-icon-split" style="margin-bottom: 25px;">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah Peminjaman</span>
                </a>
                <?php //endif; 
                ?>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Anggota</th>
                                <th>Nama Anggota</th>
                                <th>Alamat</th>
                                <th>No HP</th>
                                <th>Pokok Pinjam</th>
                                <th>Angsuran</th>
                                <th>Angsuran RP</th>
                                <th>Total Pinjam</th>
                                <th>Status</th>
                                <?php //if (session()->get('logged_in') == TRUE && session()->get('admin') == TRUE) : 
                                ?>
                                <th>Action</th>
                                <?php //endif; 
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pinjam as $key => $row) : ?>
                                <tr>
                                    <td><?= $key + 1; ?></td>
                                    <td><?= $row->no_anggota; ?></td>
                                    <td><?= $row->nama; ?></td>
                                    <td><?= $row->alamat; ?></td>
                                    <td><?= $row->no_hp; ?></td>
                                    <td><?= number_format($row->pokok_peminjaman); ?></td>
                                    <td><?= $row->kredit; ?></td>
                                    <td><?= number_format($row->total_cicilan); ?></td>
                                    <td><?= number_format($row->total_peminjaman); ?></td>
                                    <td><?= ($row->status && $row->status == 2) ? 'Pending' : (($row->status && $row->status == 1) ? 'Disetujui' : 'Batal'); ?></td>
                                    <?php //if (session()->get('logged_in') == TRUE && session()->get('admin') == TRUE) : 
                                    ?>
                                    <td>
                                        <?php if (session()->get('logged_in') == TRUE && session()->get('admin') == TRUE) { ?>
                                            <?php if ($row->status == 2) : ?>
                                                <div class="form-button-action">
                                                    <a href="<?php echo base_url('pinjam/' . $row->id . '/accept'); ?>" class="btn btn-success btn-circle">
                                                        <i class="fa fa-check"></i>
                                                    </a>
                                                    <a href="<?php echo base_url('pinjam/' . $row->id . '/decline'); ?>" class="btn btn-danger btn-circle">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($row->status == 1) : ?>
                                                <div class="form-button-action">
                                                    <a href="<?php echo base_url('bayar/' . $row->id_anggota . '/' . $row->id . '/detail'); ?>" class="btn btn-info btn-circle">
                                                        <i class="fa fa-money-bill"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        <?php } else { ?>
                                            <?php if ($row->status == 2) : ?>
                                                <div class="form-button-action">
                                                    <a href="<?php echo base_url('bayar/' . $row->id . '/detail'); ?>" class="btn btn-info btn-circle">
                                                        <i class="fa fa-money-bill"></i>
                                                    </a>
                                                    <a href="<?php echo base_url('pinjam/' . $row->id . '/edit'); ?>" class="btn btn-primary btn-circle">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="<?php echo base_url('pinjam/' . $row->id . '/delete'); ?>" class="btn btn-danger btn-circle" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($row->status == 99) : ?>
                                                Batal / Tidak disetujui
                                            <?php endif; ?>
                                        <?php } ?>
                                    </td>
                                    <?php //endif; 
                                    ?>
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