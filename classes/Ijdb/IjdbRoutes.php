<?php

namespace Ijdb;

class IjdbRoutes implements \Ninja\Routes
{
	private $authorsTable;
	private $jokesTable;
	private $authentication;

	public function __construct()
	{
		include __DIR__ . '/../../includes/DatabaseConnection.php';

		$this->jokesTable = new \Ninja\DatabaseTable($pdo, 'joke', 'id');
		$this->authorsTable = new \Ninja\DatabaseTable($pdo, 'author', 'id');
		$this->authentication = new \Ninja\Authentication($this->authorsTable, 'email', 'password');
	}


	public function getRoutes(): array
	{
		// include __DIR__ . '/../../includes/DatabaseConnection.php';

		// $jokesTable = new \Ninja\DatabaseTable($pdo, 'joke', 'id');
		// $authorsTable = new \Ninja\DatabaseTable($pdo, 'author', 'id');

		$jokeController = new \Ijdb\Controllers\Joke($this->jokesTable, $this->authorsTable, $this->authentication);
		$authorController = new \Ijdb\Controllers\Register($this->authorsTable);
		$loginController = new \Ijdb\Controllers\Login($this->authentication);

		$routes = [
			'author/register' => [
				'GET' => [
					'controller' => $authorController,
					'action' => 'registrationForm'
				],
				'POST' => [
					'controller' => $authorController,
					'action' => 'registerUser'
				]
			],
			'author/success' => [
				'GET' => [
					'controller' => $authorController,
					'action' => 'success'
				]
			],
			'joke/edit' => [
				'POST' => [
					'controller' => $jokeController,
					'action' => 'saveEdit'
				],
				'GET' => [
					'controller' => $jokeController,
					'action' => 'edit'
				],
				'login' => true
			],
			'joke/delete' => [
				'POST' => [
					'controller' => $jokeController,
					'action' => 'delete'
				],
				'login' => true
			],
			'joke/list' => [
				'GET' => [
					'controller' => $jokeController,
					'action' => 'list'
				]
			],
			'' => [
				'GET' => [
					'controller' => $jokeController,
					'action' => 'home'
				]
			],
			'login' => [
				'GET' => [
					'controller' => $loginController,
					'action' => 'loginForm'
				],
				'POST' => [
					'controller' => $loginController,
					'action' => 'processLogin'
				]
			],
			'login/success' => [
				'GET' => [
					'controller' => $loginController,
					'action' => 'success'
				]
			],
			'login/error' => [
				'GET' => [
					'controller' => $loginController,
					'action' => 'error'
				]
			],
			'logout' => [
				'GET' => [
					'controller' => $loginController,
					'action' => 'logout'
				]
			],
			'css/jokes.css' => [
				'GET' => [
					'controller' => '/css/jokes.css'
				]
			]
		];

		// $method = $_SERVER['REQUEST_METHOD'];

		// $controller = $routes[$route][$method]['controller'];
		// $action = $routes[$route][$method]['action'];

		return $routes;

		// if ($route == strtolower($route)) {
		// 	if ($route === 'joke/list') {
		// 		// include __DIR__ . '/../classes/controllers/JokeController.php';
		// 		$controller = new \Ijdb\Controllers\Joke($jokesTable, $authorsTable);
		// 		$page = $controller->list();
		// 	} elseif ($route === '') {
		// 		// include __DIR__ . '/../classes/controllers/JokeController.php';
		// 		$controller = new \Ijdb\Controllers\Joke($jokesTable, $authorsTable);
		// 		$page = $controller->home();
		// 	} elseif ($route === 'joke/edit') {
		// 		// include __DIR__ . '/../classes/controllers/JokeController.php';
		// 		$controller = new \Ijdb\Controllers\Joke($jokesTable, $authorsTable);
		// 		$page = $controller->edit();
		// 	} elseif ($route === 'joke/delete') {
		// 		// include __DIR__ . '/../classes/controllers/JokeController.php';
		// 		$controller = new \Ijdb\Controllers\Joke($jokesTable, $authorsTable);
		// 		$this->page = $controller->delete();
		// 	} elseif ($route === 'register') {
		// 		// include __DIR__ . '/../classes/controllers/RegisterController.php';
		// 		// $controller = new \Ijdb\Controllers\Register($authorsTable);
		// 		// $page = $controller->showForm();
		// 	}
		// } else {
		// 	http_response_code(301);
		// 	header('location: index.php?route=' . strtolower($route));
		// }

		// return $page;
	}

	public function getAuthentication(): \Ninja\Authentication
	{
		return $this->authentication;
	}
}
