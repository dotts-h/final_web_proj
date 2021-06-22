<?php
$pdo = new PDO(
	'mysql:host=us-cdbr-east-04.cleardb.com;dbname=heroku_a742c7cd17ba7cb;charset=utf8',
	'b90e8a074246f2',
	'0de66ca8'
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
