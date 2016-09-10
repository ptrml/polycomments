<?php

Route::delete('/polycomments/{id}', 'PolyCommentsDefaultController@deleteComment')->name('polycomments.delete');
Route::post('/polycomments/{id}', 'PolyCommentsDefaultController@commentComment')->name('polycomments.comment');

