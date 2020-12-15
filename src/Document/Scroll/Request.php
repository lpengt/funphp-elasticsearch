<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\Scroll;

use Funphp\Elasticsearch\Document\Base\BaseRequest;

/**
 * @property string $scroll
 * @property string $scrollId
 */
class Request extends BaseRequest
{
	/**
	 * @param string $scroll
	 * @return $this
	 */
	public function scroll(string $scroll = '1m'): self
	{
		$this->scroll = $scroll;

		return $this;
	}

	/**
	 * @param string $scrollId
	 * @return $this
	 */
	public function scrollId(string $scrollId): self
	{
		$this->scrollId = $scrollId;

		return $this;
	}

	/**
	 * @return array|callable
	 */
	public function search()
	{
		return $this->client->scroll($this->parser->parse($this));
	}
}