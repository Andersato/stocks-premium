<?php

namespace App\Form\Statistic;

use App\Constant\FiltersConstants;
use App\Entity\Stock;
use App\Repository\Filters\Statistics\PerfQuarterFilter;
use App\Repository\Filters\Statistics\StatisticFilter;
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
                'label' => $this->translator->trans('form.sector', domain:  'statistic')
            ])
            ->add('industry', IndustryFilterFormType::class, [
                'label' => $this->translator->trans('form.industry', domain:  'statistic')
            ])
            ->add('price', PriceFilterFormType::class, [
                'label' => $this->translator->trans('form.price', domain:  'statistic')
            ])
            ->add('perfQuarter', PerfQuarterFilterFormType::class, [
                'label' => $this->translator->trans('form.perfQuarter', domain:  'statistic')
            ])
            ->add('perfWeek', PerfWeekFilterFormType::class, [
                'label' => $this->translator->trans('form.perfWeek', domain:  'statistic')
            ])
            ->add('perfMonth', PerfMonthFilterFormType::class, [
                'label' => $this->translator->trans('form.perfMonth', domain:  'statistic')
            ])
            ->add('perfHalfYear', PerfHalfYearFilterFormType::class, [
                'label' => $this->translator->trans('form.perfHalfYear', domain:  'statistic')
            ])
            ->add('perfYear', PerfYearFilterFormType::class, [
                'label' => $this->translator->trans('form.perfYear', domain:  'statistic')
            ])
            ->add('perfYtd', PerfYTdFilterFormType::class, [
                'label' => $this->translator->trans('form.perfYtd', domain:  'statistic')
            ])
            ->add('epsQQ', EpsQQFilterFormType::class, [
                'label' => $this->translator->trans('form.epsQQ', domain:  'statistic')
            ])
            ->add('epsYYTtm', EpsYYTtmFilterFormType::class, [
                'label' => $this->translator->trans('form.epsYYTtm', domain:  'statistic')
            ])
            ->add('salesQQ', SalesQQFilterFormType::class, [
                'label' => $this->translator->trans('form.salesQQ', domain:  'statistic')
            ])
            ->add('salesYYTtm', SalesYYTtmFilterFormType::class, [
                'label' => $this->translator->trans('form.salesYYTtm', domain:  'statistic')
            ])
            ->add('high52W', High52WFilterFormType::class, [
                'label' => $this->translator->trans('form.high52W', domain:  'statistic')
            ])
            ->add('rsi', RsiFilterFormType::class, [
                'label' => $this->translator->trans('form.rsi', domain:  'statistic')
            ])
            ->add('changeVolume', ChangeVolumeFilterFormType::class, [
                'label' => $this->translator->trans('form.changeVolume', domain:  'statistic')
            ])
            ->add('changeRelativeVolume', ChangeRelativeVolumeFilterFormType::class, [
                'label' => $this->translator->trans('form.changeRelativeVolume', domain:  'statistic')
            ])
            ->add('changeInstOwnWeek', ChangeInstOwnWeekFilterFormType::class, [
                'label' => $this->translator->trans('form.changeInstOwnWeek', domain:  'statistic')
            ])
            ->add('changeInsiderOwnWeek', ChangeInsiderOwnWeekFilterFormType::class, [
                'label' => $this->translator->trans('form.changeInsiderOwnWeekChange', domain:  'statistic')
            ])
            ->add('changeShortFloatWeek', ChangeShortFloatWeekFilterFormType::class, [
                'label' => $this->translator->trans('form.changeShortFloatWeekChange', domain:  'statistic')
            ])
            ->add('save', SubmitType::class, [
                'label' => $this->translator->trans('form.submit', domain:  'statistic'),
                'attr' => [
                    'class' => 'text-white bg-dark'
                ]
            ]);

//        $builder
//            ->add('sector', ChoiceType::class, [
//                'choices' => $this->getSectors(),
//                'attr' => [
//                    'class' => 'select-filter',
//                    'data-type' => 'sector'
//                ]
//            ])
//            ->add('marketCap', ChoiceType::class, [
//                'choices' => $this->getMarketCaps(),
//                'attr' => [
//                    'class' => 'select-filter',
//                    'data-type' => 'marketCap'
//                ]
//            ])
//            ->add('per', ChoiceType::class, [
//                'choices' => $this->getPers(),
//                'attr' => [
//                    'class' => 'select-filter',
//                    'data-type' => 'per'
//                ]
//            ])
//            ->add('high52W', ChoiceType::class, [
//                'choices' => $this->getHigh52W(),
//                'attr' => [
//                    'class' => 'select-filter',
//                    'data-type' => 'high52W'
//                ]
//            ])
//        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => StatisticFilter::class,
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
