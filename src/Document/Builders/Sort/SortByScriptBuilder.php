<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\Builders\Sort;

use Funphp\Elasticsearch\Document\Builders\BaseBuilder;

/**
 */
class SortByScriptBuilder extends BaseBuilder
{
	protected $apiName = '_script';

	/**
	 * @var string $type
	 */
	private $type;

	/**
	 * @var string $order
	 */
	private $order;

	/**
	 * @var Script $script
	 */
	private $script;

	public function __construct($type, $order = 'asc')
	{
		$this->type  = $type;
		$this->order = $order;
		parent::__construct('', null);
	}

	/**
	 * @param Script $script
	 * @return $this
	 */
	public function addScript(Script $script): SortByScriptBuilder
	{
		$this->script = $script;

		return $this;
	}

	/**
	 * @inheritDoc
	 */
	public function format(): array
	{
		return [
			$this->apiName => [
				'type'   => $this->type,
				'order'  => $this->order,
				'script' => $this->script->format(),
			],
		];
	}
}