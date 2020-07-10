<?php

//use Illuminate\Support\Facades\Route;

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
Route::group(['middleware'=>['guest']],function(){

    Route::get('/','Auth\LoginController@showLoginForm');

    Route::post('/login', 'Auth\LoginController@login')->name('login');

   Route::get('/login','Auth\LoginController@showLoginForm');

});
/*Route::group(['middleware'=>['guest']],function(){
    Route::get('/','Auth\LoginController@showLoginForm');
    Route::post('/login','Auth\loginController@login')->name('login');
});*/

Route::group(['middleware'=>['auth']],function(){

    Route::post('/logout','Auth\LoginController@logout')->name('logout');
    
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');

    Route::group(['middleware'=>['administrador']],function(){
        Route::get('/persona', 'PersonaController@index');
        Route::post('/persona/registrar', 'PersonaController@store');
        Route::put('/persona/actualizar', 'PersonaController@update');
        Route::put('/persona/desactivar', 'PersonaController@desactivar');
        Route::put('/persona/activar', 'PersonaController@activar');
        Route::get('/persona/selectpersona', 'PersonaController@index');        

        Route::get('/solicitudRes/selectPersonas', 'Unidad_SolicitanteController@selectPersonas');        
        Route::get('/solicitudRespon/selectPersona', 'PersonaController@selectPersona');        
        Route::get('/solicitud', 'Unidad_SolicitanteController@index');
        Route::get('/solicitud/registrar', 'Unidad_SolicitanteController@store');
        Route::get('/solicitudSolEnsayo/nroRegistro', 'Solicitud_EnsayoController@nroSolicitud');

        Route::get('/solicitudPersona/selectPersonaCi', 'PersonaController@selectPersonaCarnet');   
        Route::get('/solicitudPersona/selectPersona', 'PersonaController@selectPersonaCarnet');        
        Route::get('/solicitudUnidad/selectUnidad', 'Unidad_SolicitanteController@selectUnidad');        


        Route::get('/solicitudUnidadSol', 'Unidad_SolicitanteController@index');
        Route::post('/solicitud/registrarUnidadSol', 'Unidad_SolicitanteController@store');
        Route::put('/solicitud/desactivarUnidadSol', 'Unidad_SolicitanteController@desactivar');

        Route::get('/solicitudSolEnsayo', 'Solicitud_EnsayoController@index');
        Route::get('/solicitudSolEnsayo/nroRegistro', 'Solicitud_EnsayoController@nroSolicitud');
        Route::post('/solicitud/registrarSolEnsayo', 'Solicitud_EnsayoController@store');
        Route::put('/solicitud/desactivarSolEnsayo', 'Solicitud_EnsayoController@desactivar');
        
        //Route::get('/solicitudInfSolicitudu', 'Informacion_SolicitudController@index');
        Route::get('/solicitudInfSolicitudId', 'Informacion_SolicitudController@indexId');
        Route::post('/solicitud/registrarInfSolicitud', 'Informacion_SolicitudController@store');
        Route::get('/solicitud/selectAnalito', 'AnalitoController@index');
         
        //Route::get('/solicitudRevision', 'RevisionController@index');
        Route::get('/solicitudRevisionId', 'RevisionController@indexId');
        Route::post('/solicitud/registrarRevision', 'RevisionController@store');
        Route::put('/solicitud/desactivarRevision', 'RevisionController@desactivar');
        
        Route::get('/solicitudResultadoId', 'ResultadoController@indexId');
        Route::post('/solicitud/registrarResultado', 'ResultadoController@store');
        Route::put('/solicitud/desactivarResultado', 'ResultadoController@desactivar');
        
        Route::get('/solicitudRecomendacionesId', 'RecomendacionesController@indexId');
        Route::post('/solicitud/registrarRecomendaciones', 'RecomendacionesController@store');
        Route::put('/solicitud/desactivarRecomendaciones', 'RecomendacionesController@desactivar');
        
        Route::get('/solicitudConformidadId', 'ConformidadController@indexId');
        Route::post('/solicitud/registrarConformidad', 'ConformidadController@store');
        Route::put('/solicitud/desactivarConformidad', 'ConformidadController@desactivar');
        
        
        Route::get('/solicitudModificacion/busquedaDatos', 'Unidad_SolicitanteController@selectDatosBusqueda');
        Route::get('/solicitud', 'GlosaController@index');
        Route::post('/solicitud/registrarModificaciones', 'GlosaController@store');
                
        Route::get('/solicitud', 'Solicitud_EnsayoController@index');
        Route::get('/solicitud/registrar', 'Solicitud_EnsayoController@store');

        Route::get('/solicitud', 'Informacion_SolicitudController@index');
        Route::get('/solicitud/registrar', 'Informacion_SolicitudController@store');
        
        Route::get('/solicitud', 'RevisionController@index');
        Route::get('/solicitud/registrar', 'RevisionController@store');

        Route::get('/solicitud', 'ResultadoController@index');
        Route::get('/solicitud/registrar', 'ResultadoController@store');

        Route::get('/solicitud', 'RecomendacionesController@index');
        Route::get('/solicitud/registrar', 'RecomendacionesController@store');

        Route::get('/solicitud/solPdf/{nro_reg}', 'Unidad_SolicitanteController@solPdf')->name('solicitud.pdf');
        // ruta de formulario
        Route::get('/solicitud', 'EmailController@index');
        // ruta al enviar correo
        Route::post('/send', 'EmailController@send');

        Route::get('/unidad_codigo', 'Unidad_CodigoController@index');
        Route::post('/unidad_codigo/registrar', 'Unidad_CodigoController@store');
        Route::put('/unidad_codigo/actualizar', 'Unidad_CodigoController@update');
        Route::put('/unidad_codigo/desactivar', 'Unidad_CodigoController@desactivar');
        Route::put('/unidad_codigo/activar', 'Unidad_CodigoController@activar');
        Route::get('/unidad_codigo/selectUnidadCodigo', 'Unidad_CodigoController@selectUnidadCodigo');


        Route::get('/solicitud', 'GlosaController@index');
        Route::get('/solicitud/registrar', 'GlosaController@store');

        Route::get('/recepcion', 'RecepcionController@index');
        Route::post('/recepcion/registrar', 'RecepcionController@store');
        Route::put('/recepcion/actualizar', 'RecepcionController@update');
        Route::put('/recepcion/desactivar', 'RecepcionController@desactivar');
        Route::put('/recepcion/activar', 'RecepcionController@activar');
        Route::get('/recepcion/selectRecepcion', 'RecepcionController@selectRecepcion'); 
        Route::get('/recepcion/selectUnidad', 'Unidad_SolicitanteController@selectUnidad2');      
        Route::get('/recepcion/selectCodigoLab', 'RecepcionController@selectCodigoLab');      
                
        Route::get('/preparacion', 'PreparacionController@index');
        Route::post('/preparacion/registrar', 'PreparacionController@store');
        Route::put('/preparacion/actualizar', 'PreparacionController@update');
        Route::put('/preparacion/desactivar', 'PreparacionController@desactivar');
        Route::put('/preparacion/activar', 'PreparacionController@activar');
        Route::get('/preparacion/selectPreparacion', 'PreparacionController@index');        


        Route::get('/cloruros_vol', 'Cloruros_VolController@index');
        Route::post('/cloruros_vol/registrar', 'Cloruros_VolController@store');
        Route::put('/cloruros_vol/actualizar', 'Cloruros_VolController@update');
        Route::put('/cloruros_vol/desactivar', 'Cloruros_VolController@desactivar');
        Route::put('/cloruros_vol/activar', 'Cloruros_VolController@activar');

        Route::get('/sulfatos_turb', 'Sulfatos_TurbController@index');
        Route::post('/sulfatos_turb/registrar', 'Sulfatos_TurbController@store');
        Route::put('/sulfatos_turb/actualizar', 'Sulfatos_TurbController@update');
        Route::put('/sulfatos_turb/desactivar', 'Sulfatos_TurbController@desactivar');
        Route::put('/sulfatos_turb/activar', 'Sulfatos_TurbController@activar');

        Route::get('/sulfatos_grav', 'Sulfatos_GravController@index');
        Route::post('/sulfatos_grav/registrar', 'Sulfatos_GravController@store');
        Route::put('/sulfatos_grav/actualizar', 'Sulfatos_GravController@update');
        Route::put('/sulfatos_grav/desactivar', 'Sulfatos_GravController@desactivar');
        Route::put('/sulfatos_grav/activar', 'Sulfatos_GravController@activar');

        Route::get('/ph_densidad', 'Ph_DensidadController@index');
        Route::post('/ph_densidad/registrar', 'Ph_DensidadController@store');
        Route::put('/ph_densidad/actualizar', 'Ph_DensidadController@update');
        Route::put('/ph_densidad/desactivar', 'Ph_DensidadController@desactivar');
        Route::put('/ph_densidad/activar', 'Ph_DensidadController@activar');

        Route::get('/humedad', 'HumedadController@index');
        Route::post('/humedad/registrar', 'HumedadController@store');
        Route::put('/humedad/actualizar', 'HumedadController@update');
        Route::put('/humedad/desactivar', 'HumedadController@desactivar');
        Route::put('/humedad/activar', 'HumedadController@activar');

        Route::get('/alcalinidad', 'AlcalinidadController@index');
        Route::post('/alcalinidad/registrar', 'AlcalinidadController@store');
        Route::put('/alcalinidad/actualizar', 'AlcalinidadController@update');
        Route::put('/alcalinidad/desactivar', 'AlcalinidadController@desactivar');
        Route::put('/alcalinidad/activar', 'AlcalinidadController@activar');

        Route::get('/carbonatos_pcl', 'Carbonatos_PclController@index');
        Route::post('/carbonatos_pcl/registrar', 'Carbonatos_PclController@store');
        Route::put('/carbonatos_pcl/actualizar', 'Carbonatos_PclController@update');
        Route::put('/carbonatos_pcl/desactivar', 'Carbonatos_PclController@desactivar');
        Route::put('/carbonatos_pcl/activar', 'Carbonatos_PclController@activar');

        Route::get('/espectrometria', 'EspectrometriaController@index');
        Route::post('/espectrometria/registrar', 'EspectrometriaController@store');
        Route::put('/espectrometria/actualizar', 'EspectrometriaController@update');
        Route::put('/espectrometria/desactivar', 'EspectrometriaController@desactivar');
        Route::put('/espectrometria/activar', 'EspectrometriaController@activar');

        Route::get('/granulometrico', 'GranulometricoController@index');
        Route::post('/granulometrico/registrar', 'GranulometricoController@store');
        Route::put('/granulometrico/actualizar', 'GranulometricoController@update');
        Route::put('/granulometrico/desactivar', 'GranulometricoController@desactivar');
        Route::put('/granulometrico/activar', 'GranulometricoController@activar');

        Route::get('/oxido_calcio', 'Oxido_CalcioController@index');
        Route::post('/oxido_calcio/registrar', 'Oxido_CalcioController@store');
        Route::put('/oxido_calcio/actualizar', 'Oxido_CalcioController@update');
        Route::put('/oxido_calcio/desactivar', 'Oxido_CalcioController@desactivar');
        Route::put('/oxido_calcio/activar', 'Oxido_CalcioController@activar');

        Route::get('/muestreo_cal', 'MuestreoCalController@index');
        Route::post('/muestreo_cal/registrar', 'MuestreoCalController@store');
        Route::put('/muestreo_cal/actualizar', 'MuestreoCalController@update');
        Route::put('/muestreo_cal/desactivar', 'MuestreoCalController@desactivar');
        Route::put('/muestreo_cal/activar', 'MuestreoCalController@activar');

        Route::get('/correccion_metrologica', 'Correccion_MetrologicaController@index');
        Route::post('/correccion_metrologica/registrar', 'Correccion_MetrologicaController@store');
        Route::put('/correccion_metrologica/actualizar', 'Correccion_MetrologicaController@update');
        Route::put('/correccion_metrologica/desactivar', 'Correccion_MetrologicaController@desactivar');
        Route::put('/correccion_metrologica/activar', 'Correccion_MetrologicaController@activar');

        Route::get('/cloruros_pspv', 'Cloruros_PspvController@index');
        Route::post('/cloruros_pspv/registrar', 'Cloruros_PspvController@store');
        Route::put('/cloruros_pspv/actualizar', 'Cloruros_PspvController@update');
        Route::put('/cloruros_pspv/desactivar', 'Cloruros_PspvController@desactivar');
        Route::put('/cloruros_pspv/activar', 'Cloruros_PspvController@activar');

        Route::get('/boro_volumetria', 'Boro_VolumetriaController@index');
        Route::post('/boro_volumetria/registrar', 'Boro_VolumetriaController@store');
        Route::put('/boro_volumetria/actualizar', 'Boro_VolumetriaController@update');
        Route::put('/boro_volumetria/desactivar', 'Boro_VolumetriaController@desactivar');
        Route::put('/boro_volumetria/activar', 'Boro_VolumetriaController@activar');

        Route::get('/cal_mg_complexometria', 'Cal_Mg_CompleController@index');
        Route::post('/cal_mg_complexometria/registrar', 'Cal_Mg_CompleController@store');
        Route::put('/cal_mg_complexometria/actualizar', 'Cal_Mg_CompleController@update');
        Route::put('/cal_mg_complexometria/desactivar', 'Cal_Mg_CompleController@desactivar');
        Route::put('/cal_mg_complexometria/activar', 'Cal_Mg_CompleController@activar');

        Route::get('/ph_densidad_solidas', 'Ph_Densidad_SolidasController@index');
        Route::post('/ph_densidad_solidas/registrar', 'Ph_Densidad_SolidasController@store');
        Route::put('/ph_densidad_solidas/actualizar', 'Ph_Densidad_SolidasController@update');
        Route::put('/ph_densidad_solidas/desactivar', 'Ph_Densidad_SolidasController@desactivar');
        Route::put('/ph_densidad_solidas/activar', 'Ph_Densidad_SolidasController@activar');

        Route::get('/carbonatos_mssv', 'Carbonatos_MssvController@index');
        Route::post('/carbonatos_mssv/registrar', 'Carbonatos_MssvController@store');
        Route::put('/carbonatos_mssv/actualizar', 'Carbonatos_MssvController@update');
        Route::put('/carbonatos_mssv/desactivar', 'Carbonatos_MssvController@desactivar');
        Route::put('/carbonatos_mssv/activar', 'Carbonatos_MssvController@activar');

        Route::get('/carbonatos_oxidrilos', 'Carbonatos_OxidrilosController@index');
        Route::post('/carbonatos_oxidrilos/registrar', 'Carbonatos_OxidrilosController@store');
        Route::put('/carbonatos_oxidrilos/actualizar', 'Carbonatos_OxidrilosController@update');
        Route::put('/carbonatos_oxidrilos/desactivar', 'Carbonatos_OxidrilosController@desactivar');
        Route::put('/carbonatos_oxidrilos/activar', 'Carbonatos_OxidrilosController@activar');

        Route::get('/turbidez_conductividad', 'Turbidez_ConductividadController@index');
        Route::post('/turbidez_conductividad/registrar', 'Turbidez_ConductividadController@store');
        Route::put('/turbidez_conductividad/actualizar', 'Turbidez_ConductividadController@update');
        Route::put('/turbidez_conductividad/desactivar', 'Turbidez_ConductividadController@desactivar');
        Route::put('/turbidez_conductividad/activar', 'Turbidez_ConductividadController@activar');

        Route::get('/potasio_valoracion', 'Potasio_ValoracionController@index');
        Route::post('/potasio_valoracion/registrar', 'Potasio_ValoracionController@store');
        Route::put('/potasio_valoracion/actualizar', 'Potasio_ValoracionController@update');
        Route::put('/potasio_valoracion/desactivar', 'Potasio_ValoracionController@desactivar');
        Route::put('/potasio_valoracion/activar', 'Potasio_ValoracionController@activar');

        Route::get('/potasio_gravimetria', 'Potasio_GravimetriaController@index');
        Route::post('/potasio_gravimetria/registrar', 'Potasio_GravimetriaController@store');
        Route::put('/potasio_gravimetria/actualizar', 'Potasio_GravimetriaController@update');
        Route::put('/potasio_gravimetria/desactivar', 'Potasio_GravimetriaController@desactivar');
        Route::put('/potasio_gravimetria/activar', 'Potasio_GravimetriaController@activar');

        Route::get('/trazas_aa', 'Trazas_AaController@index');
        Route::post('/trazas_aa/registrar', 'Trazas_AaController@store');
        Route::put('/trazas_aa/actualizar', 'Trazas_AaController@update');
        Route::put('/trazas_aa/desactivar', 'Trazas_AaController@desactivar');
        Route::put('/trazas_aa/activar', 'Trazas_AaController@activar');

        Route::get('/rol', 'RolController@index');
        Route::get('/rol/selectRol', 'RolController@selectRol');
        Route::get('/user', 'UserController@index');
        Route::post('/user/registrar', 'UserController@store');
        Route::put('/user/actualizar', 'UserController@update');

    });

    Route::group(['middleware'=>['control']],function(){
        Route::get('/persona', 'PersonaController@index');
        Route::post('/persona/registrar', 'PersonaController@store');
        Route::put('/persona/actualizar', 'PersonaController@update');
        Route::put('/persona/desactivar', 'PersonaController@desactivar');
        Route::put('/persona/activar', 'PersonaController@activar');
        Route::get('/persona/selectpersona', 'PersonaController@index');        
        
        Route::get('/analito', 'AnalitoController@index');
        Route::post('/analito/registrar', 'AnalitoController@store');
        Route::put('/analito/actualizar', 'AnalitoController@update');
        Route::put('/analito/desactivar', 'AnalitoController@desactivar');
        Route::put('/analito/activar', 'AnalitoController@activar');
        Route::get('/analito/selectanalito', 'AnalitoController@index');        


        Route::get('/recepcion', 'RecepcionController@index');
        Route::post('/recepcion/registrar', 'RecepcionController@store');
        Route::put('/recepcion/actualizar', 'RecepcionController@update');
        Route::put('/recepcion/desactivar', 'RecepcionController@desactivar');
        Route::put('/recepcion/activar', 'RecepcionController@activar');
        Route::get('/recepcion/selectRecepcion', 'RecepcionController@selectRecepcion');
                
        Route::get('/preparacion', 'PreparacionController@index');
        Route::post('/preparacion/registrar', 'PreparacionController@store');
        Route::put('/preparacion/actualizar', 'PreparacionController@update');
        Route::put('/preparacion/desactivar', 'PreparacionController@desactivar');
        Route::put('/preparacion/activar', 'PreparacionController@activar');
        Route::get('/preparacion/selectPreparacion', 'PreparacionController@index');        


        Route::get('/cloruros_vol', 'Cloruros_VolController@index');
        Route::post('/cloruros_vol/registrar', 'Cloruros_VolController@store');
        Route::put('/cloruros_vol/actualizar', 'Cloruros_VolController@update');
        Route::put('/cloruros_vol/desactivar', 'Cloruros_VolController@desactivar');
        Route::put('/cloruros_vol/activar', 'Cloruros_VolController@activar');

        Route::get('/sulfatos_turb', 'Sulfatos_TurbController@index');
        Route::post('/sulfatos_turb/registrar', 'Sulfatos_TurbController@store');
        Route::put('/sulfatos_turb/actualizar', 'Sulfatos_TurbController@update');
        Route::put('/sulfatos_turb/desactivar', 'Sulfatos_TurbController@desactivar');
        Route::put('/sulfatos_turb/activar', 'Sulfatos_TurbController@activar');


        Route::get('/sulfatos_grav', 'Sulfatos_GravController@index');
        Route::post('/sulfatos_grav/registrar', 'Sulfatos_GravController@store');
        Route::put('/sulfatos_grav/actualizar', 'Sulfatos_GravController@update');
        Route::put('/sulfatos_grav/desactivar', 'Sulfatos_GravController@desactivar');
        Route::put('/sulfatos_grav/activar', 'Sulfatos_GravController@activar');

        Route::get('/ph_densidad', 'Ph_DensidadController@index');
        Route::post('/ph_densidad/registrar', 'Ph_DensidadController@store');
        Route::put('/ph_densidad/actualizar', 'Ph_DensidadController@update');
        Route::put('/ph_densidad/desactivar', 'Ph_DensidadController@desactivar');
        Route::put('/ph_densidad/activar', 'Ph_DensidadController@activar');

        Route::get('/humedad', 'HumedadController@index');
        Route::post('/humedad/registrar', 'HumedadController@store');
        Route::put('/humedad/actualizar', 'HumedadController@update');
        Route::put('/humedad/desactivar', 'HumedadController@desactivar');
        Route::put('/humedad/activar', 'HumedadController@activar');

        Route::get('/alcalinidad', 'AlcalinidadController@index');
        Route::post('/alcalinidad/registrar', 'AlcalinidadController@store');
        Route::put('/alcalinidad/actualizar', 'AlcalinidadController@update');
        Route::put('/alcalinidad/desactivar', 'AlcalinidadController@desactivar');
        Route::put('/alcalinidad/activar', 'AlcalinidadController@activar');

        Route::get('/carbonatos_pcl', 'Carbonatos_PclController@index');
        Route::post('/carbonatos_pcl/registrar', 'Carbonatos_PclController@store');
        Route::put('/carbonatos_pcl/actualizar', 'Carbonatos_PclController@update');
        Route::put('/carbonatos_pcl/desactivar', 'Carbonatos_PclController@desactivar');
        Route::put('/carbonatos_pcl/activar', 'Carbonatos_PclController@activar');

        Route::get('/espectrometria', 'EspectrometriaController@index');
        Route::post('/espectrometria/registrar', 'EspectrometriaController@store');
        Route::put('/espectrometria/actualizar', 'EspectrometriaController@update');
        Route::put('/espectrometria/desactivar', 'EspectrometriaController@desactivar');
        Route::put('/espectrometria/activar', 'EspectrometriaController@activar');

        Route::get('/granulometrico', 'GranulometricoController@index');
        Route::post('/granulometrico/registrar', 'GranulometricoController@store');
        Route::put('/granulometrico/actualizar', 'GranulometricoController@update');
        Route::put('/granulometrico/desactivar', 'GranulometricoController@desactivar');
        Route::put('/granulometrico/activar', 'GranulometricoController@activar');

        Route::get('/oxido_calcio', 'Oxido_CalcioController@index');
        Route::post('/oxido_calcio/registrar', 'Oxido_CalcioController@store');
        Route::put('/oxido_calcio/actualizar', 'Oxido_CalcioController@update');
        Route::put('/oxido_calcio/desactivar', 'Oxido_CalcioController@desactivar');
        Route::put('/oxido_calcio/activar', 'Oxido_CalcioController@activar');

        Route::get('/muestreo_cal', 'MuestreoCalController@index');
        Route::post('/muestreo_cal/registrar', 'MuestreoCalController@store');
        Route::put('/muestreo_cal/actualizar', 'MuestreoCalController@update');
        Route::put('/muestreo_cal/desactivar', 'MuestreoCalController@desactivar');
        Route::put('/muestreo_cal/activar', 'MuestreoCalController@activar');

        Route::get('/correccion_metrologica', 'Correccion_MetrologicaController@index');
        Route::post('/correccion_metrologica/registrar', 'Correccion_MetrologicaController@store');
        Route::put('/correccion_metrologica/actualizar', 'Correccion_MetrologicaController@update');
        Route::put('/correccion_metrologica/desactivar', 'Correccion_MetrologicaController@desactivar');
        Route::put('/correccion_metrologica/activar', 'Correccion_MetrologicaController@activar');

        Route::get('/cloruros_pspv', 'Cloruros_PspvController@index');
        Route::post('/cloruros_pspv/registrar', 'Cloruros_PspvController@store');
        Route::put('/cloruros_pspv/actualizar', 'Cloruros_PspvController@update');
        Route::put('/cloruros_pspv/desactivar', 'Cloruros_PspvController@desactivar');
        Route::put('/cloruros_pspv/activar', 'Cloruros_PspvController@activar');

        Route::get('/boro_volumetria', 'Boro_VolumetriaController@index');
        Route::post('/boro_volumetria/registrar', 'Boro_VolumetriaController@store');
        Route::put('/boro_volumetria/actualizar', 'Boro_VolumetriaController@update');
        Route::put('/boro_volumetria/desactivar', 'Boro_VolumetriaController@desactivar');
        Route::put('/boro_volumetria/activar', 'Boro_VolumetriaController@activar');

        Route::get('/cal_mg_complexometria', 'Cal_Mg_CompleController@index');
        Route::post('/cal_mg_complexometria/registrar', 'Cal_Mg_CompleController@store');
        Route::put('/cal_mg_complexometria/actualizar', 'Cal_Mg_CompleController@update');
        Route::put('/cal_mg_complexometria/desactivar', 'Cal_Mg_CompleController@desactivar');
        Route::put('/cal_mg_complexometria/activar', 'Cal_Mg_CompleController@activar');

        Route::get('/ph_densidad_solidas', 'Ph_Densidad_SolidasController@index');
        Route::post('/ph_densidad_solidas/registrar', 'Ph_Densidad_SolidasController@store');
        Route::put('/ph_densidad_solidas/actualizar', 'Ph_Densidad_SolidasController@update');
        Route::put('/ph_densidad_solidas/desactivar', 'Ph_Densidad_SolidasController@desactivar');
        Route::put('/ph_densidad_solidas/activar', 'Ph_Densidad_SolidasController@activar');

        Route::get('/carbonatos_mssv', 'Carbonatos_MssvController@index');
        Route::post('/carbonatos_mssv/registrar', 'Carbonatos_MssvController@store');
        Route::put('/carbonatos_mssv/actualizar', 'Carbonatos_MssvController@update');
        Route::put('/carbonatos_mssv/desactivar', 'Carbonatos_MssvController@desactivar');
        Route::put('/carbonatos_mssv/activar', 'Carbonatos_MssvController@activar');

        Route::get('/carbonatos_oxidrilos', 'Carbonatos_OxidrilosController@index');
        Route::post('/carbonatos_oxidrilos/registrar', 'Carbonatos_OxidrilosController@store');
        Route::put('/carbonatos_oxidrilos/actualizar', 'Carbonatos_OxidrilosController@update');
        Route::put('/carbonatos_oxidrilos/desactivar', 'Carbonatos_OxidrilosController@desactivar');
        Route::put('/carbonatos_oxidrilos/activar', 'Carbonatos_OxidrilosController@activar');

        Route::get('/turbidez_conductividad', 'Turbidez_ConductividadController@index');
        Route::post('/turbidez_conductividad/registrar', 'Turbidez_ConductividadController@store');
        Route::put('/turbidez_conductividad/actualizar', 'Turbidez_ConductividadController@update');
        Route::put('/turbidez_conductividad/desactivar', 'Turbidez_ConductividadController@desactivar');
        Route::put('/turbidez_conductividad/activar', 'Turbidez_ConductividadController@activar');

        Route::get('/potasio_valoracion', 'Potasio_ValoracionController@index');
        Route::post('/potasio_valoracion/registrar', 'Potasio_ValoracionController@store');
        Route::put('/potasio_valoracion/actualizar', 'Potasio_ValoracionController@update');
        Route::put('/potasio_valoracion/desactivar', 'Potasio_ValoracionController@desactivar');
        Route::put('/potasio_valoracion/activar', 'Potasio_ValoracionController@activar');

        Route::get('/potasio_gravimetria', 'Potasio_GravimetriaController@index');
        Route::post('/potasio_gravimetria/registrar', 'Potasio_GravimetriaController@store');
        Route::put('/potasio_gravimetria/actualizar', 'Potasio_GravimetriaController@update');
        Route::put('/potasio_gravimetria/desactivar', 'Potasio_GravimetriaController@desactivar');
        Route::put('/potasio_gravimetria/activar', 'Potasio_GravimetriaController@activar');

        Route::get('/trazas_aa', 'Trazas_AaController@index');
        Route::post('/trazas_aa/registrar', 'Trazas_AaController@store');
        Route::put('/trazas_aa/actualizar', 'Trazas_AaController@update');
        Route::put('/trazas_aa/desactivar', 'Trazas_AaController@desactivar');
        Route::put('/trazas_aa/activar', 'Trazas_AaController@activar');

    });

    Route::group(['middleware'=>['registrador']],function(){
        Route::get('/persona', 'PersonaController@index');
        Route::post('/persona/registrar', 'PersonaController@store');
        Route::put('/persona/actualizar', 'PersonaController@update');
        Route::put('/persona/desactivar', 'PersonaController@desactivar');
        Route::put('/persona/activar', 'PersonaController@activar');
        Route::get('/persona/selectpersona', 'PersonaController@index');        

        Route::get('/solicitudRes/selectPersonas', 'Unidad_SolicitanteController@selectPersonas');        
        Route::get('/solicitudRespon/selectPersona', 'PersonaController@selectPersona');        
        Route::get('/solicitud', 'Unidad_SolicitanteController@index');
        Route::get('/solicitud/registrar', 'Unidad_SolicitanteController@store');
        Route::get('/solicitudSolEnsayo/nroRegistro', 'Solicitud_EnsayoController@nroSolicitud');

        Route::get('/solicitud', 'Solicitud_EnsayoController@index');
        Route::get('/solicitud/registrar', 'Solicitud_EnsayoController@store');

        Route::get('/solicitud', 'Informacion_SolicitudController@index');
        Route::get('/solicitud/registrar', 'Informacion_SolicitudController@store');
        
        Route::get('/solicitud', 'RevisionController@index');
        Route::get('/solicitud/registrar', 'RevisionController@store');

        Route::get('/solicitud', 'ResultadoController@index');
        Route::get('/solicitud/registrar', 'ResultadoController@store');

        Route::get('/solicitud', 'RecomendacionesController@index');
        Route::get('/solicitud/registrar', 'RecomendacionesController@store');

        Route::get('/solicitud', 'GlosaController@index');
        Route::get('/solicitud/registrar', 'GlosaController@store');

        Route::get('/recepcion', 'RecepcionController@index');
        Route::post('/recepcion/registrar', 'RecepcionController@store');
        Route::put('/recepcion/actualizar', 'RecepcionController@update');
        Route::put('/recepcion/desactivar', 'RecepcionController@desactivar');
        Route::put('/recepcion/activar', 'RecepcionController@activar');
        Route::get('/recepcion/selectRecepcion', 'RecepcionController@selectRecepcion');
                
        Route::get('/preparacion', 'PreparacionController@index');
        Route::post('/preparacion/registrar', 'PreparacionController@store');
        Route::put('/preparacion/actualizar', 'PreparacionController@update');
        Route::put('/preparacion/desactivar', 'PreparacionController@desactivar');
        Route::put('/preparacion/activar', 'PreparacionController@activar');
        Route::get('/preparacion/selectPreparacion', 'PreparacionController@index');        


        Route::get('/cloruros_vol', 'Cloruros_VolController@index');
        Route::post('/cloruros_vol/registrar', 'Cloruros_VolController@store');
        Route::put('/cloruros_vol/actualizar', 'Cloruros_VolController@update');
        Route::put('/cloruros_vol/desactivar', 'Cloruros_VolController@desactivar');
        Route::put('/cloruros_vol/activar', 'Cloruros_VolController@activar');

        Route::get('/sulfatos_turb', 'Sulfatos_TurbController@index');
        Route::post('/sulfatos_turb/registrar', 'Sulfatos_TurbController@store');
        Route::put('/sulfatos_turb/actualizar', 'Sulfatos_TurbController@update');
        Route::put('/sulfatos_turb/desactivar', 'Sulfatos_TurbController@desactivar');
        Route::put('/sulfatos_turb/activar', 'Sulfatos_TurbController@activar');


        Route::get('/sulfatos_grav', 'Sulfatos_GravController@index');
        Route::post('/sulfatos_grav/registrar', 'Sulfatos_GravController@store');
        Route::put('/sulfatos_grav/actualizar', 'Sulfatos_GravController@update');
        Route::put('/sulfatos_grav/desactivar', 'Sulfatos_GravController@desactivar');
        Route::put('/sulfatos_grav/activar', 'Sulfatos_GravController@activar');

        Route::get('/ph_densidad', 'Ph_DensidadController@index');
        Route::post('/ph_densidad/registrar', 'Ph_DensidadController@store');
        Route::put('/ph_densidad/actualizar', 'Ph_DensidadController@update');
        Route::put('/ph_densidad/desactivar', 'Ph_DensidadController@desactivar');
        Route::put('/ph_densidad/activar', 'Ph_DensidadController@activar');

        Route::get('/humedad', 'HumedadController@index');
        Route::post('/humedad/registrar', 'HumedadController@store');
        Route::put('/humedad/actualizar', 'HumedadController@update');
        Route::put('/humedad/desactivar', 'HumedadController@desactivar');
        Route::put('/humedad/activar', 'HumedadController@activar');

        Route::get('/alcalinidad', 'AlcalinidadController@index');
        Route::post('/alcalinidad/registrar', 'AlcalinidadController@store');
        Route::put('/alcalinidad/actualizar', 'AlcalinidadController@update');
        Route::put('/alcalinidad/desactivar', 'AlcalinidadController@desactivar');
        Route::put('/alcalinidad/activar', 'AlcalinidadController@activar');

        Route::get('/carbonatos_pcl', 'Carbonatos_PclController@index');
        Route::post('/carbonatos_pcl/registrar', 'Carbonatos_PclController@store');
        Route::put('/carbonatos_pcl/actualizar', 'Carbonatos_PclController@update');
        Route::put('/carbonatos_pcl/desactivar', 'Carbonatos_PclController@desactivar');
        Route::put('/carbonatos_pcl/activar', 'Carbonatos_PclController@activar');

        Route::get('/espectrometria', 'EspectrometriaController@index');
        Route::post('/espectrometria/registrar', 'EspectrometriaController@store');
        Route::put('/espectrometria/actualizar', 'EspectrometriaController@update');
        Route::put('/espectrometria/desactivar', 'EspectrometriaController@desactivar');
        Route::put('/espectrometria/activar', 'EspectrometriaController@activar');

        Route::get('/granulometrico', 'GranulometricoController@index');
        Route::post('/granulometrico/registrar', 'GranulometricoController@store');
        Route::put('/granulometrico/actualizar', 'GranulometricoController@update');
        Route::put('/granulometrico/desactivar', 'GranulometricoController@desactivar');
        Route::put('/granulometrico/activar', 'GranulometricoController@activar');

        Route::get('/oxido_calcio', 'Oxido_CalcioController@index');
        Route::post('/oxido_calcio/registrar', 'Oxido_CalcioController@store');
        Route::put('/oxido_calcio/actualizar', 'Oxido_CalcioController@update');
        Route::put('/oxido_calcio/desactivar', 'Oxido_CalcioController@desactivar');
        Route::put('/oxido_calcio/activar', 'Oxido_CalcioController@activar');

        Route::get('/muestreo_cal', 'MuestreoCalController@index');
        Route::post('/muestreo_cal/registrar', 'MuestreoCalController@store');
        Route::put('/muestreo_cal/actualizar', 'MuestreoCalController@update');
        Route::put('/muestreo_cal/desactivar', 'MuestreoCalController@desactivar');
        Route::put('/muestreo_cal/activar', 'MuestreoCalController@activar');

        Route::get('/correccion_metrologica', 'Correccion_MetrologicaController@index');
        Route::post('/correccion_metrologica/registrar', 'Correccion_MetrologicaController@store');
        Route::put('/correccion_metrologica/actualizar', 'Correccion_MetrologicaController@update');
        Route::put('/correccion_metrologica/desactivar', 'Correccion_MetrologicaController@desactivar');
        Route::put('/correccion_metrologica/activar', 'Correccion_MetrologicaController@activar');

        Route::get('/cloruros_pspv', 'Cloruros_PspvController@index');
        Route::post('/cloruros_pspv/registrar', 'Cloruros_PspvController@store');
        Route::put('/cloruros_pspv/actualizar', 'Cloruros_PspvController@update');
        Route::put('/cloruros_pspv/desactivar', 'Cloruros_PspvController@desactivar');
        Route::put('/cloruros_pspv/activar', 'Cloruros_PspvController@activar');

        Route::get('/boro_volumetria', 'Boro_VolumetriaController@index');
        Route::post('/boro_volumetria/registrar', 'Boro_VolumetriaController@store');
        Route::put('/boro_volumetria/actualizar', 'Boro_VolumetriaController@update');
        Route::put('/boro_volumetria/desactivar', 'Boro_VolumetriaController@desactivar');
        Route::put('/boro_volumetria/activar', 'Boro_VolumetriaController@activar');

        Route::get('/cal_mg_complexometria', 'Cal_Mg_CompleController@index');
        Route::post('/cal_mg_complexometria/registrar', 'Cal_Mg_CompleController@store');
        Route::put('/cal_mg_complexometria/actualizar', 'Cal_Mg_CompleController@update');
        Route::put('/cal_mg_complexometria/desactivar', 'Cal_Mg_CompleController@desactivar');
        Route::put('/cal_mg_complexometria/activar', 'Cal_Mg_CompleController@activar');

        Route::get('/ph_densidad_solidas', 'Ph_Densidad_SolidasController@index');
        Route::post('/ph_densidad_solidas/registrar', 'Ph_Densidad_SolidasController@store');
        Route::put('/ph_densidad_solidas/actualizar', 'Ph_Densidad_SolidasController@update');
        Route::put('/ph_densidad_solidas/desactivar', 'Ph_Densidad_SolidasController@desactivar');
        Route::put('/ph_densidad_solidas/activar', 'Ph_Densidad_SolidasController@activar');

        Route::get('/carbonatos_mssv', 'Carbonatos_MssvController@index');
        Route::post('/carbonatos_mssv/registrar', 'Carbonatos_MssvController@store');
        Route::put('/carbonatos_mssv/actualizar', 'Carbonatos_MssvController@update');
        Route::put('/carbonatos_mssv/desactivar', 'Carbonatos_MssvController@desactivar');
        Route::put('/carbonatos_mssv/activar', 'Carbonatos_MssvController@activar');

        Route::get('/carbonatos_oxidrilos', 'Carbonatos_OxidrilosController@index');
        Route::post('/carbonatos_oxidrilos/registrar', 'Carbonatos_OxidrilosController@store');
        Route::put('/carbonatos_oxidrilos/actualizar', 'Carbonatos_OxidrilosController@update');
        Route::put('/carbonatos_oxidrilos/desactivar', 'Carbonatos_OxidrilosController@desactivar');
        Route::put('/carbonatos_oxidrilos/activar', 'Carbonatos_OxidrilosController@activar');

        Route::get('/turbidez_conductividad', 'Turbidez_ConductividadController@index');
        Route::post('/turbidez_conductividad/registrar', 'Turbidez_ConductividadController@store');
        Route::put('/turbidez_conductividad/actualizar', 'Turbidez_ConductividadController@update');
        Route::put('/turbidez_conductividad/desactivar', 'Turbidez_ConductividadController@desactivar');
        Route::put('/turbidez_conductividad/activar', 'Turbidez_ConductividadController@activar');

        Route::get('/potasio_valoracion', 'Potasio_ValoracionController@index');
        Route::post('/potasio_valoracion/registrar', 'Potasio_ValoracionController@store');
        Route::put('/potasio_valoracion/actualizar', 'Potasio_ValoracionController@update');
        Route::put('/potasio_valoracion/desactivar', 'Potasio_ValoracionController@desactivar');
        Route::put('/potasio_valoracion/activar', 'Potasio_ValoracionController@activar');

        Route::get('/potasio_gravimetria', 'Potasio_GravimetriaController@index');
        Route::post('/potasio_gravimetria/registrar', 'Potasio_GravimetriaController@store');
        Route::put('/potasio_gravimetria/actualizar', 'Potasio_GravimetriaController@update');
        Route::put('/potasio_gravimetria/desactivar', 'Potasio_GravimetriaController@desactivar');
        Route::put('/potasio_gravimetria/activar', 'Potasio_GravimetriaController@activar');

        Route::get('/trazas_aa', 'Trazas_AaController@index');
        Route::post('/trazas_aa/registrar', 'Trazas_AaController@store');
        Route::put('/trazas_aa/actualizar', 'Trazas_AaController@update');
        Route::put('/trazas_aa/desactivar', 'Trazas_AaController@desactivar');
        Route::put('/trazas_aa/activar', 'Trazas_AaController@activar');

    });

    
});


//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
