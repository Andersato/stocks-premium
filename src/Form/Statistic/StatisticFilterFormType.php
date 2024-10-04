<?php

namespace App\Form\Statistic;

use App\Constant\ElasticsearchConstants;
use App\Constant\FiltersConstants;
use App\Entity\Stock;
use App\Repository\Filters\Statistics\PerfQuarterFilter;
use App\Repository\Filters\Statistics\StatisticFilter;
use App\Utils\Utils;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class StatisticFilterFormType extends AbstractType
{
    private TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sector', SectorFilterFormType::class, [
                'label' => $this->translator->trans('form.sector', domain:  'statistic'),
                'aggregation' => $options['aggregations'][ElasticsearchConstants::AGGS_SECTOR]
            ])
            ->add('industry', IndustryFilterFormType::class, [
                'label' => $this->translator->trans('form.industry', domain:  'statistic'),
                'aggregation' => $options['aggregations'][ElasticsearchConstants::AGGS_SECTOR]
            ])
            ->add('price', PriceFilterFormType::class, [
                'min' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MIN_PRICE]),
                'max' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MAX_PRICE]),
                'label' => $this->translator->trans('form.price', domain:  'statistic'),
            ])
            ->add('perfQuarter', PerfQuarterFilterFormType::class, [
                'min' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MIN_PERF_QUARTER]),
                'max' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MAX_PERF_QUARTER]),
                'label' => $this->translator->trans('form.perfQuarter', domain:  'statistic')
            ])
            ->add('perfWeek', PerfWeekFilterFormType::class, [
                'min' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MIN_PERF_WEEK]),
                'max' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MAX_PERF_WEEK]),
                'label' => $this->translator->trans('form.perfWeek', domain:  'statistic')
            ])
            ->add('perfMonth', PerfMonthFilterFormType::class, [
                'min' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MIN_PERF_MONTH]),
                'max' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MAX_PERF_MONTH]),
                'label' => $this->translator->trans('form.perfMonth', domain:  'statistic')
            ])
            ->add('perfHalfYear', PerfHalfYearFilterFormType::class, [
                'min' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MIN_PERF_HALF_YEAR]),
                'max' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MAX_PERF_HALF_YEAR]),
                'label' => $this->translator->trans('form.perfHalfYear', domain:  'statistic')
            ])
            ->add('perfYear', PerfYearFilterFormType::class, [
                'min' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MIN_PERF_YEAR]),
                'max' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MAX_PERF_YEAR]),
                'label' => $this->translator->trans('form.perfYear', domain:  'statistic')
            ])
            ->add('perfYtd', PerfYTdFilterFormType::class, [
                'min' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MIN_PERF_YTD]),
                'max' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MAX_PERF_YTD]),
                'label' => $this->translator->trans('form.perfYtd', domain:  'statistic')
            ])
            ->add('epsQQ', EpsQQFilterFormType::class, [
                'min' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MIN_EPS_QQ]),
                'max' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MAX_EPS_QQ]),
                'label' => $this->translator->trans('form.epsQQ', domain:  'statistic')
            ])
            ->add('epsYYTtm', EpsYYTtmFilterFormType::class, [
                'min' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MIN_EPS_YY_TTM]),
                'max' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MAX_EPS_YY_TTM]),
                'label' => $this->translator->trans('form.epsYYTtm', domain:  'statistic')
            ])
            ->add('salesQQ', SalesQQFilterFormType::class, [
                'min' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MIN_SALES_QQ]),
                'max' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MAX_SALES_QQ]),
                'label' => $this->translator->trans('form.salesQQ', domain:  'statistic')
            ])
            ->add('salesYYTtm', SalesYYTtmFilterFormType::class, [
                'min' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MIN_SALES_YY_TTM]),
                'max' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MAX_SALES_YY_TTM]),
                'label' => $this->translator->trans('form.salesYYTtm', domain:  'statistic')
            ])
            ->add('high52W', High52WFilterFormType::class, [
                'min' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MIN_HIGH_52W]),
                'max' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MAX_HIGH_52W]),
                'label' => $this->translator->trans('form.high52W', domain:  'statistic')
            ])
            ->add('rsi', RsiFilterFormType::class, [
                'min' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MIN_RSI]),
                'max' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MAX_RSI]),
                'label' => $this->translator->trans('form.rsi', domain:  'statistic')
            ])
            ->add('changeVolume', ChangeVolumeFilterFormType::class, [
                'min' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MIN_CHANGE_VOLUME]),
                'max' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MAX_CHANGE_VOLUME]),
                'label' => $this->translator->trans('form.changeVolume', domain:  'statistic')
            ])
            ->add('changeRelativeVolume', ChangeRelativeVolumeFilterFormType::class, [
                'min' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MIN_CHANGE_RELATIVE_VOLUME]),
                'max' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MAX_CHANGE_RELATIVE_VOLUME]),
                'label' => $this->translator->trans('form.changeRelativeVolume', domain:  'statistic')
            ])
            ->add('changeInstOwnWeek', ChangeInstOwnWeekFilterFormType::class, [
                'min' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MIN_CHANGE_INST_OWN_WEEK]),
                'max' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MAX_CHANGE_INST_OWN_WEEK]),
                'label' => $this->translator->trans('form.changeInstOwnWeek', domain:  'statistic')
            ])
            ->add('changeInsiderOwnWeek', ChangeInsiderOwnWeekFilterFormType::class, [
                'min' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MIN_CHANGE_INSIDER_OWN_WEEK]),
                'max' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MAX_CHANGE_INSIDER_OWN_WEEK]),
                'label' => $this->translator->trans('form.changeInsiderOwnWeekChange', domain:  'statistic')
            ])
            ->add('changeShortFloatWeek', ChangeShortFloatWeekFilterFormType::class, [
                'min' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MIN_CHANGE_SHORT_OWN_WEEK]),
                'max' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MAX_CHANGE_SHORT_OWN_WEEK]),
                'label' => $this->translator->trans('form.changeShortFloatWeekChange', domain:  'statistic')
            ])
            ->add('roe', RoeFilterFormType::class, [
                'min' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MIN_ROE]),
                'max' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MAX_ROE]),
                'label' => $this->translator->trans('form.roe', domain:  'statistic')
            ])
            ->add('roi', RoiFilterFormType::class, [
                'min' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MIN_ROI]),
                'max' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MAX_ROI]),
                'label' => $this->translator->trans('form.roi', domain:  'statistic')
            ])
            ->add('roa', RoaFilterFormType::class, [
                'min' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MIN_ROA]),
                'max' => Utils::getFilterAggregationValue($options['aggregations'][ElasticsearchConstants::AGGS_MAX_ROA]),
                'label' => $this->translator->trans('form.roa', domain:  'statistic')
            ])
            ->add('save', SubmitType::class, [
                'label' => $this->translator->trans('form.submit', domain:  'statistic'),
                'attr' => [
                    'class' => 'text-white bg-dark'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => StatisticFilter::class,
            'aggregations' => []
        ]);
    }

    private function getSectors(): array
    {
        $sectors[FiltersConstants::ANY_FILTER] = '';
        $distinctSectors = $this->entityManager->getRepository(Stock::class)->findSectors();
        foreach ($distinctSectors as $item) {
            $sectors[$item['sector']] = $item['sector'];
        }

        return $sectors;
    }

    private function getMarketCaps(): array
    {
        return [
            FiltersConstants::ANY_FILTER => '',
            FiltersConstants::MARKET_CAP_LESS_THAN => FiltersConstants::MARKET_CAP_LESS_THAN,
            FiltersConstants::MARKET_CAP_BETWEEN_300_TO_1000 => FiltersConstants::MARKET_CAP_BETWEEN_300_TO_1000,
            FiltersConstants::MARKET_CAP_BETWEEN_1000_TO_10000 => FiltersConstants::MARKET_CAP_BETWEEN_1000_TO_10000,
            FiltersConstants::MARKET_CAP_BETWEEN_10000_TO_200000 => FiltersConstants::MARKET_CAP_BETWEEN_10000_TO_200000,
            FiltersConstants::MARKET_CAP_MORE_THAN_200000 => FiltersConstants::MARKET_CAP_MORE_THAN_200000,
        ];
    }

    private function getPers(): array
    {
        return [
            FiltersConstants::ANY_FILTER => '',
            FiltersConstants::PER_LESS_THAN_0 => FiltersConstants::PER_LESS_THAN_0,
            FiltersConstants::PER_BETWEEN_0_TO_15 => FiltersConstants::PER_BETWEEN_0_TO_15,
            FiltersConstants::PER_BETWEEN_15_TO_30 => FiltersConstants::PER_BETWEEN_15_TO_30,
            FiltersConstants::PER_MOTE_THAN_30 => FiltersConstants::PER_MOTE_THAN_30,
        ];
    }

    private function getHigh52W(): array
    {
        return [
            FiltersConstants::ANY_FILTER => '',
            FiltersConstants::RANGE_52W_MORE_THAN_10 => FiltersConstants::RANGE_52W_MORE_THAN_10,
            FiltersConstants::RANGE_52W_BETWEEN_5_TO_10 => FiltersConstants::RANGE_52W_BETWEEN_5_TO_10,
            FiltersConstants::RANGE_52W_BETWEEN_0_TO_5 => FiltersConstants::RANGE_52W_BETWEEN_0_TO_5,
            FiltersConstants::RANGE_52W_BETWEEN_0_TO_MINUS_5 => FiltersConstants::RANGE_52W_BETWEEN_0_TO_MINUS_5,
            FiltersConstants::RANGE_52W_BETWEEN_MINUS_5_TO_MINUS_10 => FiltersConstants::RANGE_52W_BETWEEN_MINUS_5_TO_MINUS_10,
            FiltersConstants::RANGE_52W_BETWEEN_MINUS_10_TO_MINUS_15 => FiltersConstants::RANGE_52W_BETWEEN_MINUS_10_TO_MINUS_15,
            FiltersConstants::RANGE_52W_BETWEEN_LESS_MINUS_15 => FiltersConstants::RANGE_52W_BETWEEN_LESS_MINUS_15,
        ];
    }

//    private function getIndustries(): array
//    {
//        $sectors = [];
//        $distinctSectors = $this->entityManager->getRepository(Stock::class)->findIndustries();
//        foreach ($distinctSectors as $item) {
//            $sectors[$item['sector']] = $item['sector'];
//        }
//
//        return $sectors;
//    }
}
