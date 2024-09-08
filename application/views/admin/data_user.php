<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" /> -->
<main class="content">
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Data User</h5>
                        <!-- <h6 class="card-subtitle text-muted">The</h6> -->
                    </div>
                    <div class="card-body">
                        <!-- <button type="button" class="btn btn-info btn-lg mb-3 mb-lg-4" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Data <i class="fa-solid fa-plus"></i></button> -->
                        <!-- <button type="button" class="btn btn-info btn-lg mb-3 mb-lg-4" onclick="funcAddData()">Tambah Data <i class="fa-solid fa-plus"></i></button> -->
                        <table id="datatabless" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th>Username</th>
                                    <th>Nama User</th>
                                    <th>Active</th>
                                    <th>Waktu Registrasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="col">No</th>
                                    <th>Username</th>
                                    <th>Nama User</th>
                                    <th>Active</th>
                                    <th>Waktu Registrasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>




<!-- Tutup elemen dari topbar.php -->
</div>
<?= $this->session->flashdata('message'); ?>
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
<script src="<?= base_url('assets'); ?>/js/customsweetalert.js"></script>
<!-- <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script> -->

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
    function funcLoadDT() {
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
                                columns: [0, 1, 2, 3, 4]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            exportOptions: {
                                // columns: ':visible'
                                columns: [0, 1, 2, 3, 4]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
                            }
                        },
                        'colvis'
                    ]
                }
            },
            responsive: true,
            processing: true, //Feature control the processing indicator.
            serverSide: true, //Feature control DataTables' server-side processing mode.
            order: [], //Initial no order.
            ajax: {
                url: '<?= base_url('admin/loadDataPenyakit'); ?>',
                type: "POST"
            },
            columnDefs: [{
                    target: [0, -1],
                    orderable: false,
                },
                {
                    className: "dt-head-left",
                    targets: [0, 1, 2, 3, 4, 5]
                },
            ],
        });
    }

    // Fungsi Reload DataTable
    function funcReloadDT() {
        table.DataTable().ajax.reload();
    }
</script>
<!-- Olah Data -->
<script>
    // Fungsi Copy
    function copyToClipboard(text) {
        var dummy = document.createElement("textarea");
        // to avoid breaking orgain page when copying more words
        // cant copy when adding below this code
        // dummy.style.display = 'none'
        document.body.appendChild(dummy);
        //Be careful if you use texarea. setAttribute('value', value), which works with "input" does not work with "textarea". – Eduard
        dummy.value = text;
        dummy.select();
        document.execCommand("copy");
        document.body.removeChild(dummy);
    }

    // Fungsi Toggle kolom is_active
    var title = '';
    var title_sweet = '';

    function funcToggleActive(id, is_active, username) {
        var html = '';
        html = "Username '<span class='fw-bold'>" + username + "</span>' akan dinonaktifkan.";
        title = 'Nonaktifkan User?';
        title_sweet = 'Berhasil dinonaktifkan';
        if (is_active !== 1) {
            title = 'Aktifkan User?';
            title_sweet = 'Berhasil diaktifkan';
        };
        Swal.fire({
            title: title,
            html: html,
            // html: "Semua data terkait penyakit ini akan dimasukkan ke <br><span class='fw-bold'>daftar sampah</span>.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Setuju',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'GET',
                    url: "<?= base_url('admin/toogleUser/'); ?>" + id,
                    dataType: "JSON",
                    success: function(resp) {
                        console.log(resp);
                        Custom.fire({
                            icon: 'success',
                            title: "<span class='fw-bold'>" + username + "</span> " + title_sweet,
                        });
                        funcReloadDT()
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(errorThrown);
                        // console.error(this.props.url, status, err.toString());
                        Swal.fire({
                            icon: 'error',
                            title: textStatus,
                            text: errorThrown,
                        });
                        funcReloadDT()
                    }
                });
            }
        })
    }

    // Fungsi Reset Password
    function funcResetPw(id, username) {
        var html = '';
        html = "Password dari username '<span class='fw-bold'>" + username + "</span>' akan direset.<br>";
        html += "Password baru akan muncul setelah anda klik <br><span class='fw-bold text-primary'>Proses</span>.";
        Swal.fire({
            title: "Reset Password?",
            html: html,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Proses',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'GET',
                    url: "<?= base_url('admin/resetPw/'); ?>" + id,
                    dataType: "JSON",
                    success: function(resp) {
                        Swal.fire({
                            title: "Success",
                            html: "Password username '<span class='fw-bold'>" + username + "</span>' adalah:<br><span class='fw-bold text-primary'>" + resp.new_pw + "</span>",
                            icon: "success",
                            confirmButtonText: 'Copy'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                copyToClipboard(resp.new_pw);
                            }
                        });
                        funcReloadDT();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(errorThrown);
                        // console.error(this.props.url, status, err.toString());
                        Swal.fire({
                            icon: 'error',
                            title: textStatus,
                            text: errorThrown,
                        });
                        funcReloadDT()
                    }
                });
            }
        })
    }
</script>
<script>
    $(document).ready(function() {
        funcLoadDT();
    });
</script>