	<table class="responsive-table" border="2" style="width: 100%;">
	<tr>
		<td><h4 class="blue-text hide-on-med-and-down">Tulis Laporan</h4></td>
		
	</tr>
	<tr>
		<td style="padding: 20px;">
			<form method="POST" enctype="multipart/form-data">
				<textarea class="materialize-textarea" name="laporan" placeholder="Tulis Laporan"></textarea><br><br>
				<label>Gambar</label>
				<input type="file" name="foto"><br><br>
				<input type="submit" name="kirim" value="Kirim" class="btn">
			</form>
		</td>

		<td>
			<tr>
			<td><h4 class="blue-text hide-on-med-and-down">Daftar Laporan</h4></td>

			
			<table border="3" class="responsive-table striped highlight">
				<Thread>
				<tr>
					<td>No</td>
				    <td>NIK </td>
					<td>nama</td>
					<td>isi laporan</td>
					<td>Tanggal Masuk</td>
					<td>Status</td>
					<td>Opsi</td>
				</tr>
				<?php
					$no=1;
					$pengaduan = mysqli_query($koneksi,"SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik=masyarakat.nik WHERE pengaduan.nik='".$_SESSION['data']['nik']."' ORDER BY pengaduan.id_pengaduan DESC");
					while ($r=mysqli_fetch_assoc($pengaduan)) { ?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $r['nik']; ?></td>
						<td><?php echo $r['nama']; ?></td>
						<td><?php echo $r['isi_laporan'] ?> </td>
						<td><?php echo $r['tgl_pengaduan']; ?></td>
						<td><?php echo $r['status']; ?></td>
						<td>
							<a class="btn blue modal-trigger" href="#tanggapan&id_pengaduan=<?php echo $r['id_pengaduan'] ?>">More</a> 
							<a class="btn red" onclick="return confirm('Anda Yakin Ingin Menghapus Laporan? Y/N')" href="index.php?p=pengaduan_hapus&id_pengaduan=<?php echo $r['id_pengaduan'] ?>">Hapus</a></td>

<!-- ditanggapi -->
        <div id="tanggapan&id_pengaduan=<?php echo $r['id_pengaduan'] ?>" class="modal">
          <div class="modal-content">
            <h4 class="blue-text">Detail</h4>
            <div class="col s12">
				
            	<p>Petugas : <?php echo $r['nama_petugas']; ?></p>
				<p>Tanggal Masuk : <?php echo $r['tgl_pengaduan']; ?></p>
				<p>Tanggal Ditanggapi : <?php echo $r['tgl_tanggapan']; ?></p>
				<p>Isi Tanggapan : <?php echo $r['tanggapan']; ?> </p>
				<?php 
					if($r['foto']=="kosong"){ ?>
						<img src="../img/noImage.png" width="100">
				<?php	}else{ ?>
					<img width="100" src="../img/<?php echo $r['foto']; ?>">
				<?php }
				 ?>
				<br><b>Pesan</b>
				<p><?php echo $r['isi_laporan']; ?></p>
				<br><b>respon</b>
				<p><?php echo $r['tanggapan']; ?></p>
				<p>Status : <?php echo $r['status']; ?></p>
            </div>
          </div>
          <div class="modal-footer col s12">
            <a href="#!" class="modal-close waves-effect waves-red btn-flat">Close</a>
          </div>
        </div>
<!-- ditanggapi -->

					</tr>
				<?php	}
				 ?>
			</table>

		</td>
	</tr>
</table>
<?php 
	
	 if(isset($_POST['kirim'])){
	 	$nik = $_SESSION['data']['nik'];
	 	$tgl = date('Y-m-d');


	 	$foto = $_FILES['foto']['name'];
	 	$source = $_FILES['foto']['tmp_name'];
	 	$folder = './../img/';
	 	$listeks = array('jpg','png','jpeg');
	 	$pecah = explode('.', $foto);
	 	$eks = $pecah['1'];
	 	$size = $_FILES['foto'][''];
	 	$nama = date('dmYis').$foto;

		if($foto !=""){
		 	if(in_array($eks, $listeks)){
		 		if($size<=100000){
					move_uploaded_file($source, $folder.$nama);
					$query = mysqli_query($koneksi,"INSERT INTO pengaduan VALUES (NULL,'$tgl','$nik','".$_POST['laporan']."','$nama','proses')");

		 			if($query){
			 			echo "<script>alert('Pengaduan Berhasil Dikirim Dan akan segera di proses')</script>";
			 			echo "<script>location='index.php';</script>";
		 			}

		 		}
		 		else{
		 			echo "<script>alert('Akuran Gambar Tidak Lebih Dari 100KB')</script>";
		 		}
		 	}
		 	else{
		 		echo "<script>alert('Format File Tidak Di Dukung')</script>";
		 	}
		}
		else{
			$query = mysqli_query($koneksi,"INSERT INTO pengaduan VALUES (NULL,'$tgl','$nik','".$_POST['laporan']."','noImage.png','proses')");
			if($query){
			 	echo "<script>alert('Berhasil Mengirim Laporan')</script>";
	 			echo "<script>location='index.php';</script>";
 			}
		}

	 }

 ?>