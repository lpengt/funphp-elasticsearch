<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Common;

trait HasAttributes
{

	public function __get($name)
	{
		if (!$this->__isset($name)) {
			return null;
		}

		return $this->$name;
	}

	public function __set($name, $value)
	{
		$this->$name = $value;
	}

	public function __isset($name)
	{
		return property_exists($this, $name);
	}
}