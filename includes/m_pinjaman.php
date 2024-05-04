<?php
	$kodePinjam = date('Ymd')."".$type."".$idUser;
	$db=new MySQL();
	$db->connect();
	$db->execute("SELECT b.judul, b.kodeBuku, t2.kodePinjamDetail, t1.kodePinjam
		FROM tb_buku b, tb_pinjam t1, tb_pinjamdetail t2 
		WHERE t1.kodePinjam = ".$kodePinjam."
		AND t1.kodePinjam = t2.kodePinjam
		AND t2.kodeBuku = b.kodeBuku
		AND t1.status = 0");
	$data = $db->get_dataset();
	if(count($data) > 0) {
?>
<div class="row-fluid">
	<h2 class="title title-large">Daftar Pinjaman</h2>
	<hr />
	<table class="table">
	  <thead>
		<tr>
		  <th width="5%">#</th>
		  <th width="45%">Judul Buku</th>
		  <th width="45%">Kode Buku</th>
		  <th width="5%"></th>
		</tr>
	  </thead>
	  <tbody>
	  <?php
		for($i=0; $i<count($data); $i++) {
	  ?>
		<tr>
		  <td><?=$i+1?></td>
		  <td><?=$data[$i][0]?></td>
		  <td><?=$data[$i][1]?></td>
		  <td>
			<a href="?page=process&o=d&id=<?=$data[$i][2]?>" class="btn btn-small btn-danger"><i class="icon-remove icon-white"></i></a>
		  </td>
		</tr>
	  <?php } ?>
	  </tbody>
	</table>
	<hr />
	<a href="?page=process&o=pp&id=<?=$data[0][3]?>" class="btn btn-primary pull-right"><i class="icon-ok icon-white"></i> Proses Pinjaman</a>
</div>

<?php } else { ?>
<div class="row-fluid">
	<h2 class="title title-large">Daftar Pinjaman</h2>
	<hr />
	<div class="alert alert-error">
	  <strong>Warning!</strong> Anda belum meminjam buku
	</div>
</div>
<?php } ?>