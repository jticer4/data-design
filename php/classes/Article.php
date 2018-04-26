<?php
namespace Edu\Cnm\jticer\DataDesign;

require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

class article implements \JsonSerializable {
	use ValidateDate;
	use ValidateUuid;
	/**
	 * id for this article, this will be my primary key
	 * @var Uuid $articleId
	 **/
	protected $articleId;

	/**
	 * id for this article's author, this will be my foreign key
	 * @var Uuid $articleAuthorId
	 **/
	protected $articleAuthorId;

	/**
	 *the actual content of this article
	 * @var string $articleContent
	 **/
	protected $articleContent;

	/**
	 * the date and time this article was posted, in a php date time object
	 * @var \DateTime $articleDateTime
	 **/
	protected $articleDateTime;

	/**
	 * the title of the article
	 * @var string $articleTitle
	 **/
	protected $articleTitle;

	/**
	 * article constructor.
	 * @param Uuid $articleId
	 * @param Uuid $articleAuthorId
	 * @param string $articleContent
	 * @param \DateTime $articleDateTime
	 * @param string $articleTitle
	 */
	public function __construct(Uuid $articleId, Uuid $articleAuthorId, string $articleContent, \DateTime $articleDateTime, string $articleTitle) {
		$this->articleId = $articleId;
		$this->articleAuthorId = $articleAuthorId;
		$this->articleContent = $articleContent;
		$this->articleDateTime = $articleDateTime;
		$this->articleTitle = $articleTitle;
	}

	/**
	 * accessor method for article id
	 * @return Uuid
	 **/
	public function getArticleId(): Uuid {
		return $this->articleId;
	}

	/**
	 * mutator method for article id
	 * @param string | Uuid $newArticleId
	 * @throws \RangeException if $newArticleId is not positive
	 * @throws \TypeError if $newArticleId is not an integer
	 **/
	public function setArticleId(Uuid $newArticleId): void {
		try {
			$uuid = self::validateUuid($newArticleId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the article id
		$this->articleId = $uuid;
	}

	/**
	 * accessor method for article author id
	 * @return Uuid
	 **/
	public function getArticleAuthorId(): Uuid {
		return $this->articleAuthorId;
	}

	/**
	 * mutator method for the article author id
	 * @param string | Uuid $newArticleAuthorId
	 * @throws \RangeException if $newArticleAuthorId is not positive
	 * @throws \TypeError if $newArticleAuthorId is not an integer
	 **/
	public function setArticleAuthorId(Uuid $newArticleAuthorId): void {
		try {
			$uuid = self::validateUuid($newArticleAuthorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the article author id
		$this->articleAuthorId = $uuid;
	}

	/**
	 * accessor method for the article content
	 * @return string value of the article content
	 **/
	public function getArticleContent(): string {
		return $this->articleContent;
	}

	/**
	 * mutator method for the new article content
	 * @param string $newArticleContent
	 * @throws \InvalidArgumentException if $newArticleContent is not a string or insecure
	 * @throws \RangeException if $newArticleContent is > 1024 characters
	 * @throws \TypeError if $newArticleContent is not a string
	 **/
	public function setArticleContent(string $newArticleContent): void {
		// verify the article content is secure
		$newArticleContent = trim($newArticleContent);
		$newArticleContent = filter_var($newArticleContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newArticleContent) === true) {
			throw(new \InvalidArgumentException("article content is empty or insecure"));
		}

		// verify the article content will fit in the database
		if(strlen($newArticleContent) > 1024) {
			throw(new \RangeException("article content too large"));
		}

		// store the article content
		$this->articleContent = $newArticleContent;
	}

	/**
	 * accessor method for the article date time
	 * @return \DateTime value of article date
	 **/
	public function getArticleDateTime(): DateTime {
		return $this->articleDateTime;
	}

	/**
	 * mutator method for the article date time
	 * @param DateTime|string|null $newArticleDateTime article date as a Date Time object or string(or null for the current time)
	 * @throws \InvalidArgumentException if $newArticleDateTime is not a valid object or string
	 * @throws \RangeException if $newArticleDateTime is a date that does not exist
	 **/
	public function setArticleDateTime($newArticleDateTime = null): void {
		// base case: if the date is null, use the current date and time
		if($newArticleDateTime === null) {
			$this->articleDateTime = new \DateTime();
			return;
		}

		// store the article date using the ValidateDate trait
		try {
			$newArticleDateTime = self::validateDateTime($newArticleDateTime);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->articleDateTime = $newArticleDateTime;
	}

	/**
	 * accessor method for the article title
	 * @return string
	 **/
	public function getArticleTitle(): string {
		return $this->articleTitle;
	}

	/**
	 * mutator method for the article title
	 * @param string $newArticleTitle
	 * @throws \InvalidArgumentException if $newArticleTitle is not a string or insecure
	 * @throws \RangeException if $newArticleTitle is > 256 characters
	 * @throws \TypeError if $newArticleTitle is not a string
	 **/
	public function setArticleTitle(string $newArticleTitle): void {
		// verify the article title content is secure
		$newArticleTitle = trim($newArticleTitle);
		$newArticleTitle = filter_var($newArticleTitle, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newArticleTitle) === true) {
			throw(new \InvalidArgumentException("article title is empty or insecure"));
		}

		// verify the article title content will fit in the database
		if(strlen($newArticleTitle) > 140) {
			throw(new \RangeException("article title too large"));
		}

		// store the article title content
		$this->articleTitle = $newArticleTitle;
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
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() : array {
		$fields = get_object_vars($this);

		$fields["articleId"] = $this->articleId->toString();
		$fields["articleAuthorId"] = $this->articleAuthorId->toString();

		//format the date so that the front end can consume it
		$fields["articleDateTime"] = round(floatval($this->articleDateTime->format("U.u")) * 1000);
		return($fields);
	}

}