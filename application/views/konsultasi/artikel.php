<link rel="stylesheet" href="<?= base_url('assets/mediplus'); ?>/css/nice-select.css">
<link rel="stylesheet" href="<?= base_url('assets/css/codepen.css'); ?>">
<style>
	/* CSS */
	.button-55 {
		align-self: center;
		background-color: #fff;
		background-image: none;
		background-position: 0 90%;
		background-repeat: repeat no-repeat;
		background-size: 4px 3px;
		border-radius: 15px 225px 255px 15px 15px 255px 225px 15px;
		border-style: solid;
		border-width: 2px;
		box-shadow: rgba(0, 0, 0, .2) 15px 28px 25px -18px;
		box-sizing: border-box;
		color: #41403e;
		cursor: pointer;
		display: inline-block;
		font-family: Neucha, sans-serif;
		font-size: 1rem;
		line-height: 23px;
		outline: none;
		padding: .75rem;
		text-decoration: none;
		transition: all 235ms ease-in-out;
		border-bottom-left-radius: 15px 255px;
		border-bottom-right-radius: 225px 15px;
		border-top-left-radius: 255px 15px;
		border-top-right-radius: 15px 225px;
		user-select: none;
		-webkit-user-select: none;
		touch-action: manipulation;
	}

	.button-55:hover {
		box-shadow: rgba(0, 0, 0, .3) 2px 8px 8px -5px;
		transform: translate3d(0, 2px, 0);
	}

	.button-55:focus {
		box-shadow: rgba(0, 0, 0, .3) 2px 8px 4px -6px;
	}

	@media only screen and (min-width: 600px) {
		.modal-size {
			min-width: 120vh;
		}
	}
</style>
<!-- Start Feautes -->
<div class="breadcrumbs overlay">
	<div class="container">
		<div class="bread-inner">
			<div class="row">
				<div class="col-12">
					<h2>Artikel Penyakit</h2>
					<ul class="bread-list">
						<li><a href="<?= base_url('') ?>">Beranda</a></li>
						<li><i class="icofont-simple-right"></i></li>
						<li class="active">Artikel</li>
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
					<h2>Artikel Penyakit</h2>
					<img src="<?= base_url('assets/mediplus/'); ?>img/section-img.png" alt="#">
					<p>Daftar artikel penyakit.</p>
					<!-- <p class="pt-0 mt-0">Anda dapat memilih kepastian kondisi ayam dari '<span class="text-primary">pasti tidak</span>' hingga '<span class="text-primary">pasti ya</span>'.</p>
					<p class="pt-0 mt-0">Jika sudah, silahkan tekan tombol proses <span class="text-primary"><i class="fad fa-search-plus"></i></span> di bawah untuk melihat hasil.</p> -->
				</div>
			</div>
		</div>
	</div>
</section>
<div class="container">
	<div class="row mb-4 mt-3 mt-lg-0">
		<div class="col-12 col-lg-7 mb-2 mb-lg-0 d-flex align-items-center">
			<table class="p-0 m-0 w-auto">
				<tr>
					<td>
						<div class="input-group"><span class="card-title my-auto me-3 d-none d-md-block">Urut Berdasar</span></div>
					</td>
					<td>
						<div class="input-group">
							<span class="card-title my-auto me-3 d-none d-md-block">:</span>
						</div>
					</td>
					<td>
						<div class="input-group">
							<!-- <div class="col-md-4 col-lg-5 me-3"> -->
							<select class="rounded pt-2 mb-0 me-3 fw-medium" id="order" style="max-width: 10rem;">
								<option value="a.terakhir_diubah ASC" selected>Terakhir diubah ⇩</option>
								<option value="a.terakhir_diubah DESC">Terakhir diubah ⇪</option>
								<option value="a.id ASC">Data Baru</option>
								<option value="a.id DESC">Data Lama</option>
								<option value="a.nama_post ASC">Nama Post ⇩</option>
								<option value="a.nama_post DESC">Nama Post ⇪</option>
							</select>
							<!-- </div> -->
						</div>
					</td>
				</tr>
				<tr class="spasi">
					<td>
						<div class="p-1"></div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="input-group">
							<span class="card-title my-auto me-3 d-none d-md-block">Muat</span>
						</div>
					</td>
					<td>
						<div class="input-group">
							<span class="card-title my-auto me-3 d-none d-md-block">:</span>
						</div>
					</td>
					<td>
						<div class="input-group">
							<select class="rounded pt-2 mb-0 me-3 fw-medium" id="show" style="max-width: 10rem;">
								<option value=5 selected>5</option>
								<option value=10>10</option>
								<option value=20>20</option>
								<option value=50>50</option>
								<option value=100>100</option>
							</select>
							<span class="card-title my-auto">dari (<span id="num_rows">0</span>) Data</span>
						</div>
					</td>
				</tr>
			</table>
		</div>
		<div class="col-12 col-lg-5 d-flex align-items-center">
			<div class="input-group input-group-md">
				<input type="search" class="form-control border my-0 py-0" id="keyword" placeholder="Search Filter">
				<span class="btn border" style="cursor: default;"><i class="fa-solid fa-magnifying-glass"></i> Search</span>
			</div>
		</div>
	</div>
	<section>
		<div class="cards mb-4 row" id="load_data">
		</div>
	</section>
	<div class="mb-5" id="load_data_message"></div>

</div>
<!--/ End Feautes -->
<!-- Modal -->
<div class="modal fade" id="infoArtikel" tabindex="-1" aria-labelledby="infoArtikelLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-xl modal-size">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="infoArtikelLabel">Info Artikel</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<!-- Tabel Post -->
				<table class="table table-responsive table-bordered border-info border-5">
					<thead class="table-danger">
						<tr>
							<th scope="col" class="col-md-1">Nama Penyakit</th>
						</tr>
					</thead>
					<tbody id="">
						<tr>
							<th scope="col" id="post"></th>
						</tr>
					</tbody>
				</table>
				<!-- Tabel Detail Penyakit -->
				<table class="table table-responsive table-bordered border-info border-5">
					<thead class="table-info">
						<tr>
							<th scope="col" class="col-md-1">Detail Penyakit</th>
						</tr>
					</thead>
					<tbody id="">
						<tr>
							<th scope="col" id="detail"></th>
						</tr>
					</tbody>
				</table>
				<!-- Tabel Saran Penyakit -->
				<table class="table table-responsive table-bordered border-warning border-5 mb-lg-4">
					<thead class="table-warning">
						<tr>
							<th scope="col" class="col-md-1">Saran Penyakit</th>
						</tr>
					</thead>
					<tbody id="">
						<tr>
							<th scope="col" id="saran"></th>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>




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
<!-- Infinite Scroll -->
<script>
	// var data_elem = [];
	var limit = 5;
	var start = 0;
	var action = 'inactive';
	var keyword = '';
	var order = 'a.terakhir_diubah DESC';
	var timeout = null;
	// Effect
	const placeholder_timer = 1000;

	function func_loader_spinner() {
		var output = '';
		output += '<div class="d-flex justify-content-center">';
		output += '<div class="spinner-border text-primary fw-bold fs-2 my-2" role="status">';
		output += '<span class="visually-hidden">Loading...</span>';
		output += '</div>';
		output += '</div>';
		$('#load_data_message').html(output);
	}

	function load_data(limit, start, keyword, order) {
		$.ajax({
			url: "<?php echo base_url(); ?>konsultasi/fetch_artikel",
			method: "POST",
			data: {
				limit: limit,
				start: start,
				keyword: keyword,
				order: order
			},
			dataType: "JSON",
			cache: false,
			success: function(resp) {
				$('#num_rows').html(resp.num_rows);
				if (resp.data == 'null') {
					$('#load_data_message').html('<div class="fw-bold text-center card-title fs-4 mt-3 mb-3 mb-lg-0">Data Masih Kosong</div>');
					action = 'active';
				} else if (resp.data == 'null2') {
					if (keyword == '' || keyword == null) {
						$('#load_data_message').html('<div class="fw-bold text-center card-title fs-4 mt-3 mb-3 mb-lg-0">Tidak Ada Lagi Hasil yang Ditemukan</div>');
						action = 'active';
					} else {
						$('#load_data_message').html('<div class="fw-bold text-center card-title fs-4 mt-3 mb-3 mb-lg-0">Data Tidak Ditemukan</div>');
						action = 'active';
					}
				} else {
					// data_elem.push(data);
					// $('#load_data').html(data_elem);
					$(resp.data).appendTo('#load_data').slideUp(0).slideDown(0, 'easeInOutExpo', function() {});
					if (resp.next == 'true') {
						$('#load_data_message').html("");
						action = 'inactive';
					} else {
						$('#load_data_message').html('<div class="fw-bold text-center card-title fs-4 mt-3 mb-3 mb-lg-0">Tidak Ada Lagi Hasil yang Ditemukan</div>');
						action = 'active'
					}
				}
			}
		})
	}

	function reloadDT() {
		$('#load_data').empty();
		$('#load_data').html('');
		start = 0;
		action = 'inactive';
		func_loader_spinner();
		if (timeout !== null) {
			clearTimeout(timeout);
		}
		timeout = setTimeout(function() {
			load_data(limit, start, keyword, order);
		}, placeholder_timer);
	}

	$(document).ready(function() {
		func_loader_spinner();

		if (action == 'inactive') {
			action = 'active';
			load_data(limit, start, keyword, order);
		}

		$(window).scroll(function() {
			if ($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive') {
				func_loader_spinner();
				action = 'active';
				start = start + limit;
				setTimeout(function() {
					load_data(limit, start, keyword, order);
				}, placeholder_timer); //Buat animasi doang
			}
		});

		// Search
		$('#keyword').on('input', function() {
			keyword = $(this).val();
			start = 0;
			action = 'inactive';
			// var e = $('<div id="load_data"></div>');
			// $('#load_data').empty().remove();
			// $('#row_data').append(e);
			reloadDT();
			// console.log(keyword);
			// if (keyword != '') {
			//     infinite_scroll(keyword);
			// } else {
			//     infinite_scroll();
			// }
		});

		// Order
		$('#order').on('change', function() {
			order = $(this).find(":selected").val();
			reloadDT();
		});

		// Order
		$('#show').on('change', function() {
			limit = parseInt($(this).find(":selected").val());
			reloadDT();
		});
	});
</script>
<script>
	function funcInfoArtikel(id) {
		$('#post').html($('#post_' + id).html());
		$('#detail').html($('#detail_' + id).html());
		$('#saran').html($('#saran_' + id).html());
		funcFixScImg();
		$('#infoArtikel').modal('show');
	}

	function funcFixScImg() {
		console.clear();
		$('.modal-body img[name=gambar_base_url]').each(function() {
			base_url = "<?= base_url('assets/img/artikel_quill/'); ?>";
			src = $(this).attr('src');
			$(this).attr('src', base_url + src);
			// $(this).addClass('rounded mx-auto d-block');
			$(this).addClass('rounded border border-2 border-dark');
			$(this).css('max-height', '200px');
		});
	}
</script>