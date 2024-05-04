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
 <?php for($i=0; $i<count($data); $i++) { ?>
	<div class="span2 center">
        <p><img src="img/no_image.jpg" class="img-polaroid"></p>
        <p class="title"><?=$data[$i][1]?></p>
        <p class="title title-small">( <?=$data[$i][3]?> )</p>
        <p>
	        <a href="#modalDetail<?=$i?>" role="button" class="btn btn-block btn-info btn-small" data-toggle="modal">
            	<i class="icon-zoom-in icon-white"></i> Detail
            </a>
        </p>
        <p>
            <a class="btn btn-block btn-success btn-small">
            	<i class="icon-ok icon-white"></i> Pinjam
            </a>
        </p>
    </div>
  <?php } ?>
</div>
<hr />
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
	$data=$db->get_dataset();
	$jum=count($data);
	$jhal=ceil($jum/$batas);
	
	echo "
		<div class='pagination'>
			<ul>
		";
	for($j=1;$j<=$jhal;$j++){
		if($j != $hal) {
			echo "<li><a href=\"?page=d_jadwal&hal=$j\">$j</a></li>";
		}else{
			echo "<li class='active'><a href=#>$j</a></li>";
		}
	}
	echo "
			</ul>
		</div>
	";
?>


<div class="modal hide fade" id="modalDetail<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="modalDetail<?=$i?>Label" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 id="modalDetail<?=$i?>">Edit</h4>
  </div>
  <div class="modal-body row-fluid">
    <label>
    	<input name="id" type="hidden"value="<?=$poli[$i][0]?>">
    </label>
  	<label><span class="title">Nama Poli</span>
		<input name="nama" type="text" class="span11" placeholder="Nama Poli" value="<?=$poli[$i][1]?>">
    </label>
    <label><span class="title">Alamat IP</span>
		<input name="ip" type="text" class="span11" placeholder="Nama Poli" value="<?=$poli[$i][2]?>">
    </label>
  </div>
  <div class="modal-footer">
    <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Batal</button>
    <button class="btn btn-primary" type="submit" name="submitPoli">Simpan</button>
  </div>
</div>