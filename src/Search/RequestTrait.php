<?php

declare(strict_types = 1);

namespace Funphp\Elasticsearch\Search;

use Funphp\Elasticsearch\Client\Client;
use Funphp\Elasticsearch\Document\Create\Parser as DocumentCreateParser;
use Funphp\Elasticsearch\Document\Create\Request as DocumentCreateRequest;
use Funphp\Elasticsearch\Document\Delete\Request as DeleteRequest;
use Funphp\Elasticsearch\Document\Query\Parser as QueryParser;
use Funphp\Elasticsearch\Document\Query\Request as QueryRequest;
use Funphp\Elasticsearch\Document\Scroll\Parser as ScrollParser;
use Funphp\Elasticsearch\Document\Scroll\Request as ScrollRequest;
use Funphp\Elasticsearch\Document\Update\Parser as UpdateParser;
use Funphp\Elasticsearch\Document\Update\Request as UpdateRequest;
use Funphp\Elasticsearch\Document\UpdateByQuery\Parser as UpdateByQueryParser;
use Funphp\Elasticsearch\Document\UpdateByQuery\Request as UpdateByQueryRequest;
use Funphp\Elasticsearch\Index\Create\Parser as IndexCreateParser;
use Funphp\Elasticsearch\Index\Create\Request as IndexCreateRequest;
use Funphp\Elasticsearch\Index\Delete\Request as IndexDeleteRequest;

trait RequestTrait
{

	/**
	 * @return IndexCreateRequest
	 */
	public static function indexCreateBuilder(): IndexCreateRequest
	{
		return (new static)->newIndexCreateRequest();
	}

	/**
	 * @return IndexCreateRequest
	 */
	public function newIndexCreateRequest(): IndexCreateRequest
	{
		return (new IndexCreateRequest($this->newClient(), new IndexCreateParser()))
			->index($this->searchableIndex());
	}

	/**
	 * @return IndexDeleteRequest
	 */
	public static function indexDeleteBuilder(): IndexDeleteRequest
	{
		return (new static)->newIndexDeleteRequest();
	}

	/**
	 * @return IndexDeleteRequest
	 */
	public function newIndexDeleteRequest(): IndexDeleteRequest
	{
		return (new IndexDeleteRequest($this->newClient()))
			->index($this->searchableIndex());
	}

	public static function documentCreateBuilder(): DocumentCreateRequest
	{
		return (new static)->newDocumentCreateRequest();
	}

	public function newDocumentCreateRequest(): DocumentCreateRequest
	{
		return (new DocumentCreateRequest($this->newClient(), new DocumentCreateParser()))
			->index($this->searchableIndex());
	}

	/**
	 * @return QueryRequest
	 */
	public static function documentQueryBuilder(): QueryRequest
	{
		return (new static)->newDocumentQueryRequest();
	}

	/**
	 * @return QueryRequest
	 */
	public function newDocumentQueryRequest(): QueryRequest
	{
		return (new QueryRequest($this->newClient(), new QueryParser()))
			->index($this->searchableIndex());
	}

	/**
	 * @return ScrollRequest
	 */
	public static function documentScrollBuilder(): ScrollRequest
	{
		return (new static)->newDocumentScrollRequest();
	}

	/**
	 * @return ScrollRequest
	 */
	public function newDocumentScrollRequest(): ScrollRequest
	{
		return (new ScrollRequest($this->newClient(), new ScrollParser()));
	}

	/**
	 * @return UpdateRequest
	 */
	public static function documentUpdateBuilder(): UpdateRequest
	{
		return (new static)->newDocumentUpdateBuilder();
	}

	/**
	 * @return UpdateRequest
	 */
	public function newDocumentUpdateBuilder(): UpdateRequest
	{
		return (new UpdateRequest($this->newClient(), new UpdateParser()))
			->index($this->searchableIndex());
	}

	/**
	 * @return UpdateByQueryRequest
	 */
	public static function documentUpdateByQueryBuilder(): UpdateByQueryRequest
	{
		return (new static)->newDocumentUpdateByQueryBuilder();
	}

	/**
	 * @return UpdateByQueryRequest
	 */
	public function newDocumentUpdateByQueryBuilder(): UpdateByQueryRequest
	{
		return (new UpdateByQueryRequest($this->newClient(), new UpdateByQueryParser()))
			->index($this->searchableIndex());
	}

	/**
	 * @return DeleteRequest
	 */
	public static function documentDeleteBuilder(): DeleteRequest
	{
		return (new static())->newDocumentDeleteBuilder();
	}

	/**
	 * @return DeleteRequest
	 */
	public function newDocumentDeleteBuilder(): DeleteRequest
	{
		return (new DeleteRequest($this->newClient()))
			->index($this->searchableIndex());
	}

	/**
	 * @return Client
	 */
	protected function newClient(): Client
	{
		return new Client($this->hosts());
	}
}
