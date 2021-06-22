<?php

try {
	include __DIR__ . '/../includes/autoload.php';
	// include __DIR__ . '/../includes/DatabaseConnection.php';
	// include __DIR__ . '/../classes/DatabaseTable.php';
	// include __DIR__ . '/../classes/controllers/JokeController.php';
	// include __DIR__ . '/../classes/EntryPoint.php';
	// include __DIR__ . '/../classes/IjdbRoutes.php';

	// $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
	// $authorsTable = new DatabaseTable($pdo, 'author', 'id');

	// $route = $_GET['route'] ?? 'joke/home';
	$route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
	// print 'route' . $route;


	$entryPoint = new \Framework\EntryPoint($route, $_SERVER['REQUEST_METHOD'], new \Ijdb\IjdbRoutes());
	$entryPoint->run();
} catch (PDOException $e) {
	$title = 'An error has occurred';

	$output = 'Database error: ' .
		$e->getMessage() . ' in ' .
		$e->getFile() . ':' .
		$e->getLine();

	include __DIR__ . '/../templates/layout.html.php';
}
