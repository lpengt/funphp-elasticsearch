<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\Update;

use Funphp\Elasticsearch\Document\Base\BaseParser;
use Funphp\Elasticsearch\Document\Base\BaseRequest;

class Parser extends BaseParser
{
	public function parse(BaseRequest $request): array
	{
		$this->request = $request;
		return [
			'body'  => $this->parseBody(),
			'index' => $this->request->index,
			'id'    => $this->request->searchableId,
		];
	}

	protected function parseBody()
	{
		return [
			'doc' => $this->request->doc,
		];
	}
}