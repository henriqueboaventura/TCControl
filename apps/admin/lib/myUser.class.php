<?php

class myUser extends doAuthSecurityUser
{
    public function signIn($user, $remember = false, $con = null)
    {           
        parent::signIn($user, $remember, $con);
        $this->setAttribute('id', $user->id, 'usuario');
        $this->setAttribute('email', $user->email, 'usuario');
        $this->setAttribute('nome', $user->nome, 'usuario');        
        if(!is_null($user->curso_id)){
            $this->setAttribute('curso', $user->curso_id, 'usuario');
            if(strtolower(get_class($user)) == 'professor'){
                $this->setAttribute('coordenador', (is_null($user->curso_id) ? false : true), 'professor');
            }
        }
        $configuracao = Doctrine_Core::getTable('Configuracao')->findAll()->getFirst();
        foreach($configuracao as $field => $value){
            $this->setAttribute($field, $value, 'configuracao');
        }

        $this->addCredential(strtolower(get_class($user)));
    }

    public function signOut() {
        parent::signOut();
        
        $this->getAttributeHolder()->removeNamespace('configuracao');
        $this->getAttributeHolder()->removeNamespace('professor');
        $this->getAttributeHolder()->removeNamespace('usuario');
    }
}
