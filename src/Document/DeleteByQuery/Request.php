<?php

declare(strict_types=1);

namespace Funphp\Elasticsearch\Document;

use Funphp\Elasticsearch\Document\Base\BaseRequest;

class Request extends BaseRequest
{
    public function delete()
    {
        return $this->client->deleteByQuery($this->parser->parse($this));
    }
}