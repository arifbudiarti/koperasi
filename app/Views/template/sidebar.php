<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">KSP</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('simpan'); ?>">
            <i class="fas fa-fw fa-save"></i>
            <span>Simpan</span></a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Pinjam</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <?php if (session()->get('logged_in') == TRUE && session()->get('admin') == TRUE) { ?>
                    <a class="collapse-item" href="<?php echo base_url('pinjam'); ?>">Pengajuan</a>
                <?php } else { ?>
                    <a class="collapse-item" href="<?php echo base_url('pinjam'); ?>">Pengajuan</a>
                    <a class="collapse-item" href="<?php echo base_url('bayar'); ?>">Pembayaran</a>
                <?php } ?>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Nav Item - Pages Collapse Menu -->
    <?php if (session()->get('logged_in') == TRUE && session()->get('admin') == TRUE) { ?>

        <!-- Heading -->
        <div class="sidebar-heading">
            Admin
        </div>
        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('users'); ?>">
                <i class="fas fa-fw fa-users"></i>
                <span>Users</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('anggota'); ?>">
                <i class="fas fa-fw fa-users"></i>
                <span>Anggota</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('petugas'); ?>">
                <i class="fas fa-fw fa-user"></i>
                <span>Petugas</span></a>
        </li>
    <?php } ?>

</ul>
<!-- End of Sidebar -->