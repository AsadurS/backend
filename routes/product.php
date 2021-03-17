<?php
use App\Http\Controllers\ProductController;
Route::prefix('product')->name('product.')->group(function(){
 Route::get('/manage', [ProductController::class,'manage'])->name('manage');
 Route::post('/store', [ProductController::class,'store'])->name('store');
 Route::post('{product}/update', [ProductController::class,'update'])->name('update');
 Route::delete('{product}/delete', [ProductController::class,'delete'])->name('delete');
});