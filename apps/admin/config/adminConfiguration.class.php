<?php

class adminConfiguration extends sfApplicationConfiguration
{
    public function configure()
    {
        $this->dispatcher->connect('artigo.comentario', array('MailerEvent', 'artigoComentario'));
        $this->dispatcher->connect('proposta.comentario', array('MailerEvent', 'propostaComentario'));
        $this->dispatcher->connect('solicitacao.enviada', array('MailerEvent', 'solicitacaoEnviada'));
        $this->dispatcher->connect('email.enviado', array('MailerEvent', 'emailEnviado'));
        $this->dispatcher->connect('arquivo.enviado', array('MailerEvent', 'arquivoEnviado'));
      
    }
}
