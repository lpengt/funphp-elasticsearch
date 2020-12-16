<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\Builders\Sort;

class Script
{
	/**
	 * @var string $lang
	 */
	private $lang;

	/**
	 * @var string $source
	 */
	private $source;

	/**
	 * @var array $params
	 */
	private $params;

	public function __construct($source, $lang = 'painless', $params = [])
	{
		$this->source = $source;
		$this->lang   = $lang;
		$this->params = $params;
	}

	public function format(): array
	{
		return [
			'lang'   => $this->lang,
			'source' => $this->source,
			'params' => (object) $this->params,
		];
	}
}