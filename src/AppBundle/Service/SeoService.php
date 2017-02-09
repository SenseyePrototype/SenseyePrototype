<?php

namespace AppBundle\Service;

class SeoService
{
    public function getByCityAlias($alias)
    {
        $map = [
            'kyiv' => [
                'title' => 'Поиск программистов в Киеве',
                'description' => '',
                'keywords' => '',
            ],
            'kharkiv' => [
                'title' => 'Поиск программистов в Харькове',
                'description' => '',
                'keywords' => '',
            ],
            'lviv' => [
                'title' => 'Поиск программистов в Львове',
                'description' => '',
                'keywords' => '',
            ],
            'dnipro' => [
                'title' => 'Поиск программистов в Днепропетровске',
                'description' => '',
                'keywords' => '',
            ],
            'odesa' => [
                'title' => 'Поиск программистов в Одессе',
                'description' => '',
                'keywords' => '',
            ],
            'ukraine' => [
                'title' => 'Поиск программистов в Украине',
                'description' => '',
                'keywords' => '',
            ],
            'vinnytsya' => [
                'title' => 'Поиск программистов в Виннице',
                'description' => '',
                'keywords' => '',
            ],
            'mykolaiv' => [
                'title' => 'Поиск программистов в Николаеве',
                'description' => '',
                'keywords' => '',
            ],
            'zaporizhzhya' => [
                'title' => 'Поиск программистов в Запорожье',
                'description' => '',
                'keywords' => '',
            ],
            'khmelnytskyi' => [
                'title' => 'Поиск программистов в Хмельницком',
                'description' => '',
                'keywords' => '',
            ],
            'ivano-frankivsk' => [
                'title' => 'Поиск программистов в Ивано-Франковске',
                'description' => '',
                'keywords' => '',
            ],
            'cherkasy' => [
                'title' => 'Поиск программистов в Черкассах',
                'description' => '',
                'keywords' => '',
            ],
            'chernivtsi' => [
                'title' => 'Поиск программистов в Черновцах',
                'description' => '',
                'keywords' => '',
            ],
            'zhytomyr' => [
                'title' => 'Поиск программистов в Житомире',
                'description' => '',
                'keywords' => '',
            ],
            'chernihiv' => [
                'title' => 'Поиск программистов в Чернигове',
                'description' => '',
                'keywords' => '',
            ],
            'simferopol' => [
                'title' => 'Поиск программистов в Симферополе',
                'description' => '',
                'keywords' => '',
            ],
            'donetsk' => [
                'title' => 'Поиск программистов в Донецке',
                'description' => '',
                'keywords' => '',
            ],
            'sevastopol' => [
                'title' => 'Поиск программистов в Севастополе',
                'description' => '',
                'keywords' => '',
            ],
        ];

        return $map[$alias] ?? null;
    }
}
