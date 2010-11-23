<?php
class MailerEvent
{
    static public function emailEnviado(sfEvent $event)
    {
        $mailer = sfContext::getInstance()->getMailer();
        sfContext::getInstance()->getUser();
        $body = <<<EOT
Olá %s,

Você recebeu uma nova mensagem na sua caixa de entrada.

Para visualizá-la, vá até o endereço: %s/%s

Equipe TCCtrl

------------------------------------------------------------
Essa mensagem foi gerada automaticamente pelo sistema TCCtrl
EOT;
        $message = $mailer->compose(
            array(sfContext::getInstance()->getUser()->getAttribute('email', null, 'configuracao') => 'TCCtrl'),
            $event->getSubject()->Destinatario->email,            
            'Você recebeu uma mensagem',
            sprintf(
                $body,
                $event->getSubject()->Destinatario->nome,
                sfContext::getInstance()->getUser()->getAttribute('url', null, 'configuracao'),
                sfContext::getInstance()->getController()->genUrl('@mensagem_view?id=' . $event->getSubject()->id))
        );
        
        $mailer->send($message);
    }
    
    static public function arquivoEnviado(sfEvent $event)
    {
        $mailer = sfContext::getInstance()->getMailer();
        sfContext::getInstance()->getUser();
        $body = <<<EOT
Olá %s,

Você recebeu um novo arquivo.

Para visualizá-la, vá até o endereço: %s/%s

Equipe TCCtrl

------------------------------------------------------------
Essa mensagem foi gerada automaticamente pelo sistema TCCtrl
EOT;
        $message = $mailer->compose(
            array(sfContext::getInstance()->getUser()->getAttribute('email', null, 'configuracao') => 'TCCtrl'),
            $event->getSubject()->Destinatario->email,            
            'Você recebeu um arquivo',
            sprintf(
                $body,
                $event->getSubject()->Destinatario->nome,
                sfContext::getInstance()->getUser()->getAttribute('url', null, 'configuracao'),
                sfContext::getInstance()->getController()->genUrl('arquivo/index'))
        );
        
        $mailer->send($message);
    }
    
    static public function solicitacaoEnviada(sfEvent $event)
    {
        $mailer = sfContext::getInstance()->getMailer();
        sfContext::getInstance()->getUser();
        $body = <<<EOT
Olá %s,

Você recebeu um nova solicitação de orientação. 

Para visualizá-la, vá até o endereço: %s/%s

Equipe TCCtrl

------------------------------------------------------------
Essa mensagem foi gerada automaticamente pelo sistema TCCtrl
EOT;
        $message = $mailer->compose(
            array(sfContext::getInstance()->getUser()->getAttribute('email', null, 'configuracao') => 'TCCtrl'),
            $event->getSubject()->Professor->email,            
            'Você recebeu uma nova solicitação de orientação',
            sprintf(
                $body,
                $event->getSubject()->Professor->nome,
                sfContext::getInstance()->getUser()->getAttribute('url', null, 'configuracao'),
                sfContext::getInstance()->getController()->genUrl('orientandos_list?filtro=aguardando'))
        );
        
        $mailer->send($message);
    }
    
    static public function propostaComentario(sfEvent $event)
    {
        $mailer = sfContext::getInstance()->getMailer();
        sfContext::getInstance()->getUser();
        $body = <<<EOT
Olá %s,

Você recebeu um novo comentário na sua proposta. 

Para visualizá-lo, vá até o endereço: %s/%s

Equipe TCCtrl

------------------------------------------------------------
Essa mensagem foi gerada automaticamente pelo sistema TCCtrl
EOT;
        $message = $mailer->compose(
            array(sfContext::getInstance()->getUser()->getAttribute('email', null, 'configuracao') => 'TCCtrl'),
            $event->getSubject()->Proposta->Aluno->email,            
            'Você recebeu um novo comentário',
            sprintf(
                $body,
                $event->getSubject()->Proposta->Aluno->nome,
                sfContext::getInstance()->getUser()->getAttribute('url', null, 'configuracao'),
                sfContext::getInstance()->getController()->genUrl('@proposta_view_comment?proposta_id=' . $event->getSubject()->id . '&local=' . $event->getSubject()->local))
        );
        
        $mailer->send($message);
    }
    
    static public function artigoComentario(sfEvent $event)
    {
        $mailer = sfContext::getInstance()->getMailer();
        sfContext::getInstance()->getUser();
        $body = <<<EOT
Olá %s,

Você recebeu um novo comentário no seu artigo. 

Para visualizá-lo, vá até o endereço: %s/%s

Equipe TCCtrl

------------------------------------------------------------
Essa mensagem foi gerada automaticamente pelo sistema TCCtrl
EOT;
        $message = $mailer->compose(
            array(sfContext::getInstance()->getUser()->getAttribute('email', null, 'configuracao') => 'TCCtrl'),
            $event->getSubject()->Artigo->Aluno->email,            
            'Você recebeu um novo comentário',
            sprintf(
                $body,
                $event->getSubject()->Artigo->Aluno->nome,
                sfContext::getInstance()->getUser()->getAttribute('url', null, 'configuracao'),
                sfContext::getInstance()->getController()->genUrl('@artigo_view_comment?artigo_id=' . $event->getSubject()->id))
        );
        
        $mailer->send($message);
    }
}
?>
