<?php

//1. koneksi ke database
$konek= mysql_connect("localhost", "root", "");
$db = mysql_select_db("mahasiswa");
if($konek)
	{
		echo("sip <br>");
	}
	else 
	{
		echo("ora sip <br>");
	}

if($db)
	{
		echo("db ada <br>");
	}
	else 
	{
		echo ("db null <br>");
	}

//2.query database
$query = "select * from mahasiswa";
$hasil = mysql_query($query);
$datamahasiswa = array();
while ($data = mysql_fetch_array($hasil)){
		$datamahasiswa [] =array('nim' => $data['nim'],
		'nama' => $data['nama'],
		'alamat' => $data['alamat'],
		'prodi'=>$data['prodi']);	}
//3.parsing data xml
$document = new DOMDocument ();
$document -> formatOutput = true;
$root = $document -> createElement("data");
$document -> appendChild($root);
foreach ($datamahasiswa as $mahasiswa ){
		$block = $document -> createElement ("mahasiswa");
		//create element nim
		$nim = $document -> createElement("nim");
		//Create element untuk membuat element baru
		$nim -> appendChild ($document->createTextNode($mahasiswa['nim']));
		//create text node untuk menampilkan isi/value
		$block->appendChild($nim);
		//create element nama
		$nama = $document->createElement("nama");
		//Create element untuk membuat element baru
		$nama -> appendChild ($document->createTextNode($mahasiswa['nama']));
		//create text node untuk menampilkan isi/value
		$block->appendChild($nama);
		//create element alamat
		$alamat = $document->createElement("alamat");
		//Create element untuk membuat element baru
		$alamat -> appendChild ($document->createTextNode($mahasiswa['alamat']));
		//create text node untuk menampilkan isi/value
		$block->appendChild($alamat);
		//create element prodi
		$prodi = $document->createElement("prodi");
		//Create element untuk membuat element baru
		$prodi -> appendChild ($document->createTextNode($mahasiswa['prodi']));
		//create text node untuk menampilkan isi/value
		$block->appendChild($prodi);
		$root->appendChild($block);}

//4. menyimpan data dalam bentuk file xml

$generateXML = $document->save("mahasiswa.xml");
if($generateXML)
	{
		echo("berhasil di generate <br>");
	}
	else
	{
		echo ("gagal <br>");
	}

//5. membaca file xml, 
	//membuka file 

$url ="http://localhost/sit_mahasiswa/4.12/mahasiswa.xml";
$client =curl_init($url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($client);
curl_close($client);
	//membaca file
//6.menampilkan dalam bentuk html
$datamahasiswaxml= simplexml_load_string($response);
//print_r ($datamahasiswa);
//perulangan 
	echo "
		<table border='1'>
		<tr>
			<td>NIM</td>
			<td>Nama</td>
			<td>Alamat</td>
			<td>Prodi</td>
		</tr>";
foreach($datamahasiswaxml ->mahasiswa as $mahasiswa)
	{
		echo "
		<tr>
			<td>".$mahasiswa ->nim."</td>
			<td>".$mahasiswa ->nama."</td>
			<td>".$mahasiswa ->alamat."</td>
			<td>".$mahasiswa ->prodi."</td>
		</tr>";
	}
	echo "</table>";
?>

