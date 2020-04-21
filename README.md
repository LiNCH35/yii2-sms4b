# yii-sms4b

## Краткое описание
Реализация сервиса [SMS4B](https://www.sms4b.ru/) на основе [примеров кода для PHP](https://www.sms4b.ru/programs/clearphp.php) для Yii-2.

## Установка

Для установки выполните

```
$ php composer.phar require linch/yii2-sms4b "@dev"
```

или добавьте

```
"linch/yii2-sms4b": "@dev"
```

в `require` в вашем `composer.json` файле.

## Использование

Наиболее удобный способ использования - создание компонента в вашем конфиге

```
'components' => [
    ...
    'sms4b' => [
        'class' => '\linch\sms4b\Sms4b',
        'login' => 'login_example',
        'password' => 'password_example',
        'sender' => 'sender_example', // optional
    ],
]
```

Вызов в коде

```
Yii::$app->sms4b->send($phone,$message);
```
