  <div class="row-fluid nav-left">
	<div class="span3 well scroll">
	  <div class="sidebar-nav">
		<ul class="nav nav-list">
			<li class="nav-header title">Menu</li>
			<li><a href="?page=daftar_buku">Daftar Buku</a></li>
			<li><a href="?page=daftar_kategori">Daftar Kategori</a></li>
			<li><a href="?page=daftar_penerbit">Daftar Penerbit</a></li>
			<li><a href="?page=daftar_pengarang">Daftar Pengarang</a></li>
			<li class="divider"></li>
			<li class="nav-header title">User</li>
			<li><a href="?page=daftar_petugas">Daftar Petugas</a></li>
			<li><a href="?page=daftar_dosen">Daftar Dosen</a></li>
			<li><a href="?page=daftar_mahasiswa">Daftar Mahasiswa</a></li>
			<li class="divider"></li>
			<li class="nav-header title">Transaksi</li>
			<li><a href="?page=daftar_peminjaman">Daftar Peminjaman</a></li>
			<li><a href="?page=daftar_pengembalian">Daftar Pengembalian</a></li>
		</ul>
	  </div><!--/.well -->
	</div><!--/span-->
	
	<div class="span9 well" id="main-content">
	  <div class="row-fluid">
		<div class="span12">
		  <?php 
			if(!isset($page))
				include("includes/p_daftar_buku.php"); 
			else
				include("includes/p_". $page .".php"); 
		  ?>
		</div><!--/span-->
	  </div><!--/row-->
	</div><!--/span-->
  </div><!--/row-->