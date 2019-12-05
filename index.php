<?php

require_once "config.php";

$sql = new Sql();

$users = $sql->select("SELECT * FROM php7db.users;");
//$sql->insert("INSERT INTO php7db.users(username, password) values ('Andre','123456789')");

echo json_encode($users);