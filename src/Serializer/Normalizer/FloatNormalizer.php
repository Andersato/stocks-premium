<?php

declare(strict_types=1);


namespace App\Serializer\Normalizer;

use App\Repository\Filters\Statistics\ChangeInsiderOwnWeekFilter;
use App\Repository\Filters\Statistics\ChangeInstOwnWeekFilter;
use App\Repository\Filters\Statistics\ChangeRelativeVolumeFilter;
use App\Repository\Filters\Statistics\ChangeShortFloatWeekFilter;
use App\Repository\Filters\Statistics\ChangeVolumeFilter;
use App\Repository\Filters\Statistics\EpsQQFilter;
use App\Repository\Filters\Statistics\EpsYYTtmFilter;
use App\Repository\Filters\Statistics\High52WFilter;
use App\Repository\Filters\Statistics\PerfHalfYearFilter;
use App\Repository\Filters\Statistics\PerfMonthFilter;
use App\Repository\Filters\Statistics\PerfQuarterFilter;
use App\Repository\Filters\Statistics\PerfWeekFilter;
use App\Repository\Filters\Statistics\PerfYearFilter;
use App\Repository\Filters\Statistics\PerfYtdFilter;
use App\Repository\Filters\Statistics\PriceFilter;
use App\Repository\Filters\Statistics\RangeFilter;
use App\Repository\Filters\Statistics\RsiFilter;
use App\Repository\Filters\Statistics\SalesQQFilter;
use App\Repository\Filters\Statistics\SalesYYTtmFilter;
use App\Repository\Filters\Statistics\StatisticFilterInterface;
use App\Repository\Filters\Statistics\TestInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * @method array getSupportedTypes(?string $format)
 */
final class FloatNormalizer implements DenormalizerInterface, NormalizerInterface
{

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {

        if (isset($data['minValue'])) {
            $data['minValue'] = !empty($data['minValue']) ? (float) $data['minValue'] : null;
        }

        if (isset($data['maxValue'])) {
            $data['maxValue'] = !empty($data['maxValue']) ? (float) $data['maxValue'] : null;
        }

        $object = new $type($data);
        $object->minValue = $data['minValue'];
        $object->maxValue = $data['maxValue'];

        return $object;
    }

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null): bool
    {
        return in_array($type, [
            ChangeInsiderOwnWeekFilter::class,
            ChangeInstOwnWeekFilter::class,
            ChangeRelativeVolumeFilter::class,
            ChangeShortFloatWeekFilter::class,
            ChangeVolumeFilter::class,
            EpsQQFilter::class,
            EpsYYTtmFilter::class,
            High52WFilter::class,
            PerfHalfYearFilter::class,
            PerfMonthFilter::class,
            PerfQuarterFilter::class,
            PerfWeekFilter::class,
            PerfYearFilter::class,
            PerfYtdFilter::class,
            PriceFilter::class,
            RsiFilter::class,
            SalesQQFilter::class,
            SalesYYTtmFilter::class
        ]);
    }

    public function __call(string $name, array $arguments)
    {
        return [
            ChangeInsiderOwnWeekFilter::class => true,
            ChangeInstOwnWeekFilter::class => true,
            ChangeRelativeVolumeFilter::class => true,
            ChangeShortFloatWeekFilter::class => true,
            ChangeVolumeFilter::class => true,
            EpsQQFilter::class => true,
            EpsYYTtmFilter::class => true,
            High52WFilter::class => true,
            PerfHalfYearFilter::class => true,
            PerfMonthFilter::class => true,
            PerfQuarterFilter::class => true,
            PerfWeekFilter::class => true,
            PerfYearFilter::class => true,
            PerfYtdFilter::class => true,
            PriceFilter::class => true,
            RsiFilter::class => true,
            SalesQQFilter::class => true,
            SalesYYTtmFilter::class => true,
        ];
    }

    public function normalize(mixed $object, ?string $format = null, array $context = [])
    {
        // TODO: Implement normalize() method.
    }

    public function supportsNormalization(mixed $data, ?string $format = null)
    {
        // TODO: Implement supportsNormalization() method.
    }
}