<main class="content">
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <!-- <h5 class="card-title">The</h5> -->
                        <!-- <h6 class="card-subtitle text-muted">The</h6> -->
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-info btn-lg mb-3 mb-lg-4" onclick="funcAddData()">Tambah Data <i class="fa-solid fa-plus"></i></button>
                        <table id="datatabless" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Gejala</th>
                                    <th>Terakhir Diubah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Gejala</th>
                                    <th>Terakhir Diubah</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL UPDATE DATA -->
    <div class="modal fade modal-lg" id="modal" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title card-title" id="modalTitle">?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" id="modalForm">
                        <input type="hidden" id="id" name="id" value="">
                        <div class="mb-3">
                            <label for="nama_gejala" class="col-form-label fw-bold">Nama Gejala</label>
                            <textarea class="form-control" id="nama_gejala" name="nama_gejala"></textarea>
                            <?= form_error('nama_gejala', '<small class="text-danger">', '</small>'); ?>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnSimpan">Simpan</button>
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
<script>
    function tippyjs(id, content) {
        tippy('#' + id, {
            placement: 'bottom-end',
            allowHTML: true,
            delay: [700, 0],
            content: content,
        });
    }
    tippyjs('notulen-pdf', 'Preview Notulen');
    tippyjs('notulen-peserta', 'Lihat Perserta');
</script>
<script>
    var table = $('#datatabless');
    var modal = $('#modal');
    var modalForm = $('#modalForm');
    var modalTitle = $('#modalTitle');
    var btnSimpan = $('#btnSimpan');
    var simpanData; // tambah || edit
    var InputValidation;
    var data_namaGejala;

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
                                columns: [0, 1, 2]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            exportOptions: {
                                // columns: ':visible'
                                columns: [0, 1, 2]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: [0, 1, 2]
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: [0, 1, 2]
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
                url: '<?= base_url('diagnosis/loadDataGejala'); ?>',
                type: "POST"
            },
            columnDefs: [{
                    target: [0, -1],
                    orderable: false,
                },
                {
                    className: "dt-head-left",
                    targets: [0, 1, 2, 3]
                },
            ],
        });
    }

    function modalSet(_simpanData, modalTitle_text) {
        // Conf type save data
        if (simpanData == 'edit') {
            modalForm[0].reset();
        }
        simpanData = _simpanData;

        // Conf Modal
        btnSimpan.text('Simpan');
        btnSimpan.attr('disabled', false);
        modalTitle.text(modalTitle_text);

        // Reset Form Validation
        $('#modalForm input[type=text]').removeClass('is-valid is-invalid');
        $('#modalForm textarea').removeClass('is-valid is-invalid');
        InputValidation.resetForm();
    }

    // Fungsi Tambah Data
    function funcAddData() {
        modalSet('tambah', 'Tambah Data Gejala');
        modal.modal('show').on('shown.bs.modal', function() {
            $('#nama_gejala').focus();
        });
    }

    // Fungsi Update Data
    function funcUpdateData(id, type) {
        if (type == 'edit') {
            modalSet('edit', 'Edit Data Gejala');
        }

        // Get data by Id
        $.ajax({
            type: 'GET',
            url: "<?= base_url('diagnosis/loadDataGejalaByID/'); ?>" + id,
            dataType: "JSON",
            success: function(resp) {
                if (type == 'edit') {
                    $('[name="id"]').val(resp.id);
                    $('[name="nama_gejala"]').val(resp.nama_gejala);
                    data_namaGejala = resp.nama_gejala;
                    modal.modal('show').on('shown.bs.modal', function() {
                        $('#nama_gejala').blur();
                    });
                } else {
                    Swal.fire({
                        title: "Hapus data gejala?",
                        html: "Semua data terkait gejala ini akan dihapus <br><span class='fw-bold'>secara permanen</span>.",
                        // html: "Semua data terkait gejala ini akan dimasukkan ke <br><span class='fw-bold'>daftar sampah</span>.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Hapus',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            funcHapusData(resp.id);
                        }
                    })
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
                // console.error(this.props.url, status, err.toString());
                Swal.fire({
                    icon: 'error',
                    title: textStatus,
                    text: errorThrown,
                });
            }
        });

    }

    // Fungsi Reload DataTable
    function funcReloadDT() {
        table.DataTable().ajax.reload();
    }

    // Fungsi Simpan Data
    function funcsimpanData() {
        var title;
        btnSimpan.text('Processing..');
        btnSimpan.attr('disabled', true);
        if (simpanData == 'tambah') {
            url = "<?= base_url('diagnosis/tambahDataGejala'); ?>";
            title = 'Data Berhasil Ditambahkan';
        } else if (simpanData == 'edit') {
            url = "<?= base_url('diagnosis/ubahDataGejala'); ?>";
            title = 'Data Berhasil Diupdate';
        }
        $.ajax({
            type: 'POST',
            url: url,
            data: modalForm.serialize(),
            dataType: "JSON",
            success: function(resp) {
                if (resp.status == 'success') {
                    modal.modal('hide');
                    modalForm[0].reset();
                    funcReloadDT();
                    setTimeout(function() {
                        Custom.fire({
                            icon: 'success',
                            title: title,
                        });
                    }, 300);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
                // console.error(this.props.url, status, err.toString());
                Swal.fire({
                    icon: 'error',
                    title: textStatus,
                    text: errorThrown,
                });
            }
        });
    }

    // Fungsi Hapus Data
    function funcHapusData(id) {
        $.ajax({
            type: 'GET',
            url: '<?= base_url('diagnosis/hapusDataGejala/'); ?>' + id,
            dataType: 'JSON',
            success: function(resp) {
                Custom.fire({
                    icon: 'success',
                    title: 'Data Berhasil Dihapus',
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
            },
        });
    }

    // Validasi Modal Input
    function validateInput() {
        InputValidation = modalForm.validate({
            rules: {
                nama_gejala: {
                    required: true,
                    remote: {
                        // remote: base_url + "user/cekpassword",
                        url: "<?= base_url('diagnosis/cekValidateGejala'); ?>",
                        type: "POST",
                        data: {
                            nama_gejala: function() {
                                return $("#modalForm textarea[name='nama_gejala']").val();
                            },
                            simpanData: function() {
                                return simpanData;
                            },
                            data_namaGejala: function() {
                                return data_namaGejala;
                            },
                        }
                    },
                },
            },
            messages: {
                nama_gejala: {
                    required: "Nama gejala tidak boleh kosong",
                    remote: "Nama gejala sudah terinput",
                },
            },
            highlight: function(element, errorClass) {
                $(element).closest("#nama_gejala").addClass("is-invalid");
            },
            unhighlight: function(element, errorClass) {
                $(element).closest("#nama_gejala").removeClass("is-invalid");
            },
            submitHandler: function() {
                funcsimpanData();
            }
        });
    }

    $(document).ready(function() {
        funcLoadDT();
        validateInput();
    });
</script>