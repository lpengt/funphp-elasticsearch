<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\Scroll;

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
			'scroll' => $request->scroll,
			'body'   => [
				'scroll_id' => $request->scrollId,
			],
		];
	}
}