<?php


namespace Funphp\Elasticsearch\Common\Contract;


use Funphp\Elasticsearch\Common\AbstractRequest;

interface ParserInterface
{
	/**
	 * @param AbstractRequest $request
	 * @return array
	 */
	public function parse(AbstractRequest $request): array;

}