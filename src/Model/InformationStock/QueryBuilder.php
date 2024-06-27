<?php

declare(strict_types=1);


namespace App\Model\InformationStock;

class QueryBuilder {
    private array $query = [];

    public function match($field, $value): self {
        $this->query[ParamsElasticSearch::QUERY][ParamsElasticSearch::MATCH][$field] = $value;
        return $this;
    }

    public function term($field, $value): self {
        $this->query[ParamsElasticSearch::QUERY][ParamsElasticSearch::TERM][$field] = $value;
        return $this;
    }

    public function range($field, $options): self {
        $this->query[ParamsElasticSearch::QUERY][ParamsElasticSearch::RANGE][$field] = $options;
        return $this;
    }

    public function bool($type, $queries): self {
        $this->query[ParamsElasticSearch::QUERY][ParamsElasticSearch::BOOL][$type] = $queries;
        return $this;
    }

    public function sort($field, $order): self {
        $this->query[ParamsElasticSearch::SORT][] = [$field => $order];
        return $this;
    }

    public function from($from): self {
        $this->query[ParamsElasticSearch::FROM] = $from;
        return $this;
    }

    public function size($size): self {
        $this->query[ParamsElasticSearch::SIZE] = $size;
        return $this;
    }

    public function aggregation($name, $type, $field, $options = []): self {
        $this->query[ParamsElasticSearch::AGGS][$name][$type] = array_merge([ParamsElasticSearch::FIELD => $field], $options);
        return $this;
    }

    public function build(): array {
        return $this->query;
    }
}