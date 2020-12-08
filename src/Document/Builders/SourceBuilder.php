<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\Builders;

class SourceBuilder extends BaseBuilder
{
	protected $apiName = '_source';

	protected $fields = [];

	public function __construct($fields = ['*'])
	{
		$this->fields = is_array($fields) ? $fields : func_get_args();
		parent::__construct('', null);
	}

	public function format(): array
	{
		return $this->fields;
	}

}
