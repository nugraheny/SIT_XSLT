<?php
ini_set('display_errors', false);
//header untuk format xml, jika dihilangkan maka akan berbentuk data string
header('Content-Type: text/xml; charset=ISO-8859-1');
include "koneksi.php";
//check for the path elemen 
$path = $_SERVER[PATH_INFO];
if($path != null)
	{
		$path_params = spliti ("/", $path);
	}
//method request untuk GET
	if($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		if($path_params[1] !=null){
			$query = "select niim, nama, alamat, prodi from mahasiswa where nim=$path_params[1]";
		}
		else
		{
			$query = "select nim, nama, alamat, prodi from mahasiswa";
		}
		$result = mysql_query($query) or die ('Query failed : '.mysql_error());

		echo"<data>";
		while($line = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			echo "<mahasiswa>";
			foreach ($line as $key => $col_value) 
			{
				echo "<$key>$col_value</$key>";
			}
			echo "</mahasiswa>";
		}
		echo "</data>";

mysql_free_result($result);
	}

	//method request untuk close

mysql_close($link);
?>