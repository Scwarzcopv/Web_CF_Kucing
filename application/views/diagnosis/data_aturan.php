<style>
    /* .choices__list--dropdown,
    .choices__list[aria-expanded] {
        word-break: break-word;
        width: max-content;
    } */
    .tippy-box[data-theme~=danger] {
        /* color: #26323d; */
        box-shadow: 0 0 20px 4px rgba(154, 161, 177, .15), 0 4px 80px -8px rgba(36, 40, 47, .25), 0 4px 4px -2px rgba(91, 94, 105, .15);
        background-color: #dc3545
    }

    .tippy-box[data-theme~=danger] {
        color: #fff;
        box-shadow: 0 0 20px 4px rgba(154, 161, 177, .15), 0 4px 80px -8px rgba(36, 40, 47, .25), 0 4px 4px -2px rgba(91, 94, 105, .15);
        background-color: #dc3545
    }

    .tippy-box[data-theme~=danger][data-placement^=top]>.tippy-arrow:before {
        border-top-color: #dc3545
    }

    .tippy-box[data-theme~=danger][data-placement^=bottom]>.tippy-arrow:before {
        border-bottom-color: #dc3545
    }

    .tippy-box[data-theme~=danger][data-placement^=left]>.tippy-arrow:before {
        border-left-color: #dc3545
    }

    .tippy-box[data-theme~=danger][data-placement^=right]>.tippy-arrow:before {
        border-right-color: #dc3545
    }

    .tippy-box[data-theme~=danger]>.tippy-backdrop {
        background-color: #dc3545
    }

    .tippy-box[data-theme~=danger]>.tippy-svg-arrow {
        fill: #dc3545
    }
</style>
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
                                    <th scope="col">No</th>
                                    <th>Penyakit</th>
                                    <th>Gejala</th>
                                    <th>MB</th>
                                    <th>MD</th>
                                    <th>Terakhir Diubah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="col">No</th>
                                    <th>Penyakit</th>
                                    <th>Gejala</th>
                                    <th>MB</th>
                                    <th>MD</th>
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
                            <label for="choices_penyakit" class="col-form-label fw-bold">Nama Penyakit</label>
                            <select class="form-control choices-penyakit" id="choices_penyakit" name="choices_penyakit">
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="choices_gejala" class="col-form-label fw-bold">Nama Gejala</label>
                            <div class="closest-gejala d-none">
                                <select class="form-control choices-gejala" id="choices_gejala" name="choices_gejala">
                                </select>
                            </div>
                            <div id="" class="spinner-border spinner-border-sm text-primary loading-gejala ms-2" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <div class="d-flex justify-content-center mt-1 closest-kombinasi">
                                <div id="kombinasi" class="fw-bold">...</div>
                                <div id="kombinasi-warning" class="fw-bold"><i class="fas fa-exclamation-circle text-warning"></i> Kombinasi sudah terpakai</div>
                                <div id="kombinasi-success" class="fw-bold"><i class="fas fa-check-circle text-success"></i> Kombinasi belum pernah dipakai</div>
                                <div id="kombinasi-loading" class="spinner-border spinner-border-sm text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 col-lg-6">
                                <!-- <label for="choices_mb" class="col-form-label fw-bold">MB <i class="fas fa-info-circle text-primary"></i></label> -->
                                <label for="choices_mb" class="col-form-label fw-bold position-relative">MB
                                    <span class="position-absolute top-25 start-100 translate-middle badge text-primary " id="label-choices_mb">
                                        <i class="fas fa-info-circle text-primary"></i>
                                    </span>
                                </label>
                                <select class="form-control choices-mb" id="choices_mb" name="choices_mb">
                                </select>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="choices_md" class="col-form-label fw-bold position-relative">MD
                                    <span class="d-none position-absolute top-25 start-100 translate-middle badge text-primary " id="label-choices_md">
                                        <i class="far fa-exclamation-circle text-danger"></i>
                                    </span></label>
                                <select class="form-control choices-md" id="choices_md" name="choices_md">
                                </select>
                            </div>
                        </div>
                        <div class="rounded rounded-3 p-2 p-lg-3 text-white" style="background-color: rgba(253,157,10,255);">
                            <p class="fs-3 fw-bold text-center"><i class="fa-solid fa-triangle-exclamation me-2 mb-2"></i> Petunjuk Pengisian Pakar <i class="fa-solid fa-triangle-exclamation ms-2 mb-2"></i></p>
                            <p class="mb-0">Silahkan pilih gejala yang sesuai dengan penyakit yang ada, dan berikan <strong>nilai kepastian (MB & MD)</strong> dengan cakupan sebagai berikut:</p>
                            <ul class="">
                                <li><strong>0.1 — 0.4</strong> (Kemungkinan Kecil)</li>
                                <li><strong>0.5 — 0.7</strong> (Kemungkinan Besar)</li>
                                <li><strong>0.8 — 1.0</strong> (Pasti Ada)</li>
                                <!-- <li><strong>1.0</strong> (Pasti Ya)</li>
                                <li><strong>0.8</strong> (Hampir Pasti)</li>
                                <li><strong>0.6</strong> (Kemungkinan Besar)</li>
                                <li><strong>0.4</strong> (Mungkin)</li>
                                <li><strong>0.2</strong> (Hampir Mungkin)</li>
                                <li><strong>0.0</strong> (Tidak Tahu atau Tidak Yakin)</li> -->
                            </ul>
                            <p class="mb-0"><strong>CF(Pakar) = MB-MD</strong></p>
                            <table>
                                <tr>
                                    <td>MB</td>
                                    <td> : Ukuran kenaikan kepercayaan (measure of increased belief)</td>
                                </tr>
                                <tr>
                                    <td>MD</td>
                                    <td> : Ukuran kenaikan ketidakpercayaan (measure of increased disbelief)</td>
                                </tr>
                            </table>
                            <p class="mt-2 mb-0"><strong>Contoh:</strong></p>
                            Jika kepercayaan <strong>(MB)</strong> anda terhadap gejala ... untuk penyakit ... adalah <strong>0.8 (Hampir Pasti)</strong><br>
                            Dan ketidakpercayaan <strong>(MD)</strong> anda terhadap gejala ... untuk penyakit ... adalah <strong>0.2 (Hampir Mungkin)</strong>
                            <p class="mt-2 mb-0"><strong>Maka:</strong></p>
                            CF(Pakar) = MB-MD (0.8 - 0.2) = 0.6 <br>
                            Dimana nilai kepastian anda terhadap gejala ... untuk penyakit ... adalah <strong>0.6 (Kemungkinan Besar)</strong>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnSimpan" onclick="funcsimpanData()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</main>




<!-- Tutup elemen dari topbar.php -->
</div>
<?= $this->session->flashdata('message'); ?>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>
<script src="<?= base_url('assets'); ?>/js/customsweetalert.js"></script>
<script>
    function tippyjs(id, content, placement, arrow = false, animation = 'shift-away-extreme', theme = 'default') {
        tippy('#' + id, {
            placement: placement,
            animation: animation,
            arrow: arrow,
            allowHTML: true,
            // delay: [700, 0],
            content: content,
            theme: theme,
        });
    }
    tippyjs('label-choices_mb', '<small><strong>MB</strong> harus ≥ <strong>MD</strong></small>', 'top-start', true, 'fade');
    tippyjs('label-choices_md', '<small><i class="far fa-exclamation-circle"></i> <strong>MB</strong> kurang dari <strong>MD</strong></small>', 'top-start', true, 'fade', 'danger');
    tippyjs("kombinasi", "Inputkan <strong>'Nama Penyakit'</strong> dan <strong>'Nama Gejala'</strong>", "bottom");
    tippyjs("kombinasi-warning", "<div class='text-center'>Data <br><strong>'Nama Penyakit'</strong> dan <strong>'Nama Gejala'</strong><br> sudah terinput</div>", "bottom");
    tippyjs("kombinasi-success", "<div class='text-center'>Data <br><strong>'Nama Penyakit'</strong> dan <strong>'Nama Gejala'</strong><br> belum pernah terinput</div>", "bottom");
    // tippyjs();
</script>
<script>
    var table = $('#datatabless');
    var modal = $('#modal');
    var modalForm = $('#modalForm');
    var modalTitle = $('#modalTitle');
    var btnSimpan = $('#btnSimpan');
    var simpanData; // tambah || edit
    var InputValidation;
    var data_namaAturan;
    var noId = 0;
    // 
    let closest_gejala = $('.closest-gejala');
    let closest_kombinasi = $('.closest-kombinasi');
    let loading_gejala = $('.loading-gejala');
    // Choices
    var choicesPenyakit;
    var choicesGejala;
    var choicesMB;
    var choicesMD;
    var activeCP = false;
    var activeCG = false;
    var activeCMB = false;
    var activeCMD = false;

    var active_id_penyakit;
    var active_id_aturan;

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
            responsive: true,
            processing: true, //Feature control the processing indicator.
            serverSide: true, //Feature control DataTables' server-side processing mode.
            order: [], //Initial no order.
            ajax: {
                url: '<?= base_url('diagnosis/loadDataAturan'); ?>',
                type: "POST"
            },
            columnDefs: [{
                    target: [0, -1],
                    orderable: false,
                },
                {
                    className: "dt-head-left",
                    targets: [0, 1, 2, 3, 4, 5, 6]
                },
            ],
        });
    }

    function modalSet(_simpanData, modalTitle_text) {
        // Conf type save data
        // if (simpanData == 'edit') {
        modalForm[0].reset();
        // }
        simpanData = _simpanData;
        if (simpanData == 'tambah') {
            closest_gejala.removeClass('d-none');
            loading_gejala.addClass('d-none');
            closest_kombinasi.removeClass('d-none');
        } else if (simpanData == 'edit') {
            closest_gejala.addClass('d-none');
            loading_gejala.removeClass('d-none');
            closest_kombinasi.addClass('d-none');
        }

        // Conf Modal
        $('#kombinasi').show();
        $('#kombinasi-warning').hide();
        $('#kombinasi-success').hide();
        $('#kombinasi-loading').hide();
        $('#label-choices_md').addClass('d-none');
        activeCP = false;
        activeCG = false;
        activeCMB = false;
        activeCMD = false;
        btnSimpan.text('Simpan');
        btnSimpan.attr('disabled', true);
        modalTitle.text(modalTitle_text);
    }

    // Fungsi Tambah Data
    function funcAddData() {
        modalSet('tambah', 'Tambah Data Aturan');
        funcChoicesMenu();
        funcChoicesMenuM();
        modal.modal('show');
    }

    // Fungsi Update Data
    function funcUpdateData(id, type) {
        active_id_aturan = id;

        function getDatabyId() {
            $.ajax({
                type: 'GET',
                url: "<?= base_url('diagnosis/loadDataAturanByID/'); ?>" + id,
                dataType: "JSON",
                success: function(resp) {
                    if (type == 'edit') {
                        console.log(resp)
                        // $('[name="choices_md"]').val(resp.id_gejala);
                        $('[name="id"]').val(resp.id);
                        choicesPenyakit.setChoiceByValue(resp.id_penyakit);
                        choicesGejala.setChoiceByValue(resp.id_gejala);
                        choicesMB.setChoiceByValue(parseFloat(resp.mb));
                        choicesMD.setChoiceByValue(parseFloat(resp.md));
                        active_id_penyakit = resp.id_penyakit;
                        // $('[name="nama_gejala"]').val(resp.nama_gejala);
                        // data_namaGejala = resp.nama_gejala;
                        modal.modal('show');
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
        if (type == 'edit') {
            modalSet('edit', 'Edit Data Aturan');
            btnSimpan.attr('disabled', false);
            funcChoicesMenu(id, function() {
                getDatabyId();
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
                    funcHapusData(id);
                    funcReloadDT();
                }
            })
        }

        // Get data by Id


    }

    // Fungsi Hapus Data
    function funcHapusData(id) {
        $.ajax({
            type: 'GET',
            url: '<?= base_url('diagnosis/hapusDataAturan/'); ?>' + id,
            dataType: 'JSON',
            success: function(resp) {
                Custom.fire({
                    icon: 'success',
                    title: 'Data Berhasil Dihapus',
                });
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

    // Fungsi Reload DataTable
    function funcReloadDT() {
        table.DataTable().ajax.reload();
    }

    // Fungsi Simpan Data
    function funcsimpanData() {
        // console.log($('#choices_penyakit').find(":selected").val());
        var title;
        btnSimpan.text('Processing..');
        btnSimpan.attr('disabled', true);
        if (simpanData == 'tambah') {
            url = "<?= base_url('diagnosis/cekKombinasiAturan'); ?>";
            title = 'Data Berhasil Ditambahkan';
        } else if (simpanData == 'edit') {
            url = "<?= base_url('diagnosis/ubahDataAturan'); ?>";
            title = 'Data Berhasil Diupdate';
        }
        $.ajax({
            type: 'POST',
            url: url,
            data: modalForm.serialize(),
            dataType: "JSON",
            success: function(resp) {
                console.log(resp)
                console.log(modalForm.serialize());
                // console.log($('#id').val())
                // console.log(active_id_aturan)
                if (resp.num_rows <= 0) {
                    $.ajax({
                        url: "<?= base_url('diagnosis/tambahDataAturan'); ?>",
                        method: "POST",
                        data: modalForm.serialize(),
                        dataType: "JSON",
                        success: function(resp) {
                            if (resp.status == 'success') {
                                modal.modal('hide');
                                // modalForm[0].reset();
                                funcReloadDT();
                                setTimeout(function() {
                                    Custom.fire({
                                        icon: 'success',
                                        title: 'Data Berhasil Ditambahkan',
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
                } else {
                    Swal.fire({
                        title: "Timpa Data?",
                        html: "Data saat ini akan ditimpa dengan data yang baru.",
                        icon: "warning",
                        showCancelButton: true,
                        cancelButtonColor: '#d33',
                        confirmButtonColor: '#3085d6',
                        cancelButtonText: 'Batal',
                        confirmButtonText: 'Ubah',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "<?= base_url('diagnosis/tambahDataAturan'); ?>",
                                method: "POST",
                                data: modalForm.serialize(),
                                dataType: "JSON",
                                success: function(resp) {
                                    if (resp.status == 'success') {
                                        modal.modal('hide');
                                        // modalForm[0].reset();
                                        funcReloadDT();
                                        setTimeout(function() {
                                            Custom.fire({
                                                icon: 'success',
                                                title: 'Data Berhasil Diupdate',
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
                        } else {
                            btnSimpan.text('Simpan');
                            btnSimpan.attr('disabled', false);
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

    function funcChoicesMenuM() {
        var arr_M = [0.0, 0.1, 0.12, 0.13, 0.14, 0.15, 0.16, 0.17, 0.18, 0.19, 0.20,
            0.21, 0.22, 0.23, 0.24, 0.25, 0.26, 0.27, 0.28, 0.29, 0.30,
            0.31, 0.32, 0.33, 0.34, 0.35, 0.36, 0.37, 0.38, 0.39, 0.40,
            0.41, 0.42, 0.43, 0.44, 0.45, 0.46, 0.47, 0.48, 0.49, 0.50,
            0.51, 0.52, 0.53, 0.54, 0.55, 0.56, 0.57, 0.58, 0.59, 0.60,
            0.61, 0.62, 0.63, 0.64, 0.65, 0.66, 0.67, 0.68, 0.69, 0.70,
            0.71, 0.72, 0.73, 0.74, 0.75, 0.76, 0.77, 0.78, 0.79, 0.80,
            0.81, 0.82, 0.83, 0.84, 0.85, 0.86, 0.87, 0.88, 0.89, 0.90,
            0.91, 0.92, 0.93, 0.94, 0.95, 0.96, 0.97, 0.98, 0.99, 1.0,
        ];
        var arr_MNew = [];

        // CHOICES M
        choicesMB.clearStore();
        choicesMD.clearStore();
        choicesMB.clearChoices();
        choicesMD.clearChoices();
        $.each(arr_M, function(index, data) {
            arr_MNew.push({
                value: data,
                label: '' + data,
            });
        });
        choicesMB.setChoices(
            arr_MNew,
            'value',
            'label',
            false,
        );
        choicesMD.setChoices(
            arr_MNew,
            'value',
            'label',
            false,
        );
    }

    function funcChoicesMenu(id = null, callback = function() {}) {
        var arr_penyakit = [];
        var arr_gejala = [];
        var selected;
        var url;
        funcChoicesMenuM();
        if (simpanData == 'tambah') {
            url = '<?= base_url('diagnosis/loadDataChoices'); ?>';
        } else {
            url = '<?= base_url('diagnosis/loadDataChoices2'); ?>';
            closest_gejala.addClass('d-none');
            loading_gejala.removeClass('d-none');
        }

        $.ajax({
            type: 'POST',
            url: url,
            data: {
                id_aturan: id
            },
            dataType: 'JSON',
            success: function(resp) {
                // CHOICES PENYAKIT
                choicesPenyakit.clearChoices();
                $.each(resp['data_penyakit'], function(index, data) {
                    selected = false;
                    if (index == 0) {
                        // selected = true;
                    }
                    // $('#optgroup-penyakit').append('<option value="' + data['id'] + '">' + data['nama_penyakit'] + '</option>');
                    arr_penyakit.push({
                        value: data['id'],
                        label: data['nama_penyakit'],
                        selected: selected
                    });
                });
                choicesPenyakit.setChoices(
                    arr_penyakit,
                    'value',
                    'label',
                    false,
                );

                // CHOICES GEJALA
                choicesGejala.clearChoices();
                $.each(resp['data_gejala'], function(index, data) {
                    selected = false;
                    if (index == 0) {
                        // selected = true;
                    }
                    // $('#optgroup-gejala').append('<option value="' + data['id'] + '">' + data['nama_gejala'] + '</option>');
                    arr_gejala.push({
                        value: data['id'],
                        label: data['nama_gejala'],
                        selected: selected
                    });
                });
                choicesGejala.setChoices(
                    arr_gejala,
                    'value',
                    'label',
                    false,
                );

                // 
                if (simpanData == 'edit') {
                    closest_gejala.removeClass('d-none');
                    loading_gejala.addClass('d-none');
                }
                callback();
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

    function funcChoices() {
        let choicesSettings = {
            noResultsText: 'Tidak ada hasil yang ditemukan',
            noChoicesText: 'Tidak ada pilihan untuk dipilih',
            itemSelectText: 'Tekan untuk memilih',
        }
        let choicesSearchFalse = {
            ...choicesSettings,
            searchEnabled: true,
        }
        choicesPenyakit = new Choices(document.querySelector(".choices-penyakit"), choicesSettings);
        choicesGejala = new Choices(document.querySelector(".choices-gejala"), choicesSettings);
        choicesMB = new Choices(document.querySelector(".choices-mb"), choicesSearchFalse);
        choicesMD = new Choices(document.querySelector(".choices-md"), choicesSearchFalse);
    }

    function funcFormVerify() {
        // function activeC() {
        //     if (simpanData == 'tambah') {
        //         if (activeCP == true && activeCG == true && activeCMB == true && activeCMD == true) {
        //             btnSimpan.attr('disabled', false);
        //         } else {
        //             btnSimpan.attr('disabled', true);
        //         }
        //     } else if (simpanData == 'edit') {
        //         if (activeCG == true && activeCMB == true && activeCMD == true) {
        //             btnSimpan.attr('disabled', false);
        //         } else {
        //             btnSimpan.attr('disabled', true);
        //         }
        //     }
        // }
        function activeC() {
            var valCP = $('#choices_penyakit').val();
            var valCG = $('#choices_gejala').val();
            var valCMB = $('#choices_mb').val();
            var valCMD = $('#choices_md').val();
            if (valCP != null && valCG != null && valCMB != null && valCMD != null) {
                if (valCMB >= valCMD) {
                    btnSimpan.attr('disabled', false);
                    $('#label-choices_md').addClass('d-none');
                } else {
                    btnSimpan.attr('disabled', true);
                    $('#label-choices_md').removeClass('d-none');
                }
            } else {
                btnSimpan.attr('disabled', true);
            }
        }

        function messageKombinasi() {
            if ($("#choices_penyakit").val() != null && $("#choices_gejala").val() != null) {
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url('diagnosis/cekKombinasiAturan'); ?>',
                    data: modalForm.serialize(),
                    dataType: 'JSON',
                    beforeSend: function() {
                        $('#kombinasi').hide();
                        $('#kombinasi-warning').hide();
                        $('#kombinasi-success').hide();
                        $('#kombinasi-loading').show();
                    },
                    success: function(resp) {
                        if (resp.num_rows <= 0) {
                            $('#kombinasi').hide();
                            $('#kombinasi-warning').hide();
                            $('#kombinasi-success').show();
                            $('#kombinasi-loading').hide();
                            choicesMB.clearStore();
                            choicesMD.clearStore();
                            funcChoicesMenuM();
                            activeC();
                        } else if (resp.num_rows > 0) {
                            $('#kombinasi').hide();
                            $('#kombinasi-warning').show();
                            $('#kombinasi-success').hide();
                            $('#kombinasi-loading').hide();
                            choicesMB.setChoiceByValue(parseFloat(resp.row_array['mb']));
                            choicesMD.setChoiceByValue(parseFloat(resp.row_array['md']));
                            $('#id').val(resp.row_array['id']);
                            activeC();
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
                    },
                });
            }
        }

        $("#choices_penyakit").change(function() {
            activeC();
            messageKombinasi();
        });

        $("#choices_gejala").change(function() {
            activeC();
            messageKombinasi();
        });

        $("#choices_mb").change(function() {
            activeC();
        });

        $("#choices_md").change(function() {
            activeC();
        });
    }

    function funcAdjustGejala() {
        function activeC() {
            var valCP = $('#choices_penyakit').val();
            var valCG = $('#choices_gejala').val();
            var valCMB = $('#choices_mb').val();
            var valCMD = $('#choices_md').val();
            if (valCP != null && valCG != null && valCMB != null && valCMD != null) {
                if (valCMB >= valCMD) {
                    btnSimpan.attr('disabled', false);
                } else {
                    btnSimpan.attr('disabled', true);
                }
            } else {
                btnSimpan.attr('disabled', true);
            }
            $('#label-choices_md').addClass('d-none');
        }
        $('#choices_penyakit').change(function() {
            if (simpanData == 'edit') {
                var id_penyakit = $('#choices_penyakit').val();
                var arr_gejala = [];
                var selected;
                var url = '<?= base_url('diagnosis/loadDataChoices2'); ?>';
                closest_gejala.addClass('d-none');
                loading_gejala.removeClass('d-none');

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        active_id_penyakit: active_id_penyakit,
                        id_penyakit: id_penyakit,
                        id_aturan: active_id_aturan
                    },
                    dataType: 'JSON',
                    success: function(resp) {
                        // CHOICES GEJALA
                        choicesGejala.clearStore();
                        choicesMB.clearStore();
                        choicesMD.clearStore();
                        choicesGejala.clearChoices();
                        $.each(resp['data_gejala'], function(index, data) {
                            selected = false;
                            if (index == 0) {
                                // selected = true;
                            }
                            // $('#optgroup-gejala').append('<option value="' + data['id'] + '">' + data['nama_gejala'] + '</option>');
                            arr_gejala.push({
                                value: data['id'],
                                label: data['nama_gejala'],
                                selected: selected
                            });
                        });
                        choicesGejala.setChoices(
                            arr_gejala,
                            'value',
                            'label',
                            false,
                        );
                        closest_gejala.removeClass('d-none');
                        loading_gejala.addClass('d-none');
                        funcChoicesMenuM();
                        activeC();
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
        });
    }

    $(document).ready(function() {
        funcLoadDT();
        funcChoices();
        funcFormVerify();
        funcAdjustGejala();
    });
</script>