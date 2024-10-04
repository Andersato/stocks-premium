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
    final public const AGGS_MIN_CHANGE_VOLUME = 'minChangeVolume';
    final public const AGGS_MAX_CHANGE_VOLUME = 'maxChangeVolume';
    final public const AGGS_MIN_CHANGE_RELATIVE_VOLUME = 'minChangeRelativeVolume';
    final public const AGGS_MAX_CHANGE_RELATIVE_VOLUME = 'maxChangeRelativeVolume';
    final public const AGGS_MIN_CHANGE_INST_OWN_WEEK = 'minChangeInstOwnWeek';
    final public const AGGS_MAX_CHANGE_INST_OWN_WEEK = 'maxChangeInstOwnWeek';
    final public const AGGS_MIN_CHANGE_INSIDER_OWN_WEEK = 'minChangeInsiderOwnWeek';
    final public const AGGS_MAX_CHANGE_INSIDER_OWN_WEEK = 'maxChangeInsiderOwnWeek';
    final public const AGGS_MIN_CHANGE_SHORT_OWN_WEEK = 'minChangeShortFloatWeek';
    final public const AGGS_MAX_CHANGE_SHORT_OWN_WEEK = 'maxChangeShortFloatWeek';
    final public const AGGS_MIN_HIGH_52W = 'minHigh52W';
    final public const AGGS_MAX_HIGH_52W = 'maxHigh52W';
    final public const AGGS_MIN_RSI = 'minRsi';
    final public const AGGS_MAX_RSI = 'maxRsi';
    final public const AGGS_SECTOR = 'sector';
    final public const AGGS_INDUSTRY = 'industry';
    final public const AGGS_MARKETCAP_RANGES = 'marketcapRanges';
    final public const AGGS_MIN_ROE = 'minRoe';
    final public const AGGS_MAX_ROE = 'maxRoe';
    final public const AGGS_MIN_ROA = 'minRoa';
    final public const AGGS_MAX_ROA = 'maxRoa';
    final public const AGGS_MIN_ROI = 'minRoi';
    final public const AGGS_MAX_ROI = 'maxRoi';

    final public const AGGS_RANGE_300 = 300;
    final public const AGGS_RANGE_1000 = 1000;
    final public const AGGS_RANGE_10000 = 10000;
    final public const AGGS_RANGE_200000 = 200000;
    
    final public const FIELD_TICKER = 'ticker';
    final public const FIELD_NAME = 'name';
    final public const FIELD_PRICE = 'price';
    final public const FIELD_SECTOR = 'sector';
    final public const FIELD_INDUSTRY = 'industry';
    final public const FIELD_MARKET_CAP = 'marketCap';
    final public const FIELD_CHANGE_VOLUME = 'changeVolume';
    final public const FIELD_CHANGE_RELATIVE_VOLUME = 'changeRelativeVolume';
    final public const FIELD_CHANGE_INST_OWN = 'ChangeInstOwn';
    final public const FIELD_CHANGE_INST_OWN_WEEK = 'changeInstOwnWeek';
    final public const FIELD_CHANGE_INSIDER_OWN = 'changeInsiderOwn';
    final public const FIELD_CHANGE_INSIDER_OWN_WEEK = 'changeInsiderOwnWeek';
    final public const FIELD_CHANGE_SHORT_FLOAT = 'changeShortFloat';
    final public const FIELD_CHANGE_SHORT_FLOAT_WEEK = 'changeShortFloatWeek';
    final public const FIELD_CHANGE_PRICE = 'changePrice';
    final public const FIELD_PERF_WEEK = 'perfWeek';
    final public const FIELD_PERF_MONTH = 'perfMonth';
    final public const FIELD_PERF_QUARTER = 'perfQuarter';
    final public const FIELD_PERF_HALF_YEAR = 'perfHalfYear';
    final public const FIELD_PERF_YEAR = 'perfYear';
    final public const FIELD_PERF_YTD = 'perfYtd';
    final public const FIELD_HIGH_52W = 'high52W';
    final public const FIELD_EPS_YY_TTM = 'epsYYTtm';
    final public const FIELD_EPS_QQ = 'epsQQ';
    final public const FIELD_SALES_YY_TTM = 'salesYYTtm';
    final public const FIELD_SALES_QQ = 'salesQQ';
    final public const FIELD_RSI = 'rsi';
    final public const FIELD_VOLUME = 'volume';
    final public const FIELD_AVG_VOLUME = 'avgVolume';

    final public const FIELD_ROE = 'roe';
    final public const FIELD_ROI = 'roi';
    final public const FIELD_ROA = 'roa';
}