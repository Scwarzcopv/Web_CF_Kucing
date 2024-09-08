<style>
    /* .ql-editor {
        line-height: 0;
    } */
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
                        <button type="button" class="btn btn-info btn-lg mb-3 mb-lg-4" data-toggle="modal" onclick="funcAddData()">Tambah Data <i class="fa-solid fa-plus"></i></button>
                        <table id="datatabless" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Post</th>
                                    <th>Terakhir Diubah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="ql-editor" style="line-height: 0;">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Post</th>
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
</main>

<!-- MODAL UPDATE DATA -->
<div class="modal fade modal-lg" id="modal" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title card-title" id="modalTitle">?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- <form action="#" id="modalForm"> -->
                <input type="hidden" id="id" name="id" value="">
                <div class="mb-3">
                    <label for="nama_post" class="col-form-label fw-bold">Nama Post</label>
                    <textarea class="form-control" id="nama_post" name="nama_post"></textarea>
                    <!-- <?= form_error('nama_post', '<small class="text-danger">', '</small>'); ?> -->
                    <div class="d-flex justify-content-center mt-1 closest-post" style="height: 30px;">
                        <div id="post" class="fw-bold">...</div>
                        <div id="post-warning" class="fw-bold"><i class="fas fa-exclamation-circle text-warning"></i> Nama post sudah terpakai</div>
                        <div id="post-success" class="fw-bold"><i class="fas fa-check-circle text-success"></i> Nama post belum pernah dipakai</div>
                        <div id="post-loading" class="spinner-border spinner-border-sm text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                    <label class="col-form-label fw-bold mt-3">Detail Post</label>
                    <div class="clearfix">
                        <div id="quill-toolbar-detail_post">
                            <span class="ql-formats">
                                <select class="ql-font"></select>
                                <select class="ql-size"></select>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-bold"></button>
                                <button class="ql-italic"></button>
                                <button class="ql-underline"></button>
                                <button class="ql-strike"></button>
                            </span>
                            <span class="ql-formats">
                                <select class="ql-color"></select>
                                <select class="ql-background"></select>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-script" value="sub"></button>
                                <button class="ql-script" value="super"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-header" value="1"></button>
                                <button class="ql-header" value="2"></button>
                                <button class="ql-blockquote"></button>
                                <button class="ql-code-block"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-list" value="ordered"></button>
                                <button class="ql-list" value="bullet"></button>
                                <button class="ql-indent" value="-1"></button>
                                <button class="ql-indent" value="+1"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-direction" value="rtl"></button>
                                <select class="ql-align"></select>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-link"></button>
                                <button class="ql-image"></button>
                                <button class="ql-video"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-clean"></button>
                            </span>
                        </div>
                        <div id="quill-detail_post"></div>
                    </div>

                    <label class="col-form-label fw-bold mt-3">Saran Post</label>
                    <div class="clearfix">
                        <div id="quill-toolbar-saran_post">
                            <span class="ql-formats">
                                <select class="ql-font"></select>
                                <select class="ql-size"></select>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-bold"></button>
                                <button class="ql-italic"></button>
                                <button class="ql-underline"></button>
                                <button class="ql-strike"></button>
                            </span>
                            <span class="ql-formats">
                                <select class="ql-color"></select>
                                <select class="ql-background"></select>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-script" value="sub"></button>
                                <button class="ql-script" value="super"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-header" value="1"></button>
                                <button class="ql-header" value="2"></button>
                                <button class="ql-blockquote"></button>
                                <button class="ql-code-block"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-list" value="ordered"></button>
                                <button class="ql-list" value="bullet"></button>
                                <button class="ql-indent" value="-1"></button>
                                <button class="ql-indent" value="+1"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-direction" value="rtl"></button>
                                <select class="ql-align"></select>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-link"></button>
                                <button class="ql-image"></button>
                                <button class="ql-video"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-clean"></button>
                            </span>
                        </div>
                        <div id="quill-saran_post"></div>
                    </div>

                    <div class="text-center mt-3">
                        <img alt="Gambar Penyakit" src="<?= base_url('assets/img/default/gambar_penyakit_default.png'); ?>" class="rounded border border-1 border-secondary img-responsive mt-2" width="128" height="128" id="gambar_penyakit" />
                        <div class="mt-2">
                            <span class="btn btn-primary btn-file"><i class="fas fa-upload"></i> Upload Thumbnail <input type="file" accept=".jpg, .jpeg, .png" id="upload_image" data-img=""></span>
                        </div>
                        <small id="nama_gambar">Format jpg/jpeg/png</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSimpan">Simpan</button>
                <button type="button" class="btn btn-primary d-none" id="btnUbah">Ubah</button>
            </div>
        </div>
    </div>
</div>
</main>

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


<!-- INSERT -->
<div id="insert-detail" class="d-none">
</div>
<div id="insert-saran" class="d-none">
</div>




<!-- Tutup elemen dari topbar.php -->
</div>
<?= $this->session->flashdata('message'); ?>
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script> -->
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
    tippyjs("post", "Inputkan <strong>'Nama Post'</strong>", "bottom");
    tippyjs("post-warning", "<div class='text-center'>Data <strong>'Nama Post'</strong> sudah terinput</div>", "bottom");
    tippyjs("post-success", "<div class='text-center'>Data <strong>'Nama Post'</strong> belum pernah terinput</div>", "bottom");
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
    var data_namaGejala;
    // gambar
    let formatGambar = "Format jpg/jpeg/png"; //id: nama_gambar
    let defaultSrcImg = "<?= base_url('assets/img/default/gambar_penyakit_default.png'); ?>"; //id: gambar_penyakit
    let defaultNamaImg = "gambar_penyakit_default.png"; //id: nama_gambar
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
                url: '<?= base_url('diagnosis/loadDataArtikel'); ?>',
                type: "POST"
            },
            columnDefs: [{
                    target: [0, -1],
                    orderable: false,
                },
                {
                    className: "dt-head-left",
                    targets: [0, 1]
                },
            ],
        });
    }

    // Fungsi Reload DataTable
    function funcReloadDT() {
        table.DataTable().ajax.reload();
    }

    $(document).ready(function() {
        funcLoadDT();
        // validateInput();
    });
</script>
<script>
    function modalSet(_simpanData, modalTitle_text) {
        // Conf type save data
        // if (simpanData == 'edit') {
        //     modalForm[0].reset();
        // }
        simpanData = _simpanData;

        // Conf Modal
        btnSimpan.text('Simpan');
        // btnSimpan.attr('disabled', false);
        modalTitle.text(modalTitle_text);

        if ($.trim($('#nama_post').val()) != '') {
            btnSimpan.attr('disabled', false);
        } else {
            btnSimpan.attr('disabled', true);
            $('#post').show();
            $('#post-warning').hide();
            $('#post-success').hide();
            $('#post-loading').hide();
        }
    }

    // Fungsi Tambah Data
    function funcAddData() {
        $('#id').val('');
        modalSet('tambah', 'Tambah Data Artikel');
        modal.modal('show').on('shown.bs.modal', function() {
            $('#nama_post').focus();
        });
    }

    // Fungsi Update Data
    function funcUpdateData(id, type) {
        $('#id').val(id);
        if (type == 'edit') {
            modalSet('edit', 'Edit Data Post');
        }

        // Get data by Id
        $.ajax({
            type: 'POST',
            url: "<?= base_url('diagnosis/loadDataArtikelByID'); ?>",
            data: {
                id_artikel: id,
            },
            dataType: "JSON",
            success: function(resp) {
                if (type == 'edit') {
                    $('#nama_post').val(resp.data.nama_post);
                    var valDetail = resp.data.detail_post;
                    $('#insert-detail').html('');
                    $('#insert-detail').append(valDetail);
                    $('#insert-detail img').each(function() {
                        var base_url = '<?= base_url('assets/img/artikel_quill/'); ?>';
                        var src = $(this).attr('src');
                        $(this).attr('src', base_url + src);
                    });
                    valDetail = $('#insert-detail').html();
                    var detailPost = detail_post.clipboard.convert(valDetail);
                    detail_post.setContents(detailPost, 'silent');
                    var valSaran = resp.data.saran_post;
                    // var saranPost = saran_post.clipboard.convert(valSaran);
                    // saran_post.setContents(saranPost, 'silent');
                    // detail_post.setContents([{
                    //     insert: '<p><br></p>'
                    // }]);
                    // saran_post.setContents([{
                    //     insert: '\n'
                    // }]);
                    // Gambar
                    var base_url = '<?= base_url('assets/img/artikel_thumbnail/'); ?>';
                    if (resp.data.img_thumbnail == 'gambar_penyakit_default.png') {
                        base_url = '<?= base_url('assets/img/default/'); ?>';
                    }
                    var img_src = base_url + resp.data.img_thumbnail;
                    $('#gambar_penyakit').attr('src', img_src);
                    $('#upload_image').attr('data-img', resp.data.img_thumbnail);
                    // End-Gambar
                    modalSet('edit', 'Edit Data Post');
                    modal.modal('show').on('shown.bs.modal', function() {
                        $('#nama_post').blur();
                    });
                    // modal.on('hidden.bs.modal', function() {
                    //     $('#gambar_penyakit').attr('src', defaultSrcImg);
                    //     $('#nama_gambar').html(formatGambar);
                    // });
                } else {
                    Swal.fire({
                        title: "Hapus data post?",
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
                            // funcHapusData(resp.id);
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
        modal.on('hide.bs.modal', function() {
            $('#nama_post').val('');
            detail_post.setContents([{
                insert: '\n'
            }]);
            saran_post.setContents([{
                insert: '\n'
            }]);
        });
    }

    // Fungsi Get Data Detail & Saran Post
    function funcGetDetailSaran(nama_post) {
        $.ajax({
            type: 'POST',
            url: '<?= base_url('diagnosis/loadDataArtikelByName'); ?>',
            data: {
                nama_post: nama_post,
            },
            dataType: "JSON",
            cache: false,
            success: function(resp) {
                console.log(resp)
                var valDetail = resp.data_post.detail_post;
                var detailPost = detail_post.clipboard.convert(valDetail);
                detail_post.setContents(detailPost, 'silent');
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
        })
    }

    // Fungsi On Change Nama Post
    function funcOnChangePost() {
        //setup before functions
        var typingTimer; //timer identifier
        var doneTypingInterval = 1000;
        var $input = $('#nama_post');

        //on keyup, start countdown
        $input.on('keyup', function() {
            var valPost = $.trim($input.val());
            detail_post.disable();
            saran_post.disable();
            $('#post').hide();
            $('#post-warning').hide();
            $('#post-success').hide();
            $('#post-loading').show();
            if (valPost == null || valPost == '') {
                $('#post').show();
                $('#post-warning').hide();
                $('#post-success').hide();
                $('#post-loading').hide();
            }
            btnSimpan.attr('disabled', true);
            clearTimeout(typingTimer);
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        });

        //on keydown, clear countdown 
        $input.on('keydown', function() {
            clearTimeout(typingTimer);
        });

        //user is "finished typing," do something
        function doneTyping() {
            var valPost = $.trim($input.val());
            detail_post.enable();
            saran_post.enable();
            if (valPost == null || valPost == '') {
                $('#post').show();
                $('#post-warning').hide();
                $('#post-success').hide();
                $('#post-loading').hide();
                btnSimpan.attr('disabled', true);
            } else {
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url('diagnosis/loadDataArtikelByName'); ?>',
                    data: {
                        nama_post: valPost,
                        id_artikel: $('#id').val()
                    },
                    dataType: "JSON",
                    cache: false,
                    success: function(resp) {
                        if (resp.num_rows <= 0) {
                            $('#post').hide();
                            $('#post-warning').hide();
                            $('#post-success').show();
                            $('#post-loading').hide();
                            btnSimpan.attr('disabled', false);
                        } else {
                            funcGetDetailSaran(valPost);
                            // console.log(resp.nama_artikel);
                            $('#post').hide();
                            $('#post-warning').show();
                            $('#post-success').hide();
                            $('#post-loading').hide();
                            btnSimpan.attr('disabled', false);
                            if (simpanData == 'edit' && resp.nama_artikel == valPost) {
                                $('#post').hide();
                                $('#post-warning').hide();
                                $('#post-success').show();
                                $('#post-loading').hide();
                            }
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
                })
            }
        }
    }

    // Crop Image
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
        funcOnChangePost();
        cropImage();
    });
</script>
<script>
    function randomId(length) {
        let result = '';
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        const charactersLength = characters.length;
        let counter = 0;
        while (counter < length) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
            counter += 1;
        }
        return result;
    }

    var detail_post;
    var saran_post;

    function funcQuill() {
        detail_post = new Quill("#quill-detail_post", {
            modules: {
                toolbar: "#quill-toolbar-detail_post"
            },
            placeholder: "Masukkan detail post",
            theme: "snow",
        });
        saran_post = new Quill("#quill-saran_post", {
            modules: {
                toolbar: "#quill-toolbar-saran_post"
            },
            placeholder: "Masukkan saran post",
            theme: "snow",
        });
    }

    function simpanData() {
        function funcSimpan() {
            console.clear();
            $('#insert-detail').html('');
            $('#insert-saran').html('');
            var data_nama = '';
            var data_detail = '';
            var data_saran = '';
            data_nama = $('#nama_post').val();
            data_detail = detail_post.root.innerHTML.trim();
            data_saran = saran_post.root.innerHTML.trim();
            var arrBase64_detail = [];
            var arrBase64_saran = [];
            var arrNameImg_detail = [];
            var arrNameImg_saran = [];
            var image;
            var base64;
            var id_AI;

            // Konfigurasi data detail
            $('#insert-detail').append(data_detail);
            $('#insert-detail img').each(function() {
                image = $(this).attr('src');
                base64 = image.replace(/^data:image\/[a-z]+;base64,/, "");
                arrBase64_detail.push(base64);
                $(this).attr('src', '');
            });
            data_detail = $('#insert-detail').html();

            // Konfigurasi data saran
            $('#insert-saran').append(data_saran);
            $('#insert-saran img').each(function() {
                image = $(this).attr('src');
                base64 = image.replace(/^data:image\/[a-z]+;base64,/, "");
                arrBase64_saran.push(base64);
                $(this).attr('src', '');
            });
            data_saran = $('#insert-saran').html();

            // Simpan ke DBS
            $.ajax({
                type: 'POST',
                url: '<?= base_url('diagnosis/tambahDataArtikel'); ?>',
                data: {
                    id_artikel: $('#id').val(),
                    nama_post: data_nama,
                    // oldImage: oldImage,
                    image: sendImage,
                },
                dataType: "JSON",
                cache: false,
                success: function(resp) {
                    // sendImage = null;
                    // oldImage = null;
                    // $('#gambar_penyakit').attr('src', defaultSrcImg);
                    // $('#nama_gambar').html(formatGambar);
                    if (resp['status'] == 'failed') { //Jika tidak input gambar *quill
                        Custom.fire({
                            icon: 'success',
                            title: 'Data Berhasil Ditambahkan',
                        });
                        detail_post.setContents([{
                            insert: '\n'
                        }]);
                        saran_post.setContents([{
                            insert: '\n'
                        }]);
                        modal.modal('hide');
                        // modalForm[0].reset();
                    } else {
                        id_AI = resp['auto_increment_val'];
                        // Konfigurasi data detail
                        $('#insert-detail img').each(function() {
                            var time = Date.now();
                            var randomStr = randomId(10);
                            var tempName = id_AI + '_d_' + time + '_' + randomStr + '.png';
                            $(this).attr('src', tempName);
                            $(this).attr('name', 'gambar_base_url');
                            arrNameImg_detail.push(tempName);
                        });
                        data_detail = $('#insert-detail').html();
                        // Konfigurasi data saran
                        $('#insert-saran img').each(function() {
                            var time = Date.now();
                            var randomStr = randomId(10);
                            var tempName = id_AI + '_s_' + time + '_' + randomStr + '.png';
                            $(this).attr('src', tempName);
                            $(this).attr('name', 'gambar_base_url');
                            arrNameImg_saran.push(tempName);
                        });
                        data_saran = $('#insert-saran').html();

                        // console.log(arrBase64_detail) //data gambar - detail post
                        // console.log(arrNameImg_detail) //data nama gambar - detail post
                        // console.log(data_detail) //data seluruh input - detail post

                        $.ajax({
                            type: 'POST',
                            url: '<?= base_url('diagnosis/tambahDataArtikel_fase2'); ?>',
                            data: {
                                id_artikel: id_AI,
                                nama_post: data_nama,
                                //detail post
                                detail_post: data_detail,
                                arrBase64_detail: arrBase64_detail,
                                arrNameImg_detail: arrNameImg_detail,
                                //saran post
                                saran_post: data_saran,
                                arrBase64_saran: arrBase64_saran,
                                arrNameImg_saran: arrNameImg_saran,
                            },
                            dataType: "JSON",
                            cache: false,
                            success: function(resp) {
                                modal.modal('hide');
                                sendImage = null;
                                oldImage = null;
                                if (resp.status_4 == 'success') {
                                    $('#nama_post').val('');
                                    detail_post.setContents([{
                                        insert: '\n'
                                    }]);
                                    saran_post.setContents([{
                                        insert: '\n'
                                    }]);
                                    funcReloadDT();
                                    modal.on('hidden.bs.modal', function() {
                                        $('#gambar_penyakit').attr('src', defaultSrcImg);
                                        $('#nama_gambar').html(formatGambar);
                                        Custom.fire({
                                            icon: 'success',
                                            title: 'Berhasil Simpan Data',
                                        });
                                    });
                                    // setTimeout(function() {
                                    //     Custom.fire({
                                    //         icon: 'success',
                                    //         title: 'Berhasil Simpan Data',
                                    //     });
                                    // }, 300);
                                }
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
        $('#btnSimpan').on('click', function() {
            if (simpanData == 'tambah') {
                if ($('#post-warning').is(":visible")) {
                    Swal.fire({
                        title: "Timpa Data Artikel?",
                        html: "Data saat ini akan ditimpa dengan data yang baru.",
                        // html: "Semua data terkait penyakit ini akan dimasukkan ke <br><span class='fw-bold'>daftar sampah</span>.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ubah',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            funcSimpan();
                        }
                    })
                } else {
                    funcSimpan();
                    // Custom.fire({
                    //     icon: 'success',
                    //     title: 'Mampus',
                    // });
                }
            } else {
                var data_nama = '';
                var data_detail = '';
                var data_saran = '';
                var arrBase64_detail = [];
                var arrBase64_saran = [];
                var arrNameImg_detail = [];
                var arrNameImg_saran = [];
                var image;
                var base64;
                var id_AI;
                console.clear();
                data_detail = detail_post.root.innerHTML.trim();
                $('#insert-detail').html('');
                $('#insert-detail').append(data_detail);
                $('#insert-detail img').each(function() {
                    var base_url = '<?= base_url('assets/img/artikel_quill/'); ?>';
                    var src = $(this).attr('src');
                    $(this).attr('src', src.split(base_url)[1]);
                });
                console.log($('#insert-detail').html());
                // data_saran = saran_post.root.innerHTML.trim();


                // Konfigurasi data detail
                // $('#insert-detail').append(data_detail);
                $('#insert-detail img').each(function() {
                    image = $(this).attr('src');
                    split = image.split(';')[1];
                    if (split != null) {
                        base64 = image.replace(/^data:image\/[a-z]+;base64,/, "");
                        arrBase64_detail.push(base64);
                        $(this).attr('src', '');
                    }
                });
                data_detail = $('#insert-detail').html();
                console.log(arrBase64_detail);
            }
        })
    }

    $(document).ready(function() {
        // console.log();
        funcQuill();
        simpanData();
    })
</script>