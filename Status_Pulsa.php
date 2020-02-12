<?php
//Script Auto Update Status Pulsa Nasional

//apidata
 $apikey = "api_Key_Lo"; //Api Key
    $id =  123356; //id order
//end apidata

//postdata
$postdata = array('api_key' => $apikey,
                  'action'  => 'status'
                  'id'      =>  $id
                 );
//end postdata

//curl
$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://nasional-media.com/api/pulsa');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $chresult = curl_exec($ch);
    curl_close($ch);
    $json_result = json_decode($chresult);
//end curl
 
      //check provider apakah nespedia dan memasukan result ke variabel
      if ($provider == "NASIONAL-PULSA") {
          $status = $json_result['data']['status'];
          $catatan = $json_result['data']['catatan'];
      //end check provider
       
       //check/ubah status Layanan sesuai database
         if ($status == "Pending") {
            $u_status = "Pending";
         } else if ($status == "Error") {
            $u_status = "Error";
         } else if ($status == "Success") {
            $u_status = "Success";
         } else {
             $u_status = "Pending";
         }
        //end check status
        }
       

?>
