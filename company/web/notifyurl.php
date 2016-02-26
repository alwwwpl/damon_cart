<?php
    $data = file_get_contents('php://input');

    if(empty($data))
    {
        return;
    }

    $url = 'http://wap.iddmall.com/cart/wx-notify-url';

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($curl,CURLOPT_SSLVERSION,CURL_SSLVERSION_TLSv1);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);

    curl_close($curl);

    echo $output;

?>