<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\Builders;

class SortBuilder extends BaseBuilder
{

	protected $apiName = 'sort';

	/**
	 * @var string $column
	 */
	protected $column;

	/**
	 * @var string $order
	 */
	protected $order = 'asc';

	public function __construct($column, $order)
	{
		$this->column = $column;
		$this->order  = $order;

		parent::__construct('', null);
	}

	public function format(): array
	{
		return [
			$this->column => [
				'order' => $this->order,
			],
		];
	}

}
