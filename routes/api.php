<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SelectController;
use App\Http\Controllers\CosechaController;
use App\Http\Controllers\CuentaCorrienteController;
use App\Http\Controllers\PlantacionController;
use App\Http\Controllers\EmpresaController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    // return $request->user();
    // Route::get('/Eliminar/{id}/Rol/',[RoleController::class, 'destroy']);
   
});

Route::get('/Eliminar/{id}/Rol/',[RoleController::class, 'destroy']);
Route::get('Seleccion/{id}/Empresa',[SelectController::class, 'CambioEmpresa']);
Route::get('Seleccion/{id}/Campo',[SelectController::class, 'CambioCampo']);
Route::get('Seleccion/{id}/Cuartel',[SelectController::class, 'CambioCuatel']);
Route::get('Seleccion/{id}/Especie',[SelectController::class, 'CambioEspecie']);

// cambio de cuartel para planificacion de cocecha

Route::get('Seleccion/{id}/EmpresaPlan',[SelectController::class, 'CambioEmpresaPlan']);
Route::get('Seleccion/{id}/CampoPlan',[SelectController::class, 'CambioCampoPlan']);
Route::get('Seleccion/{id}/CuartelPlan',[SelectController::class, 'CambioCuartelPlan']);
Route::get('Eliminar/{id}/PlanificacionCosecha',[CosechaController::class, 'EliminarPlanificacionCosecha']);
Route::get('/stock/{caID}/envase/{enID}/empresa',[CosechaController::class, 'StockEnvaseEmpresa']);
Route::get('/stock/{exID}/envase/{enID}/exportadora',[CosechaController::class, 'StockEnvaseExportadora']);
Route::get('/recuperar/{color_id}/color',[SelectController::class, 'RecuperarColor']);
Route::get('/Eliminar/Cuenta/{valorPersonalizado}/Envases',[CuentaCorrienteController::class, 'destroy']);
Route::get('/Eliminar/Cuenta/{valorPersonalizado}/Envases/Campo',[CuentaCorrienteController::class, 'destroyCampo']);
Route::get('/datos/{rut}/Empresa/',[EmpresaController::class, 'verificarRut']);
Route::get('/Eliminar/{idEliminar}/Plantacion',[PlantacionController::class, 'destroy']);
Route::get('/obtenerDatosEspecie/{id}',[CosechaController::class, 'EstimacionCosecha']);
