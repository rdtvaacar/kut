<?php
Route::get('/kutuphane', function () {
    return Kut::kutuphane();
});
Route::post('/kitap_sil', function () {
    return Kut::demirbas_sil();
});