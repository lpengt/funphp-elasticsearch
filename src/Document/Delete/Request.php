<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\Delete;

use Funphp\Elasticsearch\Document\Base\BaseRequest;

/**
 * document delete request
 */
class Request extends BaseRequest
{
	/**
	 * delete document by id
	 * @param $id
	 * @return array|callable
	 */
	public function delete($id)
	{
		return $this->client->delete([
			'index' => $this->index,
			'id'    => $id,
		]);
	}
}