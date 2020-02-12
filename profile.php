<?php
//Script Api Profile Nasional
$api = ""; //api key mu

$postdata = array('api_key' => $api                 
                 );
                 
     $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,"https://nasional-media.com/api/profile");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $chresult = curl_exec($ch);
            var_dump($chresult);
            curl_close($ch);
            $json_result = json_decode($chresult, true);
            
            if($json_result['status'] = true) {
            echo "Username : ".$json_result['data']['username'];
            echo "Saldo : ".$json_result ['data']['saldo'];
            } else {
            echo "GAGAL : ".$json_result['data']['pesan'];
            }
?>
