<?php

require_once "config.php";

//$user = new User();
//
//$user->loadById(1);
//
//echo $user
//
//;
//
//$userList = User::getList();
//echo json_encode($userList);

//$expecificUsename = User::searchUser("Andre");
//echo json_encode($expecificUsename);

//$user = new User();
//
//
//$user->login("Andre","123456789");
//echo $user;

//$aluno = new User("Aluno","server45");
//
//$aluno->insert();
//
//echo $aluno;

$user = new User();
$user->loadById(3);
$user->update("Luis","server7Luis");