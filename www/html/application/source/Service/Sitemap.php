<?php

namespace Service;

class Sitemap
{
    public static function process(\stdClass $data): \stdClass
    {   
        /*error_reporting(E_ALL);
        ini_set('display_errors', 'On');*/

        // setting up the xml
        $xml = new DomDocument('1.0', 'utf-8');
        $xml->preserveWhiteSpace = false;
        $xml->formatOutput = true;

        // creating base node
        $urlset = $xml->createElement('urlset');
        $urlset->appendChild(
            new DomAttr('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9')
        );

        // appending urlset node
        $xml->appendChild($urlset);

        /* Para solucionar probleas de links pode criar um sistema de encurtação de links */
        $entries = [
            [
                'permalink' => 'https://capedac.org',
                'lastmod' => date('c', time()), // format is YYYY-MM-DDThh:mmTZD
                'changefreq' => 'monthly',
                'priority' => '1.0' // 0.1-1.0
            ],
            [
                'permalink' => 'https://capedac.org/historia',
                'lastmod' => date('c', time()),
                'changefreq' => 'monthly',
                'priority' => '0.5'
            ],
            [
                'permalink' => 'https://capedac.org/estatuto',
                'lastmod' => date('c', time()),
                'changefreq' => 'monthly',
                'priority' => '1.0'
            ],
            [
                'permalink' => 'https://capedac.org/denuncia',
                'lastmod' => date('c', time()),
                'changefreq' => 'monthly',
                'priority' => '1.0'
            ],
            [
                'permalink' => 'https://capedac.org/biblioteca',
                'lastmod' => date('c', time()),
                'changefreq' => 'monthly',
                'priority' => '1.0'
            ],
            [
                'permalink' => 'https://capedac.org/projetos',
                'lastmod' => date('c', time()),
                'changefreq' => 'monthly',
                'priority' => '0.2'
            ],
            [
                'permalink' => 'https://capedac.org/cadastro',
                'lastmod' => date('c', time()),
                'changefreq' => 'monthly',
                'priority' => '0.5'
            ],
            [
                'permalink' => 'https://capedac.org/mensalidade',
                'lastmod' => date('c', time()),
                'changefreq' => 'monthly',
                'priority' => '0.1'
            ],
            [
                'permalink' => 'https://capedac.org/voluntario',
                'lastmod' => date('c', time()),
                'changefreq' => 'monthly',
                'priority' => '0.5'
            ],
            [
                'permalink' => 'https://capedac.org/contato',
                'lastmod' => date('c', time()),
                'changefreq' => 'monthly',
                'priority' => '0.1'
            ],
            [
                'permalink' => 'https://capedac.org/doacao',
                'lastmod' => date('c', time()),
                'changefreq' => 'monthly',
                'priority' => '1.0'
            ],
            [
                'permalink' => 'https://capedac.org/contato',
                'lastmod' => date('c', time()),
                'changefreq' => 'monthly',
                'priority' => '0.1'
            ],
            [
                'permalink' => 'https://capedac.org/transparencia',
                'lastmod' => date('c', time()),
                'changefreq' => 'monthly',
                'priority' => '0.5'
            ],
            [
                'permalink' => 'https://capedac.org/parceiros',
                'lastmod' => date('c', time()),
                'changefreq' => 'monthly',
                'priority' => '0.3'
            ],
            [
                'permalink' => 'https://capedac.org/depoimentos',
                'lastmod' => date('c', time()),
                'changefreq' => 'monthly',
                'priority' => '0.2'
            ],
            [
                'permalink' => 'https://capedac.org/protecao',
                'lastmod' => date('c', time()),
                'changefreq' => 'monthly',
                'priority' => '0.7'
            ]
        ];

        // appending content to xml-document
        foreach ($entries as $key => $value) {
            // declaring variables for content
            $permalink = $value['permalink'];
            $lastmod = $value['lastmod'];
            $changefreq = $value['changefreq'];
            $priority = $value['priority'];
            // creating single url node
            $url = $xml->createElement('url');
            // filling node with entry info
            $url->appendChild($xml->createElement('loc', $permalink));
            $url->appendChild($xml->createElement('lastmod', $lastmod));
            $url->appendChild($xml->createElement('changefreq', $changefreq));
            $url->appendChild($xml->createElement('priority', $priority));
            // appending url to urlset node
            $urlset->appendChild($url);
        }
        // $xml->save('test.xml');

        header('Content-Type: text/xml');

        echo $xml->saveXML();

    }
}