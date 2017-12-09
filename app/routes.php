<?php

return [
    ['GET', '/', 'App\Controllers\SiteController@index'],
    ['POST', '/api/task/create', 'App\Controllers\TaskController@create'],
    ['GET', '/api/tasks', 'App\Controllers\TaskController@index'],
];