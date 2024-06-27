<?php

namespace App\Model\InformationItem;

use Symfony\Component\DomCrawler\Crawler;

interface InformationTypeInterface
{
    public function getValue(): ?string;
    public function getType(): string;
    public function getName(): string;
}