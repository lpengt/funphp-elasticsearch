<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\Query;

use Funphp\Elasticsearch\Document\Base\BaseRequest;

/**
 * @property int $from
 * @property int $size
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

	public function search()
	{
		return $this->client->search($this->parser->parse($this));
	}

}
