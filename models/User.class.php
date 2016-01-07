<?php

class User {
	private $_login;
	private $_password;


	function __construct($login, $password) {
		$this->_login = $login;
		$this->_password = $password;
	}

}

?>
