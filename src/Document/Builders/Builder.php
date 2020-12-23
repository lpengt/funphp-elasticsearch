<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\Builders;

use Closure;
use Funphp\Elasticsearch\Document\Builders\Sort\SortByScriptBuilder;

class Builder
{
	use EnumerateBuilders;

	/**
	 * @var array|BaseBuilder[]
	 */
	protected $builders = [];

	/**
	 * @var array|SortBuilder $sorts
	 */
	protected $sorts = [];

	/**
	 * @var SourceBuilder $source
	 */
	protected $source = ['*'];

	/**
	 * @var Aggregation $aggs
	 */
	protected $aggs;

	/**
	 * @param Closure $closure
	 * @return Builder
	 */
	public function bool(Closure $closure): self
	{
		$this->builders[] = tap(new BoolBuilder(), $closure);

		return $this;
	}

    /**
     * @param string  $field
     * @param Closure $closure
     * @return $this
     */
	public function range(string $field, Closure $closure): self
    {
        $this->builders[] = tap(new RangeBuilder($field), $closure);

        return $this;
    }


	/**
	 * @param        $column
	 * @param string $order
	 * @return Builder
	 */
	public function sortBy(string $column, $order = 'asc'): self
	{
		$this->sorts[] = new SortBuilder($column, $order);
		return $this;
	}

	/**
	 * @param SortByScriptBuilder $sortByScript
	 * @return $this
	 */
	public function sortByScript(SortByScriptBuilder $sortByScript): self
	{
		$this->sorts[] = $sortByScript;

		return $this;
	}

	/**
	 * @param $column
	 * @return $this
	 */
	public function sortByDesc(string $column): self
	{
		return $this->sortBy($column, 'desc');
	}

	/**
	 * @param string[] $fields
	 * @return $this
	 */
	public function source($fields = ['*']): self
	{
		$this->source = new SourceBuilder($fields);

		return $this;
	}

	/**
	 * @param callable $callable
	 * @return $this
	 */
	public function aggs(callable $callable): self
	{
		$this->aggs = tap(new Aggregation(), $callable);

		return $this;
	}

	/**
	 * @return Aggregation|null
	 */
	public function getAggs(): ?Aggregation
	{
		return $this->aggs;
	}

	/**
	 * @return array|SortBuilder
	 */
	public function getSorts()
	{
		return $this->sorts;
	}

	/**
	 * @return SourceBuilder|string[]
	 */
	public function getSource()
	{
		return $this->source;
	}

	/**
	 * @return array|BaseBuilder[]
	 */
	public function getBuilders(): array
	{
		return $this->builders;
	}
}
