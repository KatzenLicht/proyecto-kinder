<?php
define('DB_HOST','fdb1034.awardspace.net');
define('DB_NAME','4735919_kinder');
define('DB_USER','4735919_kinder');
define('DB_PASS','ProyectoFinal.070702');
define('DB_CHARSET','utf8');
try{
$conn=new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,DB_USER,DB_PASS,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,PDO::ATTR_EMULATE_PREPARES=>false]);
}catch(PDOException $e){
die(json_encode(['error'=>'No se pudo conectar a la base de datos.']));
}