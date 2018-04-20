<?php

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
	 */
	protected $articleTitle;

}