<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\Update;

use Funphp\Elasticsearch\Document\Base\BaseRequest;

class Request extends BaseRequest
{
	/**
	 * @var array $doc
	 */
	protected $doc;

	/**
	 * @param $doc
	 * @return array|callable
	 */
	public function update(array $doc)
	{
		$this->doc = $doc;

		return $this->client->update($this->parser->parse($this));
	}
}