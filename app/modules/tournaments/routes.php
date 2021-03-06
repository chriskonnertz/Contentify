<?php

ModuleRoute::context(__DIR__);

ModuleRoute::resource('admin/tournaments', 'AdminTournamentsController');
ModuleRoute::get(
    'admin/tournaments/{id}/restore', 
    ['as' => 'admin.tournaments.restore', 'uses' => 'AdminTournamentsController@restore']
);
ModuleRoute::post('admin/tournaments/search', 'AdminTournamentsController@search');