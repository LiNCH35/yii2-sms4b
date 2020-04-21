<?php


namespace linch\sms4b;
use yii\base\BaseObject;

class Sms4b extends BaseObject
{
    public $login;
    public $password;
    public $sender = '';

    private $cSms4bBase;

    public function init()
    {
        $this->cSms4bBase = new CSms4bBase();
        $this->cSms4bBase->CSms4bBase($this->login, $this->password);
        parent::init();
    }

    public function send($phone, $message): bool
    {
        if (!$this->cSms4bBase->is_phone($phone)) {
            throw new \RuntimeException('Bad params "Phone"');
        }

        return $this->cSms4bBase->SendSMS(
            $message,
            $phone,
            $this->sender
        );
    }

    public function getBalance()
    {
        return $this->cSms4bBase->arBalance;
    }

    public function getLogin()
    {
        return $this->cSms4bBase->getLogin();
    }

    public function isRegUser($Login, $Password)
    {
        return $this->cSms4bBase->IsRegUser($Login, $Password);
    }

    public function getUserGMT()
    {
        return $this->cSms4bBase->getUserGMT();
    }

    public function getSID()
    {
        return $this->cSms4bBase->GetSID();
    }

    public function createGuid()
    {
        return $this->cSms4bBase->CreateGuid();
    }

    public function enCodeMessage($message)
    {
        return $this->cSms4bBase->enCodeMessage($message);
    }

    public function getNpi($addr)
    {
        return $this->cSms4bBase->get_npi($addr);
    }

    public function isPhone($destination_numbers)
    {
        return $this->cSms4bBase->is_phone($destination_numbers);
    }

    public function getFormatDate($date)
    {
        return $this->cSms4bBase->GetFormatDate($date);
    }

    public function setSender($sender)
    {
        $this->sender = $sender;
    }

    public function Translit($cyr_str)
    {
        return $this->cSms4bBase->Translit($cyr_str);
    }

    /**
     * Отправка сообщений через метод GroupSMS
     * @param $message
     * @param string|array $to Addressees
     * @param string $sender
     * @param string $startUp_p
     * @param string $dateActual_p
     * @param string $period_p
     * @return array
     */
    public function sendSmsPack($message, $to, $sender = '', $startUp_p = '', $dateActual_p = '', $period_p = '')
    {
        return $this->cSms4bBase->SendSmsPack($message, $to, $sender, $startUp_p, $dateActual_p, $period_p);
    }
}