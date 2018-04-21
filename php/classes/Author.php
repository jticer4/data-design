<?php
namespace Edu\Cnm\jticer\DataDesign;

require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

class author {
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
	 * @param Uuid $authorId
	 * @param string $authorByline
	 * @param string $authorEmail
	 * @param string $authorName
	 * @param string $authorTitle
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

}

/**
 * create an instance of our author class
**/
$drSeuss = new author();

$drSeuss->setAuthorName("Dr. Seuss");
$drSeuss->setAuthorTitle("Cheif of Green Eggs and Ham");
echo "This author is " . $drSeuss->getAuthorName() . " and his Title is " . $drSeuss->getAuthorTitle();