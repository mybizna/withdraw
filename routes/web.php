<?php
// Replace 'WithdrawController' with your actual controller name

// Routes for Views
Route::group(['middleware' => ['auth']], function () {
    Route::get('/withdraw', 'WithdrawController@index');
    Route::post('/withdraw/withdrawal_reversal', 'WithdrawController@withdrawalReversal');
    Route::get('/withdraw/auto_withdrawal', 'WithdrawController@autoWithdrawal');
    Route::get('/withdraw/masspay_generate', 'WithdrawController@masspayGenerate');
    Route::get('/withdraw/masspay_complete', 'WithdrawController@masspayComplete');
    Route::get('/withdraw/save_setting', 'WithdrawController@saveSetting');

});
