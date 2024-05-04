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
	$db->execute("SELECT p.kodePinjam, p.kodePeminjam, p.tipePeminjam, p.tglPinjam, p.status
		FROM tb_pinjam p WHERE p.status = 1
		limit $posisi, $batas"); 
	$data = $db->get_dataset();
	if(count($data) > 0) {
?>
<div class="row-fluid">
	<h2 class="title title-large">
		Daftar Peminjaman
	</h2>
	<hr />
	<table class="table table-condensed table-striped">
	  <thead>
		<tr>
		  <th width="10%">#</th>
		  <th width="15%">Kode</th>
		  <th width="25%">Nama Peminjam</th>
		  <th width="10%">Tipe</th>
		  <th width="25%">Tanggal</th>
		  <th width="15%"></th>
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
			$nama = $db->get_dataset();
		
	  ?>
		<tr>
		  <td><?=$i+1+$posisi?></td>
		  <td><?=$data[$i][0]?></td>
		  <td><?=$nama[0][0]?></td>
		  <td><?=$tipe?></td>
		  <td><?=$data[$i][3]?></td>
		  <td>
			<?php if($data[$i][4] == 1) { ?>
			<!--<a href="#modalDetail<?=$i?>" role="button" rel="tooltip" title="Detail" class="btn btn-info btn-mini" data-toggle="modal"><i class="icon-zoom-in icon-white"></i></a>-->
			<a href="?page=process&o=k&id=<?=$data[$i][0]?>&tpjm=1" rel="tooltip" title="Konfirmasi" class="btn btn-mini btn-success pull-right"><i class="icon-check icon-white"></i></a>
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
	<h2 class="title title-large">Daftar Peminjaman</h2>
	<hr />
	<div class="alert alert-error">
	  <strong>Warning!</strong> Daftar peminjaman kosong
	</div>
</div>
<?php } ?>
<hr />
<?php	
	//PAGINATION
	$db=new MySQL();
	$db->connect();
	$db->execute("SELECT p.kodePinjam, p.kodePeminjam, p.tipePeminjam, p.tglPinjam, p.status
		FROM tb_pinjam p WHERE p.status = 1"); 
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