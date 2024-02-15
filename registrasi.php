<!DOCTYPE html>
<html>
<head>
	<title>Aplikasi Pengaduan Masyarakat</title>
	<link rel="shortcut icon" href="https://cepatpilih.com/image/logo.png">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

	<link href="//cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">

</head>
 
<body style="background: url(img/paul.jpg); background-size: cover;">


<div class="container">
		

<div class="card" style="padding: 50px; width: 40%; margin: 0 auto; margin-top: 10%;">
<h3 style="text-align: center;" class="blue-text">Daftar</h3>
<br>

<form method="POST">
				<div class="col s12 input-field">
					<label for="nik"></label>
					<input id="nik" type="number" name="nik" placeholder="NIK">
				</div>
				<div class="col s12 input-field">
					<label for="nama"></label>
					<input id="nama" type="text" name="nama" placeholder="Nama">
				</div>
				<div class="col s12 input-field">
					<label for="username"></label>		
					<input id="username" type="text" name="username" placeholder="Username"><br><br>
				</div>
				<div class="col s12 input-field">
					<label for="password"></label>
					<input id="password" type="password" name="password" placeholder="password"><br><br>
				</div>
				<div class="col s12 input-field">
					<label for="telp"></label>
					<input id="telp" type="number" name="telp" placeholder="Telepon"><br><br>
				</div>
				<div class="col s12 input-field">
					<input type="submit" name="simpan" value="Simpan" class="btn right">
					<br><br><center><p>sudah punya akun? <a href='index.php' title='registrasi' target='_blank'>ke login</a></p></center>
				</div>
			</form>

			<?php 
			include 'conn/koneksi.php';
				if(isset($_POST['simpan'])){
					$password = md5($_POST['password']);

					$query=mysqli_query($koneksi,"INSERT INTO masyarakat VALUES ('".$_POST['nik']."','".$_POST['nama']."','".$_POST['username']."','".$password."','".$_POST['telp']."')");
					if($query){
						echo "<script>alert('Berhasil Membuat Akun')</script>";
						echo "<script>location='location:index.php?p=registrasi';</script>";
					}
				}
			 ?>

            
			
          </div>
          <div class="modal-footer">
            <a href="login.php" class="modal-close waves-effect waves-red btn-flat">Close</a>
          </div>





	</div>
</body>
</html>
