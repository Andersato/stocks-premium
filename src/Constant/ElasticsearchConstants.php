<?php

declare(strict_types=1);


namespace App\Constant;

final class ElasticsearchConstants
{
    final public const INDEX_NAME = 'statistics_finance';

    //Agregaciones para el filtro de estadísticas
    final public const AGGS_MIN_PERF_WEEK = 'minPerfWeek';
    final public const AGGS_MAX_PERF_WEEK = 'maxPerfWeek';
    final public const AGGS_MIN_PERF_QUARTER = 'minPerfQuarter';
    final public const AGGS_MAX_PERF_QUARTER = 'maxPerfQuarter';
    final public const AGGS_MIN_PERF_MONTH = 'minPerfMonth';
    final public const AGGS_MAX_PERF_MONTH = 'maxPerfMonth';
    final public const AGGS_MIN_PERF_HALF_YEAR = 'minPerfHalfYear';
    final public const AGGS_MAX_PERF_HALF_YEAR = 'maxPerfHalfYear';
    final public const AGGS_MIN_PERF_YEAR = 'minPerfYear';
    final public const AGGS_MAX_PERF_YEAR = 'maxPerfYear';
    final public const AGGS_MIN_PERF_YTD = 'minPerfYtd';
    final public const AGGS_MAX_PERF_YTD = 'maxPerfYtd';
    final public const AGGS_MIN_PRICE = 'minPrice';
    final public const AGGS_MAX_PRICE = 'maxPrice';
    final public const AGGS_MIN_EPS_YY_TTM = 'minEpsYYTtm';
    final public const AGGS_MAX_EPS_YY_TTM = 'maxEpsYYTtm';
    final public const AGGS_MIN_EPS_QQ = 'minEpsQQ';
    final public const AGGS_MAX_EPS_QQ = 'maxEpsQQ';
    final public const AGGS_MIN_SALES_QQ = 'minSalesQQ';
    final public const AGGS_MAX_SALES_QQ = 'maxSalesQQ';
    final public const AGGS_MIN_SALES_YY_TTM = 'minSalesYYTtm';
    final public const AGGS_MAX_SALES_YY_TTM = 'maxSalesYYTtm';
    final public const AGGS_SECTOR = 'sector';
    final public const AGGS_INDUSTRY = 'industry';



}