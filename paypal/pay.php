<?php

     require_once __DIR__."/paypal-curl.class.php";

     $base = "https://api-m.sandbox.paypal.com";
     //$base = "https://api-m.paypal.com";
     $id = "AXnrl_ug1qHek7exuv-QQ53dC81Nu-r5bV7CpCoSfasuKzLVWBUIdnoPg8ozmTSnGv_qIf4-7LkKa5KJ";
     $secret = "EGyhTm0F9xw8Tk9fOdMthbRL4y2j9l1SvdbE7euVgSgPdIA7Kvo8NUlMykkOEB2xuLDkkCKwLkvgby9e";

     //init input
     $order = time();
     $price = 10;
     $currency = "AUD";
     $return = "https://www.policetax.com.au/paypal/verify.payment.php";

     //make payment
     $paypal = new paypalCurl();
     $paypal->init($id,$secret,$base);
     $result = $paypal->makePaymentURL($order,$price,$currency,$return);

     if ($result->status === true) {
         header("location:". $result->url);
         die;
     }
     else  { //raise error
         echo $result->msg;
         die;
     }
?>