<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Aggregation;

use Funphp\Elasticsearch\Document\Builders\BaseBuilder;

class AggregationBuilder extends BaseBuilder
{
	public function __construct(string $apiName, string $filed)
	{
		parent::__construct('', null);

		$this->apiName = $apiName;
		$this->filed   = $filed;
	}

	public function format(): array
	{
		return [
			$this->apiName => [
				'field' => $this->filed,
			],
		];
	}
}