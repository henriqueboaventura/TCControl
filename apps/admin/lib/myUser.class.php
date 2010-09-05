<?php

class myUser extends doAuthSecurityUser
{
    public function signIn($user, $remember = false, $con = null)
    {
        parent::signIn($user, $remember, $con);
        $this->setAttribute('id', $user->id, 'usuario');
        $this->setAttribute('email', $user->email, 'usuario');
        $this->setAttribute('nome', $user->nome, 'usuario');

        $this->addCredential(get_class($user));
    }
}
