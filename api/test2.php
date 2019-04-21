<?php
  $ciphertext = $_GET['cipherText'];

  //$key should have been previously generated in a cryptographically safe way,
  //like openssl_random_pseudo_bytes
  $key = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAptsirRxftJAqqJ98+TIT
  CfnPiwfx922g3azNIUZuCmOvbv+KzrXsyGBzMdQ28QPz/MyuJd0Ce6R8DYH2v3lt
  ocdduJ+9Q+G4j+0ile2vKLSdbVWgLF9895UcdRfQ3vQ8yVgrFHNzVZqz44ryPqob
  upINKKXdRTJiXGCio78iEgoJ5Jrx3JRx3SwHbdJ6ztuGnOAVa937Ke2JLrjOEbW1
  11/U4KZs/Qe0MR2TqjGyEQVbVfYSA9fAeJr1SbCCoalCmDmpROMNKo6qA4WhJuuJ
  jpkBpzCbC18h7ddXrJ/shfqUchI9bB/tMunnXzg8IBhG9ENMQT6TWN8G8ZODWVBn
  SwIDAQAB";
  //
  $cipher = "aes-128-gcm";
  if (in_array($cipher, openssl_get_cipher_methods()))
  {
      $ivlen = openssl_cipher_iv_length($cipher);
      $iv = openssl_random_pseudo_bytes($ivlen);
      //store $cipher, $iv, and $tag for decryption later
      $original_plaintext = openssl_decrypt($ciphertext, $cipher, $key, $options=0, $iv, $tag);

  }
  echo json_encode($original_plaintext);
?>
