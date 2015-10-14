<!DOCTYPE html>
<html>
<body>
<?php
				include ("koneksi.php");
				if(isset($_POST['submit']))
				{
					$nim = $_POST['nim'];
					$nama = $_POST['nama'];
					$alamat = $_POST['alamat'];
					$prodi = $_POST['prodi'];
				 
					$sql = "INSERT INTO mahasiswa ".
						   "(nim,nama,alamat,prodi) ".
						   "VALUES('$nim','$nama','$alamat', '$prodi')";
				$tambahdata = mysql_query( $sql );
				if(! $tambahdata )
				{
					die('Gagal Tambah Data: ' . mysql_error());
				}
					header("location:tambah.php");
					echo "Berhasil tambah data\n";

				}
				else
				{
			?>

<a href="view_mahasiswa.php">Lihat Mahasiswa</a>
<form method="POST" action="mhs.php">
	<table>
	<tr>
		<td>NIM</td>
		<td><input type="text" name="nim" id="nim"></td>
	</tr>
	<tr>
		<td>Nama</td>
		<td><input type="text" name="nama" id="nama"></td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td><input type="text" name="alamat" id="alamat"></td>
	</tr>
	<tr>
		<td>Prodi</td>
		<td><input type="text" name="prodi" id="prodi"></td>
	</tr>

	<tr>
		<td><input type="submit" name="submit" value="tambah"></td>
	</tr>
</table>
</form>
</body>
</html>