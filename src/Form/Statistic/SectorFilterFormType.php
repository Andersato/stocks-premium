<?php

namespace App\Form\Statistic;

use App\Repository\Filters\Statistics\PriceFilter;
use App\Repository\Filters\Statistics\SectorFilter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SectorFilterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('text', ChoiceType::class, [
                'required' => false,
                'choices' => $this->getSectors($options['aggregation']),
                'label' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SectorFilter::class,
            'aggregation' => []
        ]);
    }

    private function getSectors(array $aggregation): array
    {
        $sectors = [];
        if (isset($aggregation['buckets']) && 0 < count($aggregation['buckets'])) {
            foreach ($aggregation['buckets'] as $bucket) {
                $sectors[$bucket['key'].' ('.$bucket['doc_count'].')'] = $bucket['key'];
            }
        }

        return $sectors;
    }
}
