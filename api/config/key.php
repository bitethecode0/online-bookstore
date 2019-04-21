<?php
  $config = array(
    "digest_alg" => "sha512",
    "private_key_bits" => 512,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
  );

  // create the private and public key
  $res = openssl_pkey_new($config);

  function getKey(){
      echo "get key?". $res;
      // extract the public key from $res to $pubKey
      $pubKey = openssl_pkey_get_details($res);
      $pubKey = $pubKey["key"];
      return $pubKey;
  }

  function getPrivKey(){
    // extract the private key from $res to $privKey
    openssl_pkey_export($res, $privKey);
    return $privKey;
  }
?>
