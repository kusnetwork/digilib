<?php
	$batas=20;	
	if(empty($_GET["hal"])){
		$posisi=0;
		$hal=1;
	}else{
		$hal=$_GET["hal"];
		$posisi=($hal-1)*$batas;
	}
	$db=new MySQL();
	$db->connect();
	$db->execute("SELECT kodePenerbit, nama, alamat, telp, email FROM tb_penerbit
		limit $posisi, $batas"); 
	$data = $db->get_dataset();
	if(count($data) > 0) {
?>
<div class="row-fluid">
	<h2 class="title title-large">
		Daftar Penerbit
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
		  <th width="75%">Nama Penerbit</th>
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
		  <td>			
			<a href="#modalDetail<?=$i?>" role="button" rel="tooltip" title="Detail" class="btn btn-info btn-mini" data-toggle="modal"><i class="icon-zoom-in icon-white"></i></a>
			<a href="#modalEdit<?=$i?>" role="button" rel="tooltip" title="Edit" class="btn btn-mini btn-success" data-toggle="modal"><i class="icon-edit icon-white"></i></a>
			<a href="?page=process&o=d&id=<?=$data[$i][0]?>&tpn=1" rel="tooltip" title="Hapus" class="btn btn-mini btn-danger" onClick="return confirm('Apakah anda yakin ingin menghapus Pelajaran ini?"><i class="icon-remove icon-white"></i></a>
		  </td>
		</tr>
	  <?php } ?>
	  </tbody>
	</table>
</div>

<?php } else { ?>
<div class="row-fluid">
	<h2 class="title title-large">Daftar Penerbit</h2>
	<hr />
	<div class="alert alert-error">
	  <strong>Warning!</strong> Daftar penerbit kosong
	</div>
</div>
<?php } ?>
<hr />
<?php	
	//PAGINATION
	$db=new MySQL();
	$db->connect();
	$db->execute("SELECT kodePenerbit, nama, alamat, telp, email FROM tb_penerbit
		limit $posisi, $batas"); 
	$data2=$db->get_dataset();
	$jum=count($data2);
	$jhal=ceil($jum/$batas);
	
	echo "
		<div class='pagination'>
			<ul>
		";
	for($j=1;$j<=$jhal;$j++){
		if($j != $hal) {
			echo "<li><a href=\"?page=daftar_penerbit&hal=$j\">$j</a></li>";
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
    <h4 id="modalDetail<?=$i?>">Detail Penerbit</h4>
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
				  <td><?=$data[$i][1]?></td>
				</tr>
				<tr>
				  <td>Alamat:</td>
				  <td><?=$data[$i][2]?></td>
				</tr>
				<tr>
				  <td>No telp.:</td>
				  <td><?=$data[$i][3]?></td>
				</tr>
				<tr>
				  <td>Email:</td>
				  <td><?=$data[$i][4]?></td>
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
    <h4 id="modalEdit<?=$i?>">Edit Penerbit</h4>
  </div>
  <div class="modal-body">
      <div class="row-fluid">
		<input type="hidden" name="kodePenerbit" id="kodePenerbit" value="<?=$data[$i][0]?>">
		<input type="hidden" name="tpn" id="tpn" value=1>
		<div>
			<label><p class="title">Nama Penerbit</p>
			  <input name="nama" type="text" class="span12" value="<?=$data[$i][1]?>" autofocus>
			</label>
			<label><p class="title">Alamat</p>
			  <input name="alamat" type="text" class="span12" value="<?=$data[$i][2]?>" autofocus>
			</label>
			<label><p class="title">No telp.</p>
			  <input name="telp" type="text" class="span12" value="<?=$data[$i][3]?>" autofocus>
			</label>
			<label><p class="title">Email</p>
			  <input name="email" type="text" class="span12" value="<?=$data[$i][4]?>" autofocus>
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
    <h4 id="modalTambah">Tambah Penerbit</h4>
  </div>
  <div class="modal-body">
      <div class="row-fluid">
		<input type="hidden" name="tpn" id="tpn" value=1>
		<div>
			<label><p class="title">Nama Penerbit</p>
			  <input name="nama" type="text" class="span12" value="" autofocus>
			</label>
			<label><p class="title">Alamat</p>
			  <input name="alamat" type="text" class="span12" value="" autofocus>
			</label>
			<label><p class="title">No telp.</p>
			  <input name="telp" type="text" class="span12" value="" autofocus>
			</label>
			<label><p class="title">Email</p>
			  <input name="email" type="text" class="span12" value="" autofocus>
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