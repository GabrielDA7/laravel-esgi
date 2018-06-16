<?php

namespace App\Libs;

class CustomHasher {

    /**
     * Encrypt and decrypt the given value.
     *
     * @param  string  $value
     * @return array   $options
     * @return string
     */
    public function encrypt_decrypt($action, $string, $salt) {
      $encrypt_method = "AES-256-CBC";

      $secret_key = md5($salt, true);
      $secret_iv = md5(strrev($salt), true);

      // hash
      $key = hash('sha256', $secret_key);

      // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
      $iv = substr(hash('sha256', $secret_iv), 0, 16);

      if ( $action == 'encrypt' ) {
          $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
          $output = base64_encode($output);
      } else if( $action == 'decrypt' ) {
          $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
      }
      return $output;
    }

}
