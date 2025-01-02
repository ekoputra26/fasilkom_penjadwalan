<?php
class Libencrypt {

        public $ciphering;
        public $iv_length;
        public $options;
        public $init_key;
        public $keystore;
        public function __construct(){
                $this->ciphering = "AES-128-CBC";
                $this->iv_length = openssl_cipher_iv_length($this->ciphering);
                $this->options = 0;
                $this->init_key = '1020301234568123';
                $this->keystore = "FASILKOMUNSRIVSFKIP";

        }

        public function encData($val){
                $encryption = openssl_encrypt($val, $this->ciphering,
                    $this->keystore, $this->options, $this->init_key);

                return $encryption;
        }
        public function decData($val){
                $decryption=openssl_decrypt ($val, $this->ciphering, 
                        $this->keystore, $this->options, $this->init_key);

                return $decryption;
        }
}
?>