<?php

include "connect.php";

$fields = array(
    "sender_id" => "FSTSMS",
    "message" => "Your OTP for Sign up in College Yata is $otp",
    "language" => "english",
    "route" => "q",
    "numbers" => $mobile,

);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => json_encode($fields),
  CURLOPT_HTTPHEADER => array(
    "authorization: aUWhxLRiqaV8SsfpprHb45SEsKLHvm1ddd4hSbFj7IYHoHFdUeIczFe7hReO",
    "accept: */*",
    "cache-control: no-cache",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
curl_close($curl);
echo $response;


?>

