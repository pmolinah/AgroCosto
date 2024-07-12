<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CampoController;
use App\Http\Controllers\CuartelController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\PlantacionController;
use App\Http\Controllers\CosechaController;
use App\Http\Controllers\ParametrosController;
use App\Http\Controllers\CuentaCorrienteController;
use App\Http\Controllers\GuiasController;
use App\Http\Controllers\GraficosController;
use App\Http\Controllers\CertificacionController;
use App\Http\Controllers\VehiculosController;
use App\Http\Controllers\DevolucionEnvaseController;
use App\Http\Livewire\Graficos\Graficos;
use App\Http\Controllers\CierreInicioTemporadaController;
use App\Http\Controllers\PlanEstimadoController;
use App\Http\Controllers\BodegaItemsController;
use App\Http\Controllers\TareasController;
use App\Models\empresa;
/*??
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

    Route::middleware(['web',config('jetstream.auth_session')])->group(function () {
    // Route::middleware(['web',config('jetstream.auth_session'),'verified'])->group(function () {


    Route::get('/dashboard',function(){return view('dashboard');})->name('dashboard');
    Route::get('/Role', [RoleController::class, 'show']);
    // Rutas de User
    Route::get('/Index/User', [UserController::class, 'index'])->name('User.index');
    Route::get('/Nuevo/User', [UserController::class, 'create'])->name('User.create');
    Route::post('/Guardar/User',[UserController::class, 'store'])->name('User.store');
    Route::get('/Editar/{id}/User',[UserController::class,'edit'])->name('User.edit');
    Route::post('/Update/User',[UserController::class, 'update'])->name('User.update');

    //Rutas de Roles y Permisos
    Route::get('/Index/rolPermisos',[RoleController::class, 'index'])->name('RolePermisos.index');
    Route::get('/Create/Rol',[RoleController::class,'create'])->name('Rol.create');
    Route::post('/Guardar/Rol',[RoleController::class,'store'])->name('Rol.store');
    route::get('Edit/{rol}/Rol',[RoleController::class,'edit'])->name('roles.edit');
    route::post('Update/{role}/Rol',[RoleController::class,'update'])->name('roles.update');
    route::delete('Delete/{role}/Rol',[RoleController::class, 'delete'])->name('roles.destroy');

    //Rutas de Empresa
    Route::get('/Index/Empresa',[EmpresaController::class,'Index'])->name('Empresa.index');
    Route::get('(/Create/Empresa',[EmpresaController::class,'create'])->name('Empresa.create');
    Route::post('/Guardar/Empresa',[EmpresaController::class,'store'])->name('Empresa.store');
    Route::get('/Editar/{Empresa}/Empresa',[EmpresaController::class,'edit'])->name('Empresa.edit');
    route::put('Update/{empresa}/Empresa',[EmpresaController::class,'update'])->name('Empresa.update');
 
    //Rutas de Campos
    Route::get('/Create/Campos',[CampoController::class, 'create'])->name('Campo.create');
    Route::get('/Edit/{id}/Campos',[CampoController::class, 'edit'])->name('Campo.edit');
    Route::put('/Update/{id}/Campos',[CampoController::class, 'update'])->name('Campo.update');

    //Rutas de Cuarteles livewire
    Route::get('/Create/Cuartel', [CuartelController::class, 'create'])->name('Cuartel.create');

    // Rutas de plantación
    Route::get('/Index/Plantacion',[PlantacionController::class, 'index'])->name('Plantacion.index');
    Route::get('/Create/Plantacion',[PlantacionController::class, 'create'])->name('Plantacion.create');
    Route::post('/Store/Plantacion',[PlantacionController::class, 'store'])->name('Plantacion.store');
    // Rutas de cosecha
    Route::get('/Index/Cosechas',[CosechaController::class, 'index'])->name('Cosecha.index');
    Route::get('/Planificacion/Cosechas',[CosechaController::class, 'planificacion'])->name('Cosecha.planificacion');
    Route::get('/Cosechar/{id}/Cosecha',[CosechaController::class,'cosechar'])->name('Cosechar.cosecha');
    Route::get('create/Planificacion/Cosechas',[CosechaController::class, 'planificacionCreate'])->name('Cosecha.planificacionCreate');
    Route::post('/Store/Planificacion',[CosechaController::class, 'planificacionStore'])->name('Planificacion.store');
    Route::get('/Edit/{id}/Planificacion',[CosechaController::class, 'planificacionEdit'])->name('Planificacion.edit');
    Route::post('/Update/Planificacion/Cosechas',[CosechaController::class, 'planificacionUpdate'])->name('Planificacion.update');
    Route::post('/Store/Cosecha',[CosechaController::class, 'CosechaStore'])->name('Cosecha.store');
    Route::get('/Create/Cosechas',[CosechaController::class, 'create'])->name('Cosecha.create');
    
    //rutas de cosechas cerradas e informes
    Route::get('/Index/CosechasCerradas',[CosechaController::class,'indexCosechasCerradas'])->name('CosechasCerradas.index');
    Route::get('/Reporte/{planificacioncosecha_id}/Cosecha',[CosechaController::class, 'ReporteCosecha'])->name('Reporte.cosecha');
    Route::get('/Reporte/{planificacioncosecha_id}/Cosecha/{contratista_id}/Contratista',[CosechaController::class, 'ReporteCosechaContratista'])->name('Reporte.cosecha.contratista');

   //rutas de Guias Despacho
   Route::get('/Guias/index',[GuiasController::class,'index'])->name('Guias.index'); 
   Route::get('/Guias/show',[GuiasController::class, 'show'])->name('Guias.show');
   Route::get('Guia/{guia_id}/Despacho',[GuiasController::class, 'GuiaDespacho'])->name('Guia.despacho');
    
    // rutas de guias de recepcion    //
    Route::get('/Guias/Recepcion',[GuiasController::class, 'GuiaRecepcion'])->name('Guias.recepcion');     
    Route::get('/Guias/{id}/Recepcion',[GuiasController::class, 'GuiaRecepcionEmitir'])->name('Guia.RecepcionEmitir');    

    //rutas de parametros de sistema
    Route::get('/Parametros/Index',[ParametrosController::class,'index'])->name('Parametros.index');

    //rutas de Cuenta Corriente de Envases
    Route::get('Cuenta/Corriente/Envases',[CuentaCorrienteController::class, 'index'])->name('CuentaCorriente.index');
    Route::get('Cuenta/Corriente/Envases/Exportadoras',[CuentaCorrienteController::class, 'indexExportadoras'])->name('CuentaCorrienteExportadoras.index'); 
    // rutas de certificacion
    Route::get('Index/Certificacion',[CertificacionController::class, 'index'])->name('Certificacion.index');
    Route::get('Index/Certificacion/Cuarteles',[CertificacionController::class, 'indexCertificacionCuartel'])->name('CertificacionCuartel.index');

    //cuenta corriente
    Route::post('/store/cuentacorriente/exportadora',[CuentaCorrienteController::class, 'store'])->name('cuentacorriente.store');
    Route::post('/store/cuentacorriente/campo',[CuentaCorrienteController::class, 'storeCampo'])->name('CuenEnvaseCampo.store');
    
    //rutas de Administración de Vehiculos
    Route::get('/Administracion/Vehiculos',[VehiculosController::class, 'index'])->name('Vehiculos.index');

    //asignacion de certificados a campos
    Route::post('/Asignacion/certificados/campo',[CertificacionController::class, 'store'])->name('store.certificado');
    Route::post('/Asignacion/certificados/cuartel',[CertificacionController::class, 'storeCuartel'])->name('store.certificadoCuartel');

    //Devolucion de Envases
    Route::get('/Devolucion/Envases',[DevolucionEnvaseController::class,'Devolucion'])->name('Devolucion.Envases');
    Route::get('/Devolucion/{id}/Traspaso/Envases',[GuiasController::class, 'GuiaDevolucionEmitir'])->name('Guia.DevolucionEmitir');

    //ruta de graficos
    Route::get('/ver/graficos',[GraficosController::class, 'Graficos'])->name('Ver.graficos');
    Route::get('/ver/graficos/envases',[GraficosController::class, 'graficosEnvases'])->name('Ver.graficosEnvases');

    Route::get('/Cierre/Inicio/Temporada',[CierreInicioTemporadaController::class,'CierreInicioTemporada'])->name('CierreInicioTemporada.index');

    //Rutas de Organización
    // Route::get('/Organizacion/Campos', [CamposController::class, 'index'])->name('Organizacion.index');
    Route::get('/Organizacion/Campos/Cuarteles',[CampoController::class, 'organizacion'])->name('organizacion.index');

    //Bodega Items
    Route::get('/Bodega/Items',[BodegaItemsController::class,'BodegaItems'])->name('BodegaItem.show');
    Route::post('Store/item',[BodegaItemsController::class,'itemStore'])->name('item.store');
    Route::post('Update/item',[BodegaItemsController::class,'itemUpdate'])->name('item.update');
    //bodega guia e ingreso a inventario
    Route::get('/Bodega/Ingreso',[BodegaItemsController::class,'BodegaIngreso'])->name('bodega.ingreso');
    Route::get('/Bodega/Egreso',[BodegaItemsController::class,'BodegaEgreso'])->name('bodega.egreso');
    Route::get('/Registro/Ingresos/Egresos/Bodega',[BodegaItemsController::class, "Registro"])->name('Registros.bodega');
    Route::get('/Registro/{documento_id}/Ingreso',[BodegaItemsController::class, 'IngresoBodegaPDF'])->name('registro.bodega.ingreso');
    Route::get('/Registro/{documento_id}/Egreso',[BodegaItemsController::class, 'EgresoBodegaPDF'])->name('registro.bodega.egreso');
    Route::get('/Edit/ingreso/salida/{factura_id}/bodega', [BodegaItemsController::class, 'editIngSal'])->name('edit.ingreso.salida');

    //tareas
    Route::get('/Crear/Tareas',[TareasController::class, 'CrearTarea'])->name('Tarea.crear');
    Route::get('/Tareas/Planificadas',[TareasController::class, 'TareasPlanificadas'])->name('Tareas.planificadas');
    Route::get('/Tareas/Finalizadas',[TareasController::class, 'TareasFinalizadas'])->name('Tareas.finalizadas');

    //planEstimado de especies
    Route::get('/Plan/Estimado/Index',[PlanEstimadoController::class, 'index'])->name('PlanEstimado.index');
    Route::get('/Plan/Estimado',[PlanEstimadoController::class, 'CreatePlan'])->name('Create.plan');
    Route::post('/Store/PlanEstimado',[PlanEstimadoController::class, 'store'])->name('PlanEstimacion.store');
});
