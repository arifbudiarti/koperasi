<?= $this->extend('template/theme'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <!-- Pie Chart -->
    <div class="col-xl-12 col-lg-8">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Simpan</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="row">
                    <!-- Earnings (Annual) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Total Peminjaman</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($pinjam['total_peminjaman']); ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Angsuran / Bulan</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($pinjam['total_cicilan']); ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Total Angsuran</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($dashboard[0]['bayar_total']); ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Sisa</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($pinjam['total_peminjaman'] - $dashboard[0]['bayar_total']); ?></div>
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
    <!-- Pie Chart -->
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
                <?php if (session()->get('logged_in') == TRUE && session()->get('admin') == TRUE && ($pinjam['total_peminjaman'] - $dashboard[0]['bayar_total'] != 0)) : ?>
                    <a href="<?php echo base_url('bayar/' . $id . '/' . $idanggota . '/new/'); ?>" class="btn btn-success btn-icon-split" style="margin-bottom: 25px;">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah Pembayaran</span>
                    </a>
                <?php endif; ?>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tgl Pembayaran</th>
                                <th>Jumlah</th>
                                <?php if (session()->get('logged_in') == TRUE && session()->get('admin') == TRUE) : ?>
                                    <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $saldo = 0; ?>
                            <?php foreach ($bayar as $key => $row) : ?>
                                <?php $saldo += $row['nominal']; ?>
                                <tr>
                                    <td><?= $key + 1; ?></td>
                                    <td><?= $row['tgl_pembayaran']; ?></td>
                                    <td><?= number_format($row['nominal']); ?></td>
                                    <?php if (session()->get('logged_in') == TRUE && session()->get('admin') == TRUE) : ?>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="<?php echo base_url('bayar/' . $row['id'] . '/edit'); ?>" class="btn btn-info btn-circle">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="<?php echo base_url('bayar/' . $row['id'] . '/delete'); ?>" class="btn btn-danger btn-circle " onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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