<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\Query;

use Funphp\Elasticsearch\Document\Base\BaseParser;
use Funphp\Elasticsearch\Document\Builders\SourceBuilder;

class Parser extends BaseParser
{
	public function parse($request): array
	{
		$this->request = $request;
		$this->builder = $this->request->builder;

		return array_merge([
			'body'  => $this->parseBody(),
			'index' => $this->request->index,
		], $this->parseScroll());
	}

	/**
	 * @return array
	 */
	protected function parseBody(): array
	{
		return array_merge($this->parseQuery(),
			$this->parseSort(),
			$this->parseSource(),
			$this->parseFrom(),
			$this->parseSize()
		);
	}

	/**
	 * @return array|array[]
	 */
	protected function parseSort(): array
	{
		$sort = [];
		foreach ($this->builder->getSorts() as $_sort) {
			$sort[] = $_sort->format();
		}

		return $sort ? [
			'sort' => $sort,
		] : [];
	}

	/**
	 * @return array
	 */
	protected function parseSource(): array
	{
		$source = $this->builder->getSource();
		if ($source instanceof SourceBuilder) {
			$source = $source->format();
		}

		return [
			'_source' => $source,
		];
	}

	protected function parseFrom(): array
	{
		return $this->request->from ? [
			'from' => $this->request->from,
		] : [];
	}

	protected function parseSize(): array
	{
		return [
			'size' => $this->request->size ?? 10,
		];
	}

	protected function parseScroll()
	{
		return $this->request->scroll ? [
			'scroll' => $this->request->scroll ?? '1m',
		] : [];
	}

}
