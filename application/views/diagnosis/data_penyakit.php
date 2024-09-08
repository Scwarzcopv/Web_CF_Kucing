<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" /> -->
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
                        <!-- <button type="button" class="btn btn-info btn-lg mb-3 mb-lg-4" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Data <i class="fa-solid fa-plus"></i></button> -->
                        <button type="button" class="btn btn-info btn-lg mb-3 mb-lg-4" onclick="funcAddData()">Tambah Data <i class="fa-solid fa-plus"></i></button>
                        <table id="datatabless" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th>Nama Penyakit</th>
                                    <th>Detail Penyakit</th>
                                    <th>Saran Penyakit</th>
                                    <th>Terakhir Diubah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="col">No</th>
                                    <th>Nama Penyakit</th>
                                    <th>Detail Penyakit</th>
                                    <th>Saran Penyakit</th>
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
                            <label for="nama_penyakit" class="col-form-label fw-bold">Nama Penyakit</label>
                            <input type="text" class="form-control" id="nama_penyakit" name="nama_penyakit">
                            <?= form_error('nama_penyakit', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="mb-3">
                            <label for="detail_penyakit" class="col-form-label fw-bold">Detail Penyakit</label>
                            <textarea class="form-control" id="detail_penyakit" name="detail_penyakit"></textarea>
                            <?= form_error('detail_penyakit', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="mb-3">
                            <label for="saran_penyakit" class="col-form-label fw-bold">Saran Penyakit</label>
                            <textarea class="form-control" id="saran_penyakit" name="saran_penyakit"></textarea>
                            <?= form_error('saran_penyakit', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="text-center">
                            <img alt="Gambar Penyakit" src="<?= base_url('assets/img/default/gambar_penyakit_default.png'); ?>" class="rounded border border-1 border-secondary img-responsive mt-2" width="128" height="128" id="gambar_penyakit" />
                            <div class="mt-2">
                                <span class="btn btn-primary btn-file"><i class="fas fa-upload"></i> Upload <input type="file" accept=".jpg, .jpeg, .png" id="upload_image" data-img=""></span>
                            </div>
                            <small id="nama_gambar">Format jpg/jpeg/png</small>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnSimpan">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL EDIT IMAGE -->
    <div class="modal fade" id="modal_edit_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalLabel">Crop Gambar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-8 col-md-8 d-flex d-md-block">
                                <div class="col-12" style="height: 75vh;">
                                    <img src="" id="sample_image" class=" fit-image " />
                                </div>
                            </div>
                            <div class="col-4 col-md-4 d-flex align-items-center justify-content-center ">
                                <div class="preview border border-1 border-secondary"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
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
    var data_namaPenyakit;
    var formatGambar = "Format jpg/jpeg/png"; //id: nama_gambar
    var defaultSrcImg = "<?= base_url('assets/img/default/gambar_penyakit_default.png'); ?>"; //id: gambar_penyakit
    var defaultNamaImg = "gambar_penyakit_default.png"; //id: nama_gambar
    var nama_gambar_input;
    var sendImage = null;
    var oldImage = null;

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
                url: '<?= base_url('diagnosis/loadDataPenyakit'); ?>',
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
        modalSet('tambah', 'Tambah Data Penyakit');
        modal.modal('show').on('shown.bs.modal', function() {
            $('#nama_penyakit').focus();
        });
    }

    // Fungsi Update Data
    function funcUpdateData(id, type) {
        if (type == 'edit') {
            modalSet('edit', 'Edit Data Penyakit');
        }

        // Get data by Id
        $.ajax({
            type: 'GET',
            url: "<?= base_url('diagnosis/loadDataPenyakitByID/'); ?>" + id,
            dataType: "JSON",
            success: function(resp) {
                if (type == 'edit') {
                    $('[name="id"]').val(resp.id);
                    $('[name="nama_penyakit"]').val(resp.nama_penyakit);
                    data_namaPenyakit = resp.nama_penyakit;
                    $('[name="detail_penyakit"]').val(resp.detail_penyakit);
                    $('[name="saran_penyakit"]').val(resp.saran_penyakit);
                    // Gambar
                    var base_url = '<?= base_url('assets/img/penyakit/'); ?>';
                    if (resp.img_penyakit == 'gambar_penyakit_default.png') {
                        base_url = '<?= base_url('assets/img/default/'); ?>';
                    }
                    var img_src = base_url + resp.img_penyakit;
                    $('#gambar_penyakit').attr('src', img_src);
                    $('#upload_image').attr('data-img', resp.img_penyakit);
                    // End-Gambar
                    modal.modal('show').on('shown.bs.modal', function() {
                        $('#nama_penyakit').blur();
                    });
                    modal.on('hidden.bs.modal', function() {
                        $('#gambar_penyakit').attr('src', defaultSrcImg);
                        $('#nama_gambar').html(formatGambar);
                    });
                } else {
                    Swal.fire({
                        title: "Hapus data penyakit?",
                        html: "Semua data terkait penyakit ini akan dihapus <br><span class='fw-bold'>secara permanen</span>.",
                        // html: "Semua data terkait penyakit ini akan dimasukkan ke <br><span class='fw-bold'>daftar sampah</span>.",
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
        var data;
        btnSimpan.text('Processing..');
        btnSimpan.attr('disabled', true);
        if (simpanData == 'tambah') {
            url = "<?= base_url('diagnosis/tambahDataPenyakit'); ?>";
            title = 'Data Berhasil Ditambahkan';
        } else if (simpanData == 'edit') {
            url = "<?= base_url('diagnosis/ubahDataPenyakit'); ?>";
            title = 'Data Berhasil Diupdate';
        }

        // data = modalForm.serialize();
        $.ajax({
            type: 'POST',
            url: url,
            // data: data,
            data: {
                id: $('#id').val(),
                nama_penyakit: $.trim($('#nama_penyakit').val()),
                detail_penyakit: $.trim($('#detail_penyakit').val()),
                saran_penyakit: $.trim($('#saran_penyakit').val()),
                oldImage: oldImage,
                image: sendImage,
                // username: username,
            },
            dataType: "JSON",
            success: function(resp) {
                sendImage = null;
                oldImage = null;
                $('#gambar_penyakit').attr('src', defaultSrcImg);
                $('#nama_gambar').html(formatGambar);
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
                console.log($('#id').val());
                console.log($('#nama_penyakit').val());
                console.log($('#detail_penyakit').val());
                console.log($('#saran_penyakit').val());
                console.log(oldImage);
                console.log(sendImage);
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
            url: '<?= base_url('diagnosis/hapusDataPenyakit/'); ?>' + id,
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
                nama_penyakit: {
                    required: true,
                    remote: {
                        // remote: base_url + "user/cekpassword",
                        url: "<?= base_url('diagnosis/cekValidatePenyakit'); ?>",
                        type: "POST",
                        data: {
                            nama_penyakit: function() {
                                return $("#modalForm input[name='nama_penyakit']").val();
                            },
                            simpanData: function() {
                                return simpanData;
                            },
                            data_namaPenyakit: function() {
                                return data_namaPenyakit;
                            },
                        }
                    },
                },
                detail_penyakit: {
                    required: true,
                },
                saran_penyakit: {
                    required: true,
                },
            },
            messages: {
                nama_penyakit: {
                    required: "Nama penyakit tidak boleh kosong",
                    remote: "Nama penyakit sudah terinput",
                },
                detail_penyakit: {
                    required: "Detail penyakit tidak boleh kosong",
                },
                saran_penyakit: {
                    required: "Saran penyakit tidak boleh kosong",
                },
            },
            highlight: function(element, errorClass) {
                $(element).closest("#nama_penyakit").addClass("is-invalid");
                $(element).closest("#detail_penyakit").addClass("is-invalid");
                $(element).closest("#saran_penyakit").addClass("is-invalid");
            },
            unhighlight: function(element, errorClass) {
                $(element).closest("#nama_penyakit").removeClass("is-invalid");
                $(element).closest("#detail_penyakit").removeClass("is-invalid");
                $(element).closest("#saran_penyakit").removeClass("is-invalid");
            },
            submitHandler: function() {
                funcsimpanData();
            }
        });
    }

    // Crop Input Gambar
    function cropImage() {
        var modal_img = $('#modal_edit_modal');
        var image;
        var cropper;
        // Konfigurasi image cropper
        $('#upload_image').change(function(event) {
            nama_gambar_input = $('#upload_image').val().replace(/C:\\fakepath\\/i, '');
            image = $('#sample_image')[0];
            var files = event.target.files;
            var done = function(url) {
                image.src = url;
                modal_img.modal('show');
            };
            if (files && files.length > 0) {
                reader = new FileReader();
                reader.onload = function(event) {
                    done(reader.result);
                };
                reader.readAsDataURL(files[0]);
            }
        });

        modal_img.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 1,
                preview: '.preview',
                dragMode: 'move',
                // responssive: true,
            });
        }).on('hidden.bs.modal', function() {
            $('#upload_image').val('');
            cropper.destroy();
            cropper = null;
        });

        // Trigger crop
        $("#crop").click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 800,
                height: 800,
            });
            canvas.toBlob(function(blob) {
                var reader = new FileReader();

                reader.readAsDataURL(blob);
                reader.onloadend = function(e) {
                    base64data = reader.result;
                    sendImage = base64data;
                    oldImage = $('#upload_image').attr('data-img');
                    // console.log(sendImage);
                    // var username = $('#username').val();

                    // $.ajax({
                    //     url: base_url + "user/editgambar",
                    //     method: "POST",
                    //     data: {
                    //         image: base64data,
                    //         oldImage: img,
                    //         // username: username,
                    //     },
                    //     success: function(response) {
                    //         window.location = base_url + 'user/edit';
                    //         // location.reload(true);
                    //     }
                    // });
                    $('#upload_image').val('');
                    // cropper.destroy();
                    // cropper = null;
                    $('#gambar_penyakit').attr('src', e.target.result);
                    $('#nama_gambar').html(nama_gambar_input);
                    modal_img.modal('hide');
                }
            });
        });
    }
    $(document).ready(function() {
        funcLoadDT();
        validateInput();
        cropImage();
    });
</script>