<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search;

use Funphp\Utils\StringHelper;

trait Searchable
{

	use RequestTrait;

	/**
	 * @return string
	 */
	public function searchableIndex(): string
	{
		return StringHelper::camel(class_basename($this));
	}

	/**
	 * @return string[][]
	 */
	public function hosts(): array
	{
		return [
			[
				'host'   => '127.0.0.1',
				'port'   => '9200',
				'scheme' => 'http',
			],
		];
	}
}