<?php

namespace App\Form\Statistic;

use App\Constant\ElasticsearchConstants;
use App\Repository\Filters\Statistics\IndustryFilter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IndustryFilterFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('text', ChoiceType::class, [
                'required' => false,
                'choices' => $this->getIndustries($options['aggregation']),
                'label' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => IndustryFilter::class,
            'aggregation' => []
        ]);
    }

    private function getIndustries(array $aggregation): array
    {
        $industries = [];
        if (isset($aggregation['buckets']) && 0 < count($aggregation['buckets'])) {
            $aggsIndustries = $aggregation['buckets'][0][ElasticsearchConstants::AGGS_INDUSTRY];
            if (isset($aggsIndustries['buckets']) && 0 < count($aggsIndustries['buckets'])) {
                foreach ($aggsIndustries['buckets'] as $bucket) {
                    $industries[$bucket['key'] . ' (' . $bucket['doc_count'] . ')'] = $bucket['key'];
                }
            }
        }

        return $industries;
    }
}
