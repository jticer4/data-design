/**
	 * inserts this Author into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) : void {

		// create query template
		$query = "INSERT INTO author(authorId, authorByline, authorEmail, authorName, authorTitle) VALUES(:authorId, :authorByline, :authorEmail, :authorName, :authorTitle)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["authorId" => $this->authorId->getBytes(), "authorByline" => $this->authorByline, "authorEmail" => $this->authorEmail, "authorName" => $this->authorName, "authorTitle" => $this->authorTitle];
		$statement->execute($parameters);
	}
/**
	 * inserts this Article into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) : void {

		// create query template
		$query = "INSERT INTO article(articleId, articleAuthorId, articleContent, articleDateTime, articleTitle) VALUES(:articleId, :articleAuthorId, :articleContent, :articleDateTime, :articleTitle)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["authorId" => $this->authorId->getBytes(), "authorByline" => $this->authorByline, "authorEmail" => $this->authorEmail, "authorName" => $this->authorName, "authorTitle" => $this->authorTitle];
		$statement->execute($parameters);
	}
