<?php

Route::delete('/polycomments/{id}', 'PolycommentsDefaultController@deleteComment')->name('polycomments.delete');
Route::post('/polycomments/{id}', 'PolycommentsDefaultController@commentComment')->name('polycomments.comment');

