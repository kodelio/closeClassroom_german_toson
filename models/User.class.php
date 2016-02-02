<?php

class User
{
    private $_login;
    private $_password;

    public function __construct($login, $password)
    {
        $this->_login = $login;
        $this->_password = $password;
    }
}
