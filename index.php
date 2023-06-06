<?php

use Anastasiia\DbQueryBuilder\Db;

require __DIR__ . "/vendor/autoload.php";

$db = new Db('localhost',
    'online-store',
    'root',
    '');

$sqlBuilder = new  \Anastasiia\DbQueryBuilder\sqlBuilder();

$sql = $sqlBuilder->table('products')
    ->select(['name'])
    ->where(['price' => '39000.99'])
    ->order(['id' => 'ASC'])
    ->limit(20)
    ->offset(40)
    ->getSql();

echo $sql;

$result = $db->query($sql);
var_dump($result);