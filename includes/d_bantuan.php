<?php
	$kodePinjam = date('Ymd')."".$type."".$idUser;
	$db=new MySQL();
	$db->connect();
	$db->execute("SELECT b.judul, b.kodeBuku, t2.kodePinjamDetail, t1.kodePinjam, t1.tglPinjam
		FROM tb_buku b, tb_pinjam t1, tb_pinjamdetail t2 
		WHERE t1.kodePeminjam = ".$idUser."
		AND t1.kodePinjam = t2.kodePinjam
		AND t2.kodeBuku = b.kodeBuku
		AND t1.status = 2");
	$data = $db->get_dataset();
	if(count($data) > 0) {
?>
<div class="row-fluid">
	<h2 class="title title-large">Bantuan</h2>
	<hr />
</div>
ini bantuan

<?php } else { ?>
<div class="row-fluid">
	<h2 class="title title-large">Bantuan</h2>
	<hr />
	<div class="alert alert-error">
	  <strong>Warning!</strong> Anda belum meminjam buku
	</div>
</div>
<?php } ?>
