<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Builder;

class TermKeywordBuilder extends BaseBuilder
{
	protected $apiName = 'term';

	public function format()
	{
		return [
			$this->filed . '.keyword' => [
				'value' => $this->value,
			],
		];
	}

}