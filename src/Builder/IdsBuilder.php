<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Builder;

class IdsBuilder extends BaseBuilder
{
	protected $apiName = 'ids';

	public function format()
	{
		return [
			'values' => $this->value,
		];
	}

}