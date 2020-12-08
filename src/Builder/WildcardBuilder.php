<?php
declare(strict_types = 1);

namespace Funphp\Elasticsearch\Builder;

class WildcardBuilder extends BaseBuilder
{
	protected $apiName = 'wildcard';

	public function format()
	{
		return [
			$this->filed => [
				'value' => $this->value,
			],
		];
	}

}