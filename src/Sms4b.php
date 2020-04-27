<?php


namespace linch\sms4b;
use yii\base\BaseObject;
use yii\httpclient\Client;
use yii\httpclient\Response;

class Sms4b extends BaseObject
{
    public $login;
    public $password;
    public $sender = '';
    public $dev = false;

    private $client;

    public function init()
    {
        $this->client = new Client();
        parent::init();
    }

    public function getBalance()
    {
        return $this->cSms4bBase->arBalance;
    }

    public function setSender(string $sender)
    {
        return new self([
            'login' => $this->login,
            'password' => $this->password,
            'sender' => $sender,
            'dev' => $this->dev,
        ]);
    }

    /**
     * @param $phone
     * @param string $message
     * @return bool
     * @throws Sms4bException
     */
    public function send($phone, string $message): bool
    {
        $response = $this->makeRequest('SendSMS', $phone, $message);
        return !(ctype_digit($response)  && $response <= 0);
    }

    /**
     * @param string $action SendSMS|
     * @param string $phone
     * @param string $text
     * @return mixed
     * @throws Sms4bException
     */
    private function makeRequest(string $action, string $phone, string $text)
    {
        /** @var Response $response */
        $response = $this->client->createRequest()
            ->addHeaders(['content-type' => 'application/x-www-form-urlencoded'])
            ->setMethod('POST')
            ->setUrl('https://sms4b.ru/ws/sms.asmx/' . $action)
            ->setData([
                'Login' => $this->login,
                'Password' => $this->password,
                'Source' => $this->sender,
                'Phone' => $phone,
                'Text' => $text
            ])
            ->send();

        $responseCode = $response->getData()[0];
        if ($this->dev && ctype_digit($responseCode) && $responseCode <= 0) {
            throw new Sms4bException($responseCode);
        }
        return $responseCode;
    }
}