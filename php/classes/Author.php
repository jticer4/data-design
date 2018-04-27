<?php
namespace Edu\Cnm\jticer\DataDesign;

require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

class author implements \JsonSerializable {

	use ValidateUuid;

	/**
	 * id for this author, this is the primary key
	 * @var Uuid $authorId
	 **/
	protected $authorId;

	/**
	 * byline for the author
	 * @var string $authorByline
	 **/
	protected $authorByline;

	/**
	 * email address for this author
	 * @var string $authorEmail
	 **/
	protected $authorEmail;

	/**
	 * the name for the author
	 * @var string $authorName
	 **/
	protected $authorName;

	/**
	 * title for the author
	 * @var string $authorTitle
	 **/
	protected $authorTitle;

	/**
	 * author constructor.
	 * @param Uuid $authorId id for this author, or null if a new author
	 * @param string $authorByline string containing the authorByline
	 * @param string $authorEmail string containing the author email
	 * @param string $authorName string containing the author name
	 * @param string $authorTitle string containing the author title
	 */
	public function __construct(Uuid $authorId, string $authorByline, string $authorEmail, string $authorName, string $authorTitle) {
		$this->authorId = $authorId;
		$this->authorByline = $authorByline;
		$this->authorEmail = $authorEmail;
		$this->authorName = $authorName;
		$this->authorTitle = $authorTitle;
	}

	/**
	 * accessor method for author id
	 * @return Uuid
	 **/
	public function getAuthorId() : Uuid {
		return($this->authorId);
	}

	/**
	 * mutator method for author id
	 * @param $newAuthorId
	 * @throws \RangeException if $newAuthorId is not positive
	 * @throws \TypeError if $newAuthorId is not an integer
	 **/
	public function setAuthorId($newAuthorId) : void {
		try {
			$uuid = self::validateUuid($newAuthorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the author id
		$this->authorId = $uuid;
	}


	/**
	 * accessor method for author by line
	 * @return string value of the author by line content
	 **/
	public function getAuthorByline() : string {
		return($this->authorByline);
	}

	/**
	 * mutator method for author byline
	 * @param string $newAuthorByline  new value of the author by line
	 * @throws \InvalidArgumentException if $newAuthorByline is not a string or insecure
	 * @throws \RangeException if $newAuthorByline is > 256 characters
	 * @throws \TypeError if $newAuthorByline is not a string
	 **/
	public function setAuthorByline(string $newAuthorByline) : void {

// verify the author byline content is secure
		$newAuthorByline = trim($newAuthorByline);
		$newAuthorByline = filter_var($newAuthorByline, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorByline) === true) {
			throw(new \InvalidArgumentException("byline content is empty or insecure"));
		}

		// verify the byline content will fit in the database
		if(strlen($newAuthorByline) > 256) {
			throw(new \RangeException("byline content too large"));
		}

		// store the byline content
		$this->authorByline = $newAuthorByline;
	}

	/**
	 * accessor method for author email
	 * @return string
	 **/
	public function getAuthorEmail() : string {
		return($this->authorEmail);
	}

	/**
	 * mutator method for author email
	 * @param string $newAuthorEmail new value of the author email
	 * @throws \InvalidArgumentException if $newAuthorEmail is not a string or insecure
	 * @throws \RangeException if $newAuthorEmail is > 256 characters
	 * @throws \TypeError if $newAuthorEmail is not a string
	 **/
	public function setAuthorEmail(string $newAuthorEmail) : void {
		// verify the email address content is secure
		$newAuthorEmail = trim($newAuthorEmail);
		$newAuthorEmail = filter_var($newAuthorEmail, FILTER_SANITIZE_EMAIL, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorEmail) === true) {
			throw(new \InvalidArgumentException("email address is empty or not valid"));
		}

		// verify the email address content will fit in the database
		if(strlen($newAuthorEmail) > 256) {
			throw(new \RangeException("email address is too large"));
		}

		// store the email address
		$this->authorEmail = $newAuthorEmail;
	}

	/**
	 * accessor method for author name
	 * @return string
	 **/
	public function getAuthorName() : string {
		return($this->authorName);
	}

	/**
	 * mutator method for author name
	 * @param $newAuthorName
	 * @throws \InvalidArgumentException if $newAuthorName is not a string or insecure
	 * @throws \RangeException if $newAuthorName is > 64 characters
	 * @throws \TypeError if $newAuthorName is not a string
	 **/
	public function setAuthorName(string $newAuthorName) : void {
		// verify the author name content is secure
		$newAuthorName = trim($newAuthorName);
		$newAuthorName = filter_var($newAuthorName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorName) === true) {
			throw(new \InvalidArgumentException("name is empty or insecure"));
		}

		// verify the author name content will fit in the database
		if(strlen($newAuthorName) > 64) {
			throw(new \RangeException("name too large"));
		}

		// store the author name content
		$this->authorName = $newAuthorName;
	}

	/**
	 * accessor method for author title
	 * @return string
	 **/
	public function getAuthorTitle() : string {
		return($this->authorTitle);
	}

	/**
	 * mutator method for author title
	 * @param $newAuthorTitle
	 * @throws \InvalidArgumentException if $newAuthorTitle is not a string or insecure
	 * @throws \RangeException if $newAuthorTitle is > 256 characters
	 * @throws \TypeError if $newAuthorTitle is not a string
	 **/
	public function setAuthorTitle(string $newAuthorTitle) : void {
		// verify the author title is secure
		$newAuthorTitle = trim($newAuthorTitle);
		$newAuthorTitle = filter_var($newAuthorTitle, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorTitle) === true) {
			throw(new \InvalidArgumentException("title content is empty or insecure"));
		}

		// verify the author title will fit in the database
		if(strlen($newAuthorTitle) > 140) {
			throw(new \RangeException("title is too long"));
		}

		// store the author title content
		$this->authorTitle = $newAuthorTitle;
	}

	/**
	 * inserts this Author into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert($pdo) : void {

		// create query template
		$query = "INSERT INTO author(authorId, authorByline, authorEmail, authorName, authorTitle) VALUES(:authorId, :authorByline, :authorEmail, :authorName, authorTitle)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["authorId" => $this->authorId->getBytes(), "authorByline" => $this->authorByline, "authorEmail" => $this->authorEmail, "authorName" => $this->authorName, "authorTitle" => $this->authorTitle];
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
	 * updates this Author in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update($pdo) : void {

		// create query template
		$query = "UPDATE author SET authorByline = :authorByline, authorEmail = :authorEmail WHERE authorId = :authorId";
		$statement = $pdo->prepare($query);

		$parameters = ["authorId" => $this->authorId->getBytes(), "authorByline" => $this->authorByline, "authorEmail" => $this->authorEmail];
		$statement->execute($parameters);
	}
	/**
	 * gets the Author by authorId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $authorId author id to search for
	 * @return Author|null Author found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getAuthorByAuthorId($pdo, $authorId) : ?Author {
		// sanitize the authorId before searching
		try {
			$authorId = self::validateUuid($authorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT authorId, authorByline, authorEmail, authorName, authorTitle FROM author WHERE authorId = :authorId";
		$statement = $pdo->prepare($query);

		// bind the author id to the place holder in the template
		$parameters = ["authorId" => $authorId->getBytes()];
		$statement->execute($parameters);

		// grab the author from mySQL
		try {
			$author = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$author= new Author($row["authorId"], $row["authorByline"], $row["authorEmail"], $row["authorName"], $row["authorTitle"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($author);
	}

	/**
	 * gets the Foo by content
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $fooContent foo content to search for
	 * @return \SplFixedArray SplFixedArray of Foos found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getFooByFooContent(\PDO $pdo, string $fooContent) : \SplFixedArray {
		// sanitize the description before searching
		$fooContent = trim($fooContent);
		$fooContent = filter_var($fooContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($fooContent) === true) {
			throw(new \PDOException("foo content is invalid"));
		}

		// escape any mySQL wild cards
		$fooContent = str_replace("_", "\\_", str_replace("%", "\\%", $fooContent));

		// create query template
		$query = "SELECT fooId, fooBarId, fooContent, fooDate FROM foo WHERE fooContent LIKE :fooContent";
		$statement = $pdo->prepare($query);

		// bind the foo content to the place holder in the template
		$fooContent = "%$fooContent%";
		$parameters = ["fooContent" => $fooContent];
		$statement->execute($parameters);

		// build an array of foos
		$foos = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$foo = new Foo($row["fooId"], $row["fooBarId"], $row["fooContent"], $row["fooDate"]);
				$foos[$foos->key()] = $foo;
				$foos->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($foos);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() : array {
		$fields = get_object_vars($this);

		$fields["authorId"] = $this->authorId->toString();

		return($fields);
	}
}
