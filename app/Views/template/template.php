<!DOCTYPE html>
<html>
<?php echo view('template/header'); ?>

<body class="mini-navbar">
    <div id="wrapper">
        <?php echo view('template/sidebar'); ?>
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <?php echo view('template/topbar'); ?>
            </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2><?= $title ?></h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= site_url() . $url; ?>"> <?= $title ?></a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong><?= (!empty($child) && $child != '') ? $child : ''; ?></strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <?= $this->renderSection('content') ?>
            </div>
            <div class="footer">
                <div>
                    <strong>Copyright</strong> PT. Nusantara Sebelas Medika &copy; 2021
                </div>
            </div>
        </div>
    </div>
    <?php echo view('template/footer'); ?>
</body>

</html>