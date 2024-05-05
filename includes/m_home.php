<?php
	$batas=10;	
	if(empty($_GET["hal"])){
		$posisi=0;
		$hal=1;
	}else{
		$hal=$_GET["hal"];
		$posisi=($hal-1)*$batas;
	}
	$db=new MySQL();
	$db->connect();
	$db->execute("SELECT b.kodeBuku, b.judul, p1.nama, p2.nama, b.tahun, b.edisi, b.issn_isbn, 
		b.seri, b.abstraksi, k.namaKategori
		FROM tb_buku b, tb_penerbit p1, tb_pengarang p2, tb_kategori k
		WHERE b.kodePenerbit = p1.kodePenerbit
		AND b.kodePengarang = p2.kodePengarang
		AND b.kodeKategori = k.kodeKategori
		limit $posisi, $batas"); 
	$data=$db->get_dataset();
?>

<div class="row-fluid">
	<h2 class="title title-large">Daftar Buku</h2>


	<!-- DAFTAR DATA BUKU YANG DITAMPILKAN -->

	<?php if(isset($_POST['search']) && !empty($data_search)):?>
			<!-- Jika value dari $data search bukan NULL dan ada isinya, maka // -->
		<hr />
		
		<div class="container-fluid">
			<?php for($i = 0; $i < count($data_search); $i++) { ?>
				<!-- Looping Pengambilan Data Buku -->
				<div class="span3 center">
					<p><img src="img/no_image.jpg" class="img-polaroid"></p>
					<p class="title"><?= $data_search[$i][1] ?></p>
					<p class="title title-small">( <?= $data_search[$i][3] ?> )</p>
					<p>
						<a href="#modalDetail<?= $i ?>" role="button" class="btn btn- btn-inverse btn-small" data-toggle="modal">
							<i class="icon-zoom-in icon-white"></i> Detail
						</a>
					</p>
				</div>
			<?php } ?>
		</div>
		<hr />

		<?php elseif(isset($_POST['search']) && empty($data_search)): ?>
			<!-- Jika kolom search terisi, tapi data buku tidak ditemukan -->
			<hr />
			<p>No results found.</p>
			<hr />

			<?php elseif(empty($data_search)): ?>
		<!-- Jika kolom search tidak terisi, maka.. -->
		<hr />
		
		<?php for($i=0; $i<count($data); $i++) { ?>
			<!-- Looping Pengambilan Data Buku -->
			<div class="span3 center">
				<p><img src="img/no_image.jpg" class="img-polaroid"></p>
				<p class="title"><?=$data[$i][1]?></p>
				<p class="title title-small">( <?=$data[$i][3]?> )</p>
				<p>
					<a href="#modalDetail<?=$i?>" role="button" class="btn btn- btn-inverse btn-small" data-toggle="modal">
						<i class="icon-zoom-in icon-white"></i> Detail
					</a>
				</p>
			</div>
		<?php } ?>
		</div>
		<hr />

	
	<?php endif; ?>

<?php	
	//PAGINATION
	$db=new MySQL();
	$db->connect();
	$db->execute("SELECT b.kodeBuku, b.judul, p1.nama, p2.nama, b.tahun, b.edisi, b.issn_isbn, 
		b.seri, b.abstraksi, k.namaKategori
		FROM tb_buku b, tb_penerbit p1, tb_pengarang p2, tb_kategori k
		WHERE b.kodePenerbit = p1.kodePenerbit
		AND b.kodePengarang = p2.kodePengarang
		AND b.kodeKategori = k.kodeKategori"); 
	$data2=$db->get_dataset();
	$jum=count($data2);
	$jhal=ceil($jum/$batas);
	
	echo "
		<div class='pagination'>
			<ul>
		";
	for($j=1;$j<=$jhal;$j++){
		if($j != $hal) {
			echo "<li><a href=\"?page=home&hal=$j\">$j</a></li>";
		}else{
			echo "<li class='active'><a href=#>$j</a></li>";
		}
	}
	echo "
			</ul>
		</div>
	";
?>

<?php for($i = 0; $i < count($data); $i++) { ?>
<form action="?page=process" method="post">
<div class="modal hide fade" id="modalDetail<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="modalDetail<?=$i?>Label" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 id="modalDetail<?=$i?>">Detail Buku</h4>
  </div>
  <div class="modal-body">
      <div class="row-fluid">
		<input type="hidden" name="kodeBuku" id="kodeBuku" value="<?=$data[$i][0]?>">
		<input type="hidden" name="kodePeminjam" id="kodePeminjam" value="<?=$idUser?>">
		<input type="hidden" name="type" id="type" value="<?=$type?>">
		<div class="span4">
			<p><img src="img/no_image.jpg" class="img-polaroid img"></p>
		</div>
		<div class="span7 title">
			<table class="table table-condensed">
			  <thead>
				<tr>
				  <th width="30%"></th>
				  <th></th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
				  <td>Judul:</td>
				  <td><?=$data[$i][1]?></td>
				</tr>
				<tr>
				  <td>Penerbit:</td>
				  <td><?=$data[$i][2]?></td>
				</tr>
				<tr>
				  <td>Pengarang:</td>
				  <td><?=$data[$i][3]?></td>
				</tr>
				<tr>
				  <td>Tahun:</td>
				  <td><?=$data[$i][4]?></td>
				</tr>
				<tr>
				  <td>Kategori:</td>
				  <td><?=$data[$i][9]?></td>
				</tr>
			  </tbody>
			</table>
		</div>
	  </div>
	  <hr />
	  <div class="row-fluid">
		<div class="span12">
			<p class="title">
				<strong>Abstrak</strong>
			</p>
			<p class="title">
				<?=$data[$i][8]?>
			</p>
		</div>
	  </div>
  </div>
  <div class="modal-footer">
    <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Tutup</button>
	
	<?php
		$kodePinjam = date('Ymd')."".$type."".$idUser;
		$db=new MySQL();
		$db->connect();
		$db->execute("SELECT p.kodePinjam FROM tb_pinjamdetail t, tb_pinjam p
			WHERE p.kodePinjam = ".$kodePinjam." 
			AND p.kodePeminjam = ".$idUser."
			AND p.kodePinjam = t.kodePinjam");
		$exist1 = $db->get_dataset();
		$db->execute("SELECT kodePinjam FROM tb_pinjam 
			WHERE kodePinjam = ".$kodePinjam." 
			AND status != 0 
			AND kodePeminjam = ".$idUser."");
		$exist2 = $db->get_dataset();
		$db->execute("SELECT t.kodeBuku FROM tb_pinjamdetail t, tb_pinjam p WHERE t.kodePinjam = ".$kodePinjam." AND t.kodeBuku = ".$data[$i][0]." AND p.kodePeminjam = ".$idUser."");
		$exist3 = $db->get_dataset();
		if(count($exist1) == 2) {		
	?>
		<input class="btn btn-primary" type="submit" value="Anda telah memenuhi batas pinjaman hari ini" name="pinjam" id="pinjam" disabled>
	<?php } else if(count($exist2) == 1) { ?>
		<input class="btn btn-primary" type="submit" value="Anda telah memenuhi batas pinjaman hari ini" name="pinjam" id="pinjam" disabled>
	<?php } else if(count($exist3) == 1) { ?>
		<input class="btn btn-primary" type="submit" value="Anda telah meminjam buku ini" name="pinjam" id="pinjam" disabled>
	<?php } else { ?>	
		<input class="btn btn-primary" type="submit" value="Pinjam" name="pinjam">
	<?php }	?>
  </div>
</div>
</form>
<?php } ?>
