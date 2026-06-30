<?php
    
    require_once __DIR__."/paypal-curl.class.php";
    
    //$token = $_GET["token"];
    $token = "4W4942241A6609545rr";
    
    $base = "https://api-m.sandbox.paypal.com";
    //$base = "https://api-m.paypal.com";
    $id = "AXnrl_ug1qHek7exuv-QQ53dC81Nu-r5bV7CpCoSfasuKzLVWBUIdnoPg8ozmTSnGv_qIf4-7LkKa5KJ";
    $secret = "EGyhTm0F9xw8Tk9fOdMthbRL4y2j9l1SvdbE7euVgSgPdIA7Kvo8NUlMykkOEB2xuLDkkCKwLkvgby9e";
    
    $paypal = new paypalCurl();
    $paypal -> init($id,$secret,$base);
    
    $result = $paypal->verify($token);
    
    if ($result -> state == true && $result -> ref === "COMPLETED" && is_string($result -> id) && $result -> id !== '' ) {
        echo "YES";
    } else echo "NO";
    var_dump($result);
?>