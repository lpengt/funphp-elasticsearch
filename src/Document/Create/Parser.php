<?php


namespace Funphp\Elasticsearch\Document\Create;


use Funphp\Elasticsearch\Document\Base\BaseParser;
use Funphp\Elasticsearch\Document\Base\BaseRequest;

class Parser extends BaseParser
{
	/**
	 * @inheritDoc
	 */
	public function parse(BaseRequest $request): array
	{
		return [
			'id'    => (string) $request->searchableId,
			'index' => $request->index,
			'body'  => $request->doc,
		];
	}

}