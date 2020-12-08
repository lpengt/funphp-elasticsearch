<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\Base;

use Funphp\Elasticsearch\Document\Builders\Builder;

abstract class BaseParser implements ParserInterface
{
	/**
	 * @var BaseRequest $request
	 */
	protected $request;

	/**
	 * @var Builder $builder
	 */
	protected $builder;

	/**
	 * @return array
	 */
	protected function parseQuery(): array
	{
		$query = [];

		$builders = $this->request->builder->getBuilders() ?? [];
		foreach ($builders as $builder) {
			$query[] = [
				$builder->getApiName() => $builder->format(),
			];
		}

		return ($query[0] ?? []) ? [
			'query' => $query[0],
		] : [];
	}
}