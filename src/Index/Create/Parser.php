<?php


namespace Funphp\Elasticsearch\Index\Create;

use Funphp\Elasticsearch\Builder\BuilderInterface;
use Funphp\Elasticsearch\Common\AbstractRequest;
use Funphp\Elasticsearch\Common\Contract\ParserInterface;
use Funphp\Elasticsearch\Common\Settings\Settings;

class Parser implements ParserInterface
{
	/**
	 * @var AbstractRequest
	 */
	private $request;

	/**
	 * @inheritDoc
	 */
	public function parse(AbstractRequest $request): array
	{
		$this->request = $request;

		return [
			'index' => $request->index,
			'body' => $this->parseBuilders(),
		];
	}

	/**
	 * @return array
	 */
	private function parseBuilders()
	{
		$builders = $this->request->builders ?? [];
		if (!$builders) {
			return [];
		}

		$data = [];
		/** @var BuilderInterface $builder */
		foreach ($builders as $builder) {
			if (!$builder instanceof BuilderInterface) {
				continue;
			}

			$data = array_merge($data, $builder->format());
		}

		return $data;
	}

	private function setting()
	{
		/** @var Settings $settings */
		$settings = $this->request->settings;
		if (!$settings) {
			return [];
		}

		return $settings->format();
	}

	private function mappings()
	{
		$mappings = $this->request->mappings;
		if (!$mappings) {
			return [];
		}

		return [
			'mappings' => $mappings,
		];
	}

}