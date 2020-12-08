<?php
declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\Base;

interface ParserInterface
{
	/**
	 * @param BaseRequest $request
	 * @return array
	 */
	public function parse(BaseRequest $request): array;
}