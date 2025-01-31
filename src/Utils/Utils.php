<?php

namespace App\Utils;

use Symfony\Component\DomCrawler\Crawler;

final class Utils
{
    public static function getDate(string $date): \DateTimeInterface
    {
        preg_match('/\b(?:Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\s+\d{1,2}\b/', $date, $matches);

        $currentDate = new \DateTime();
        $date = $matches[0].', '.$currentDate->format('Y');

        return \DateTime::createFromFormat('M d, Y', $date);
    }

    public static function getFilterAggregationValue(array $data): int
    {
        return intval($data['value']);
    }

    public static function getSlug(string $value): string
    {
        $slug = mb_strtolower(preg_replace('/([a-z\d])([A-Z])/', '$1_$2', $value), 'UTF-8');

        // Reemplazar caracteres especiales con sus equivalentes en ASCII
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $slug);

        // Eliminar cualquier carácter que no sea una letra, número o espacio
        $slug = preg_replace('/[^a-z0-9_\s-]/', '', $slug);

        // Reemplazar espacios y guiones múltiples por un solo guion
        $slug = preg_replace('/[\s-]+/', '-', $slug);

        // Eliminar guiones al inicio y final
        return trim($slug, '-');
    }

    public static function translateEnglishToSpanishValue(string $value): string
    {
        $value = str_replace(' ', '', $value);

        return lcfirst($value);
    }
}