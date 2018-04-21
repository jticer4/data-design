<?php
namespace Edu\Cnm\jticer\DataDesign;

require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

class article {

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
	 * accessor method for article id
	 * @return Uuid
	 **/
	public function getArticleId(): Uuid {
		return $this->articleId;
	}

	/**
	 * mutator method for article id
	 * @param string | Uuid $articleId
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
	 * @param string | Uuid $articleAuthorId
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
	 * mutator method for the article content
	 * @param string $articleContent
	 **/
	public function setArticleContent(string $articleContent): void {
		$this->articleContent = $articleContent;
	}

	/**
	 * accessor method for the article date time
	 * @return DateTime
	 **/
	public function getArticleDateTime(): DateTime {
		return $this->articleDateTime;
	}

	/**
	 * mutator method for the article date time
	 * @param DateTime|string|null $articleDateTime article date as a Date Time object or string(or null for the current time)
	 **/
	public function setArticleDateTime(DateTime $articleDateTime): void {
		$this->articleDateTime = $articleDateTime;
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
	 * @param string $articleTitle
	 **/
	public function setArticleTitle(string $articleTitle): void {
		$this->articleTitle = $articleTitle;
	}



}