<?php 
//return [
//    'class' => 'yii\swiftmailer\Mailer',
//    'transport' => [
//        'class' => 'Swift_SmtpTransport',
//        'host' => 'smtp.exmail.qq.com',
//        'username' => 'service@iddmall.com',
//        'password' => 'dmg13579',
//        'port' => 25,
//        'encryption' => 'service@iddmall.com',
//    ],
//];

return [
    'class' => 'yii\swiftmailer\Mailer',
    'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' => getenv('MAIL_HOST'),
        'username' => getenv('MAIL_USRNAME'),
        'password' => getenv('MAIL_PASSWORD'),
        'port' => getenv('MAIL_PORT'),
        'encryption' => getenv('MAIL_ENCRYPTION'),
    ],
];

