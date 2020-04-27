<?php


namespace linch\sms4b;

class Sms4bException extends \Exception
{
    const ERRORS = [
        -1 => 'Wrong login or password',
        -2 => 'Session is closed',
        -29 => 'Message rejected',
        -30 => 'Incorrect message encoding',
        -33 => 'Delivery time exceeded',
        -50 => 'Wrong sender',
        -51 => 'Unresolved recipient',
        -52 => 'Insufficient funds in your account',
        -53 => 'Unregistered sender',
        -66 => 'No sender specified',
        -68 => 'The user is blocked',
    ];

    /**
     * Class constructor
     *
     * @param string|int $messageCode Error message
     * @param int $code       Error code
     */
    public function __construct($messageCode = null, $code = 0)
    {
        if (key_exists($messageCode, self::ERRORS)) {
            parent::__construct(self::ERRORS[$messageCode], $code);
        } else {
            parent::__construct($messageCode, $code);
        }
    }
}