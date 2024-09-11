<?php

return [

  /*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    |
    | This option controls the default mailer that is used to send all email
    | messages unless another mailer is explicitly specified when sending
    | the message. All additional mailers can be configured within the
    | "mailers" array. Examples of each type of mailer are provided.
    |
    */

  'default' => env('MAIL_MAILER', 'log'),

  /*
    |--------------------------------------------------------------------------
    | Mailer Configurations
    |--------------------------------------------------------------------------
    |
    | Here you may configure all of the mailers used by your application plus
    | their respective settings. Several examples have been configured for
    | you and you are free to add your own as your application requires.
    |
    | Laravel supports a variety of mail "transport" drivers that can be used
    | when delivering an email. You may specify which one you're using for
    | your mailers below. You may also add additional mailers if needed.
    |
    | Supported: "smtp", "sendmail", "mailgun", "ses", "ses-v2",
    |            "postmark", "resend", "log", "array",
    |            "failover", "roundrobin"
    |
    */

  'mailers' => [

    'smtp_viro' => [
      'transport' => 'smtp',
      'url' => env('MAIL_URL'),
      'host' => 'smtp.yandex.ru',
      'port' => 465,
      'encryption' => 'ssl',
      'username' => 'viro@viro.edu.ru',
      'password' => env('MAIL_PASSWORD_VIRO'),
      'timeout' => null,
      'from' => [
        'address' => 'viro@viro.edu.ru',
        'name' => 'АОУ ВО ДПО «ВИРО»',
      ],
      'local_domain' => env('MAIL_EHLO_DOMAIN', parse_url(env('APP_URL', 'http://localhost'), PHP_URL_HOST)),
    ],

    'smtp_no_reply' => [
      'transport' => 'smtp',
      'url' => env('MAIL_URL'),
      'host' => 'smtp.yandex.ru',
      'port' => 465,
      'encryption' => 'ssl',
      'username' => 'no-reply@viro.edu.ru',
      'password' => env('MAIL_PASSWORD_NO_REPLY'),
      'timeout' => null,
      'from' => [
        'address' => 'no-reply@viro.edu.ru',
        'name' => 'АОУ ВО ДПО «ВИРО»',
      ],
      'local_domain' => env('MAIL_EHLO_DOMAIN', parse_url(env('APP_URL', 'http://localhost'), PHP_URL_HOST)),
    ],


    'ses' => [
      'transport' => 'ses',
    ],

    'postmark' => [
      'transport' => 'postmark',
      // 'message_stream_id' => env('POSTMARK_MESSAGE_STREAM_ID'),
      // 'client' => [
      //     'timeout' => 5,
      // ],
    ],

    'resend' => [
      'transport' => 'resend',
    ],

    'sendmail' => [
      'transport' => 'sendmail',
      'path' => env('MAIL_SENDMAIL_PATH', '/usr/sbin/sendmail -bs -i'),
    ],

    'log' => [
      'transport' => 'log',
      'channel' => env('MAIL_LOG_CHANNEL'),
    ],

    'array' => [
      'transport' => 'array',
    ],

    'failover' => [
      'transport' => 'failover',
      'mailers' => [
        'smtp',
        'log',
      ],
    ],

    'roundrobin' => [
      'transport' => 'roundrobin',
      'mailers' => [
        'ses',
        'postmark',
      ],
    ],

  ],

];
