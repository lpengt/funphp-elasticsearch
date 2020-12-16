<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\Query;

use Funphp\Elasticsearch\Document\Base\BaseRequest;

/**
 * @property int $from
 * @property int $size
 * @property string $scroll
 */
class Request extends BaseRequest
{
	/**
	 * @param $from
	 * @return $this
	 */
	public function from($from): self
	{
		$this->from = $from;

		return $this;
	}

	/**
	 * @param int $size
	 * @return $this
	 */
	public function size(int $size): self
	{
		$this->size = $size;

		return $this;
	}

	/**
	 * @param string $scroll
	 * @return $this
	 */
	public function scroll(string $scroll = '1m'): self
	{
		$this->scroll = $scroll;

		return $this;
	}

	public function search()
	{
		return $this->client->search($this->parser->parse($this));
	}

	/**
	 * @return array|callable
	 */
	public function count()
	{
		return $this->client->count($this->parser->parse($this));
	}

}
