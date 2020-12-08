<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Builder;

class ExistsBuilder extends BaseBuilder
{
	protected $apiName = 'exists';

	public function format()
	{
		return [
			$this->filed => $this->value,
		];
	}

}