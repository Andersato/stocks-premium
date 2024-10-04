<?php

declare(strict_types=1);


namespace App\Model\InformationStock;

final class ParamsElasticSearch
{
    final public const QUERY = 'query';
    final public const MATCH = 'match';
    final public const TERM = 'term';
    final public const TERMS = 'terms';
    final public const RANGE = 'range';
    final public const BOOL = 'bool';
    final public const MUST = 'must';
    final public const SORT = 'sort';
    final public const TO = 'to';
    final public const FROM = 'from';
    final public const SIZE = 'size';
    final public const AGGS = 'aggs';
    final public const FIELD = 'field';
    final public const RANGES = 'ranges';
    final public const GT = 'gt';
    final public const GTE = 'gte';
    final public const LT = 'lt';
    final public const LTE = 'lte';
    final public const TOP_DOCS = 'top_docs';
    final public const TOP_HITS = 'top_hits';
    final public const HITS = 'hits';
    final public const SOURCE = '_source';
    final public const ORDER = 'order';
    final public const ASC = 'asc';
    final public const DESC = 'desc';
    final public const MAX = 'max';
    final public const MIN = 'min';
    final public const AGGREGATIONS = 'aggregations';
    final public const BUCKETS = 'buckets';
    final public const KEY = 'key';
    final public const DOC_COUNT = 'doc_count';
}