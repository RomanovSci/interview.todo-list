<?php

return [
    ['GET', '/', 'App\Controllers\SiteController@index'],

    /** Tasks */
    ['GET', '/api/tasks', 'App\Controllers\TaskController@index'],
    ['POST', '/api/task/create', 'App\Controllers\TaskController@create'],
    ['POST', '/api/tasks/update', 'App\Controllers\TaskController@update'],

    /** Auth */
    ['POST', '/api/login', 'App\Controllers\IndividualController@login'],
    ['GET', '/api/check-token', 'App\Controllers\IndividualController@check']
];