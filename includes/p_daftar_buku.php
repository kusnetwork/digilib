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
		b.seri, b.abstraksi, k.namaKategori, b.tglInput, b.tglUpdate, pt.nama, p1.kodePenerbit, p2.kodePengarang
		FROM tb_buku b, tb_penerbit p1, tb_pengarang p2, tb_kategori k, tb_petugas pt
		WHERE b.kodePenerbit = p1.kodePenerbit
		AND b.kodePengarang = p2.kodePengarang
		AND b.kodeKategori = k.kodeKategori
		AND pt.kodePetugas = b.lastUpdateBy
		limit $posisi, $batas"); 
	$data = $db->get_dataset();
	if(count($data) > 0) {
?>
<div class="row-fluid">
	<h2 class="title title-large">
		Daftar Buku
		<span class="pull-right">
			<a href="#modalTambah" role="button" rel="tooltip" title="Tambah" class="btn btn-mini btn-success" data-toggle="modal">
				<i class="icon-plus icon-white"></i> Tambah Data
			</a>
		</span>
	</h2>
	<hr />
	<table class="table table-condensed table-striped">
	  <thead>
		<tr>
		  <th width="10%">#</th>
		  <th width="25%">Judul Buku</th>
		  <th width="25%">Penerbit</th>
		  <th width="25%">Pengarang</th>
		  <th width="15%"></th>
		</tr>
	  </thead>
	  <tbody>
	  <?php
		for($i=0; $i<count($data); $i++) {
	  ?>
		<tr>
		  <td><?=$i+1+$posisi?></td>
		  <td><?=$data[$i][1]?></td>
		  <td><?=$data[$i][2]?></td>
		  <td><?=$data[$i][3]?></td>
		  <td>
			<a href="#modalDetail<?=$i?>" role="button" rel="tooltip" title="Detail" class="btn btn-info btn-mini" data-toggle="modal"><i class="icon-zoom-in icon-white"></i></a>
			<a href="#modalEdit<?=$i?>" role="button" rel="tooltip" title="Edit" class="btn btn-mini btn-success" data-toggle="modal"><i class="icon-edit icon-white"></i></a>
			<a href="?page=process&o=d&id=<?=$data[$i][0]?>&tb=1" rel="tooltip" title="Hapus" class="btn btn-mini btn-danger" onClick="return confirm('Apakah anda yakin ingin menghapus Pelajaran ini?"><i class="icon-remove icon-white"></i></a>
		  </td>
		</tr>
	  <?php } ?>
	  </tbody>
	</table>
</div>

<?php } else { ?>
<div class="row-fluid">
	<h2 class="title title-large">Daftar Buku</h2>
	<hr />
	<div class="alert alert-error">
	  <strong>Warning!</strong> Daftar buku kosong
	</div>
</div>
<?php } ?>
<hr />
<?php	
	//PAGINATION
	$db=new MySQL();
	$db->connect();
	$db->execute("SELECT b.kodeBuku, b.judul, p1.nama, p2.nama, b.tahun, b.edisi, b.issn_isbn, 
		b.seri, b.abstraksi, k.namaKategori, b.tglInput, b.tglUpdate, pt.nama, p1.kodePenerbit, p2.kodePengarang
		FROM tb_buku b, tb_penerbit p1, tb_pengarang p2, tb_kategori k, tb_petugas pt
		WHERE b.kodePenerbit = p1.kodePenerbit
		AND b.kodePengarang = p2.kodePengarang
		AND b.kodeKategori = k.kodeKategori
		AND pt.kodePetugas = b.lastUpdateBy"); 
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
	  </div><!--row-->
	  <hr />
	  
	  <div class="row-fluid">
		<div class="span12">
			<p class="title">
				<strong>Keterangan</strong>
			</p>
			<table class="table table-condensed">
			  <thead>
				<tr>
				  <th width="30%"></th>
				  <th></th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
				  <td>Edisi:</td>
				  <td><?=$data[$i][5]?></td>
				</tr>
				<tr>
				  <td>ISSN ISBN:</td>
				  <td><?=$data[$i][6]?></td>
				</tr>
				<tr>
				  <td>Seri:</td>
				  <td><?=$data[$i][7]?></td>
				</tr>
				<tr>
				  <td>Tanggal Input:</td>
				  <td><?=$data[$i][10]?></td>
				</tr>
				<tr>
				  <td>Tanggal Update:</td>
				  <td><?=$data[$i][11]?></td>
				</tr>
				<tr>
				  <td>Terakhir Update:</td>
				  <td><?=$data[$i][12]?></td>
				</tr>
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

<!-- EDIT -->
<?php for($i = 0; $i < count($data); $i++) { ?>
<form action="?page=process" method="post">
<div class="modal hide fade" id="modalEdit<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="modalEdit<?=$i?>Label" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 id="modalEdit<?=$i?>">Edit Buku</h4>
  </div>
  <div class="modal-body">
      <div class="row-fluid">
		<input type="hidden" name="kodeBuku" id="kodeBuku" value="<?=$data[$i][0]?>">
		<input type="hidden" name="kodePetugas" id="kodePetugas" value="<?=$idUser?>">
		<input type="hidden" name="tb" id="tb">
		<div>
			<label><p class="title">Judul Buku</p>
			  <input name="judul" type="text" class="span12" value="<?=$data[$i][1]?>">
			</label>
			<label><p class="title">Penerbit</p>
				<select name="kodePenerbit" class="span12">
				  <?php
					$db=new MySQL();
					$db->connect();
					$db->execute("SELECT kodePenerbit, nama FROM tb_penerbit"); 
					$pn=$db->get_dataset();
					for($j = 0; $j < count($pn); $j++) {
						if($data[$i][13] == $pn[$j][0]) {
				  ?>
							<option value="<?=$pn[$j][0]?>" selected="selected"><?=$pn[$j][1]?></option>
				  <?php } else { ?>
							<option value="<?=$pn[$j][0]?>"><?=$pn[$j][1]?></option>
				  <?php }
					} ?>
				</select>
			</label>
			<label><p class="title">Pengarang</p>
				<select name="kodePengarang" class="span12">
				  <?php
					$db=new MySQL();
					$db->connect();
					$db->execute("SELECT kodePengarang, nama FROM tb_pengarang"); 
					$pn=$db->get_dataset();
					for($j = 0; $j < count($pn); $j++) {
						if($data[$i][14] == $pn[$j][0]) {
				  ?>
							<option value="<?=$pn[$j][0]?>" selected="selected"><?=$pn[$j][1]?></option>
				  <?php } else { ?>
							<option value="<?=$pn[$j][0]?>"><?=$pn[$j][1]?></option>
				  <?php }
					} ?>
				</select>
			</label>
			<label><p class="title">Tahun Terbit</p>
			  <input name="tahun" type="text" class="span12" value="<?=$data[$i][4]?>">
			</label>
			<label><p class="title">Edisi</p>
			  <input name="edisi" type="text" class="span12" value="<?=$data[$i][5]?>">
			</label>
			<label><p class="title">ISSN ISBN</p>
			  <input name="issn_isbn" type="text" class="span12" value="<?=$data[$i][6]?>">
			</label>
			<label><p class="title">Seri</p>
			  <input name="seri" type="text" class="span12" value="<?=$data[$i][7]?>">
			</label>
			<label><p class="title">Abstraksi</p>
			  <textarea name="abstraksi" class="span12" rows="4"><?=$data[$i][8]?></textarea>
			</label>
			<label><p class="title">Kategori</p>
				<select name="kodeKategori" class="span12">
				  <?php
					$db=new MySQL();
					$db->connect();
					$db->execute("SELECT kodeKategori, namaKategori FROM tb_kategori"); 
					$pn=$db->get_dataset();
					for($j = 0; $j < count($pn); $j++) {
						if($data[$i][9] == $pn[$j][0]) {
				  ?>
							<option value="<?=$pn[$j][0]?>" selected="selected"><?=$pn[$j][1]?></option>
				  <?php } else { ?>
							<option value="<?=$pn[$j][0]?>"><?=$pn[$j][1]?></option>
				  <?php }
					} ?>
				</select>
			</label>
		</div>
	  </div>
  </div>
  <div class="modal-footer">
    <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Tutup</button>
	<input class="btn btn-primary" type="submit" value="Simpan" name="edit" id="edit">
  </div>
</div>
</form>
<?php } ?>

<!-- TAMBAH -->
<form action="?page=process" method="post">
<div class="modal hide fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 id="modalTambah">Tambah Buku</h4>
  </div>
  <div class="modal-body">
      <div class="row-fluid">
		<input type="hidden" name="kodePetugas" id="kodePetugas" value="<?=$idUser?>">
		<input type="hidden" name="tb" id="tb">
		<div>
			<label><p class="title">Judul Buku</p>
			  <input name="judul" type="text" class="span12" value="">
			</label>
			<label><p class="title">Penerbit</p>
				<select name="kodePenerbit" class="span12">
				  <?php
					$db=new MySQL();
					$db->connect();
					$db->execute("SELECT kodePenerbit, nama FROM tb_penerbit"); 
					$pn=$db->get_dataset();
					for($j = 0; $j < count($pn); $j++) {
				  ?>
					<option value="<?=$pn[$j][0]?>"><?=$pn[$j][1]?></option>
				  <?php } ?>
				</select>
			</label>
			<label><p class="title">Pengarang</p>
				<select name="kodePengarang" class="span12">
				  <?php
					$db=new MySQL();
					$db->connect();
					$db->execute("SELECT kodePengarang, nama FROM tb_pengarang"); 
					$pn=$db->get_dataset();
					for($j = 0; $j < count($pn); $j++) {
				  ?>
					<option value="<?=$pn[$j][0]?>"><?=$pn[$j][1]?></option>
				  <?php } ?>
				</select>
			</label>
			<label><p class="title">Tahun Terbit</p>
			  <input name="tahun" type="text" class="span12" value="">
			</label>
			<label><p class="title">Edisi</p>
			  <input name="edisi" type="text" class="span12" value="">
			</label>
			<label><p class="title">ISSN ISBN</p>
			  <input name="issn_isbn" type="text" class="span12" value="">
			</label>
			<label><p class="title">Seri</p>
			  <input name="seri" type="text" class="span12" value="">
			</label>
			<label><p class="title">Abstraksi</p>
			  <textarea name="abstraksi" class="span12" rows="4"></textarea>
			</label>
			<label><p class="title">Kategori</p>
				<select name="kodeKategori" class="span12">
				  <?php
					$db=new MySQL();
					$db->connect();
					$db->execute("SELECT kodeKategori, namaKategori FROM tb_kategori"); 
					$pn=$db->get_dataset();
					for($j = 0; $j < count($pn); $j++) {
				  ?>
						<option value="<?=$pn[$j][0]?>"><?=$pn[$j][1]?></option>
				  <?php } ?>
				</select>
			</label>
		</div>
	  </div>
  </div>
  <div class="modal-footer">
    <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Tutup</button>
	<input class="btn btn-primary" type="submit" value="Simpan" name="add" id="add">
  </div>
</div>
</form>