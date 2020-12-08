<?php


namespace Funphp\Elasticsearch\Index\Create;

use Funphp\Elasticsearch\Builder\BuilderInterface;
use Funphp\Elasticsearch\Common\AbstractRequest;
use Funphp\Elasticsearch\Common\Mappings;
use Funphp\Elasticsearch\Common\Settings\Settings;

class Request extends AbstractRequest
{

	/**
	 * @var array|BuilderInterface[] $builders
	 */
	protected $builders = [];
	/**
	 * @var Settings
	 */
	protected $settings;

	/**
	 * @var array
	 */
	protected $mappings = [];

	/**
	 * @param Settings $settings
	 * @return $this
	 */
	public function setting(Settings $settings): Request
	{
		$this->settings = $settings;

		$this->builders[] = $settings;

		return $this;
	}

	/**
	 * @param Mappings $mappings
	 * @return $this
	 */
	public function mappings(Mappings $mappings): Request
	{
		$this->mappings = $mappings;

		$this->builders[] = $mappings;

		return $this;
	}

	// /**
	//  * @param array $mappings
	//  * @return $this
	//  */
	// public function mappings(array $mappings = []): Request
	// {
	// 	$this->mappings = $mappings;
	//
	// 	return $this;
	// }

	/**s
	 * @param string $index
	 * @return array|callable
	 */
	public function create(string $index = '')
	{
		$this->index = $index ?: $this->index;
		return $this->client->createIndex($this->parser->parse($this));
	}

}