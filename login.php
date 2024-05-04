<?php
session_start();
include("config/MySQL.php");
include("config/date.php");
include("config/functions.php");

if (isset($_GET['p'])) {
    $p = $_GET['p'];
}



?>
<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="icon" type="image/png" href="img/logo.png">
    <title>Thesis Assistant | PENS</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            background: url(img/cream_dust.png);
        }
    </style>
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="js/redactor/css/redactor.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />

    <script src="js/vendor/modernizr-2.6.1-respond-1.1.0.min.js"></script>
</head>

<body>
    <!--MAIN CONTENT-->
    <div class="container-fluid">

        <?php if (empty($_GET['p'])) { ?>
            <br />
            <br />
            <div id="login">
                <div id="logo">
                    <img src="img/logoTA.png" width="70px" class="img-float">
                </div>
                <h3 class="title">Login User Thesis Assistant</h3>
                <form action="checklogin.php" method="post">
                    <label>
                        <input class="span4" type="text" placeholder="Username" name="username">
                    </label>
                    <label>
                        <input class="span4" type="password" placeholder="Password" name="password">
                    </label>
                    <label>
                        <select name="type" class="span4">
                            <option value="1">Koordinator</option>
                            <option value="2">Dosen</option>
                            <option value="3">Mahasiswa</option>
                        </select>
                    </label>
                    <hr />
                    <button type="submit" class="btn btn-primary">
                        <i class="icon-ok icon-white"></i>
                        Login
                    </button>
                    <a href="<?= base_url() ?>" class="btn btn-success">
                        <i class="icon-remove icon-white"></i>
                        Close
                    </a>
                </form>
            </div>
        <?php } else {
            if (!isset($_SESSION['user'])) {
                redirect("admin.php", "Anda belum login");
            }
        ?>
            <!--NAVBAR-->
            <div id="admin" class="navbar navbar-fixed-top">
                <div class="navbar-inner">
                    <div class="container">
                        <ul class="nav">
                            <li>
                                <a class="disabled" href="#"><?= $today; ?></a>
                            </li>
                        </ul>
                    </div><!--/.container -->
                </div><!--/.nav-inner -->
            </div>

            <div id="admin-main">
                <div class="row-fluid">
                    <ul class="nav nav-tabs tabs-left">

                        <li class="dropdown <?php if ($p == "post") echo "active" ?>">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="?p=post">
                                Berita
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="?p=post">Semua</a></li>
                                <li class="divider"></li>
                                <?php
                                $db = new MySQL();
                                $db->connect();
                                $db->execute("SELECT * FROM category");
                                $data = $db->get_dataset();
                                for ($i = 0; $i < count($data); $i++) {
                                ?>

                                    <li><a href="?p=post&cat=<?= $data[$i][0] ?>"><?= $data[$i][1] ?></a></li>

                                <?php
                                }
                                ?>
                            </ul>
                        </li>
                        <li <?php if ($p == "photo") echo "class=active" ?>><a href="?p=photo">Galeri Foto</a></li>
                        <li <?php if ($p == "category") echo "class=active" ?>><a href="?p=category">Kategori</a></li>
                        <li <?php if ($p == "comment") echo "class=active" ?>><a href="?p=comment">Komentar</a></li>
                        <li <?php if ($p == "admin-list") echo "class=active" ?>><a href="?p=admin-list">Admin</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                    <div style="padding: 15px">
                        <?php
                        if (isset($p)) {
                            include("admin/" . $_GET['p'] . ".php");
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!--FOOTER-->
            <div id="footer">
                <p>&copy; Thesis Assistant | PENS | 2012</p>
            </div>
            <!--End of FOOTER-->

        <?php } ?>
    </div><!--./CONTAINER-->



    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.2.min.js"><\/script>')</script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/redactor/redactor.min.js"></script>


    <!--Redactor WYSIWYG-->
    <script type="text/javascript">
        $(document).ready(
            function() {
                $('.redactor').redactor({
                    imageUpload: 'js/redactor/image_upload.php',
                    fileUpload: 'js/redactor/redactor_upload.php'
                });
                $("[rel=tooltip]").tooltip();
            }
        );
    </script>
</body>
</html>
