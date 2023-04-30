<?php
//include('error_display.php');
function encrypt_string($simple_string, $encryption_key){
    $ciphering = "aes-256-cbc";
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($ciphering));
    $encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, OPENSSL_RAW_DATA, $iv);
    $encrypted_data = base64_encode($iv . $encryption); // Combine IV and ciphertext and encode as base64
    echo "<script>console.log('Debug Objects: " . $encrypted_data . "' );</script>";
    return $encrypted_data;
}

function decrypt_string($encrypted_data, $encryption_key){
    $ciphering = "aes-256-cbc";
    $encrypted_data = base64_decode($encrypted_data); // Decode base64-encoded string
    $iv = substr($encrypted_data, 0, openssl_cipher_iv_length($ciphering)); // Extract IV from encrypted data
    $encryption = substr($encrypted_data, openssl_cipher_iv_length($ciphering)); // Extract ciphertext from encrypted data
    $decryption = openssl_decrypt($encryption, $ciphering, $encryption_key, OPENSSL_RAW_DATA, $iv);
    return $decryption;
}

?>
