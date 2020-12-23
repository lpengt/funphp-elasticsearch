<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Document\Builders;

class RangeBuilder extends BaseBuilder
{
	protected $apiName = 'range';

    /**
     * @var array $operators
     */
	protected $operators = [];

    /**
     * RangeBuilder constructor.
     * @param string $filed
     */
	public function __construct(string $filed)
	{
		parent::__construct($filed, null);
	}

	public function format(): array
	{
		return [
			$this->filed => $this->operators,
		];
	}

    public function lt($value): RangeBuilder
    {
        $this->operators['lt'] = $value;
        return $this;
    }

    public function lte($value): RangeBuilder
    {
        $this->operators['lte'] = $value;
        return $this;
    }

    public function gt($value): RangeBuilder
    {
        $this->operators['gt'] = $value;
        return $this;
    }

    public function gte($value): RangeBuilder
    {
        $this->operators['gte'] = $value;

        return $this;
    }

    public function from($value): RangeBuilder
    {
        $this->operators['from'] = $value;
        return $this;
    }

    public function to($value): RangeBuilder
    {
        $this->operators['to'] = $value;
        return $this;
    }

}
