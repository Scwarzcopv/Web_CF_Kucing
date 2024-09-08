<section class="text-center text-lg-start">
    <main class="d-flex w-100 h-100 justify-content-center">
        <div class="row vh-100">
            <div class=" h-custom ">
                <div class="row d-flex justify-content-center align-items-center h-100" style="min-height: 100vh;">
                    <!-- KIRI -->
                    <div class="col-md-9 col-lg-6 col-xl-5 d-none d-lg-block">
                        <!-- https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp -->
                        <img src="<?= base_url('assets'); ?>/img/icons/kiri.png" class="img-fluid" alt="Image Kiri">
                        <div class="d-flex align-items-center mt-2 justify-content-center">
                            <p class="text-center fw-bold mx-3 mb-0 h1 comicsans text-dark">DIAGNOSA PENYAKIT PADA KUCING</p>
                        </div>
                        <div class="d-flex align-items-center mb-4 mt-2 justify-content-center">
                            <p class="text-center mx-3 mb-0 h4 comicsans text-dark">Mengecek kesehatan kucing bisa dilakukan di rumah lho, sebelum memutuskan apakah perlu sampai dibawa ke dokter hewan atau tidak.</p>
                        </div>
                    </div>
                    <!-- KANAN -->
                    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                        <form action="<?= base_url('login/registration'); ?>" method="POST">
                            <div class="text-center">
                                <img src="<?= base_url('assets'); ?>/img/icons/logo-crop.png" alt="Logo Kucing" class="img-fluid" width="125" height="125" />
                            </div>
                            <div class="divider d-flex align-items-center mb-4 mt-2">
                                <p class="text-center fw-bold mx-3 mb-0">DIAGNOSA PENYAKIT KUCING</p>
                            </div>

                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="username">Username</label>
                                <input type="text" id="username" class="form-control form-control-lg" placeholder="Username" name="username" id="username" value="<?= set_value('username'); ?>" autofocus />
                                <?= form_error('username', '<small class="text-danger ms-3">', '</small>'); ?>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-3">
                                <label class="form-label" for="password1">Password</label>
                                <input type="password" id="password1" class="form-control form-control-lg" placeholder="Password" name="password1" id="password1" />
                                <?= form_error('password1', '<small class="text-danger ms-3">', '</small>'); ?>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-3">
                                <label class="form-label" for="password2">Konfirmasi Password</label>
                                <input type="password" id="password2" class="form-control form-control-lg" placeholder="Konfirmasi Password" name="password2" id="password2" />
                                <?= form_error('password2', '<small class="text-danger ms-3">', '</small>'); ?>
                            </div>

                            <!-- Button Login -->
                            <div class="text-center text-lg-start mt-4 pt-2">
                                <button type="submit" class="btn btn-success btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Register <i class="fa-solid fa-paw"></i></button>
                                <a href="<?= base_url('') ?>" class="btn btn-primary btn-lg ms-2" style="padding-left: 1rem; padding-right: 1rem;">Guest <i class="fa-solid fa-"></i></a>
                            </div>
                            <div class="text-center text-lg-start mt-2 ms-1">
                                <a href="<?= base_url('login'); ?>">Sudah punya akun?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- FOOTER -->
            <div class="d-flex text-center text-md-start align-items-center full-width">
                <div class="text-dark ms-1 d-none d-md-block">
                    <!-- ©2023 | Pemerintah Kota Kediri -->
                </div>
            </div>
            <nav class="navbar fixed-bottom bg-light d-none d-lg-flex py-1 ps-2">
                <div class="container-fluid d-flex align-items-center ps-0 d-none d-lg-block">
                    <span class="text-dark h5 my-auto" href="#">©2024 | Sistem Pakar - Diagnosa Penyakit Pada Kucing</span>
                </div>
            </nav>
            <!-- END FOOTER -->
        </div>
    </main>
</section>

<?= $this->session->flashdata('message'); ?>