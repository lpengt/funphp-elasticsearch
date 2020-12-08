<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\Builders;

class TermsBuilder extends BaseBuilder
{
	protected $apiName = 'terms';

	public function format(): array
	{
		return [
			$this->filed => (array) $this->value,
		];
	}

}
