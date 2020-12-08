<?php

namespace Funphp\Elasticsearch\Document\Create;

use Funphp\Elasticsearch\Document\Base\BaseRequest;

class Request extends BaseRequest
{

	/**
	 * @var array
	 */
	protected $doc;

	public function create(array $doc)
	{
		$this->doc = $doc;

		return $this->client->create($this->parser->parse($this));
	}

}