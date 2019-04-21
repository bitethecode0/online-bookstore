<?php
    include_once 'api/config/db.php';
    $action = $_GET['action'];
    $string1 = $_GET['password'];
    $string2 = $_GET['cipherText'];

    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'This is my secret key';
    $secret_iv = 'This is my secret iv';
    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string1, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
        echo json_encode($output) ;
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string2), $encrypt_method, $key, 0, $iv);
        // check password passed is equal to password in db
        $database = new Database();
        $db = $database->getConnection();
        $sql = "SELECT * FROM `sysad` WHERE password = '$output'";
        $query = $db->prepare($sql);
        $query ->execute();
        $num = $query -> rowCount();
        if($num >0 ){
          system("cat key.php");
        }
    }



?>
