<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Common\Settings;

use Funphp\Elasticsearch\Document\Builders\BuilderInterface;

class Settings implements BuilderInterface
{
	/**
	 * @var array|string[]
	 */
	private $settings = [];

	/**
	 * @return Settings
	 */
	public static function builder(): Settings
	{
		return new static;
	}

	/**
	 * @param string       $key
	 * @param string|mixed $value
	 * @return $this
	 */
	public function setting(string $key, $value = ''): Settings
	{
		$this->settings[$key] = $value;

		return $this;
	}

	public function format(): array
	{
		if (!$this->settings) {
			return [];
		}

		return [
			'settings' => $this->settings,
		];
	}
}