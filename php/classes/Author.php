<?php

/*
 * @authorId is the Author Id
 * @authorByline is the Author's Byline
 * @authorEmail is the Author's Email
 * @authorName is the Author's Name
 * @authorTitle is the Author's Title
 */
class author {

	protected $authorId;
	protected $authorByline;
	protected $authorEmail;
	protected $authorName;
	protected $authorTitle;

	/**
	 * accessor method for author id
	 * @return mixed
	 */
	public function getAuthorId() : Uuid {
		return($this->authorId);
	}

	/**
	 * mutator method for author id
	 * @param $newAuthorId
	 */
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
	 * @return string
	 */
	public function getAuthorByline() : string {
		return($this->authorByline);
	}

	/**
	 * mutator method for author byline
	 * @param $authorByline
	 */
	public function setAuthorByline($authorByline) : void {
		$this->authorByline = $authorByline;
	}

	/**
	 * accessor method for author email
	 * @return string
	 */
	public function getAuthorEmail() : string {
		return($this->authorEmail);
	}

	/**
	 * mutator method for author email
	 * @param $authorEmail
	 */
	public function setAuthorEmail($authorEmail) : void {
		$this->authorEmail = $authorEmail;
	}

	/**
	 * accessor method for author name
	 * @return string
	 */
	public function getAuthorName() : string {
		return($this->authorName);
	}

	/**
	 * mutator method for author name
	 * @param $authorName
	 */
	public function setAuthorName($authorName) : void {
		$this->authorName = $authorName;
	}

	/**
	 * accessor method for author title
	 * @return string
	 */
	public function getAuthorTitle() : string {
		return($this->authorTitle);
	}

	/**
	 * mutator method for author title
	 * @param $authorTitle
	 */
	public function setAuthorTitle($authorTitle) : void {
		$this->authorTitle = $authorTitle;
	}
	/*
	 * this is my constructor method
	 * it sets all emails to the same email when an instance of the author class is created
	 */
	public function __construct($newAuthorId) {
		$this->setAuthorId($newAuthorId);
	}

}

/*create an instance of our author class
*/
$drSeuss = new author();

$drSeuss->setAuthorName("Dr. Seuss");
$drSeuss->setAuthorTitle("Cheif of Green Eggs and Ham");
echo "This author is " . $drSeuss->getAuthorName() . " and his Title is " . $drSeuss->getAuthorTitle();