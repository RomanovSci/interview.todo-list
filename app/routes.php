<?php

return [
    ['GET', '/', 'App\Controllers\SiteController@index'],
    ['POST', '/api/task/create', 'App\Controllers\TaskController@create'],
];