					<?php
					// Atur gambar Thumbnail
					$thumbnail = base_url('assets/img/default/') . 'gambar_penyakit_default.png';
					if (@$row['img_thumbnail'] != 'gambar_penyakit_default.png')
						$thumbnail = base_url('assets/img/artikel_thumbnail/') . $row['img_thumbnail'];
					// Atur nama post
					$nama_post = @$row['nama_post'];
					if (@!$row['nama_post']) $nama_post = '<span class="text-danger">?</span>';
					// Atur terakhir diubah
					$terakhir_diubah = @$terakhir_diubah_ago;
					?>



					<div class="col-md-4 col-sm-6 col-xs-12 mb-2" onclick="funcInfoArtikel(<?= $row['id_a']; ?>)">
						<div class="card border-0 rounded">
							<div class="cover" style="background-image: url(<?= $thumbnail; ?>);">
								<h1 class="" id="post_<?= $row['id_a']; ?>"><?= $nama_post; ?></h1>
								<span class="price"><?= $terakhir_diubah; ?> <i class="far fa-edit"></i></span>
								<div class="card-back">
									<a class="button-55">Info <i class="fas fa-info-square"></i></a>
								</div>
							</div>
						</div>
						<div class="d-none" id="detail_<?= $row['id_a']; ?>"><?= $row['detail_post']; ?></div>
						<div class="d-none" id="saran_<?= $row['id_a']; ?>"><?= $row['saran_post']; ?></div>
					</div>