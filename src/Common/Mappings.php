<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Common;

use Funphp\Elasticsearch\Document\Builders\BuilderInterface;

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


	public function format(): array
	{
		if (!$this->mappings) {
			return [];
		}

		return [
			'mappings' => $this->mappings,
		];
	}

}