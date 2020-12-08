<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Builder;

class TermsBuilder extends BaseBuilder
{
	protected $apiName = 'terms';

	public function format()
	{
		return [
			$this->filed => (array) $this->value,
		];
	}

}