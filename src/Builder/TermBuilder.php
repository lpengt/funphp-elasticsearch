<?php
declare(strict_types = 1);

namespace Funphp\Elasticsearch\Builder;

class TermBuilder extends BaseBuilder
{
	protected $apiName = 'term';

	public function format()
	{
		return [
			$this->filed => [
				'value' => $this->value,
			],
		];
	}
}