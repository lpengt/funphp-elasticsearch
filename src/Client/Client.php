<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Client;

use Elasticsearch\Namespaces\IndicesNamespace;

class Client
{
	/**
	 * @var \Elasticsearch\Client $client
	 */
	private $client;

	/**
	 * Client constructor.
	 * @param array $connections
	 */
	public function __construct(array $connections = [])
	{
		$this->client = Connection::connect($connections);
	}

	/**
	 * @param array $params
	 * @return array|callable
	 */
	public function search(array $params = [])
	{
		return $this->client->search($params);
	}

	/**
	 * @param array $params
	 * @return array|callable
	 */
	public function count(array $params = [])
	{
		return $this->client->count($params);
	}

	/**
	 * @param array $params
	 * @return array|callable
	 */
	public function scroll(array $params = [])
	{
		return $this->client->scroll($params);
	}

	/**
	 * @param array $params
	 * @return array|callable
	 */
	public function create(array $params = [])
	{
		return $this->client->index($params);
	}

	/**
	 * @param array $params
	 * @return array|callable
	 */
	public function update(array $params = [])
	{
		return $this->client->update($params);
	}

	/**
	 * @param array $params
	 * @return array|callable
	 */
	public function updateByQuery(array $params = [])
	{
		return $this->client->updateByQuery($params);
	}

	/**
	 * @param array $params
	 * @return array|callable
	 */
	public function deleteByQuery(array $params = [])
	{
		return $this->client->deleteByQuery($params);
	}

	/**
	 * @param array $params
	 * @return array|callable
	 */
	public function delete(array $params = [])
	{
		return $this->client->delete($params);
	}

	/**
	 * @param array $params
	 * @return array|callable
	 */
	public function createIndex(array $params = [])
	{
		return $this->indices()->create($params);
	}

	/**
	 * @param array $params
	 * @return array|callable
	 */
	public function deleteIndex(array $params = [])
	{
		return $this->indices()->delete($params);
	}

	/**
	 * @param array $params
	 * @return array|callable
	 */
	public function bulk(array $params = [])
	{
		return $this->client->bulk($params);
	}

	/**
	 * @return IndicesNamespace
	 */
	protected function indices(): IndicesNamespace
	{
		return $this->client->indices();
	}
}
