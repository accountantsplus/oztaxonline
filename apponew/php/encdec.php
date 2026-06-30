<?php
function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'policetaxsecretkey';
    $secret_iv = date("H:i:s:u:v");
    $key = hash('sha256', $secret_key);
    if ( $action == 'encrypt' ) {
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = $iv.openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = base64_decode($string);
        $iv = substr($output, 0, 16);
        $output = substr($output, 16);
        $output = openssl_decrypt($output, $encrypt_method, $key, 0, $iv);
    }
    return $output;
}
?>