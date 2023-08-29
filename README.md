# PHP Sitemap Generator

## Example Input and Output

### Input:

```php
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
```

### Output:

For the given input, the generated `sitemap.csv` file:

```csv
loc,lastmod,priority,changefreq
https://site.ru/,2020-12-14,1,hourly
https://site.ru/news,2020-12-10,0.5,daily
https://site.ru/about,2020-12-07,0.1,weekly
https://site.ru/products,2020-12-12,0.5,daily
https://site.ru/products/ps5,2020-12-11,0.1,weekly
https://site.ru/products/xbox,2020-12-12,0.1,weekly
https://site.ru/products/wii,2020-12-11,0.1,weekly
```
