<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('bem-vindo');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
Route::get('/tarefa/exportacao/excel', [App\Http\Controllers\TarefaController::class, 'exportacaoExcel'])->name('tarefa.exportacao.excel');
Route::get('/tarefa/exportacao/pdf', [App\Http\Controllers\TarefaController::class, 'exportacaoPdf'])->name('tarefa.exportacao.pdf');
Route::resource('tarefa', App\Http\Controllers\TarefaController::class)->middleware('verified');
Route::get('/mensagem-teste', function() {
    return new App\Mail\MensagemTesteMail();
    //Mail::to("paulofiori34@gmail.com")->send(new App\Mail\MensagemTesteMail());
    //return "Email enviado com sucesso";
});
