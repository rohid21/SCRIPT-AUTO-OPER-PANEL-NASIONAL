<?php
//Script Order Layanan Pulsa Nasional


// api data
            $service_id = 123; //id service
            $api_key = "api_key";
            $target = "083321xxx";
            // end api data

               //postdata
                $postdata = array('api_key' => $api_key,
                                  'action'  => 'pemesanan',
                                  'layanan' => $service_id,
                                  'target'  => $target
                                  );
                 //end postdata
                 
                //curl
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://nasional-media.com/api/pulsa");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $chresult = curl_exec($ch);
                curl_close($ch);
                $json_result = json_decode($chresult);
                 //end curl
     
                 //Response Json
                 if ($json_result['status'] == true) {
    echo "ORDER SUKSES, ORDER ID : ".$json_result['data']['id'];
} else {
    echo "ORDER GAGAL, PESAN : ".$json_result['data']['pesan'];
}
                  //end Response

?>
