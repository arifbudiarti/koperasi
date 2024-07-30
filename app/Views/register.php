<!DOCTYPE html>
<html lang="en">
<?php echo view('template/header'); ?>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Koperasi Simpan Pinjam</h1>
                                    </div>
                                    <form class="user" action="<?php echo base_url('auth'); ?>" method="post">
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
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" name="name" class="form-control form-control-user" id="exampleFirstName" placeholder="First Name">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" name="name2" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="nik" class="form-control form-control-user" id="exampleInputEmail" placeholder="NIK">
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="jenis_kelamin" style="margin-bottom: 10px;" placeholder="Jenis Kelamin">
                                                <option value="1">Laki-Laki</option>
                                                <option value="2">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="no_hp" class="form-control form-control-user" id="exampleInputEmail" placeholder="Nomor Handphone">
                                        </div>
                                        <div class=" form-group">
                                            <input type="text" name="alamat" class="form-control form-control-user" id="exampleInputEmail" placeholder="Alamat">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user" id="exampleFirstName" placeholder="Username">
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" name="password2" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary btn-user btn-block" value="Register">
                                        </div>
                                        <hr>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?php echo view('template/footer'); ?>

</body>

</html>