<?php
$pdo = new PDO(
	'mysql:host=localhost;dbname=ijdb;charset=utf8',
	'ijdbuser',
	'Tester123'
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
