/**
	 * inserts this Author into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert($pdo) : void {

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
	public function insert($pdo) : void {

		// create query template
		$query = "INSERT INTO article(articleId, articleAuthorId, articleContent, articleDateTime, articleTitle) VALUES(:articleId, :articleAuthorId, :articleContent, :articleDateTime, :articleTitle)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$formattedDate = $this->articleDateTime->format("Y-m-d H:i:s.u");
		$parameters = ["articleId" => $this->articleId->getBytes(), "articleAuthorId" => $this->articleAuthorId->getBytes(), "articleContent" => $this->articleContent, "articleDateTime" => $formattedDate, "articleTitle" => $this->articleTitle];
		$statement->execute($parameters);
	}
/**
	 * updates this Author in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update($pdo) : void {

		// create query template
		$query = "UPDATE author SET authorByline = :authorByline, authorEmail = :authorEmail, authorName = :authorName, authorTitle = :authorTitle WHERE authorId = :authorId";
		$statement = $pdo->prepare($query);

		$parameters = ["authorId" => $this->authorId->getBytes(), "authorByline" => $this->authorByline, "authorEmail" => $this->authorEmail, "authorName" => $this->authorName, "authorTitle" => $this->authorTitle];
		$statement->execute($parameters);
	}
/**
	 * updates this Article in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update($pdo) : void {

		// create query template
		$query = "UPDATE article SET articleAuthorId = :articleAuthorId, articleContent = :articleContent, articleDateTime = :articleDateTime, articleTitle = :articleTitle WHERE articleId = :articleId";
		$statement = $pdo->prepare($query);

		$formattedDate = $this->articleDateTime->format("Y-m-d H:i:s.u");
		$parameters = ["articleId" => $this->articleId->getBytes(),"articleAuthorId" => $this->articleAuthorId->getBytes(), "articleContent" => $this->articleContent, "articleDateTime" => $formattedDate, "articleTitle" => $this->articleTitle];
		$statement->execute($parameters);
	}
/**
	 * deletes this Author from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete($pdo) : void {

		// create query template
		$query = "DELETE FROM author WHERE authorId = :authorId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["authorId" => $this->authorId->getBytes()];
		$statement->execute($parameters);
	}
/**
	 * deletes this Article from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete($pdo) : void {

		// create query template
		$query = "DELETE FROM article WHERE articleId = :articleId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["articleId" => $this->articleId->getBytes()];
		$statement->execute($parameters);
	}