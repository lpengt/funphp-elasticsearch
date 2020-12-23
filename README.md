# Elasticsearch

一个简易的个人使用的Elasticsearch工具包, 对[elasticsearch/elasticsearch](https://github.com/elastic/elasticsearch-php)的`Index`, `Document`操作进行了简单的封装.

## 安装

```bash
composer require funphp/elasticsearch
```

## 使用

### 引入相关搜索类

在你需要搜索的类中添加 `Funphp\Elasticsearch\Search\Searchable` trait, 就可以使用相关的搜索操作了.

通过 `searchableIndex()`方法, 就可以指定`index`了.

```php
namespace Start;

use Funphp\Elasticsearch\Search\Searchable;

Class User{
    use Searchable;
    
    public function searchableIndex(): string
    {
        return 'index-user';
    }
}

```

### 创建索引

```php
self::indexCreateBuilder()->create();
```

这样就可以创建一个通过`searchableIndex()`方法设定的`index`了.

如果你需要创建索引的时候进行一些设置, 可以使用以下方式:

```php
<?php
namespace Start;

use Funphp\Elasticsearch\Common\Mappings;
use Funphp\Elasticsearch\Search\Searchable;
use Funphp\Elasticsearch\Common\Settings\Settings;

class User
{
    use Searchable;
    
    public function searchableIndex(): string
    {
        return 'index-user';
    }
    
    public function createIndex()
    {
        self::indexCreateBuilder()
            ->setting(Settings::builder()
                ->setting('number_of_shards', 3)
                ->setting('number_of_replicas', 2)
            )->mappings(Mappings::builder()
                ->mappings('properties', [
                    'login_at' => [
                        'type'   => 'date',
                        'format' => 'yyyy-MM-dd HH:mm:ss',
                    ],
                    'name'     => [
                        'type' => 'text',
                    ]
                ]))->create();
    }

}
```

### 删除索引
删除索引非常简单, 只需要调用以下方法即可:

```php
return self::indexDeleteBuilder()->delete();
```

### 新增一个文档

```php
self::documentCreateBuilder()->create([
    'date' => date('Y-m-d H:i:s'),
    'name' => 'test-name',
]);

```
这种方式会随机生成一个`id`, 如果你想指定`id`,可以调用`id($id)`方法:

```php
self::documentCreateBuilder()
    ->id('point-id')
    ->create([
        'date' => date('Y-m-d H:i:s'),
        'name' => 'test-point_id',
    ]);

```

### 删除指定id的文档

```php
return self::documentDeleteBuilder()->delete(6);
```

### 查询文档
#### 根据指定`id`查询
```php
self::documentQueryBuilder()
    ->searchableId('test-id')
    ->search();
```

#### 根据条件查询 

- `term`

```php
self::documentQueryBuilder()
    ->term('order_status', 'create')->search();
```

- `match`

```php
self::documentQueryBuilder()
    ->match('name', '乌拉')
    ->search();
```

- `ids`

```php
self::documentQueryBuilder()
    ->ids([1, 2])
    ->search();
```

- `range`

```php
self::documentQueryBuilder()
    ->range('age', function(RangeBuilder $builder) {
        $builder->gte(12);
    })
    ->search();
```

- `bool`
    - `must`

    ```php
    self::documentQueryBuilder()
        ->bool(function (BoolBuilder $builder) {
            $builder->must(function (Builder $builder) {
                $builder->range('login_at', function (RangeBuilder $builder) {
                   $builder->gte('2020-10-01 00:00:00');
                });
            })->must(function (Builder $builder) {
                $builder->range('age', function (RangeBuilder $builder) {
                   $builder->gte('12')->lte(15);
                });
            });
        })
        ->sortByDesc('age')
        ->search();
    ```

    - `must_not`
    
    ```php
    self::documentQueryBuilder()
        ->bool(function (BoolBuilder $builder) {
            $builder->mustNot(function (Builder $builder) {
                $builder->exists('login_at');
            });
    })
    ->sortByDesc('age')
    ->source(['id', 'name', 'age'])
    ->search();
    ```
    
    - `filter` `should`用法与`must`相同

- `source`
    你可以使用`source` 来指定查询的列

    对于分页查询,你可以使用`from`和`size`方法来实现.

- `scroll` 深度分页

```php
self::documentScrollBuilder()
    ->scroll('5m')
    ->scrollId($scrollId)
    ->search();
```

- `count` 数量查询
```php
self::documentQueryBuilder()
    ->bool(function (BoolBuilder $builder) {
        $builder->mustNot(function (Builder $builder) {
            $builder->exists('login_at');
        });
    })
    ->count();
```

- `aggs` 聚合
```php
use Funphp\Elasticsearch\Document\Builders\Aggregation;

self::documentQueryBuilder()
    ->match('description', $description)
    ->aggs(function (Aggregation $aggregation) {
        $aggregation->count('count', 'id')
            ->max('max', 'id')
            ->sum('sum', 'price');
    })->search();
```

### 修改指定`id`文档的内容

```php
self::documentUpdateBuilder()
    ->id('test-id')
    ->update([
        'date' => date('Y-m-d H:i:s'),
        'name' => 'test-update_point'
    ]);
```

### 删除文档
- 根据`id`删除

```php
self::documentDeleteBuilder()->delete(6);
```