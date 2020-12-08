<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\Builders;

use Closure;

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
	 * @param Closure $closure
	 * @return Builder
	 */
	public function bool(Closure $closure): self
	{
		$this->builders[] = tap(new BoolBuilder(), $closure);

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
