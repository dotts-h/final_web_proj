<?php

namespace Ijdb\Controllers;

use \Framework\DatabaseTable;
use \Framework\Authentication;

class Joke
{
	private $authorsTable;
	private $jokesTable;
	private $authentication;

	public function __construct(
		DatabaseTable $jokesTable,
		DatabaseTable $authorsTable,
		Authentication $authentication
	) {
		$this->jokesTable = $jokesTable;
		$this->authorsTable = $authorsTable;
		$this->authentication = $authentication;
	}

	public function list()
	{
		$result = $this->jokesTable->findAll();

		$jokes = [];
		foreach ($result as $joke) {
			$author = $this->authorsTable->findById($joke['authorid']);

			$jokes[] = [
				'id' => $joke['id'],
				'joketext' => $joke['joketext'],
				'jokedate' => $joke['jokedate'],
				'name' => $author['name'],
				'email' => $author['email'],
				'authorId' => $author['id']
			];
		}

		$title = 'Joke List';

		$totalJokes = $this->jokesTable->total();

		$author = $this->authentication->getUser();

		return [
			'template' => 'jokes.html.php',
			'title' => $title,
			'variables' =>
			[
				'totalJokes' => $totalJokes,
				'jokes' => $jokes,
				'userId' => $author['id'] ?? null
			]
		];
	}

	public function home()
	{
		$title = 'Internet of Joke Database';

		return [
			'template' => 'home.html.php',
			'title' => $title
		];
	}

	public function delete()
	{
		$author = $this->authentication->getUser();

		$joke = $this->jokesTable->findById($_POST['id']);

		if ($joke['authorId'] != $author['id']) return;

		$this->jokesTable->delete($_POST['id']);

		header('location: /joke/list');
	}

	public function edit()
	{
		$author = $this->authentication->getUser();

		if (isset($_GET['id'])) {
			$joke = $this->jokesTable->findById($_GET['id']);
		}

		$title = 'Edit joke';

		return [
			'template' => 'editjoke.html.php',
			'title' => $title,
			'variables' => [
				'joke' => $joke ?? null,
				'userId' => $author['id'] ?? null
			]
		];
	}

	public function saveEdit()
	{
		$author = $this->authentication->getUser();

		if (isset($_GET['id'])) {
			$joke = $this->jokesTable->findById($_GET['id']);

			if ($joke['authorId'] != $author['id']) return;
		}

		$joke = $_POST['joke'];
		$joke['jokedate'] = new \DateTime();
		$joke['authorId'] = $author['id'];

		$this->jokesTable->save($joke);

		header('location: /joke/list');
	}
}
