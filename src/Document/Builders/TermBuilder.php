<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\Builders;

class TermBuilder extends BaseBuilder
{
	protected $apiName = 'term';

	public function format(): array
	{
		return [
			$this->filed => $this->value,
		];
	}

}
