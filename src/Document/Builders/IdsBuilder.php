<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\Builders;

class IdsBuilder extends BaseBuilder
{
	protected $apiName = 'ids';

	public function __construct(array $values)
	{
		parent::__construct('', $values);
	}

	public function format(): array
	{
		return [
			'values' => (array) $this->value,
		];
	}

}
