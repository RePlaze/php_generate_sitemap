<?php

namespace Nazen\Sitemap;

class SitemapGenerator
{
    private $pages = [];
    private $format;
    private $filePath;

    public function __construct(array $pages, string $format, string $filePath)
    {
        $this->validateFormat($format);
        $this->pages = $pages;
        $this->format = $format;
        $this->filePath = $filePath;
    }

    public function generate()
    {
        $this->validateDirectory();
        $data = $this->generateSitemapData();

        try {
            switch ($this->format) {
                case 'xml':
                    $this->generateXmlSitemap($data);
                    break;
                case 'csv':
                    $this->generateCsvSitemap($data);
                    break;
                case 'json':
                    $this->generateJsonSitemap($data);
                    break;
            }
        } catch (\Exception $e) {
            throw new FileAccessError("Error accessing the file: " . $e->getMessage());
        }
    }

    private function validateFormat($format)
    {
        if (!in_array($format, ['xml', 'csv', 'json'])) {
            throw new InvalidInitializationData("Invalid format specified");
        }
    }

    private function validateDirectory()
    {
        if (!file_exists(dirname($this->filePath))) {
            mkdir(dirname($this->filePath), 0777, true);
        }
    }

    private function generateSitemapData()
    {
        // You should implement your logic to generate sitemap data here based on $this->pages
        return $this->pages;
    }

    private function generateXmlSitemap($data)
    {
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');

        foreach ($data as $page) {
            $url = $xml->addChild('url');
            $url->addChild('loc', $page['loc']);
            $url->addChild('lastmod', $page['lastmod']);
            $url->addChild('priority', $page['priority']);
            $url->addChild('changefreq', $page['changefreq']);
        }

        $xml->asXML($this->filePath);
    }

    private function generateCsvSitemap($data)
    {
        $file = fopen($this->filePath, 'w');

        fputcsv($file, ['loc', 'lastmod', 'priority', 'changefreq']);

        foreach ($data as $page) {
            fputcsv($file, [$page['loc'], $page['lastmod'], $page['priority'], $page['changefreq']]);
        }

        fclose($file);
    }

    private function generateJsonSitemap($data)
    {
        file_put_contents($this->filePath, json_encode($data, JSON_PRETTY_PRINT));
    }
}
