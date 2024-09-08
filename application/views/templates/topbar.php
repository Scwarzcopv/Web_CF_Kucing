<div class="main">
    <nav class="navbar navbar-expand navbar-light navbar-bg">
        <a class="sidebar-toggle js-sidebar-toggle">
            <i class="hamburger align-self-center"></i>
        </a>

        <form class="d-inline-block">
            <div class="input-group input-group-navbar">
                <button class="btn" type="button">
                    <i class="fa-regular fa-compass"></i> <?= $title; ?>
                </button>
            </div>
        </form>

        <ul class="navbar-nav d-none d-lg-flex">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="<?= base_url('konsultasi/konsultasi'); ?>" id="resourcesDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Konsultasi
                </a>
                <div class="dropdown-menu" aria-labelledby="resourcesDropdown">
                    <a class="dropdown-item" href="<?= base_url(''); ?>">
                        <i class="fas fa-home me-1"></i> Homepage
                    </a>
                    <a class="dropdown-item" href="<?= base_url('konsultasi/konsultasi'); ?>">
                        <i class="fas fa-stethoscope me-1"></i> Konsultasi
                    </a>
                    <a class="dropdown-item" href="<?= base_url('konsultasi/riwayat'); ?>">
                        <i class="fas fa-history me-1"></i> Riwayat Konsultasi
                    </a>
                </div>
            </li>
        </ul>

        <div class="navbar-collapse collapse">
            <ul class="navbar-nav navbar-align">
                <li class="nav-item">
                    <a class="nav-icon js-fullscreen d-none d-lg-block" href="#">
                        <div class="position-relative">
                            <i class="align-middle" data-feather="maximize"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-icon pe-0 dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <img src="<?= base_url('assets'); ?>/img/avatars/<?= $user['image']; ?>" class="avatar img-fluid rounded-circle" alt="avatar.jpg" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                        <a class="dropdown-item" href="pages-settings.html"><i class="align-middle me-1" data-feather="settings"></i> Setting</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('login/logout'); ?>"><i class="align-middle me-1" data-feather="log-out"></i> Log out</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>