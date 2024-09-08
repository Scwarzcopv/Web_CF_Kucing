<style>
    hr.solid {
        border-top: 4px solid #999;
    }

    .fas {
        -moz-transition: transform 0.25s;
        -webkit-transition: transform 0.25s;
        transition: transform 0.25s;
    }

    .rotate_90 {
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        transform: rotate(90deg);
    }

    .rotate_min90 {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        transform: rotate(0deg);
    }
</style>
<main class="content">
    <div class="container-fluid p-0">

        <!-- <div class="row"> -->
        <!-- <div class="col-12 col-md-6 col-xxl-9"> -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Riwayat Diagnosis</h5>
                <!-- <h6 class="card-subtitle text-muted">The</h6> -->
            </div>
            <div class="card-body">
                <div class="d-flex mb-2 justify-content-end">
                    <label class="card-title user-select-none my-auto me-2" id="" for="saklar_kosong">Tampilkan Hasil Kosong </label>
                    <div class="form-check form-switch py-0 my-0 align-self-center">
                        <input class="form-check-input my-auto" type="checkbox" name="saklar_kosong" id="saklar_kosong" style=" width: 40px; height: 20px;" checked onchange="saklar_kosong()">
                    </div>
                </div>
                <!-- <h5 class="card-title">The</h5> -->
                <!-- <button type="button" class="btn btn-info btn-lg mb-3 mb-lg-4" data-toggle="modal" onClick="tambahData()">Tambah Data</button> -->
                <table id="datatabless" class="table table-striped" style="width:100%">
                    <thead class="">
                        <tr>
                            <th scope="col">No</th>
                            <th>Username</th>
                            <th>Kode Penyakit</th>
                            <th>Nama Penyakit</th>
                            <th>Persentase</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col">No</th>
                            <th>Username</th>
                            <th>Kode Penyakit</th>
                            <th>Nama Penyakit</th>
                            <th>Persentase</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- </div> -->
        <!-- </div> -->
    </div>
</main>

<!-- Start Modal -->
<div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Hasil Diagnosis</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2 mt-2 float-end" id="since">Minggu</div>
                <div class="fw-bold mb-2 mt-2" id="penginput">Hasil input dari username : </div>
                <!-- Tabel Input User -->
                <table class="table table-responsive table-hover mb-lg-4">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col" class="">No</th>
                            <th scope="col" class="">Kode</th>
                            <th scope="col" class="">Gejala</th>
                            <th scope="col" class="">Kondisi</th>
                        </tr>
                    </thead>
                    <tbody id="tbody_modal_input">
                    </tbody>
                </table>
                <hr class="solid" />
                <div id="table_modal_diagnosa">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="print()">Print <i class="far fa-print"></i></button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--/ End Modal -->




<!-- Tutup elemen dari topbar.php -->
</div>
<?= $this->session->flashdata('message'); ?>
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
<script src="<?= base_url('assets'); ?>/js/customsweetalert.js"></script>

<!-- Tippy.Js -->
<script>
    function tippyjs(id, content) {
        tippy(id, {
            placement: 'bottom-end',
            allowHTML: true,
            delay: [500, 0],
            content: content,
        });
    }

    $(document).ajaxComplete(function() {
        tippyjs('.toggle_0', 'Aktifkan user');
        tippyjs('.toggle_1', 'Nonaktikan user');
        tippyjs('.reset', 'Reset password');
    });
</script>

<!-- Datatables -->
<script>
    var table = $('#datatabless');
    // Load DataTable
    function funcLoadDT(url) {
        table.DataTable({
            language: {
                "decimal": "",
                "emptyTable": "Tak ada data yang tersedia pada tabel",
                "info": "Menampilkan _START_ -> _END_ dari _TOTAL_ data",
                "infoEmpty": "Menampilkan 0 hingga  0 dari 0 data",
                "infoFiltered": "(difilter dari _MAX_ total data)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Menampilkan _MENU_ data",
                "loadingRecords": "Loading...",
                "processing": "",
                "search": "Cari:",
                "zeroRecords": "Tidak ditemukan data yang cocok",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                },
                "aria": {
                    "orderable": "Urutkan berdasarkan kolom ini",
                    "orderableReverse": "Balikkan urutan kolom ini"
                }
            },
            layout: {
                top2Start: {
                    buttons: [{
                            extend: 'copyHtml5',
                            exportOptions: {
                                // columns: [0, ':visible']
                                columns: [0, 1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            exportOptions: {
                                // columns: ':visible'
                                columns: [0, 1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            }
                        },
                        'colvis'
                    ]
                }
            },
            bDestroy: true,
            responsive: true,
            processing: true, //Feature control the processing indicator.
            serverSide: true, //Feature control DataTables' server-side processing mode.
            order: [], //Initial no order.
            ajax: {
                url: url,
                type: "POST"
            },
            columnDefs: [{
                target: [0, -1],
                orderable: false,
            }],
        });
    }
</script>

<!-- Olah Data -->
<script>
    function saklar_kosong() {
        self = $('#saklar_kosong');
        if (self.is(':checked')) {
            saklar = true;
            funcLoadDT('<?= base_url('admin/loadDataRiwayat'); ?>');
        } else {
            saklar = false;
            funcLoadDT('<?= base_url('admin/loadDataRiwayat_filter'); ?>');
        }
    }

    function info(id_r, username, role_id, since) {
        if (role_id > 2) $('#penginput').html('Hasil input dari username : ' + username + '');
        if (role_id < 3) $('#penginput').html('Hasil input dari username : <i class="fas fa-badge-check text-success"></i> ' + username + '');
        $('#since').html(since);
        $.ajax({
            url: "<?= base_url(); ?>konsultasi/info_riwayat",
            method: "POST",
            data: {
                id_r: id_r
            },
            dataType: "JSON",
            cache: false,
            success: function(resp) {
                console.clear();
                $('#tbody_modal_input').append(resp.input_user);
                $('#table_modal_diagnosa').append(resp.hasil_akhir);
                $('#modal').modal('show');
            }
        })
        $('#modal').on('hidden.bs.modal', function() {
            $('#tbody_modal_input').html('');
            $('#table_modal_diagnosa').html('');
        });
    }

    function detailPenyakitLain(id_penyakit) {
        if ($('#detail_penyakit_lain_' + id_penyakit).hasClass("d-none")) {
            $('#detail_penyakit_lain_' + id_penyakit).removeClass('d-none').slideUp(0).slideDown(500, 'easeInOutExpo');
            $('#caret_' + id_penyakit).toggleClass('rotate_90');
        } else {
            $('#detail_penyakit_lain_' + id_penyakit).slideUp(500, 'easeInOutExpo', function() {
                $(this).addClass('d-none');
            });
            $('#caret_' + id_penyakit).toggleClass('rotate_90');
        }
    }

    function print() {
        $('.modal-body').printThis({
            importCSS: true, // import parent page css
            importStyle: true, // import style tags
            printContainer: true, // print outer container/$.selector
            pageTitle: "Hasil Diagnosa",
            header: "<h5 class='text-center mt-4 mb-2'>Diagnosa Penyakit Kucing Metode Certainty Factor</h5>",
            loadCSS: [
                'https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap',
                '<?= base_url('assets/mediplus'); ?>/css/bootstrap.min.css',
                '<?= base_url('assets/mediplus'); ?>/css/nice-select.css',
                '<?= base_url('assets/mediplus'); ?>/css/normalize.css',
                '<?= base_url('assets/mediplus'); ?>/style.css',
                '<?= base_url('assets/mediplus'); ?>/css/responsive.css',
            ],
        });
    }
</script>


<script>
    $(document).ready(function() {
        funcLoadDT('<?= base_url('admin/loadDataRiwayat'); ?>');
    });
</script>