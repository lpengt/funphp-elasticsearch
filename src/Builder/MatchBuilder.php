<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Builder;

class MatchBuilder extends BaseBuilder
{
	/**
	 * @var string
	 */
	protected $apiName = 'match';

	public function format()
	{
		return [
			$this->filed => $this->value,
		];
	}

}