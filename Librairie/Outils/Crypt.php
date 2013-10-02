<?php

/**
 * Description of Crypt
 *
 * @author galbanie
 */
class Crypt {
    /**
	 * Clé utilisée pour générer le cryptage
	 * @var string
	 */
	private $key;
 
	/**
	 * Données à crypter
	 * @var string
	 */
	private $data;
 
	/**
	 * Constructeur de l'objet
	 * @param string $key Clé utilisée pour générer l'encodage
	 */
	public function __construct($key) {
		$this->key = sha1($key);
	}
        
        public function getData() {
            return $this->data;
        }
        
	/**
	 * Encodeur de chaîne
	 * @param string $string Chaîne à coder
	 * @return string Chaîne codée
	 */
	public function code($string) {
		$this->data = '';
		for ($i = 0; $i<strlen($string); $i++) {
			$kc = substr($this->key, ($i%strlen($this->key)) - 1, 1);
			$this->data .= chr(ord($string{$i})+ord($kc));
		}
		$this->data = base64_encode($this->data);
		return $this->data;
	}
 
	/**
	 * Décodeur de Chaîne
	 * @param string $string Chaîne à décoder
	 * @return string
	 */
	public function decode($string) {
		$this->data = '';
		$string = base64_decode($string);
		for ($i = 0; $i<strlen($string); $i++) {
			$kc = substr($this->key, ($i%strlen($this->key)) - 1, 1);
			$this->data .= chr(ord($string{$i})-ord($kc));
		}
		return $this->data;
	}
}

?>
