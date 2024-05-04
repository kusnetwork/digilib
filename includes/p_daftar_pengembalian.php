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
	$db->execute("SELECT p.kodePinjam, p.kodePeminjam, p.tipePeminjam, p.tglPinjam, p.tglKembali, p.status, p.kodePetugas, pt.nama
		FROM tb_pinjam p, tb_petugas pt
		WHERE p.status = 2
		AND p.kodePetugas = pt.kodePetugas
		limit $posisi, $batas"); 
	$data = $db->get_dataset();
	if(count($data) > 0) {
?>
<div class="row-fluid">
	<h2 class="title title-large">
		Daftar Pengembalian
	</h2>
	<hr />
	<table class="table table-condensed table-striped">
	  <thead>
		<tr>
		  <th width="10%">#</th>
		  <th width="15%">Kode</th>
		  <th width="25%">Nama Peminjam</th>
		  <th width="10%">Tipe</th>
		  <th width="25%">Tanggal Pinjam</th>
		  <th width="12%"></th>
		</tr>
	  </thead>
	  <tbody>
	  <?php
		for($i=0; $i<count($data); $i++) {
			$db=new MySQL();
			$db->connect();
			if($data[$i][2] == 2) {
				$db->execute("SELECT d.nama FROM tb_dosen d, tb_pinjam p
					WHERE d.kodeDosen = ".$data[$i][1]."
					limit $posisi, $batas"); 
				$tipe = "Dosen";
			}
			else {
				$db->execute("SELECT d.nama FROM tb_mahasiswa d, tb_pinjam p
					WHERE d.kodeMhs = ".$data[$i][1]."
					limit $posisi, $batas"); 
				$tipe = "Mahasiswa";
			}
			$tp[$i][0] = $tipe;
			$nama = $db->get_dataset();
			$nm[$i][0] = $nama[0][0];
		
	  ?>
		<tr>
		  <td><?=$i+1+$posisi?></td>
		  <td><?=$data[$i][0]?></td>
		  <td><?=$nama[0][0]?></td>
		  <td><?=$tipe?></td>
		  <td><?=$data[$i][3]?></td>
		  <td>
			<a href="#modalDetail<?=$i?>" role="button" rel="tooltip" title="Detail" class="btn btn-info btn-mini" data-toggle="modal"><i class="icon-zoom-in icon-white"></i></a>
			<?php if($data[$i][4] == "0000-00-00 00:00:00") { ?>
				<a href="?page=process&o=k&id=<?=$data[$i][0]?>&tpgm=1" rel="tooltip" title="Konfirmasi" class="btn btn-mini btn-success"><i class="icon-check icon-white"></i></a>
				<!--<a href="?page=process&o=d&id=<?=$data[$i][0]?>&tb=1" rel="tooltip" title="Hapus" class="btn btn-mini btn-danger" onClick="return confirm('Apakah anda yakin ingin menghapus Pelajaran ini?"><i class="icon-remove icon-white"></i></a>-->
			<?php } ?>
		  </td>
		</tr>
	  <?php } ?>
	  </tbody>
	</table>
</div>

<?php } else { ?>
<div class="row-fluid">
	<h2 class="title title-large">Daftar Pengembalian</h2>
	<hr />
	<div class="alert alert-error">
	  <strong>Warning!</strong> Daftar pengembalian kosong
	</div>
</div>
<?php } ?>
<hr />
<?php	
	//PAGINATION
	$db=new MySQL();
	$db->connect();
	$db->execute("SELECT p.kodePinjam, p.kodePeminjam, p.tipePeminjam, p.tglPinjam, p.tglKembali, p.status, p.kodePetugas, pt.nama
		FROM tb_pinjam p, tb_petugas pt
		WHERE p.status = 2
		AND p.kodePetugas = pt.kodePetugas"); 
	$data2=$db->get_dataset();
	$jum=count($data2);
	$jhal=ceil($jum/$batas);
	
	echo "
		<div class='pagination'>
			<ul>
		";
	for($j=1;$j<=$jhal;$j++){
		if($j != $hal) {
			echo "<li><a href=\"?page=daftar_buku&hal=$j\">$j</a></li>";
		}else{
			echo "<li class='active'><a href=#>$j</a></li>";
		}
	}
	echo "
			</ul>
		</div>
	";
?>

<!-- DETAIL -->
<?php for($i = 0; $i < count($data); $i++) { ?>
<div class="modal hide fade" id="modalDetail<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="modalDetail<?=$i?>Label" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 id="modalDetail<?=$i?>">Detail Buku</h4>
  </div>
  <div class="modal-body">
      <div class="row-fluid">
		<div class="span12">
			<table class="table table-condensed">
			  <thead>
				<tr>
				  <th width="30%"></th>
				  <th></th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
				  <td>Nama:</td>
				  <td><?=$nm[$i][0]?></td>
				</tr>
				<tr>
				  <td>Petugas:</td>
				  <td><?=$data[$i][7]?></td>
				</tr>
				<tr>
				  <td>Tipe Peminjam:</td>
				  <td><?=$tp[$i][0]?></td>
				</tr>
				<tr>
				  <td>Tanggal Pinjam:</td>
				  <td><?=$data[$i][3]?></td>
				</tr>
				<tr>
				  <td>Tanggal Kembali:</td>
				  <td><?php if($data[$i][4] == "0000-00-00 00:00:00") { echo "Belum Kembali"; } else { echo $data[$i][4]; } ?></td>
				</tr>
				<tr>
				  <td>DENDA:</td>
				  <td>
				  <?php
					$db=new MySQL();
					$db->connect();
					if($data[$i][4] == "0000-00-00 00:00:00")
						$db->execute("SELECT datediff(now(), tglPinjam) 
							FROM `tb_pinjam` 
							WHERE datediff(now(), tglPinjam) < 30
							AND kodePinjam = ".$data[$i][0]." "); 
					else
						$db->execute("SELECT datediff(tglKembali, tglPinjam) 
							FROM `tb_pinjam` 
							WHERE datediff(tglKembali, tglPinjam) < 30
							AND kodePinjam = ".$data[$i][0]." ");
					$dnd=$db->get_dataset();
					if($dnd[0][0] >= 7) {
						$denda = $dnd[0][0] * 500;
				  ?>
				  Rp. <?=$denda?> (Terlambat: <?=$dnd[0][0]?> hari)
				  <?php } else {?>
				  Rp. 0
				  </td>
				  <?php } ?>
				</tr>
			  </tbody>
			</table>
		</div>
	  </div><!--row-->
	  
	  <div class="row-fluid">
		<div class="span12">
			<p class="title">Buku yang dipinjam</p>
			<table class="table table-condensed">
			  <thead>
				<tr>
				  <th width="10%">#</th>
				  <th>Judul</th>
				</tr>
			  </thead>
			  <tbody>
			  <?php
				$db=new MySQL();
				$db->connect();
				$db->execute("SELECT b.kodeBuku, b.judul FROM tb_buku b, tb_pinjamdetail pd, tb_pinjam p
					WHERE p.kodePinjam = ".$data[$i][0]."
					AND p.kodePinjam = pd.kodePinjam
					AND b.kodeBuku = pd.kodeBuku"); 
				$buku=$db->get_dataset();
				for($j = 0; $j < count($buku); $j++) {
			  ?>
				<tr>
				  <td><?=$j+1?></td>
				  <td><?=$buku[$j][1]?></td>
				</tr>
			  <?php } ?>
			  </tbody>
			</table>
		</div>
	  </div><!--row-->
	  
  </div>
  <div class="modal-footer">
    <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Tutup</button>
  </div>
</div>
<?php } ?>