<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\UpdateByQuery;

use Funphp\Elasticsearch\Document\Base\BaseParser;
use Funphp\Elasticsearch\Document\Base\BaseRequest;

class Parser extends BaseParser
{
	private static $paramPrefix = 'ctx';

	public function parse(BaseRequest $request): array
	{
		$this->request = $request;
		$this->builder = $this->request->builder;

		return [
			'body'  => $this->parseBody(),
			'index' => $this->request->index,
		];
	}

	public function parseByQuery(BaseRequest $request): array
	{
		return [
			'body'  => $this->parseBody(),
			'index' => $this->request->index,
		];
	}

	protected function parseBody()
	{
		return array_merge($this->parseScript(), $this->parseQuery());
	}

	/**
	 * @return array[]
	 */
	protected function parseScript(): array
	{
		return [
			'script' => [
				'source' => $this->combineDocs($this->request->doc),
				'lang'   => 'painless',
			],
		];
	}

	/**
	 * @param $docs
	 * @return string
	 */
	protected function combineDocs($docs): string
	{
		$data = $this->dataDotValue($docs);

		$params = '';
		foreach ($data as $field => $value) {
			$key = implode('.', [
				self::$paramPrefix,
				'_source',
				$field,
			]);

			$params .= "{$key}='{$value}';";
		}

		return $params;
	}

	private function dataDotValue($docs, $preField = '')
	{
		static $data = [];
		foreach ($docs as $field => $value) {
			if (is_array($value)) {
				$this->dataDotValue($value, $field);
				continue;
			}

			if ($preField) {
				$field = $preField . '.' . $field;
			}

			$data[$field] = $value;
		}

		return $data;
	}

}