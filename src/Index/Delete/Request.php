<?php


namespace Funphp\Elasticsearch\Index\Delete;


use Funphp\Elasticsearch\Common\AbstractRequest;

/**
 * 删除index
 */
class Request extends AbstractRequest
{
	/**
	 * @param string $index
	 * @return array
	 */
	public function delete(string $index = '')
	{
		$index = $index ?: $this->index;

		return $this->client->deleteIndex([
			'index' => $index,
		]);
	}
}