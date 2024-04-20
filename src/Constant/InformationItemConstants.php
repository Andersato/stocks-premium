<?php

namespace App\Constant;

final class InformationItemConstants
{
    final public const STRING_TYPE = 'string';
    final public const QUANTITY_TYPE = 'quantity';
    final public const PERCENTAGE_TYPE = 'percentage';
    final public const DATE_TYPE = 'date';
    final public const RATIO_TYPE = 'ratio';
    final public const RANGE_TYPE = 'range';
    final public const VOLUME_TYPE = 'volume';
    final public const VOLATILITY_TYPE = 'volatility';
    final public const FLOAT_TYPE = 'float';


    final public const INDEX = 'Index';
    final public const MARKET_CAP = 'Market Cap';
    final public const INCOME = 'Income';
    final public const SALES = 'Sales';
    final public const BOOK_SH = 'Book/sh';
    final public const CASH_SH = 'Cash/sh';
    final public const DIVIDEND_EST = 'Dividend Est.';
    final public const DIVIDEND_TTM = 'Dividend TTM';
    final public const DIVIDEND_EX_DATE = 'Dividend Ex-Date';
    final public const EMPLOYEES = 'Employees';
    final public const OPTION_SHORT = 'Option/Short';
    final public const SALES_SURPRISE = 'Sales Surprise';
    final public const SMA20 = 'SMA20';
    final public const PER = 'P/E';
    final public const FORWARD_PER = 'Forward P/E';
    final public const PEG = 'PEG';
    final public const PRICE_SALES = 'P/S';
    final public const PRICE_BOOK = 'P/B';
    final public const PRICE_CASH = 'P/C';
    final public const PRICE_FREE_CASH_FLOW = 'P/FCF';
    final public const QUICK_RATIO = 'Quick Ratio';
    final public const CURRENT_RATIO = 'Current Ratio';
    final public const DEBT_EQUITY = 'Debt/Eq';
    final public const LT_DEBT_EQUITY = 'LT Debt/Eq';
    final public const EPS_SURPRISE = 'EPS Surprise';
    final public const SMA50 = 'SMA50';
    final public const EPS_TTM = 'EPS (ttm)';
    final public const EPS_NEXT_YEAR = 'EPS next Y';
    final public const EPS_NEXT_QUARTER = 'EPS next Q';
    final public const EPS_THIS_YEAR = 'EPS this Y';
    final public const EPS_NEXT_G_YEAR = 'EPS next YY';
    final public const EPS_NEXT_5YEAR = 'EPS next 5Y';
    final public const EPS_PAST_5YEAR = 'EPS past 5Y';
    final public const SALES_PAST_5YEAR = 'Sales past 5Y';
    final public const EPS_Y_Y_TTM = 'EPS Y/Y TTM';
    final public const SALES_Y_Y_TTM = 'Sales Y/Y TTM';
    final public const EPS_Q_Q = 'EPS Q/Q';
    final public const SALES_Q_Q = 'Sales Q/Q';
    final public const SMA200 = 'SMA200';
    final public const INSIDER_OWN = 'Insider Own';
    final public const INSIDER_TRANS = 'Insider Trans';
    final public const INST_OWN = 'Inst Own';
    final public const INST_TRANS = 'Inst Trans';
    final public const ROA = 'ROA';
    final public const ROE = 'ROE';
    final public const ROI = 'ROI';
    final public const GROSS_MARGIN = 'Gross Margin';
    final public const OPER_MARGIN = 'Oper. Margin';
    final public const PROFIT_MARGIN = 'Profit Margin';
    final public const PAYOUT = 'Payout';
    final public const EARNINGS = 'Earnings';
    final public const SHS_OUTSTAND = 'Shs Outstand';
    final public const SHS_FLOAT = 'Shs Float';
    final public const SHORT_FLOAT = 'Short Float';
    final public const SHORT_RATIO = 'Short Ratio';
    final public const SHORT_INTEREST = 'Short Interest';
    final public const RANGE_52W = '52W Range';
    final public const HIGH_52W = '52W High';
    final public const LOW_52W = '52W Low';
    final public const RSI_14 = 'RSI (14)';
    final public const RECOM = 'Recom';
    final public const REL_VOLUME = 'Rel Volume';
    final public const AVG_VOLUME = 'Avg Volume';
    final public const VOLUME = 'Volume';
    final public const PERF_WEEK = 'Perf Week';
    final public const PERF_MONTH = 'Perf Month';
    final public const PERF_QUARTER = 'Perf Quarter';
    final public const PERF_HALF_YEAR = 'Perf Half Y';
    final public const PERF_YEAR = 'Perf Year';
    final public const PERF_YTD = 'Perf YTD';
    final public const BETA = 'Beta';
    final public const ATR_14 = 'ATR (14)';
    final public const VOLATILITY = 'Volatility';
    final public const TARGET_PRICE = 'Target Price';
    final public const PREV_CLOSE = 'Prev Close';
    final public const PRICE = 'Price';
    final public const CHANGE = 'Change';

    final public const ITEM_TYPES = [
        self::DATE_TYPE,
        self::FLOAT_TYPE,
        self::PERCENTAGE_TYPE,
        self::RANGE_TYPE,
        self::QUANTITY_TYPE,
        self::RATIO_TYPE,
        self::STRING_TYPE,
        self::VOLATILITY_TYPE,
        self::VOLUME_TYPE
    ];

    final public const STRING_ATTRIBUTES = [
        self::INDEX,
        self::OPTION_SHORT,
    ];

    final public const PERCENTAGE_ATTRIBUTES = [
        self::SALES_SURPRISE,
        self::SMA20,
        self::SMA50,
        self::SMA200,
        self::EPS_SURPRISE,
        self::EPS_THIS_YEAR,
        self::EPS_PAST_5YEAR,
        self::EPS_NEXT_G_YEAR,
        self::EPS_NEXT_5YEAR,
        self::SALES_PAST_5YEAR,
        self::EPS_Y_Y_TTM,
        self::SALES_Y_Y_TTM,
        self::EPS_Q_Q,
        self::SALES_Q_Q,
        self::INSIDER_OWN,
        self::INSIDER_TRANS,
        self::INST_OWN,
        self::INST_TRANS,
        self::ROA,
        self::ROE,
        self::ROI,
        self::GROSS_MARGIN,
        self::OPER_MARGIN,
        self::PROFIT_MARGIN,
        self::PAYOUT,
        self::SHORT_FLOAT,
        self::HIGH_52W,
        self::LOW_52W,
        self::PERF_WEEK,
        self::PERF_MONTH,
        self::PERF_QUARTER,
        self::PERF_HALF_YEAR,
        self::PERF_YEAR,
        self::PERF_YTD,
        self::CHANGE
    ];

    final public const QUANTITY_ATTRIBUTES = [
        self::MARKET_CAP,
        self::INCOME,
        self::SALES,
        self::SHS_OUTSTAND,
        self::SHS_FLOAT,
        self::SHORT_INTEREST,
        self::AVG_VOLUME
    ];

    final public const RATIO_ATTRIBUTES = [
        self::BOOK_SH,
        self::CASH_SH,
        self::PER,
        self::FORWARD_PER,
        self::PEG,
        self::PRICE_SALES,
        self::PRICE_BOOK,
        self::PRICE_CASH,
        self::PRICE_FREE_CASH_FLOW,
        self::QUICK_RATIO,
        self::CURRENT_RATIO,
        self::DEBT_EQUITY,
        self::LT_DEBT_EQUITY,
        self::SHORT_RATIO,
        self::RSI_14,
        self::RECOM,
        self::REL_VOLUME,
        self::BETA,
        self::ATR_14
    ];

    final public const FLOAT_ATTRIBUTES = [
        self::DIVIDEND_EST,
        self::DIVIDEND_TTM,
        self::EPS_TTM,
        self::EPS_NEXT_YEAR,
        self::EPS_NEXT_QUARTER,
        self::TARGET_PRICE,
        self::PREV_CLOSE,
        self::PRICE
    ];

    final public const DATE_ATTRIBUTES = [
        self::DIVIDEND_EX_DATE,
        self::EARNINGS
    ];

    final public const RANGE_ATTRIBUTES = [
        self::RANGE_52W
    ];

    final public const VOLATILITY_ATTRIBUTES = [
        self::VOLATILITY
    ];

    final public const VOLUME_ATTRIBUTES = [
        self::VOLUME,
        self::EMPLOYEES
    ];
}