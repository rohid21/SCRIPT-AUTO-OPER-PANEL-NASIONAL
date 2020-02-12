<?php
/*CREATED DATE: 07 DESEMBER 2019 08.44 AM
BY MRC0D3 A.K.A MUHAMMAD ROHID HIDAYAT
*/
require_once("config.php");//koneksi kepada database
$key = "ISI API KEY"; // isi api_key mu disini
$postdata = "api_key=$key&action=layanan";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://nasional-media.com/api/sosial-media");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$chresult = curl_exec($ch);
//echo $chresult;
curl_close($ch);
$json_result = json_decode($chresult, true);
$indeks=0; 
$i = 1;
// get data service
while($indeks < count($json_result['data'])){ 
    
$id=$json_result['data'][$indeks]['sid'];
$kategori =$json_result['data'][$indeks]['kategori'];
$layanan = $json_result['data'][$indeks]['layanan'];
$catatan =$json_result['data'][$indeks]['catatan'];
$min = $json_result['data'][$indeks]['min'];
$max = $json_result['data'][$indeks]['max'];
$harga = $json_result['data'][$indeks]['harga'];
$indeks++; 
$i++;
// end get data service 
// setting price 
$rate = $harga; 
$rate_asli = $rate + 500; //setting penambahan harga
// setting price 
 $check_services = mysqli_query($db, "SELECT * FROM services WHERE sid = '$id' AND provider='NASIONAL SOSMED'");
            $data_services = mysqli_fetch_assoc($check_orders);
        if(mysqli_num_rows($check_services) > 0) {
            echo "Service Sudah Ada Di database => $layanan<br />";
        } else {
            
$insert=$conn->query("INSERT INTO services (sid, kategori, layanan, catatan, min, max, harga, status, pid, provider) VALUES ('$id','$kategori','$layanan','$catatan','$min','$max','$rate_asli','Active','$id','NASIONAL SOSMED')");//Memasukan Kepada Database (OPTIONAL)
if($insert == TRUE){
echo"SUKSES INSERT LAYANAN -> Kategori : $kategori || SID : $id || Layanan :$layanan || Min :$min || Max : $max ||Harga : $rate_asli || Catatan : $catatan <br />";
}else{
    echo "GAGAL MEMASUKAN DATA";
    
}
}
}
?>
