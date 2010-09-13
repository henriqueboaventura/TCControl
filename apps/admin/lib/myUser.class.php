<?php

class myUser extends doAuthSecurityUser
{
    public function signIn($user, $remember = false, $con = null)
    {
        parent::signIn($user, $remember, $con);
        $this->setAttribute('id', $user->id, 'usuario');
        $this->setAttribute('email', $user->email, 'usuario');
        $this->setAttribute('nome', $user->nome, 'usuario');
        $this->setAttribute('coordenador', $user->coordenador, 'professor');

        $configuracao = Doctrine_Core::getTable('Configuracao')->findAll()->getFirst();
        foreach($configuracao as $field => $value){
            $this->setAttribute($field, $value, 'configuracao');
        }

        $this->addCredential(strtolower(get_class($user)));
    }
}
