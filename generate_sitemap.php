<?php

require 'vendor/autoload.php';

use Nazen\Sitemap\SitemapGenerator;
use Nazen\Sitemap\InvalidInitializationData;
use Nazen\Sitemap\FileAccessError;

$pages = [
    [
        'loc' => 'https://site.ru/',
        'lastmod' => '2020-12-14',
        'priority' => 1,
        'changefreq' => 'hourly'
    ],
    [
        'loc' => 'https://site.ru/news',
        'lastmod' => '2020-12-10',
        'priority' => 0.5,
        'changefreq' => 'daily'
    ],
    [
        'loc' => 'https://site.ru/about',
        'lastmod' => '2020-12-07',
        'priority' => 0.1,
        'changefreq' => 'weekly'
    ],
    [
        'loc' => 'https://site.ru/products',
        'lastmod' => '2020-12-12',
        'priority' => 0.5,
        'changefreq' => 'daily'
    ],
    [
        'loc' => 'https://site.ru/products/ps5',
        'lastmod' => '2020-12-11',
        'priority' => 0.1,
        'changefreq' => 'weekly'
    ],
    [
        'loc' => 'https://site.ru/products/xbox',
        'lastmod' => '2020-12-12',
        'priority' => 0.1,
        'changefreq' => 'weekly'
    ],
    [
        'loc' => 'https://site.ru/products/wii',
        'lastmod' => '2020-12-11',
        'priority' => 0.1,
        'changefreq' => 'weekly'
    ]
];

$format = 'csv'; // xml, csv, or json
$filePath = __DIR__ . '/sitemap.' . $format;

$sitemap = new SitemapGenerator($pages, $format, $filePath);

try {
    $sitemap->generate();
    echo "Sitemap generated successfully!";
} catch (InvalidInitializationData $e) {
    echo "Invalid data provided during initialization: " . $e->getMessage();
} catch (FileAccessError $e) {
    echo "Error accessing the file: " . $e->getMessage();
}
