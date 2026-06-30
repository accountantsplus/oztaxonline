<?php

$ch = curl_init();
$clientId = "AXnrl_ug1qHek7exuv-QQ53dC81Nu-r5bV7CpCoSfasuKzLVWBUIdnoPg8ozmTSnGv_qIf4-7LkKa5KJ";
$secret = "EGyhTm0F9xw8Tk9fOdMthbRL4y2j9l1SvdbE7euVgSgPdIA7Kvo8NUlMykkOEB2xuLDkkCKwLkvgby9e";

curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/oauth2/token");
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, "Accept: application/json, Accept-Language: en_AU");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_USERPWD, $clientId.":".$secret);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

$result = curl_exec($ch);
$err = curl_error($ch);

curl_close($ch);

$access_token="";
if ($err) {
  echo "cURL Error #:" . $err;
}
else
{
    $json = json_decode($result);
   // print_r($json->access_token);
    $access_token = $json->access_token;
    echo "token:" . $access_token . "<br>";
}


$data = '{
  "intent":"sale",
  "redirect_urls":{
    "return_url":"https://www.policetax.com.au/paypal/success.php",
    "cancel_url":"https://www.policetax.com.au/paypal/cancel.php"
  },
  "payer": {
    "payment_method":"paypal",
  },
  "transactions":[
    {
      "amount":{
        "total":"7.47",
        "currency":"AUD"
      },
      "description":"This is the payment transaction description."
    }
  ]
}
';
$c = curl_init();
curl_setopt($c, CURLOPT_URL, "https://api-m.sandbox.paypal.com/v2/payments/payment");
curl_setopt($c, CURLOPT_CUSTOMREQUEST ,"POST");
curl_setopt($c, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($c, CURLOPT_POSTFIELDS, $data); 
curl_setopt($c, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: Bearer ".$json->access_token));
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);

$result = curl_exec($ch);
$err = curl_error($ch);

curl_close($c);

if ($err) {
  echo "cURL Error #:" . $err;
}
else
{
    if(empty($result))die("Error: No response.");
    else
    {
        //$json = json_decode($result);
        $httpStatusCode = curl_getinfo($c, CURLINFO_HTTP_CODE);
        print_r($result);
        print_r($httpStatusCode);
    }
}

?>