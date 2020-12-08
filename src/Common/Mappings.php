<?php


namespace Funphp\Elasticsearch\Common;


use Funphp\Elasticsearch\Builder\BuilderInterface;

class Mappings implements BuilderInterface
{

	/**
	 * @var array|string[]
	 */
	private $mappings = [];


	/**
	 * @return Mappings
	 */
	public static function builder(): Mappings
	{
		return new static;
	}

	/**
	 * @param string $field
	 * @param array  $params
	 * @return $this
	 */
	public function mappings(string $field, array $params): Mappings
	{
		$this->mappings[$field] = $params;

		return $this;
	}


	public function format()
	{
		if (!$this->mappings) {
			return [];
		}

		return [
			'mappings' => $this->mappings,
		];
	}

}