<?php
/*CREATED DATE: 07 DESEMBER 2019 08.11 AM
BY MRC0D3 A.K.A MUHAMMAD ROHID HIDAYAT
*/
require_once("config.php");//koneksi kepada database
$key = "ISI API KEY"; // your api key
$postdata = "api_key=$key&action=layanan";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://nasional-media.com/api/pulsa");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$chresult = curl_exec($ch);
echo $chresult;
curl_close($ch);
$json_result = json_decode($chresult, true);
$indeks=0;
$i = 1;
// get data service
while($indeks < count($json_result['data'])){
   
$id =$json_result['data'][$indeks]['id'];
$layanan=$json_result['data'][$indeks]['layanan'];
$harga = $json_result['data'][$indeks]['harga'];
$operator=$json_result['data'][$indeks]['operator'];
$indeks++;
$i++;
// end get data service
// setting price
$rate = $harga;
$rate_asli = $rate+500; //setting penambahan harga
// setting price
 $check_services_pulsa = mysqli_query($db, "SELECT * FROM services_pulsa WHERE pid = '$id' AND provider='NASIONAL PULSA");
            $data_services_pulsa = mysqli_fetch_assoc($check_orders);
        if(mysqli_num_rows($check_services_pulsa) > 0) {
            echo "Service Sudah Ada Di database => $service | $id \n <br />";
        } else {
           
$insert=$conn->query("INSERT INTO services_pulsa (sid,operator,layanan,harga, status, pid, provider) VALUES ('$id','$operator','$layanan','$rate_asli','Normal','$id','NASIONAL PULSA')");
//Sesuaikan database anda (OPTIONAL)
if($insert == TRUE){
echo"SUKSES INSERT -> Kategori : $operator || SID : $id || Layanan :$layanan | Harga : $rate_asli<br />";
}else{
    echo "GAGAL MEMASUKAN DATA";
   
}
}
}
?>
