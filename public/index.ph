<?php

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => 'https://partners.tcbbank.co.tz/public/api/reference/KgkkLGjKhENdtS9LtPGtE6ww01uJm3uy3mo9n7tS',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => [
        'partnerCode' => 'PART-MAZINGIRA',
        'profileID'   => '150400000034',
        'reference'   => '999QSL923456',
        'name'        => 'Jordan Makwabe',
        'mobile'      => '255787753939',
        'message'     => "COLLECTION",
    ],
]);

$response = curl_exec($curl);

if(curl_errno($curl)){
    echo "cURL Error: " . curl_error($curl);
}

curl_close($curl);

echo $response;




