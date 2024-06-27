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
}