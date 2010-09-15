<?php
abstract class BaseMail
{
    protected $sender,
              $sendTo,
              $title,
              $body;

    public function __construct($sendTo = null, $params = null)
    {
        $this->sender = 'johndoe@gmail.com';
        $this->sendTo = $sendTo;

        $this->setDefaultMessage();
        $this->setParams($params);
    }

    /**
     * Metodo abstrato setDefaultMessage
     */
    public abstract function setDefaultMessage();

    /**
     * Metodo abstrato setParams
     */
    public abstract function setParams($params);

    /**
     * Metodo abstrato send
     */
    public abstract function send();

}
