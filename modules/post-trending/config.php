<?php
/**
 * post-trending config file
 * @package post-trending
 * @version 0.0.1
 * @upgrade true
 */

return [
    '__name' => 'post-trending',
    '__version' => '0.0.1',
    '__git' => 'https://github.com/getphun/post-trending',
    '__files' => [
        'modules/post-trending' => [ 'install', 'remove', 'update' ]
    ],
    '__dependencies' => [
        'post',
        'api-google'
    ],
    '_services' => [],
    '_autoload' => [
        'classes' => [
            'PostTrending\\Model\\PostTrending'         => 'modules/post-trending/model/PostTrending.php',
            'PostTrending\\Model\\PostPopular'          => 'modules/post-trending/model/PostPopular.php',
            'PostTrending\\Controller\\PostController'  => 'modules/post-trending/controller/PostController.php'
        ],
        'files' => []
    ],
    '_routes' => [
        'site' => [
            'sitePostTrending' => [
                'rule' => '/post/-/trending',
                'handler' => 'PostTrending\\Controller\\Post::calculate'
            ]
        ]
    ],
    'post-trending' => [
        'trending' => [
            'last_days' => 3,
            'total_items' => 15,
            'per_category' => FALSE,
            'per_tag' => FALSE,
            'per_canal' => FALSE,
            'per_user' => FALSE
        ],
        'popular' => [
            'time_start' => '2005-01-01',
            'total_items' => 15,
            'per_category' => FALSE,
            'per_tag' => FALSE,
            'per_canal' => FALSE,
            'per_user' => FALSE
        ]
    ]
];