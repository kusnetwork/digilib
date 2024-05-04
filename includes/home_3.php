  <div class="row-fluid nav-left">
	<div class="span3 well scroll">
	  <div class="sidebar-nav">
		<ul class="nav nav-list">
		  <li class="nav-header">Kategori</li>
		  <?php	
			$db=new MySQL();
			$db->connect();
			$db->execute("SELECT kodeKategori, namaKategori
				FROM tb_kategori"); 
			$cat=$db->get_dataset();
			for($i=0; $i<count($cat); $i++) {
		  ?>
			<li><a href="#"><?=$cat[$i][1]?></a></li>
		  <?php } ?>
		</ul>
	  </div><!--/.well -->
	</div><!--/span-->
	
	<div class="span9 well" id="main-content">
	  <div class="row-fluid">
		<div class="span12">
		  <?php 
			if(!isset($page))
				include("includes/m_home.php"); 
			else
				include("includes/m_". $page .".php"); 
		  ?>
		</div><!--/span-->
	  </div><!--/row-->
	</div><!--/span-->
  </div><!--/row-->