<?php

namespace Phpcon2013\Authentication;


class Authenticator {

    public function authenticate($login, $password)
    {
        if(empty($login)) {
            return false;
        }
    }
}