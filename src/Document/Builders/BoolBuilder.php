<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\Builders;

use Closure;

class BoolBuilder extends BaseBuilder
{
	protected $apiName = 'bool';

	/**
	 * @var array|self[]
	 */
	protected $clauses = [];

	/* clauses
	 * ---------------------------------------- */
	private const CLAUSES_MUST     = 'must';
	private const CLAUSES_SHOULD   = 'should';
	private const CLAUSES_FILTER   = 'filter';
	private const CLAUSES_MUST_NOT = 'must_not';

	public function __construct()
	{
		parent::__construct('', null);
	}

	/**
	 * @param Closure $closure
	 * @return $this
	 */
	public function must(Closure $closure): self
	{
		return $this->addClause(self::CLAUSES_MUST, $closure);
	}

	/**
	 * @param Closure $closure
	 * @return $this
	 */
	public function should(Closure $closure): self
	{
		return $this->addClause(self::CLAUSES_SHOULD, $closure);
	}

	/**
	 * @param Closure $closure
	 * @return $this
	 */
	public function filter(Closure $closure): self
	{
		return $this->addClause(self::CLAUSES_FILTER, $closure);
	}

	/**
	 * @param Closure $closure
	 * @return $this
	 */
	public function mustNot(Closure $closure): self
	{
		return $this->addClause(self::CLAUSES_MUST_NOT, $closure);
	}

	public function format(): array
	{
		$queries = [];
		$clauses = [self::CLAUSES_MUST, self::CLAUSES_SHOULD, self::CLAUSES_FILTER, self::CLAUSES_MUST_NOT];
		foreach ($clauses as $clause) {
			$queries = array_merge($queries, $this->parseClauses($clause));
		}

		return $queries;
	}

	/**
	 * @param $clauseType
	 * @param $closure
	 * @return $this
	 */
	protected function addClause($clauseType, $closure): self
	{
		$this->clauses[$clauseType][] = tap(new Builder(), $closure);

		return $this;
	}

	/**
	 * parse the clauses to query
	 * @param $clauseType
	 * @return array
	 */
	protected function parseClauses($clauseType = self::CLAUSES_MUST): array
	{
		$clauses = $this->clauses[$clauseType] ?? [];
		if (!$clauses) {
			return [];
		}

		$query = [];
		foreach ($clauses as $clause) {
			foreach ($clause->getBuilders() as $builder) {
				$query[] = $builder->parseBuilder();
			}
		}

		return [
			$clauseType => $query,
		];
	}

}
