<?php


namespace Funphp\Elasticsearch\Common;


use Funphp\Elasticsearch\Client\Client;
use Funphp\Elasticsearch\Document\Base\ParserInterface;

abstract class AbstractRequest
{
	use HasAttributes;

	/**
	 * @var ParserInterface|null $parser
	 */
	protected $parser;

	/**
	 * @var Client|null $client
	 */
	protected $client;

	/**
	 * @var string $index
	 */
	public $index;

	/**
	 * Builder constructor.
	 * @param null|Client          $client
	 * @param null|ParserInterface $parser
	 */
	public function __construct($client = null, $parser = null)
	{
		$this->parser = $parser;
		$this->client = $client;
	}


	/**
	 * @param $index
	 * @return $this
	 */
	public function index(string $index): self
	{
		$this->index = $index;

		return $this;
	}
}