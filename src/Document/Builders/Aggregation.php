<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\Builders;

class Aggregation extends BaseBuilder
{
	protected $apiName = 'aggs';

	/**
	 * @var array|AggregationBuilder
	 */
	protected $aggregations = [];

	private const AGG_VALUE_COUNT = 'value_count';
	private const AGG_AVG         = 'avg';
	private const AGG_MAX         = 'max';
	private const AGG_MIN         = 'min';
	private const AGG_SUM         = 'sum';

	public function __construct()
	{
		parent::__construct('', null);
	}

	/**
	 * @param string $name
	 * @param string $field
	 * @return Aggregation
	 */
	public function count(string $name, string $field): Aggregation
	{
		return $this->addAggregation($name, new AggregationBuilder(self::AGG_VALUE_COUNT, $field));
	}

	/**
	 * @param string $name
	 * @param string $field
	 * @return Aggregation
	 */
	public function avg(string $name, string $field): Aggregation
	{
		return $this->addAggregation($name, new AggregationBuilder(self::AGG_AVG, $field));
	}

	/**
	 * @param string $name
	 * @param string $field
	 * @return Aggregation
	 */
	public function max(string $name, string $field): Aggregation
	{
		return $this->addAggregation($name, new AggregationBuilder(self::AGG_MAX, $field));
	}

	/**
	 * @param string $name
	 * @param string $field
	 * @return Aggregation
	 */
	public function min(string $name, string $field): Aggregation
	{
		return $this->addAggregation($name, new AggregationBuilder(self::AGG_MIN, $field));
	}

	/**
	 * @param string $name
	 * @param string $field
	 * @return Aggregation
	 */
	public function sum(string $name, string $field): Aggregation
	{
		return $this->addAggregation($name, new AggregationBuilder(self::AGG_SUM, $field));
	}

	/**
	 * @param                    $name
	 * @param AggregationBuilder $aggregation
	 * @return $this
	 */
	protected function addAggregation($name, $aggregation): Aggregation
	{
		$this->aggregations[$name] = $aggregation->format();

		return $this;
	}

	public function format(): array
	{
		return [
			$this->apiName => $this->aggregations,
		];
	}
}