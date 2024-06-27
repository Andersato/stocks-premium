<?php

namespace App\Form;

use App\Constant\FiltersConstants;
use App\Entity\Stock;
use App\Form\Model\ScreenerFormModel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScreenerFormModelType extends AbstractType
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sector', ChoiceType::class, [
                'choices' => $this->getSectors(),
                'attr' => [
                    'class' => 'select-filter',
                    'data-type' => 'sector'
                ]
            ])
            ->add('marketCap', ChoiceType::class, [
                'choices' => $this->getMarketCaps(),
                'attr' => [
                    'class' => 'select-filter',
                    'data-type' => 'marketCap'
                ]
            ])
            ->add('per', ChoiceType::class, [
                'choices' => $this->getPers(),
                'attr' => [
                    'class' => 'select-filter',
                    'data-type' => 'per'
                ]
            ])
            ->add('high52W', ChoiceType::class, [
                'choices' => $this->getHigh52W(),
                'attr' => [
                    'class' => 'select-filter',
                    'data-type' => 'high52W'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ScreenerFormModel::class,
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
