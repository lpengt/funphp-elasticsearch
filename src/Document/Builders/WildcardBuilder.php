<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\Builders;

class WildcardBuilder extends BaseBuilder
{
	protected $apiName = 'wildcard';

	public function format(): array
	{
		return [
			$this->filed => [
				'value' => $this->value,
			],
		];
	}

}
