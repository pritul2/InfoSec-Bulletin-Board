<?php
function hash_cookie($value)
{
    if (!$value)
    {
        return false;
    }
    $pt = $value;
    $ct = hash_hmac('md5', $pt, 'GFG_DATA');
    return trim($ct);
}

function encrypt_cookie($value)
{
    if (!$value)
    {
        return false;
    }
    $cipher = "AES-128-CBC";
    $key = "it key";

    $len = openssl_cipher_iv_length($cipher = "AES-128-CBC");
    $iv = openssl_random_pseudo_bytes($len);

    $ct_raw = openssl_encrypt($value, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
    $hmac = hash_hmac('sha256', $ct_raw, $key, $as_binary = true);
    $ct = base64_encode($iv . $hmac . $ct_raw);

    return trim($ct);
}

function decrypt_cookie($value)
{
    if (!$value)
    {
        return false;
    }
    $cipher = "AES-128-CBC";
    $key = "it key";

    $c = base64_decode($value);

    $len = openssl_cipher_iv_length($cipher = "AES-128-CBC");
    $iv = substr($c, 0, $len);
    $hmac = substr($c, $len, $sha2len = 32);
    $ct_raw = substr($c, $len + $sha2len);
    $original_plaintext = openssl_decrypt($ct_raw, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);

    $calcmac = hash_hmac('sha256', $ct_raw, $key, $as_binary = true);
    if (hash_equals($hmac, $calcmac))
    {
        return trim($original_plaintext);
    }
    else
    {
        return false;
    }
}

?>
