<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\Builders\Sort;

use PhpParser\Node\Expr\Closure;

/**
 */
class SortByScript extends BaseBuilder
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
	 * @param Closure $closure
	 * @return $this
	 */
	public function addScript(Closure $closure): SortByScript
	{
		$this->script = tap(new Script(), $closure);

		return $this;
	}

	/**
	 * @inheritDoc
	 */
	public function format(): array
	{
		return [
			$this->apiName => [
				'type'  => $this->type,
				'order' => $this->order,
				'script' = $this->script->format(),
			],
		];
	}
}