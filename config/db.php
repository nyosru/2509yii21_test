<?php

$cfg = parse_ini_file( __DIR__.'/../.env');
//echo '<pre>',print_r($cfg),'</pre>';

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host='.$cfg['DB_HOST'].';dbname='.$cfg['DB_NAME'],
    'username' => $cfg['DB_USER'],
    'password' => $cfg['DB_PASS'],
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
