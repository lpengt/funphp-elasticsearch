<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\Builders;

interface BuilderInterface
{
	/**
	 * @return array
	 */
	public function format(): array;
}
