<?php
declare(strict_types = 1);

namespace Funphp\Elasticsearch\Builder;

abstract class BaseBuilder implements BuilderInterface
{
	/**
	 * @var string $apiName
	 */
	protected $apiName;

	/**
	 * @var string $filed
	 */
	protected $filed;

	/**
	 * @var $value
	 */
	protected $value;

	public function __construct(string $filed, $value = null)
	{
		$this->filed = $filed;
		$this->value = $value;
	}

	/**
	 * @return string
	 */
	public function getApiName(): string
	{
		return $this->apiName;
	}
}