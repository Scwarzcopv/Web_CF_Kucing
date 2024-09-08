<main class="content">
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- <div class="card-header">
						<h5 class="card-title">The</h5>
											<h6 class="card-subtitle text-muted">The</h6>
					</div> -->
                    <div class="card-body">
                        <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Surat</th>
                                    <th>Tanggal Rapat</th>
                                    <th>Agenda Rapat</th>
                                    <th>Pimpinan Rapat</th>
                                    <th>Notulis</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Perintah Langsung Kepala Dinas</td>
                                    <td>
                                        <div class="d-flex">7/18/2013</div>
                                    </td>
                                    <td>Cek Kesehatan</td>
                                    <td>KADIN OPD UJI COBA 1</td>
                                    <td>OPERATOR OPD UJI COBA 1</td>
                                    <td><button type="button" class="btn btn-success">Sudah Verifikasi</button></td>
                                    <td>
                                        <div class="d-flex">
                                            <button type="button" class="btn btn-outline-primary me-1" name="notulen-pdf" id="notulen-pdf"><i class="fa-solid fa-file-pdf"></i></button>
                                            <button type="button" class="btn btn-outline-primary me-1" name="notulen-peserta" id="notulen-peserta"><i class="fa-solid fa-user-group"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama Surat</th>
                                    <th>Tanggal Rapat</th>
                                    <th>Agenda Rapat</th>
                                    <th>Pimpinan Rapat</th>
                                    <th>Notulis</th>
                                    <th>Status</th>
                                    <th>Action</th>
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Datatables Responsive
        $("#datatables-reponsive").DataTable({
            responsive: true
        });
    });

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