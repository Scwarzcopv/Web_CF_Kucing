<!-- Nice Select CSS -->
<link rel="stylesheet" href="<?= base_url('assets/mediplus'); ?>/css/nice-select.css">
<style>
	/* CSS */
	.button-37 {
		background-color: #13aa52;
		border: 1px solid #13aa52;
		border-radius: 4px;
		box-shadow: rgba(0, 0, 0, .1) 0 2px 4px 0;
		box-sizing: border-box;
		color: #fff;
		cursor: pointer;
		font-family: "Akzidenz Grotesk BQ Medium", -apple-system, BlinkMacSystemFont, sans-serif;
		font-size: 17px;
		font-weight: 450;
		outline: none;
		outline: 0;
		padding: 10px 25px;
		text-align: center;
		transform: translateY(0);
		transition: transform 150ms, box-shadow 150ms;
		user-select: none;
		-webkit-user-select: none;
		touch-action: manipulation;
	}

	.button-37:hover {
		box-shadow: rgba(0, 0, 0, .15) 0 3px 9px 0;
		transform: translateY(-2px);
	}

	/* CSS */
	.button-24 {
		background: #FF4742;
		border: 1px solid #FF4742;
		border-radius: 6px;
		box-shadow: rgba(0, 0, 0, 0.1) 1px 2px 4px;
		box-sizing: border-box;
		color: #FFFFFF;
		cursor: pointer;
		display: inline-block;
		font-family: nunito, roboto, proxima-nova, "proxima nova", sans-serif;
		font-size: 16px;
		font-weight: 800;
		line-height: 16px;
		min-height: 40px;
		outline: 0;
		padding: 12px 14px;
		text-align: center;
		text-rendering: geometricprecision;
		text-transform: none;
		user-select: none;
		-webkit-user-select: none;
		touch-action: manipulation;
		vertical-align: middle;
	}

	.button-24:hover,
	.button-24:active {
		background-color: initial;
		background-position: 0 0;
		color: #FF4742;
	}

	.button-24:active {
		opacity: .5;
	}

	@media (min-width: 768px) {
		.button-37 {
			padding: 15px 30px;
		}
	}

	@media (min-width: 768px) {
		.modal-xl {
			width: 90%;
			max-width: 1200px;
		}
	}

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

<!-- Start Feautes -->
<div class="breadcrumbs overlay">
	<div class="container">
		<div class="bread-inner">
			<div class="row">
				<div class="col-12">
					<h2>Konsultasi Penyakit</h2>
					<ul class="bread-list">
						<li><a href="<?= base_url('') ?>">Beranda</a></li>
						<li><i class="icofont-simple-right"></i></li>
						<li class="active">Konsultasi</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<section class="Feautes section mt-lg-5 pb-3 pt-lg-5">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title">
					<h2>Konsultasi Penyakit</h2>
					<img src="<?= base_url('assets/mediplus/'); ?>img/section-img.png" alt="#">
					<p>Silahkan memilih gejala sesuai sesuai dengan kondisi kucung kesayangan anda.</p>
					<p class="pt-0 mt-0">Anda dapat memilih kepastian kondisi ayam dari '<span class="text-primary">pasti tidak</span>' hingga '<span class="text-primary">pasti ya</span>'.</p>
					<p class="pt-0 mt-0">Jika sudah, silahkan tekan tombol proses <span class="text-primary"><i class="fad fa-search-plus"></i></span> di bawah untuk melihat hasil.</p>
				</div>
			</div>
		</div>
	</div>
</section>
<!--/ End Feautes -->

<!-- Start Konsultasi -->
<section class="Konsultasi mb-5">
	<div class="container">
		<table class="table table-responsive">
			<thead class="table-primary">
				<tr>
					<th scope="col" class="col-md-1">No</th>
					<th scope="col" class="col-md-1">Kode</th>
					<th scope="col" class="col-md-6">Gejala</th>
					<th scope="col" class="col-md-4">Pilih Kondisi</th>
				</tr>
			</thead>
			<tbody id="tbody">
				<?php $no = 1; ?>
				<?php $kode_gejala = '0'; ?>
				<?php foreach ($data_gejala as $dt_gejala) : ?>
					<?php
					$id = (int)$dt_gejala['id'];
					if ($id < 10) {
						$kode_gejala = 'G00' . $id;
					} elseif ($id < 100) {
						$kode_gejala = 'G0' . $id;
					} else {
						$kode_gejala = 'G' . $id;
					}
					?>
					<tr class="tr" id="tr_<?= $no ?>">
						<th scope="row" class="align-middle"><?= $no; ?></th>
						<td><?= $kode_gejala; ?></td>
						<td><?= $dt_gejala['nama_gejala'] ?></td>
						<td>
							<input type="hidden" value=<?= $id; ?> name="id" id="id">
							<div class="rounded position-relative p-1 d-flex class_pilihan" id="class_pilihan">
								<select class="pt-2 my-0 fw-medium" name="pilihan">
									<option selected>Pilih</option>
									<option value=1>Pasti Ya</option>
									<option value=0.8>Hampir Pasti Ya</option>
									<option value=0.6>Kemungkinan Besar Ya</option>
									<option value=0.4>Mungkin Ya</option>
									<option value=0.1>Tidak Yakin</option>
									<option value=-0.4>Mungkin Tidak</option>
									<option value=-0.6>Kemungkinan Besar Tidak</option>
									<option value=-0.8>Hampir Pasti Tidak</option>
									<option value=-1>Pasti Tidak</option>
								</select>
								<div class="d-none ms-auto pe-1 text-light pennant"><i class="fas fa-pennant"></i></div>
							</div>
						</td>
					</tr>
					<?php $no++; ?>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</section>
<!--/ End Konsultasi -->

<!-- Footer Area -->
<footer id="footer" class="footer p-0">
	<!-- Footer Top -->
	<div class="footer-top">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-12">
					<div class="single-footer">
						<h2>About Us</h2>
						<p>Lorem ipsum dolor sit am consectetur adipisicing elit do eiusmod tempor incididunt ut
							labore dolore magna.</p>
						<!-- Social -->
						<ul class="social">
							<li><a href="#"><i class="icofont-facebook"></i></a></li>
							<li><a href="#"><i class="icofont-instagram"></i></a></li>
						</ul>
						<!-- End Social -->
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-12">
					<div class="single-footer">
						<h2>Open Hours</h2>
						<p>Lorem ipsum dolor sit ame consectetur adipisicing elit do eiusmod tempor incididunt.
						</p>
						<ul class="time-sidual">
							<li class="day">Senin - Kamis <span>08.00-20.00</span></li>
							<li class="day">Jumat <span>09.00-18.30</span></li>
							<li class="day">Sabtu & Minggu <span>09.00-15.00</span></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/ End Footer Top -->
	<!-- Copyright -->
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-12">
					<div class="copyright-content">
						<p>©2024 | Sistem Pakar - Diagnosa Penyakit Pada Kucing </p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/ End Copyright -->
</footer>

<!-- Static Button -->
<div class="position-fixed bottom-0 start-50 translate-middle-x mb-md-3">
	<button type="submit" class="button-37" onclick="kirimInput()">Hasil Diagnosis <i class="fad fa-search-plus"></i></button>
</div>
<!--/ End Static Button  -->

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
				<button type="button" class="button-24" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!--/ End Modal -->


<!-- Js -->
<!-- Src -->
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>
<script src="<?= base_url('assets'); ?>/js/customsweetalert.js"></script>
<script type="text/javascript" src=""></script>
<!-- Init -->
<script>
	let class_pilihan = $('.class_pilihan');
	var arrVal = []; //Isinya obj inputan id & pilihan
</script>


<script>
	// Fungsi Ganti warna hijau
	function kondisiHijau() {
		$('[name="pilihan"]').change(function() {
			if ($(this).val() == 'Pilih') {
				$(this).closest('.class_pilihan').removeClass('bg-success');
				$(this).closest('.class_pilihan').find('.pennant').addClass('d-none');
			} else {
				$(this).closest('.class_pilihan').addClass('bg-success');
				$(this).closest('.class_pilihan').find('.pennant').removeClass('d-none');
			}
		});
	}

	// Fungsi Ambil Inputan
	function ambilInput() {
		var totalRow = $("#tbody .tr").length;
		var obj;
		arrVal = [];
		for (var count = 1; count <= totalRow; count++) {
			var valId = $('#tr_' + count).find("input[name='id']").val();
			var valPilihan = $('#tr_' + count).find("select[name='pilihan']").val();
			obj = {
				id: valId,
				pilihan: valPilihan
			}
			arrVal.push(obj);

		}
		// $.each(arrVal, function(index, val) {
		// 	console.log(val.pilihan);
		// });
		// console.log(arrVal[2]);
	}

	// Fungsi Kirim Inputan
	function kirimInput() {
		ambilInput();
		<?php
		$role_id = 3;
		$username = 'Anda';
		if (@$user['role_id']) $role_id = $user['role_id'];
		if (@$user['username']) $username = $user['username'];
		?>
		var role_id = <?= $role_id; ?>;
		var username = '<?= $username; ?>';
		if (role_id > 2) $('#penginput').html('Hasil input dari username : ' + username + '');
		if (role_id < 3) $('#penginput').html('Hasil input dari username : <i class="fas fa-badge-check text-success"></i> ' + username + '');
		$.ajax({
			url: "<?php echo base_url(); ?>konsultasi/proses_hitung",
			method: "POST",
			data: {
				data: arrVal
			},
			dataType: "JSON",
			cache: false,
			success: function(resp) {
				// setTimeout(function() {
				// 	Custom.fire({
				// 		icon: 'success',
				// 		title: resp.status,
				// 	});
				// }, 300);
				console.clear();
				console.log(resp.status);
				$('#since').html(resp.status.since_now);
				$('#tbody_modal_input').append(resp.status.input_user);
				$('#table_modal_diagnosa').append(resp.status.hasil_akhir);
				$('#modal').modal('show');
			}
		});
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
		setTimeout(function() {
			// console.clear();
		}, 300);
		kondisiHijau();
		// ambilInput();
	});
</script>