<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\Builders;

class MatchBuilder extends BaseBuilder
{
	/**
	 * @var string
	 */
	protected $apiName = 'match';

	public function format(): array
	{
		return [
			$this->filed => $this->value,
		];
	}

}
