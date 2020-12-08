<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\Builders;

class ExistsBuilder extends BaseBuilder
{
	protected $apiName = 'exists';

	public function format(): array
	{
		return [
			'field' => $this->filed,
		];
	}

}
