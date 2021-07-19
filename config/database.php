<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
	'driver' =>'mysql',
	'host' => 'localhost',
	'database' => 'vvdb25052021.sql',
	'username' => 'root',
	'password' => '',
	'charset' => 'utf8',
	'collation' => 'utf8_unicode_ci',
	'prefix' => '',
]);
 
//Y finalmente, iniciamos Eloquent
$capsule->bootEloquent();