<?php

declare(strict_types=1);


namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

final class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('slug', [$this, 'slug']),
        ];
    }

    function slug(string $string): string {
        $slug = strtolower($string);

        $slug = preg_replace('/\s+/', '-', $slug);

        $slug = preg_replace('/[^a-z0-9-]/', '', $slug);

        return trim($slug, '-');
    }
}