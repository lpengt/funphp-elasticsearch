<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\Base;

use Funphp\Elasticsearch\Common\AbstractRequest;
use Funphp\Elasticsearch\Document\Builders\Builder;

/**
 * @mixin Builder
 * @property int $searchableId
 */
class BaseRequest extends AbstractRequest
{

	/**
	 * @var Builder $builder
	 */
	public $builder;

	/**
	 * @param $id
	 * @return $this
	 */
	public function searchableId($id): self
	{
		$this->searchableId = $id;

		$this->ids([$id]);

		return $this;
	}

	public function __call($name, $arguments)
	{
		if (!$this->builder) {
			$this->builder = new Builder();
		}

		$this->builder->$name(...$arguments);

		return $this;
	}

}
