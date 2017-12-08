<?php

return [
    ['GET', '/', 'App\Controllers\SiteController@index'],
    ['GET', '/api/task/create', 'App\Controllers\TaskController@create'],
];