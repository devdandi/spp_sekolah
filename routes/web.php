<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\OrangtuaController;
use App\Http\Controllers\APIController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\NewsController;

Route::get('/', [FrontController::class, 'show'])->name('user.show');
Route::post('/login_user', [FrontController::class, 'login_post'])->name('user.login');


Route::prefix('payment-gateway/midtrans/')->group(function() {
    Route::post('/', [MidtransController::class, 'callback'])->name('midtrans.callback');
});


Route::middleware('auth:parent')->group(function() {
    Route::prefix('user/')->group(function() {
        Route::prefix('pemberitahuan/')->group(function(){
            Route::get('/{slug}', [FrontController::class, 'read'])->name('pemberitahuan.index');
        });
    
        Route::get('/home', [FrontController::class, 'index'])->name('user.index');

        Route::get('/siswa', [FrontController::class, 'siswa'])->name('user.siswa');
        Route::get('/tagihan', [FrontController::class, 'tagihan'])->name('user.tagihan');
        Route::post('/logout_user', [FrontController::class, 'logout'])->name('user.logout');

        Route::get('/update-user', [FrontController::class, 'show_update'])->name('user.show.update');
        Route::post('/update-user', [FrontController::class, 'update'])->name('user.update');
    });
    Route::prefix('transaksi/')->group(function() {
        Route::get('/', [FrontController::class, 'transaction'])->name('user.transaction');
    });
    Route::prefix('payment/')->group(function() {
        Route::post('/call', [FrontController::class, 'payment'])->name('user.payment');
        Route::get('/pilih-pembayaran/{snap}', [FrontController::class, 'show_payment'])->name('user.payment.show');
        Route::get('/berhasil/{snap_token}', [FrontController::class, 'payment_success'])->name('user.payment.success');
        Route::get('/gagal/{snap_token}', [FrontController::class, 'payment_failed'])->name('user.payment.failed');
        Route::get('/pending/{snap_token}', [FrontController::class, 'payment_pending'])->name('user.payment.pending');
        
    });

});

Route::middleware(['auth:sanctum','verified'])->prefix('dashboard')->group(function() {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard.index');
    Route::prefix('siswa/')->group(function()
    {
        Route::get('/', [SiswaController::class, 'index'])->name('siswa.index');
        Route::post('/store', [SiswaController::class, 'store'])->name('siswa.store');
        Route::get('/edit/{id}', [SiswaController::class, 'show_edit'])->name('siswa.edit');
        Route::post('/edit/{id}', [SiswaController::class, 'edit_proses'])->name('siswa.edit.proses');
    });
    Route::prefix('orangtua/')->group(function()
    {
        Route::get('/', [OrangtuaController::class, 'index'])->name('orangtua.index');
        Route::get('/tambah', [OrangtuaController::class, 'show'])->name('orangtua.show');
        Route::post('/store', [OrangtuaController::class, 'store'])->name('orangtua.store');
        Route::get('/detail/{id}', [OrangtuaController::class, 'details_family'])->name('orangtua.detail');
        Route::post('/detail/delete/{id}', [OrangtuaController::class, 'destroy'])->name('orangtua.detail.destroy');
        Route::post('/bulk-upload/{id}', [OrangtuaController::class, 'bulk'])->name('orangtua.bulk');
    });
    Route::prefix('api/')->group(function() {
        Route::post('/kk-num-search', [APIController::class, 'kk_num_search'])->name('api.kk_num.search');
        Route::post('/nik-search', [APIController::class, 'nik_search'])->name('api.nik.search');
        Route::post('/laporan/luas/total',[APIController::class, 'report_money_monthly'])->name('api.report.money.monthly');
        Route::post('/laporan/luas/total/tunggakan',[APIController::class, 'report_money_monthly_tunggakan'])->name('api.report.money.monthly.tunggakan');
        Route::post('/laporan/tunggakan/count', [APIController::class, 'count_tunggakan'])->name('api.tunggakan.count');
        Route::post('/laporan/pembayaran/count', [APIController::class, 'count_pembayaran'])->name('api.pembayaran.count');
        Route::post('/laporan/siswa/count', [APIController::class, 'count_siswa'])->name('api.siswa.count');
        Route::post('/laporan/pembayaran/failure/count', [APIController::class, 'count_failure_payment'])->name('api.payment.failure.count');

    });
    Route::prefix('tagihan/')->group(function(){
        Route::get('/{parent_id}', [TagihanController::class, 'index'])->name('tagihan.index');
        Route::post('/pembayaran/{id}', [TagihanController::class, 'show'])->name('tagihan.show');
        Route::post('/pembayaran/all/{id}', [TagihanController::class, 'show_all'])->name('tagihan.show.all');
    });
    Route::prefix('laporan/')->group(function() {
        Route::get('/', [ReportController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/fiter', [ReportController::class, 'filter'])->name('laporan.filter');
        Route::post('/laporan/fiter/tanggal', [ReportController::class, 'filter_tanggal'])->name('laporan.filter.tanggal');
        Route::post('/laporan/fiter/text', [ReportController::class, 'filter_txt'])->name('laporan.filter.text');
    });
    Route::prefix('payment-gateway/')->group(function() {
        Route::get('/', [MidtransController::class, 'index'])->name('midtrans.index');
        Route::post('/store', [MidtransController::class, 'store'])->name('midtrans.store');
        Route::post('/turn-on', [MidtransController::class, 'turn_on'])->name('midtrans.turn.on');
        Route::post('/turn-off', [MidtransController::class, 'turn_off'])->name('midtrans.turn.off');
        // Route::get('/callback-page', [MidtransController::class, 'callback_show'])->name('callback.show');
        // Route::post('/callback', [MidtransController::class, 'callback'])->name('callback');
    });
    Route::prefix('berita/')->group(function() {
        Route::get('/', [NewsController::class, 'index'])->name('news.index');
        Route::post('/berita-create', [NewsController::class, 'store'])->name('news.create');
        Route::get('/berita-create', [NewsController::class, 'show'])->name('news.show');
        Route::post('/berita-delete/{id}', [NewsController::class, 'destroy'])->name('news.destroy');

    });
});