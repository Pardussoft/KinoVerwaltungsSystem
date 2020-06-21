<?php
//Oturum başlamamışsa başlat
if (empty($SID)) 
	session_start();

include "conn.php";

$dosya = @$_FILES["filmeBildFile"]; 
$filmID= $_REQUEST["id"];

if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest')
{
	// Eğer Ajax işlemi dışında dosyaya erişim sağlanırsa hata verdirelim
	die("Erişim engellendi!");
}

//php object
$json = (object) [
    'hata' => '',
	'hatano' => '',
    'basarili' => 0,
	'resimIsim' => '',
 ];


if(empty($dosya["name"])) 
{
	//Eğer dosya seçilmemişse
	$json->hata = "Bir dosya seçiniz!";
}
else {
	$dosyaBilgi = pathinfo($dosya["name"]); // Dosya bilgilerini aldık
	$yuklenecekKlasor = "img/filme"; // Dosyanın yükleneceği klasörü değişkene aktardık
	$json->hata = $yuklenecekKlasor;
	//$dosyaAdi = uniqid($dosyaBilgi["filename"]."_"); // Dosya adı oluşturduk. Çıktısı: dosyanıngerçekadı_rastgeledeğer
	
	$dosyaAdi = "filme".$filmID.".".$dosyaBilgi["extension"];

	$uzantilar = array("png","gif","jpeg","jpg"); // İzin verilen dosya uzantıları
	$boyut = 1024*1024; // İzin verilen dosya boyutu. 1MB
	if(!in_array($dosyaBilgi["extension"], $uzantilar))
	{
		// Eğer geçersiz uzantıysa
		$json->hata = "Geçersiz dosya uzantısı";
	}else if($dosya["size"] > $boyut)
	{
		// Eğer dosya boyutu fazlaysa
		$json->hata = "Dosya boyutu en fazla 500kb olabilir!";
	}else
	{
		$tam_url = $yuklenecekKlasor."/".$dosyaAdi; // Dosyamızın tam olarak yükleneceği yolu belirliyoruz

		if(move_uploaded_file($dosya["tmp_name"], $tam_url)) // Dosyayı geçici olarak yüklendiği yerden tam_url değişkenimizde bellirtiğimiz yere yüklüyoruz
		{
			
			//Upload başarılı , şimdi veri tabanına resim ismini yazalım



			$sql = "UPDATE filme SET Bild='$dosyaAdi' WHERE FilmID=$filmID;";
			$result = $conn->query($sql); 

			if ($result) {
				// İşlem başarılıysa
				$json->basarili = 1;
				$json->resimIsim = $dosyaAdi; // Resimimizin url'sini gönderiyoruz
			} 
			else {
				$json->basarili = 0;
				$json->hata = $conn->error;
				$json->hatano = $conn->errno;
			}

			$conn-> close();
		}else
		{
			// Eğer dosya yükleme başarısızsa
			$json->hata = "Yükleme işlemi bilinmeyen bir sebeple başarısız oldu."; 
		}

	}
}

	// Json olarak çıktı gönderiyoruz
	echo json_encode($json);

?>