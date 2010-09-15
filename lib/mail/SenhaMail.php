<?php
class SenhaMail extends BaseMail
{
    protected $email,
               $senha,
               $url;

    public function __construct($sendTo = null, $params = null)
    {
        parent::__construct($sendTo, $params);

        $this->email = $sendTo;
        $this->title = 'Cadastro no TCCtrl';
    }

    /**
     * setDefaultMessage
     *
     * Metodo responsavel por gerar a mensagem padrao do email
     */
    public function setDefaultMessage()
    {
        $this->body = <<<EOF
Este E-mail foi gerado de forma automática. Por favor, não o responda.

Bem vindo ao TCCtrl, o sistema de controle e gerenciamento de Trabalhos de Conclusão.

Foi gerada uma senha aleatória para a sua conta, que deve ser alterada logo após seu login,
os dados para acessar sua conta são:

-----------------------------------------
E-mail: %s

Senha: %s
-----------------------------------------

A URL para acessar o sistema é %s

Equipe TCCtrl
EOF;
    }   

    /**
     * Metodo setParams
     *
     * @param array $params
     */
    public function setParams($params)
    {
        foreach((array)$params as $key => $value){
            if(\property_exists($this, $key)){
                $this->$key = $value;
            } else {
                throw new \Exception('A Propriedade ' . $key . ' não existe na classe ' . \get_class($this));
            }
        }
    }

    /**
     * Metodo send
     *
     * @param array $params
     */
    public function send()
    {
        $this->body = \sprintf($this->body,$this->email, $this->senha, $this->url);
        $mailer = \sfContext::getInstance()->getMailer();
        $mailer->composeAndSend($this->sender, $this->sendTo, $this->title, $this->body);
    }

    /**
     * Metodo magico __set (PHP)
     *
     * quando um atributo privado e acessado, o metodo interrompe e busca um metodo set
     * para o atributo em questao. Caso nao exista tal metodo, faz a atribuicao simples do valor
     *
     * @param string $attribute
     * @param string $value
     * @return SenhaMail $this
     */
    public function __set($attribute, $value)
    {
        $methodName = 'set' . ucfirst($attribute);
        if (method_exists($this, $methodName)) {
            $this->$methodName($value);
        } else {
            $this->$attribute = $value;
        }

        return $this;
    }

     /**
     * Metodo magico __get (PHP)
     *
     * quando um atributo privado e acessado, o metodo interrompe e busca um metodo get
     * para o atributo em questao. Caso nao exista tal metodo, retorna o atributo
     *
     * @param string $attributes
     * @return mixed
     */
    public function __get($attribute)
    {
        return $this->$attribute;
    }


}
