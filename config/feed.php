<?php

return [
    'feeds' => [
        'blog' => [
            'items' => 'App\Model\Blog\Blog@getFeedItems',
            'url' => '/feed/blog',
            'title' => "Articles",
            'view' => "feed.article"
        ]
    ],
];
