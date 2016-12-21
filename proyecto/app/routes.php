<?php

Route::get('/', 'HomeController@getIndex');
Route::get('gracias', 'HomeController@getGracias');
Route::post('consulta_DA', 'HomeController@postConsultaDA');
Route::post('enviarEncuesta', 'HomeController@postEncuesta');

Route::get('reporte_OqOhxnnLmou4', 'HomeController@getReporte');
Route::post('postReporte_hf6d890w', 'HomeController@postReporte');
