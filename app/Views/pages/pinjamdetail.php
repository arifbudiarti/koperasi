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
                    <!-- Earnings (Annual) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Total Peminjaman</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($dashboard[0]['simpan_total']); ?></div>
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
                                            Angsuran</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($dashboard[0]['simpan_total']); ?></div>
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
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($dashboard[0]['simpan_total']); ?></div>
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
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($dashboard[0]['simpan_total']); ?></div>
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
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tgl Transaksi</th>
                                <th>Simpan</th>
                                <th>Saldo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $saldo = 0; ?>
                            <?php foreach ($simpan as $key => $row) : ?>
                                <?php $saldo += $row['nominal']; ?>
                                <tr>
                                    <td><?= $key + 1; ?></td>
                                    <td><?= $row['tgl_transaksi']; ?></td>
                                    <td><?= $row['nominal']; ?></td>
                                    <td><?= number_format($saldo); ?></td>
                                    <td>
                                        <div class="form-button-action">
                                            <a href="<?php echo base_url('simpan/' . $row['id'] . '/edit'); ?>" class="btn btn-info btn-circle">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="<?php echo base_url('simpan/' . $row['id'] . '/delete'); ?>" class="btn btn-danger btn-circle" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
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