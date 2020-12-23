<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\Builders;


/**
 * @method Builder   exists($field)
 * @method Builder   ids(array $values)
 * @method Builder   match($field, $value)
 * @method Builder   term($field, $value)
 * @method Builder   termKeyword($field, $value)
 * @method Builder   terms($field, $value)
 * @method Builder   wildcard($filed, $value)
 */
trait EnumerateBuilders
{
	private static $validBuilder = [
		'exists'      => ExistsBuilder::class,
		'ids'         => IdsBuilder::class,
		'match'       => MatchBuilder::class,
		'term'        => TermBuilder::class,
		'termKeyword' => TermKeywordBuilder::class,
		'terms'       => TermsBuilder::class,
		'wildcard'    => WildcardBuilder::class,
	];

	public function __call($method, $arguments)
	{
		if (!$this->buildIsValid($method)) {
			return $this;
		}

		$class   = self::$validBuilder[$method];
		$builder = new $class(...$arguments);

		return tap($this, function () use ($builder) {
			$this->builders[] = $builder;
		});
	}

	/**
	 * @param $build
	 * @return bool
	 */
	protected function buildIsValid($build): bool
	{
		return array_key_exists($build, self::$validBuilder);
	}

}
