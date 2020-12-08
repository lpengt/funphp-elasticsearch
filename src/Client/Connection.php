<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Client;

use Elasticsearch\Client as ElasticsearchClient;
use Elasticsearch\ClientBuilder;

class Connection
{
	/**
	 * @var ElasticsearchClient $elastic
	 */
	protected static $elastic;

	/**
	 * @param array|null $hosts
	 * @return ElasticsearchClient
	 */
	public static function connect(array $hosts = []): ElasticsearchClient
	{
		if (self::$elastic instanceof ElasticsearchClient) {
			return self::$elastic;
		}

		self::$elastic = ClientBuilder::create()
			->setHosts($hosts)
			->build();

		return self::$elastic;
	}
}