<main class="content">
    <!-- <?= var_dump($total['total_chart_lainnya_bulanan']); ?> -->
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3 text-primary"><i class="fas fa-home"></i> <?= $title; ?></h1>
        <div class="row">
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Total Penyakit</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="fas fa-viruses"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3"><?= $total['total_penyakit']; ?></h1>
                        <div class="mb-0">
                            <span class="text-muted">Update</span>
                            <span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i> <?= $total['total_penyakit_new']; ?> Data</span>
                            <span class="text-muted">Sejak awal bulan</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Total Gejala</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="fas fa-syringe"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3"><?= $total['total_gejala']; ?></h1>
                        <div class="mb-0">
                            <span class="text-muted">Update</span>
                            <span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i> <?= $total['total_gejala_new']; ?> Data</span>
                            <span class="text-muted">Sejak awal bulan</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Total Aturan</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="fas fa-wrench"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3"><?= $total['total_aturan']; ?></h1>
                        <div class="mb-0">
                            <span class="text-muted">Update</span>
                            <span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i> <?= $total['total_aturan_new']; ?> Data</span>
                            <span class="text-muted">Sejak awal bulan</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Total User</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3"><?= $total['total_user']; ?></h1>
                        <div class="mb-0">
                            <span class="badge badge-success-light"> <i class="mdi mdi-arrow-bottom-right"></i> +<?= $total['total_user_new']; ?> </span>
                            <span class="text-muted">Sejak awal bulan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-4 col-xxl-3">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <!-- <div class="card-actions float-end">
                            <div class="dropdown position-relative">
                                <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                                    <i class="align-middle" data-feather="more-horizontal"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div> -->
                        <h5 class="card-title mb-0">Grafik Penyakit Terbanyak</h5>
                    </div>
                    <div class="card-body d-flex">
                        <div class="align-self-center w-100">
                            <div class="py-3">
                                <div class="chart chart-xs">
                                    <canvas id="chartjs-dashboard-pie"></canvas>
                                </div>
                            </div>

                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td><i class="fas fa-circle text-primary fa-fw"></i></td>
                                        <td>
                                            <?= @$total['total_chart'][0]['nama_penyakit']; ?>
                                            <?php if (@$total['total_chart_bulanan'][0]) echo '<span class="badge badge-danger-light">+' . @$total['total_chart_bulanan'][0] . '</span>'; ?>
                                        </td>
                                        <td class="text-end"><?= @$total['total_chart'][0]['total_riwayat']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-circle text-warning fa-fw"></i></td>
                                        <td>
                                            <?= @$total['total_chart'][1]['nama_penyakit']; ?>
                                            <?php if (@$total['total_chart_bulanan'][1]) echo '<span class="badge badge-danger-light">+' . @$total['total_chart_bulanan'][1] . '</span>'; ?>
                                        </td>
                                        <td class="text-end"><?= @$total['total_chart'][1]['total_riwayat']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-circle text-danger fa-fw"></i></td>
                                        <td>
                                            <?= @$total['total_chart'][2]['nama_penyakit']; ?>
                                            <?php if (@$total['total_chart_bulanan'][2]) echo '<span class="badge badge-danger-light">+' . @$total['total_chart_bulanan'][2] . '</span>'; ?>
                                        </td>
                                        <td class="text-end"><?= @$total['total_chart'][2]['total_riwayat']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-circle text-dark fa-fw"></i></td>
                                        <td>
                                            <?= @$total['total_chart'][3]['nama_penyakit']; ?>
                                            <?php if (@$total['total_chart_bulanan'][3]) echo '<span class="badge badge-danger-light">+' . @$total['total_chart_bulanan'][3] . '</span>'; ?>
                                        </td>
                                        <td class="text-end"><?= @$total['total_chart'][3]['total_riwayat']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-circle text-light fa-fw"></i></td>
                                        <td>Lainnya
                                            <?php if (@$total['total_chart_lainnya_bulanan']) echo '<span class="badge badge-danger-light">+' . @$total['total_chart_lainnya_bulanan'] . '</span>'; ?>
                                        </td>
                                        <td class="text-end"><?= @$total['total_chart_lainnya']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Aktifitas User Terbanyak</h5>
                    </div>
                    <table class="table table-borderless my-0">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th class="d-none d-xxl-table-cell">Status Akun</th>
                                <th class="d-none d-xl-table-cell">Jumlah Konsultasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            <?php foreach ($total['total_aktifitas'] as $row) : ?>
                                <?php
                                $centang_ijo = '';
                                if ($row['role_id'] < 3) $centang_ijo = '<i class="fas fa-badge-check text-success "></i>';
                                $aktifitas_bulanan = @$total['total_aktifitas_bulanan'][$no++];
                                if ($aktifitas_bulanan == null) $aktifitas_bulanan = 0;
                                ?>
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="rounded-2">
                                                    <img class="avatar img-fluid rounded-circle" src="<?= base_url('assets/img/avatars/' . $row['image']); ?>">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <strong><?= $centang_ijo; ?> <?= $row['username']; ?></strong>
                                                <div class="text-muted">
                                                    <?= $row['name']; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="d-none d-xxl-table-cell">
                                        <?php
                                        $active = 'Aktif';
                                        if ($row['is_active'] != 1) $active = 'Nonaktif';
                                        ?>
                                        <strong><?= $active; ?></strong>
                                    </td>
                                    <td class="d-none d-xl-table-cell">
                                        <strong><?= $row['total_konsultasi']; ?></strong> x
                                        <div class="text-muted">
                                            <span class="badge badge-success-light">+<?= $aktifitas_bulanan; ?></span> Sejak awal bulan
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
</main>




<!-- Tutup elemen dari topbar.php -->
</div>
<?= $this->session->flashdata('message'); ?>
<!-- <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script> -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Pie chart
        new Chart(document.getElementById("chartjs-dashboard-pie"), {
            type: "pie",
            data: {
                labels: ["<?= @$total['total_chart'][0]['nama_penyakit']; ?>",
                    "<?= @$total['total_chart'][1]['nama_penyakit']; ?>",
                    "<?= @$total['total_chart'][2]['nama_penyakit']; ?>",
                    "<?= @$total['total_chart'][3]['nama_penyakit']; ?>",
                    "Lainnya"
                ],
                datasets: [{
                    data: [<?= @$total['total_chart'][0]['total_riwayat']; ?>,
                        <?= @$total['total_chart'][1]['total_riwayat']; ?>,
                        <?= @$total['total_chart'][2]['total_riwayat']; ?>,
                        <?= @$total['total_chart'][3]['total_riwayat']; ?>,
                        <?= @$total['total_chart_lainnya']; ?>
                    ],
                    backgroundColor: [
                        window.theme.primary,
                        window.theme.warning,
                        window.theme.danger,
                        window.theme.black,
                        window.theme.light
                    ],
                    borderWidth: 5,
                    borderColor: window.theme.white
                }]
            },
            options: {
                responsive: !window.MSInputMethodContext,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                cutoutPercentage: 70
            }
        });
    });
</script>