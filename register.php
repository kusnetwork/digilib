<!-- REGISTER PAGE -->
<br />
<br />


<?php
	if ($_GET['mode'] == "register") {
?>

<form action="checkreg.php" method="post">
<input name="register1" type="hidden">
<div id="register">
  	<div class="header">
      <div id="logo">
        <img src="img/logoTA.png" width="70px" class="img-float"> 
        <h3 class="title">Register User Thesis Assistant</h3><br>
      </div>
  	</div>
	<div class="content">
        <div class="control-group">
          <label class="control-label" for="nrp"></label>
          <div class="controls">
            <div class="input-prepend">
              <span class="add-on">NRP</span>
              <input class="span3" type="text" name="nrp" autofocus>
            </div>
          </div>
        </div>
        
        <div class="control-group">
          <label class="control-label" for="username"></label>
          <div class="controls">
            <div class="input-prepend">
              <span class="add-on"><i class="icon-user"></i></span>
              <input class="span3" type="text" placeholder="Username" name="username">
            </div>
          </div>
        </div>
        
        <div class="control-group">
          <label class="control-label" for="password"></label>
          <div class="controls">
            <div class="input-prepend">
              <span class="add-on"><i class="icon-lock"></i></span>
              <input class="span3" type="password" placeholder="Password" name="password">
            </div>
          </div>
        </div>
        
        <div class="control-group">
          <label class="control-label" for="password2"></label>
          <div class="controls">
            <div class="input-prepend">
              <span class="add-on"><i class="icon-lock"></i></span>
              <input class="span3" type="password" placeholder="Ulangi Password" name="password2">
            </div>
          </div>
        </div>
        
        <label>
            Tipe Account: 
            <select name="type" class="span2" disabled id="type">
              <option value=3>Mahasiswa</option>
            </select>
        </label>
        
        <div class="control-group">
          <label class="control-label" for="email"></label>
          <div class="controls">
            <div class="input-prepend">
              <span class="add-on"><i class="icon-envelope"></i></span>
              <input class="span3" type="text" placeholder="Email" name="email">
            </div>
          </div>
        </div>
        
        <br>            
  	</div>

<?php	
	} else if ($_GET['mode'] == "register2") {
?>
	
<form action="checkreg.php" method="post">
<input name="register2" type="hidden">
<div id="register">
  	<div class="header">
      <div id="logo">
        <img src="img/logoTA.png" width="70px" class="img-float"> 
        <h3 class="title">Register User Thesis Assistant</h3><br>
      </div>
  	</div>
    
	<div class="content">
    	<div class="well">
            Masukkan kode verifikasi yang telah dikirim ke alamat Email anda.
        </div>
        <div class="control-group">
          <label class="control-label" for="username"></label>
          <div class="controls">
            <div class="input-prepend">
              <span class="add-on"><i class="icon-lock"></i></span>
              <input class="span3" type="text" placeholder="Kode verifikasi" name="username" autofocus>
            </div>
          </div>
        </div>
        
        <br>            
  	</div>

<?php	
	} else if ($_GET['mode'] == "register3") {
?>
<form action="checkreg.php" method="post">
<input name="register3" type="hidden">
<div id="register">
  	<div class="header">
      <div id="logo">
        <img src="img/logoTA.png" width="70px" class="img-float"> 
        <h3 class="title">Register User Thesis Assistant</h3><br>
      </div>
  	</div>
	
    <div class="content">
        <div class="control-group">
          <label class="control-label" for="name"></label>
          <div class="controls">
              <input class="span3" type="text" placeholder="Nama lengkap" name="name" autofocus>
          </div>
        </div>
        
        <div class="control-group">
          <label class="control-label" for="address"></label>
          <div class="controls">
            <textarea name="address" rows="3" class="span3" placeholder="Alamat lengkap"></textarea>
          </div>
        </div>
        
        <div class="control-group">
          <label class="control-label" for="phone"></label>
          <div class="controls">
              <input class="span3" type="text" placeholder="No. telepon" name="phone">
          </div>
        </div>
        
        <br>            
  	</div>

<?php
	}
?>


<!-- FOOTER -->

	<div class="footer control-group">
      <div class="controls">
        <a href="javascript:history.back()" class="btn btn-danger btn-medium">
            <i class="icon-arrow-left icon-white"></i>
            Back
        </a>
        <button type="submit" class="btn btn-success btn-medium pull-right">
            Next
            <i class="icon-arrow-right icon-white"></i>
        </button>
      </div>
  </div>
  
</div>
</form>
          