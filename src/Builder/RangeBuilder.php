<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Builder;

class RangeBuilder extends BaseBuilder
{
	protected $apiName = 'range';

	protected $operator;

	public const OPERATOR_GT  = 'gt';
	public const OPERATOR_GTE = 'gte';
	public const OPERATOR_LT  = 'lt';
	public const OPERATOR_LTE = 'lte';

	/**
	 * RangeBuilder constructor.
	 * @param string $filed
	 * @param string $operator
	 * @param null   $value
	 * @throws RangeOperatorInvalidException
	 */
	public function __construct(string $filed, string $operator = '', $value = null)
	{
		parent::__construct($filed, $value);
		$this->operator = $this->parserOperator($operator);
	}

	public function format()
	{
		return [
			$this->filed => [
				$this->operator => $this->value,
			],
		];
	}

	/**
	 * @param $operator
	 * @return string
	 * @throws RangeOperatorInvalidException
	 */
	private function parserOperator($operator): ?string
	{
		switch ($operator) {
			case self::OPERATOR_LT:
			case '<':
				return self::OPERATOR_LT;
				break;
			case self::OPERATOR_LTE:
			case '<=':
				return self::OPERATOR_LTE;
				break;
			case self::OPERATOR_GT:
			case '>':
				return self::OPERATOR_GT;
				break;
			case self::OPERATOR_GTE:
			case '>=':
				return self::OPERATOR_GTE;
				break;
			default:
				throw new RangeOperatorInvalidException("Invalid range operator:['{$operator}']");
				break;
		}
	}

}