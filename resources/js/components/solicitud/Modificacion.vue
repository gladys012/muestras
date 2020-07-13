|<template>


    <main class="main">
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
    </ol>            
        <div class="col-sm-12">
         <div class="card">
             <div class="container">
                <h1>Modificación de solicitud de ensayo y atención al cliente</h1>
                <!--h2><p>F-A4-01-02 </p></h2-->
              
             <div class="row">
                 <!--h3>Realice la búsqueda de la solicitud de ensayo</h3-->                    
                <div class="form-group col-sm-6">
                        <label for="postal-code">Nro. de registro</label>
                        <input class="form-control" v-model="nro_registro_busq" type="text" placeholder="Nro. de registro">
                    </div>
                <div class="form-group col-sm-6">
                    <label for="">Unidad</label>
                      <v-select
                        :on-search="selectUnidadBusq"
                        label="unidad"
                        :options="arrayUnidadBusq"
                        placeholder="Buscar Unidad"
                        :onChange="getDatosUnidadBusq" 
                      >
                      <span slot="no-options">No existen registros</span>
                      </v-select>
                </div>
                <div class="form-group col-sm-6">
                    <label for="">C.I.</label>
                      <v-select
                        :on-search="selectPersonaCiBusq"
                        label="ci"
                        :options="arrayPersonaBusq"
                        placeholder="Buscar Personas por CI."
                        :onChange="getDatosCiBusq"  
                      >
                      <span slot="no-options">No existen registros</span>
                      </v-select>
                </div>
                  <div class="form-group col-sm-6">
                    <label for="">Apellido Paterno</label>
                      <v-select
                        :on-search="selectPersonaBusq"
                        label="paterno"
                        :options="arrayPersonaBusq"
                        placeholder="Buscar Personas por apellido paterno"
                        :onChange="getDatosPerPaternoBusq"  
                      >
                      <span slot="no-options">No existen registros</span>
                      </v-select>
                </div>
                <div class="form-group col-sm-6">
                    <input class="form-control" v-model="nombreciBusq" type="text" placeholder="Nombre de persona" disabled>
                </div>
                <div class="form-group col-sm-6">
                    <input class="form-control" v-model="nombrePaternoBusq" type="text" placeholder="Nombre" disabled>
                </div>
                <div class="form-group col-sm-12">
                    <b-alert
                        :show="dismissCountDown"
                        dismissible
                        variant="danger"
                        @dismiss-count-down="countDownChanged">
                            Llene un campo para realizar la búsqueda
                    </b-alert>
                </div>
                <div class="form-group col-sm-12">
                    <b-alert
                        :show="dismissCountDown2"
                        dismissible
                        variant="danger"
                        @dismiss-count-down="countDownChanged2">
                            No existen registros
                    </b-alert>
                </div>
                <div class="form-group col-sm-12">
                 
                <b-button type="submit" variant="primary" @click="buscarDatosSolicitud(unidad_busq,idPersona,ciBusq,nro_registro_busq)">Buscar datos</b-button>
                </div>
             </div>  
             <!--button type="button" title="busqueda" @click="buscarDatosSolicitud(unidad_busq,paternoBusq,ciBusq,nro_registro_busq)" class="btn btn-sm">
                <i class="icon-search" style="color:white"></i>Buscar datos
            </button--> 
            
             </div>             
           <div class="col-sm-12">
            <div class="card">
            <table class="table table-responsive-sm table-bordered table-striped table-sm">
                <thead>
                    <tr>                    
                    <th>Nro registro</th>
                    <th>Unidad</th>
                    <th>CI. Responsable</th>
                    <th>Responsable</th>
                    <th>CI. Encargado</th>
                    <th>Encargado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="busqueda in arrayBusqueda" :key="busqueda.id">                                    
                        <td v-text="busqueda.nro_registro"></td>
                        <td v-text="busqueda.unidad"></td>
                        <td v-text="busqueda.ciR"></td>
                        <td v-text="busqueda.paternoR +' '+busqueda.maternoR+' '+busqueda.nombreR"></td>
                        <td v-text="busqueda.ciE"></td>
                        <td v-text="busqueda.paternoE +' '+busqueda.maternoE+' '+busqueda.nombreE"></td>
                        <td>                                                                                   
                            <button type="button" @click="mostrarDatosSolicitud(busqueda)" class="btn btn-info pull-right">
                                    <font bold color="white">Modificar</font>
                            </button>
                        </td>                                    
                     </tr>                                                                                   
                </tbody>
                </table>     
             </div>
            </div>











           <div class="col-sm-12" v-if="datosModificar==1">
            <div class="card">
            <div class="card-header"><strong>Solicitud de ensayo</strong></div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="city">Fecha</label>
                        <datepicker 
                            :bootstrap-styling="true"
                            :language="es"
                            calendar-class="datepicker1"                            
                            input-class="form-control col-sm-6 size:30"
                            :open-date="openDate"
                            :format="customFormatterSolEn"
                            v-model="fecha_registro">
                        </datepicker>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="postal-code">Nro. de registro</label>
                        <input class="form-control" v-model="nro_registro" type="text" placeholder="Número de registro" disabled>
                    </div>
                    <div class="form-group col-sm-9">
                        <label for="city">Unidad</label>
                        <input class="form-control" v-model="unidad" type="text" placeholder="Unidad solicitante">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="postal-code">Teléfono</label>
                        <input class="form-control" v-model="telefono_unidad" type="text" placeholder="Teléfono de referencia">
                    </div>
                </div>                    
                 <div class="row">
                 <div class="form-group col-sm-6">
                    <label for="">Responsable</label>
                      <v-select
                        :on-search="selectPersona"
                        label="ci"
                        :options="arrayPersonaci"
                        placeholder="Buscar Personas por CI."
                        :onChange="getDatosResponsable"    
                        v-model="ciRes"                                        
                      >
                      <span slot="no-options">No existen registros</span>
                      <input slot="no-options" v-if="responsable==1" @click="abrirModalPersonaRes('solicitud','registrarResponsable')" class="form-control btn btn-info" type="button" value="Adicionar Persona" />
                      </v-select>
                </div>
                  <div class="form-group col-sm-6">
                    <label for="">Encargado</label>
                      <v-select
                        :on-search="selectPersona"
                        label="ci"
                        :options="arrayPersonaci"
                        placeholder="Buscar Personas por CI."
                        :onChange="getDatosEncargado"  
                        v-model="ciEnc"
                      >
                      <span slot="no-options">No existen registros</span>
                      <input slot="no-options" v-if="responsable==1" @click="abrirModalPersonaRes('solicitud','registrarEncargado')" class="form-control btn btn-info" type="button" value="Adicionar persona" />
                      </v-select>
                </div>
                <div class="form-group col-sm-6">
                    <input class="form-control" v-model="nombreResponsable" type="text" placeholder="Responsable" disabled>
                </div>
                <div class="form-group col-sm-6">
                    <input class="form-control" v-model="nombreEncargado" type="text" placeholder="Encargado" disabled>
                </div>
                </div>
                <!-- /.row-->  
                <div v-if="verificaError == 1" v-show="errorSolicitud" class="form-group row div-error">
                    <div class="text-center text-error">
                        <div v-for="error in errorMostrarMsjSolicitud" :key="error" v-text="error">

                        </div>  
                    </div>
                </div>                   
            </div>
            </div>
        </div> 
        <!-- /. solicitud-->  
                
        <div v-if="datosModificar==1">
        <div class="col-sm-12">
            <div class="card">
            <div class="card-header"><i class="fa fa-align-justify"></i><strong>Información de la Solicitud</strong> 
                <button type="button" data-toggle="modal" data-target="#modalInformacionSol" @click="abrirModalInfSol('solicitud','registrar')" class="btn btn-info pull-right" style="right:0;">
                   + Nuevo
                </button>
            </div> 
            <div class="card-body">
                <table class="table table-responsive-sm table-bordered table-striped table-sm">
                <thead>
                    <tr>                    
                    <th>Cantidad</th>
                    <th>Flujo de muestras</th>
                    <th>Matriz</th>
                    <th>Analito de interés</th>
                    <th>Descripción de la procedencia</th>                            
                    <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <tr v-for="solicitud in arrayinfoSolicitud" :key="solicitud.id">                                    
                        <td v-text="solicitud.cantidad"></td>
                        <td v-text="solicitud.flujo"></td>
                        <td v-text="solicitud.matriz"></td>
                        <td v-text="solicitud.analito"></td>
                        <td v-text="solicitud.des_procedencia"></td>
                        <td>                            
                            <a href="#" data-toggle="modal" data-target="#modalInformacionSol" @click="abrirModalInfSol('solicitud','actualizar',solicitud)">
                                <i class="fa fa-edit info" style="font-size: 23px"></i>
                            </a>                            
                            <a href="#" @click="eliminarInfSol(solicitud.id)">
                                <i class="fa fa-trash" style="font-size: 23px"></i>
                            </a>
                        </td>                                    
                     </tr>                                                                                   
                </tbody>
                </table>                
            </div>
            </div>
        </div>
        <div class="col-sm-12" v-if="datosModificar==1">
            <div class="card">
            <div class="card-header"><strong>Revisión de la oferta</strong></div>
            <div class="card-body">                                                      
                <div class="form-group row">                                
                    <label class="col-sm-10 form-control-label" for="text-input"> PERSONAL TECNICO CAPACITADO </label>
                    <div class="col-md-2">
                        <div class="container">
                            <div class="box">
                                <div class="checkbox-group">
                                <input id="checkboxName3" type="checkbox" v-model="personal_capacitado"/>
                                <label for="checkboxName3" class="ta"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <label class="col-sm-10 form-control-label" for="text-input">DISPONIBILIDAD DE TIEMPO</label>
                    <div class="col-md-2">
                         <div class="container">
                            <div class="box">
                                <div class="checkbox-group">
                                <input id="checkboxName4" type="checkbox" v-model="disponibilidad"/>
                                <label for="checkboxName4" class="ta"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <label class="col-sm-10 form-control-label" for="text-input">MATERIALES Y REACTIVOS DISPONIBLES </label>
                    <div class="col-md-2">
                        <div class="container">
                            <div class="box">
                                <div class="checkbox-group">
                                <input id="checkboxName5" type="checkbox" v-model="materiales"/>
                                <label for="checkboxName5" class="ta"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <label class="col-sm-10 form-control-label" for="text-input">EQUIPOS CON CALIBRACIONES VIGENTES </label>
                    <div class="col-md-2">
                        <div class="container">
                            <div class="box">
                                <div class="checkbox-group">
                                <input id="checkboxName6" type="checkbox" v-model="equipos"/>
                                <label for="checkboxName6" class="ta"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <label class="col-sm-10 form-control-label" for="text-input">  INSTALACIONES (MANIPULACION Y MANTENIMIENTO) </label>
                    <div class="col-md-2">
                        <div class="container">
                            <div class="box">
                                <div class="checkbox-group">
                                <input id="checkboxName7" type="checkbox" v-model="instalaciones"/>
                                <label for="checkboxName7" class="ta"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <label class="col-sm-10 form-control-label" for="text-input"> METODO DE ENSAYO DOCUMENTADO Y VALIDADO </label>
                    <div class="col-md-2">
                        <div class="container">
                            <div class="box">
                                <div class="checkbox-group">
                                <input id="checkboxName8" type="checkbox" v-model="metodo"/>
                                <label for="checkboxName8" class="ta"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">                                    
                    <hr>
                        <div class="form-group col-sm-6">
                            <label for="postal-code">Observaciones</label>
                            <textarea cols="90" rows="4" v-model="observ_revision" placeholder="Observaciones"  class="form-control"></textarea>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="postal-code">Aclaraciones</label>
                            <textarea cols="90" rows="4" v-model="aclaraciones" placeholder="Aclaraciones" class="form-control"></textarea>
                        </div>
                    </div>
                    <label class="col-sm-6 form-control-label" for="text-input">El trabajo solicitado es:</label>                   
                    
                    <div class="container">
                        <div class="box">
                            <div class="checkbox-group">
                            <input id="checkboxName1" type="checkbox" v-model="aceptado" @change="checkBoxSol(0)"/>
                            <label for="checkboxName1" class="ta">Aceptado</label>
                            <input id="checkboxName2" type="checkbox" v-model="rechazado" @change="checkBoxSol(1)"/>
                            <label for="checkboxName2" class="ta">Rechazado</label>
                            </div>
                        </div>
                    </div>
                    <div v-if="verificaError == 1" v-show="errorRevision" class="form-group row div-error">
                        <div class="text-center text-error">
                        <div v-for="error in errorMostrarMsjSolicitud" :key="error" v-text="error">

                        </div>  
                      </div>
                    </div>   
                </div>                    
            </div>
            </div>
        </div> 
        <div class="col-sm-12" v-if="datosModificar==1">
            <div class="card">
            <div class="card-header"><strong>Reporte de Resultados</strong></div>
            <div class="card-body">                                                      
                <div class="form-group row">                                               
                    <div class="container">
                        <div class="box">
                            <div class="checkbox-group">
                            <input id="checkboxName8" type="checkbox" v-model="soporte_impreso" @change="checkBoxResul(0)"/>
                            <label for="checkboxName8" class="ta"> SOPORTE IMPRESO </label>
                            <input id="checkboxName9" type="checkbox" v-model="correo" @change="checkBoxResul(1)"/>
                            <label for="checkboxName9" class="ta"> CORREO ELECTRÓNICO </label>
                            </div>
                        </div>
                    </div> 
                    <div v-if="verificaError == 1" v-show="errorResultados" class="form-group row div-error">
                          <div class="text-center text-error">
                            <div v-for="error in errorMostrarMsjSolicitud" :key="error" v-text="error">

                            </div>  
                         </div>
                        </div>
                    <div v-if="correo==true" class="form-group col-sm-6">                                
                        <label  for="text-input">Destinatario</label>
                        <input type="text" v-model="destinatario" class="form-control" placeholder="Destinatario">
                    </div>    
                    <div v-if="correo" class="form-group col-sm-6">                        
                        <label for="text-input">Correo</label>
                        <textarea cols="90" rows="1" placeholder="Correo" v-model="correo_destinatario" class="form-control"></textarea>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="postal-code">Observaciones</label>
                        <textarea cols="90" rows="3" placeholder="Observaciones" v-model="observ_resultado" class="form-control"></textarea>
                    </div> 
                    <div class="form-group col-sm-6">
                        <label for="postal-code">Disposiciones finales</label>
                        <textarea cols="90" rows="3" placeholder="Disposiciones finales" v-model="disposiciones" class="form-control"></textarea>
                    </div>                       
                </div>                    
            </div>
            </div>
        </div> 
        <div class="col-sm-12">
            <div class="card">
            <div class="card-header"><i class="fa fa-align-justify"></i><strong>Recomendaciones de mejora (Métodos de ensayo, servicios, etc.)</strong> 
                <button type="button" @click="abrirModalRecomend('recomendaciones','registrar')" class="btn btn-info pull-right" style="right:0;">
                    <font bold color="white">+ Nuevo</font>
                </button>
            </div> 
            <div class="card-body">
                <table class="table table-responsive-sm table-bordered table-striped table-sm">
                <thead>
                    <tr>                    
                    <th>Fecha</th>
                    <th>Recomendaciones(cliente)</th>
                    <th>Respuesta(encargado de laboratoio)</th>
                    <th>VoBo</th>
                    <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="recomendaciones in arrayRecomendaciones" :key="recomendaciones.id">                                    
                        <td v-text="recomendaciones.fecha_recom"></td>
                        <td v-text="recomendaciones.recomendaciones"></td>
                        <td v-text="recomendaciones.respuesta"></td>
                        <td v-text="recomendaciones.vobo"></td>
                        <td>                            
                            <a href="#" @click="abrirModalRecomend('recomendaciones','actualizar',recomendaciones)">
                                <i class="fa fa-edit info" style="font-size: 23px"></i>
                            </a>                            
                            <a href="#" @click="eliminarRecomendaciones(recomendaciones.id)">
                                <i class="fa fa-trash" style="font-size: 23px"></i>
                            </a>
                        </td>                                    
                     </tr>                          
                </tbody>
                </table>
            </div>
            </div>
        </div>
        <!-- fin tabla recomendaciones-->

    <div class="col-sm-12" v-if="datosModificar==1">
        <div class="card">
        <div class="card-header"><strong>Conformidad</strong></div>
        <div class="card-body">
        <table class="table table-responsive-sm table-bordered table-striped table-sm">
            <tr>
                <th scope="row">Datos</th>
                <th>Solicitud atendida por</th>
                <th>Solicitante</th>
            </tr>
                <tr>
                    <th>Fecha</th>
                    <td>
                        <datepicker 
                            :bootstrap-styling="true"
                            :language="es"
                            calendar-class="datepicker1"                            
                            input-class="form-control col-sm-6"
                            :open-date="openDate"
                            :format="customFormatterAtend"
                            v-model="fecha_atendida">
                        </datepicker></td>
                        <td>
                            <datepicker 
                                :bootstrap-styling="true"
                                :language="es"
                                calendar-class="datepicker1"                            
                                input-class="form-control col-sm-6"
                                :open-date="openDate"
                                :format="customFormatterSolici"
                                v-model="fecha_solicitante">
                            </datepicker></td>
                </tr>
                <tr>
                    <th>Nombre</th>
                    <td><input v-model="nombre_atendida" type="text" class="form-control"></td>
                    <td><input v-model="nombre_solicitante" type="text" class="form-control"></td>
                </tr>
                <tr>
                    <th>Cargo</th>
                    <td><input v-model="cargo_per_atendida" type="text" class="form-control"></td>
                    <td><input v-model="cargo_per_solicitante" type="text" class="form-control"></td>
                </tr>
         </table>
         <div v-if="verificaError == 1" v-show="errorConformidad" class="form-group row div-error">
            <div class="text-center text-error">
            <div v-for="error in errorMostrarMsjSolicitud" :key="error" v-text="error">

            </div>  
            </div>
        </div>
         <p>* Toda revisión y comunicación con el cliente, será registrada:</p>
         <p>- En este formulario, si la revisión afecta todo el servicio en general</p>
         <p>- En el de Recepción de muestras (F-A4-01-03), si la revisión afecta parcial u ocasionalmente el servicio </p>
         <p>- En caso de haber evidencia documentada (p.e. Nota Interna), será adjunta al presente contrato. </p>
        </div>
       </div>
    </div>

    <div class="col-sm-12" style="justify-content: center;">        
      <button type="button" class="btn btn-secondary" @click="cerrarModal()"><font color="white">Cancelar</font></button>
      <button type="button" class="btn btn-primary" @click="RegistrarSolicitudMod()"><font color="white">Guardar Datos</font></button>
    </div>
<p></p>
<hr>

    <!--Inicio del modal agregar/  persona-->
    <div class="modal fade" :class="{'mostrar1' : modal1}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" v-text="tituloModal"></h4>
                    <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="city">Nombre</label>
                                <input class="form-control" v-model="nombre" type="text" placeholder="Nombre">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="postal-code">Paterno</label>
                                <input class="form-control" v-model="paterno" type="text" placeholder="Paterno">
                            </div>                            
                            <div class="form-group col-lg-4">
                                <label for="postal-code">Materno</label>
                                <input class="form-control" v-model="materno" type="text" placeholder="Materno">
                            </div>
                        </div>
                        <!-- /.row-->
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="city">Carnet Identidad</label>
                                <input class="form-control" v-model="ciResponsable" type="text" placeholder="Carnet de identidad" disabled>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="postal-code">Teléfono</label>
                                <input class="form-control" v-model="telefono" type="text" placeholder="Teléfono">
                            </div>                            
                            <div class="form-group col-lg-4">
                                <label for="postal-code">Email</label>
                                <input class="form-control" v-model="email" type="text" placeholder="Correo Electrónico">
                            </div>
                        </div>
                        <!-- /.row--> 
                        <div class="row">                                    
                            <div class="form-group col-lg-8">
                                <label for="postal-code">Dirección</label>
                                <input class="form-control" v-model="direccion" type="text" placeholder="Dirección">
                            </div>
                        </div>
                        <!-- /.row--> 
                        <div v-show="errorPersona" class="form-group row div-error">
                            <div class="text-center text-error">
                                <div v-for="error in errorMostrarMsjPersona" :key="error" v-text="error">

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                    <button type="button" class="btn btn-primary" @click="registrarPersona()">Guardar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialvue-datepickerog -->
    </div>
    <!--Fin del modal-->

 <!--Inicio del modal agregar/actualizar  solicitud-->
    <div class="modal fade" :class="{'mostrar1' : modal2}" tabindex="-1" role="dialog" aria-labelledby="modalInformacionSolTit" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" v-text="tituloModal"></h4>
                    <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="city">Cantidad</label>
                                <input class="form-control" v-model="cantidad" type="text" placeholder="Cantidad">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="postal-code">Flujo de muestras</label>
                                <input class="form-control" v-model="flujo" type="text" placeholder="Flujo de muestras">
                            </div>
                        </div>
                        <!-- /.row-->
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="city">Matriz</label>
                                <input class="form-control" v-model="matriz" type="text" placeholder="Matriz">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="postal-code">Analito de interés</label>
                                <input class="form-control" v-model="analito" type="text" placeholder="Analito de interés">
                            </div>
                        </div>
                        <!-- /.row--> 
                        <div class="row">                                    
                            <div class="form-group col-sm-12">
                                <label for="postal-code">Descripción de la procedencia</label>
                                <textarea cols="90" rows="4" placeholder="Descripción de la procedencia" v-model="des_procedencia" class="form-control"></textarea>
                            </div>
                        </div>
                        <!-- /.row--> 
                        <div v-show="errorInfSolicitud" class="form-group row div-error">
                            <div class="text-center text-error">
                                <div v-for="error in errorMostrarMsjsolicitud" :key="error" v-text="error">

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModal()" data-dismiss="modal">Cerrar</button>
                    <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="crearInfSolicitud()" data-dismiss="modal">Guardar</button>
                    <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarInfSolicitud(solicitud.id)" data-dismiss="modal">Actualizar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialvue-datepickerog -->
    </div>
    <!--Fin del modal-->
    <!--Inicio del modal agregar/actualizar  recomdendaciones-->
    <div class="modal fade" :class="{'mostrar1' : modal3}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" v-text="tituloModal"></h4>
                    <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="city">Fecha</label>
                                <datepicker 
                                    :bootstrap-styling="true"
                                    :language="es"
                                    calendar-class="datepicker1"                                    
                                    input-class="form-control col-md-6"
                                    :open-date="openDate"
                                    :format="customFormatterRecom"
                                    v-model="fecha_recom">
                                </datepicker>                            </div>
                            <div class="form-group col-sm-6">
                                <label for="city">Recomendaciones</label>
                                <input class="form-control" v-model="recomendaciones" type="text" placeholder="Recomendaciones (cliente)">
                            </div>                            
                        </div>
                        <!-- /.row-->
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="postal-code">Respuesta</label>
                                <input class="form-control" v-model="respuesta" type="text" placeholder="Respuesta (encargado de laboratorio)">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="city">VoBo</label>
                                <input class="form-control" v-model="vobo" type="text" placeholder="VoBo">
                            </div>
                        </div>
                        <div v-show="errorRecomendaciones" class="form-group row div-error">
                            <div class="text-center text-error">
                                <div v-for="error in errorMostrarMsjsolicitud" :key="error" v-text="error">

                                </div>
                            </div>
                        </div>
                    </form> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                    <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="crearRecomendaciones()">Guardar</button>
                    <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarRecomendaciones(recomendaciones.id)">Actualizar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialvue-datepickerog -->
     </div>
    <!--Fin del modal-->    
 
    <div class="modal fade" :class="{'mostrar1' : modal4}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" v-text="tituloModal"></h4>
                    <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="card-header"><i class="fa fa-align-justify"></i><strong>Modificaciones al contrato</strong> 
                </div>                
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="row">
                            <div class="form-group col-sm-3">
                                <label for="city">Fecha</label>
                                <!--input class="form-control" v-model="fecha_mod" type="text" placeholder="Fecha"-->
                                <b-form-datepicker id="example-datepicker" v-model="fecha_mod" class="mb-2"></b-form-datepicker>
                                 <!--datepicker 
                                :bootstrap-styling="true"
                                :language="es"
                                calendar-class="datepicker1"                            
                                input-class="form-control col-sm-6"
                                :open-date="openDate"
                                :format="customFormatterModif"
                                v-model="fecha_mod">
                            </datepicker-->
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="city">Nombre Solicitante</label>
                                <input class="form-control" v-model="nombre_mod" type="text" placeholder="Nombre Solicitante">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="postal-code">Cargo</label>
                                <input class="form-control" v-model="cargo_mod" type="text" placeholder="Cargo">
                            </div>                            
                        </div>
                        <!-- /.row-->
                        <div class="row">                            
                            <div class="form-group col-sm-12">
                                <label for="city">Descripcion</label>
                            <textarea cols="90" rows="4" v-model="descripcion_mod" placeholder="Descripcion de la modificación"  class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">  
                            <button type="button" class="btn btn-primary" @click="crearModificaciones()">Adicionar datos</button>
                        </div>
                        <!--div v-show="errorModificaciones" class="form-group row div-error">
                            <div class="text-center text-error">
                                <div v-for="error in errorMostrarMsjsolicitud" :key="error" v-text="error">

                                </div>
                            </div>
                        </div-->
                    </form> 
                         <div class="col-sm-12">
                            <div class="card">
                            <div class="card-header"><i class="fa fa-align-justify"></i><strong>Datos</strong>                                 
                            </div> 
                            <div class="card-body">
                                <table class="table table-responsive-sm table-bordered table-striped table-sm">
                                <thead>
                                    <tr>                    
                                    <th>Fecha</th>
                                    <th>Nombre solicitante</th>
                                    <th>Cargo solicitante</th>
                                    <th>Descripcion Modificación</th>
                                    <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="modificaciones in arrayModificaciones" :key="modificaciones.id">                                    
                                        <td v-text="modificaciones.fecha_mod"></td>
                                        <td v-text="modificaciones.nombre_mod"></td>
                                        <td v-text="modificaciones.cargo_mod"></td>
                                        <td v-text="modificaciones.descripcion_mod"></td>
                                        <td>                            
                                            <a href="#" @click="actualizarModificaciones(modificaciones)">
                                                <i class="fa fa-edit info" style="font-size: 23px"></i>
                                            </a>                            
                                            <a href="#" @click="eliminarModificaciones(modificaciones.id)">
                                                <i class="fa fa-trash" style="font-size: 23px"></i>
                                            </a>
                                        </td>                                    
                                    </tr>                          
                                </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                        <!-- fin tabla MODIFICACIONES-->
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                    <button type="button" class="btn btn-primary" @click="guardarModificacionesTabla()">Guardar datos Modificación</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialvue-modificaciones -->
    </div>
    <!--Fin del modal-->    

    </div></div>
    <!-- /.col-->
    </div>
        <!-- /.row-->
  </main>         
</template>

<script>
   // import datables from 'datatables'
    import vSelect from 'vue-select';
    import Datepicker from 'vuejs-datepicker';
    import { es } from 'vuejs-datepicker/dist/locale';
    import moment from "moment";
    //import './resources/assets/css/modal.css';
       

    export default {
        data (){
         
            return {
                es: es,
                //fecha_registro: new Date(),
                openDate: new Date(),
                selectedDate: '',
                bootstrapStyling: true,

                dismissSecs: 5,
                dismissCountDown: 0,
                dismissCountDown2: 0,
                //date: new Date(2016, 9, 16),
                //modificacion
                nombreciBusq:'',
                nombrePaternoBusq:'',
                arrayPersonaPaterBusq:[],
                arrayPersonaBusq:[],
                nro_registro_busq:'',
                unidad_busq:'',
                ciBusq:'',
                paternoBusq:'',
                arrayUnidadBusq:[],
                arrayBusqueda:[],
                verifica1:0,
                verifica2:0,
                datosModificar:0,
                idPersona:'',
                busquedaResponsable:'',
                busquedaEncargado:'',
                arrayRevision:[],
                arrayResultado:[],

                idSolRegistroMod:0,
                idResponsableBusq:'',
                idEncargadoBusq:'',
                arrayModificaciones:[],
                
                //tabla glosa
                fecha_mod:'',
                nombre_mod:'',
                cargo_mod:'',
                descripcion_mod:'',
                modificacion_id:0,


              //persona
               ciPersona:'',
               nombre:'',
               paterno:'',
               materno:'',
               ci:'',
               telefono:'',
               direccion:'',
               email:'',               
               arrayPersonaci:[],
               arrayCategoria:[],
               errorMostrarMsjPersona:[],
               errorPersona:0,
               ciResponsable:'',
               nombreResponsable:'',
               nombreEncargado:'',               
               ciRes:'',
               ciEnc:'',
               idresponsable:1,
               idencargado:1,
               responsable:0,
               encargado:0,
            

               //Informacion solicitud
               arrayinfoSolicitud:[],
               cantidad:'',
               flujo:'',
               matriz:'',
               analito:'',
               des_procedencia:'',
               idActualizar: -1,
               solicitud_id:0,

              //revision
               personal_capacitado:'',
               materiales:'',
               instalaciones:'',
               disponibilidad:'',
               observ_revision:'',
               metodo:'',
               aclaraciones:'',
               instalaciones:'',
               aceptado:'',
               rechazado:'',

               //revision
               soporte_impreso:'',
               correo:'',
               correo_destinatario:'',
               destinatario:'',               
               disposiciones:'',
               Observaciones_rev:'',
               equipos:'',

               //recomendaciones

               recomendaciones_id:0,
               arrayRecomendaciones:[],
               recomendaciones:'',
               respuesta:'',
               vobo:'',  
               fecha_recom:'',                            
               
               //CONFORMIDAD
               fecha_atendida:new Date(),
               fecha_solicitante:new Date(),
               nombre_atendida:'',
               nombre_solicitante:'',
               cargo_per_atendida:'',
               cargo_per_solicitante:'',

               //solicitud de ensayo
               fecha_registro:new Date(),
               nro_registro:'',               
               registraDatos:0,
               disp_finales:'',
               codigo:'',
               cantidad:0,
              // fecha:'',
               arraySolEnsayo:[],
               idSolEnsayo:'',
              
               
               //unidad_solicitante 
               arrayUnidadSol:[],
               telefono_unidad:'',
               unidad:'', 
               idUnidadSol:'',
                
               usr_id:1,
               encargado:'',
               
               responsable:0,
               observ_resultado:'',                               
                                             
               fecha_resultado:'',
               solicitante_resultado:'',
               cargo_resultado:'',
               fecha_recomendaciones:'',
               descripcion:'',
               responsable:'',
               modal:0,
               modal1:0,
               modal2:0,
               modal3:0,
               modal4:0,
               modal5:0,
               tituloModal:'',
               tipoAccion:0,
               errorModificaciones:0,
               errorSolicitud: 0,
               errorPersona: 0,
               errorInfSolicitud:0,
               errorRecomendaciones: 0,
               errorRevision: 0,
               errorResultados: 0,
               errorResultado: 0,
               errorConformidad: 0,
               errorMostrarMsjsolicitud:[],
               
               verificaError:0,
               verificaMod:0,

                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'codigo',
                buscar : '',



                perPage: ['10', '25', '50'],
            colums: [
                {
                    label: 'ID',
                    name: 'id',
                    filterable: true,
                },
                {
                    label: 'Name',
                    name: 'nombre',
                    filterable: true,
                },
                {
                    label: 'Email',
                    name: 'email',
                    filterable: true,
                },
                {
                    label: '',
                    name: 'View',
                    filterable: false,
                },
            ]
            }
        },
        components: {
            vSelect,
            Datepicker
          },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },           
        },
        methods : {
            prueba(){
                console.log('prueba***-11***111');
            },
            customFormatterRecom(date) {
                return moment(date).format('D/MM/YYYY');
            },
            customFormatterSolEn(date) {
                return moment(date).format('D/MM/YYYY');
            },
            customFormatterAtend(date) {
                return moment(date).format('D/MM/YYYY');
            },
            customFormatterSolici(date) {
                return moment(date).format('D/MM/YYYY');
            },
            customFormatterModif(date) {
                return moment(date).format('D/MM/YYYY');
            },      
             listarSolNroRegistro(){
                let me=this;
                var url= '/solicitudSolEnsayo/nroRegistro';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    console.log(respuesta,'respuesta');
                    me.nro_registro = respuesta.solicitud_ensayo+1;
                  //  me.nro_registro = me.nro_registro+1;
                  
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectPersonaCiBusq(search,loading){
                let me=this;
                loading(true)
                var url= '/solicitudPersona/selectPersonaCi?filtro='+search;
                axios.get(url).then(function (response) {
                    let respuesta= response.data;
                    console.log(respuesta,'respuesta');
                    q: search
                    me.arrayPersonaBusq= respuesta.personas;
                    if (me.arrayPersonaCiBusq!='') {
                      me.responsable=1;
                      me.encargado=1;
                    }
                    console.log(me.arrayPersonaCiBusq,'select 3');
                    loading(false);                   
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectPersonaBusq(search,loading){
                let me=this;
                loading(true)
                var url= '/solicitudPersona/selectPersona?filtro='+search;
                axios.get(url).then(function (response) {
                    let respuesta= response.data;
                    console.log(respuesta,'respuesta');
                    q: search
                    me.arrayPersonaBusq= respuesta.personas;
                    console.log(me.arrayPersonaBusq,'array pwersona');
                    loading(false);                   
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getDatosCiBusq(valP){
              console.log(valP,'dato valp');
              let me = this;
              me.loading = true;
              if (valP == null || valP == '') {
                  console.log(valP,'valP');
                  me.nombreciBusq='';
                  me.ciBusq = '';
              }else {
                  me.ciBusq = valP.ci;
                  console.log(me.ciBusq,'ci bus****');
                  if (valP.materno=='' || valP.materno==null) {
                    me.nombreciBusq = valP.paterno +' '+ valP.nombre;   
                  }else{
                    me.nombreciBusq = valP.paterno +' '+ valP.materno +' '+ valP.nombre;    
                  }
               }
            },
            getDatosPerPaternoBusq(val1){
              console.log(val1,'dato val1 pater');
              let me = this;
              me.loading = true;
              if (val1 =='') {
                 me.nombrePaternoBusq='';
                 me.idPersona='';
              }else{
                  if (val1.materno=='' || val1.materno==null) {
                    me.nombrePaternoBusq = val1.paterno +' '+ val1.nombre;   
                  }else{
                    me.nombrePaternoBusq = val1.paterno +' '+ val1.materno + ' ' + val1.nombre +' ';
                    me.idPersona = val1.id;
                  }
              }              
            },            
            selectUnidadBusq(search,loading){
                let me=this;
                loading(true)
                var url= '/solicitudUnidad/selectUnidad?filtro='+search;
                axios.get(url).then(function (response) {
                    let respuesta= response.data;
                    console.log(respuesta,'respuesta');
                    q: search
                    me.arrayUnidadBusq= respuesta.unidad_solicitante;
                    console.log(me.arrayUnidadBusq,'select 3');
                    loading(false);                   
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getDatosUnidadBusq(valU){
              console.log(valU,'dato valU');
              let me = this;
              me.loading = true;
              if (valU == null || valU == '') {
                  console.log(valU,'123456789');
                  me.unidad_busq='';
              }else {
                  me.unidad_busq = valU.unidad;
              }                   
            },
            countDownChanged(dismissCountDown) {
                this.dismissCountDown = dismissCountDown
            },
            countDownChanged2(dismissCountDown2) {
                this.dismissCountDown2 = dismissCountDown2
            },
            buscarDatosSolicitud(unidad,idpaterno,ci,nro_reg){
                console.log('entra11', unidad);
                console.log('entra22', ci);
                console.log('entra33', idpaterno);
                console.log('entra4', nro_reg);
                if (unidad=='' && ci=='' && idpaterno=='' && nro_reg=='') {
                     this.dismissCountDown = this.dismissSecs
                }
               
                let me=this;
                if (unidad!='' || idpaterno!='' || ci!='' || nro_reg!='' ) {
                    var url= '/solicitudModificacion/busquedaDatos?unidad='+ unidad + '&idpaterno='+ idpaterno + '&ci='+ ci + '&nro_reg=' + nro_reg;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    console.log(respuesta,'respuesta');
                    me.arrayBusqueda = respuesta.unidad_solicitante;
                    console.log(me.arrayBusqueda,'respuesta busq');
                    if (me.arrayBusqueda=='') {
                        me.dismissCountDown2 = me.dismissSecs;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
                }
                
            },

            mostrarDatosSolicitud(busqueda){
                console.log('entra', busqueda);
                console.log('entra00', busqueda.fecha_registro);
                console.log(this.arrayBusqueda,'array');
                this.datosModificar=1;
                this.verifica1=1;
                this.verifica2=1;
                this.fecha_registro = busqueda.fecha_registro;
                this.nro_registro = busqueda.nro_registro;
                this.telefono_unidad = busqueda.telefono;
                this.unidad = busqueda.unidad;
                this.ciRes = busqueda.ciR;
                this.busquedaResponsable = busqueda.paternoR +' '+ busqueda.maternoR +' '+ busqueda.nombreR;                
                this.busquedaEncargado = busqueda.paternoE +' '+ busqueda.maternoE +' '+ busqueda.nombreE;
                this.idResponsableBusq = busqueda.idResponsable;
                this.idEncargadoBusq = busqueda.idEncargado;
                console.log(this.busquedaEncargado,'encar');
                this.ciEnc = busqueda.ciE;
                
                let me=this;
                console.log('entra serv');
                this.listarInformacion_SolId (busqueda.idSol_ensayo);                
                this.listarRevisionId(busqueda.idSol_ensayo);
                this.listarResultadoId(busqueda.idSol_ensayo);
                this.listarRecomendacionesId(busqueda.idSol_ensayo);
                this.listarConformidadId(busqueda.idSol_ensayo);
            },
            listarInformacion_SolId (idSolicitud){
                console.log(idSolicitud,'idsol inf.....');
                let me=this;
                var url= '/solicitudInfSolicitudId?idSolicitud=' + idSolicitud;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    console.log(respuesta,'respuesta info');
                    me.arrayinfoSolicitud = respuesta.informacion_solicitud.data;
                    console.log(me.arrayinfoSolicitud,'resul array infor');
                })
                .catch(function (error) {
                    console.log(error);
                });
            },                    
            listarRevisionId(idSolicitud){
                console.log(idSolicitud,'idSolicitud rev');
                let me=this;
                var url= '/solicitudRevisionId?idSolicitud=' + idSolicitud;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    console.log(respuesta,'respuesta');
                    me.arrayRevision = respuesta.revision.data;
                    console.log(me.arrayRevision,'resul array rev ');
                    console.log(me.arrayRevision[0].materiales,'prueba');
                    me.personal_capacitado =  me.arrayRevision[0].personal_capacitado;
                    me.disponibilidad = me.arrayRevision[0].disponibilidad;
                    me.materiales = me.arrayRevision[0].materiales;
                    me.equipos = me.arrayRevision[0].equipos;
                    me.instalaciones = me.arrayRevision[0].instalaciones;
                    me.metodo = me.arrayRevision[0].metodo;
                    me.observaciones = me.arrayRevision[0].observ_revision;
                    me.aclaraciones = me.arrayRevision[0].aclaraciones;
                    me.aceptado = me.arrayRevision[0].trabajo_aceptado;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            listarRecomendacionesId(idSolicitud){
                let me=this;
                var url= '/solicitudRecomendacionesId?idSolicitud=' + idSolicitud;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    console.log(respuesta,'respuesta');
                    me.arrayRecomendaciones = respuesta.recomendaciones.data;
                    console.log(me.arrayRecomendaciones,'resul array rec');
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            listarResultadoId(idSolicitud){
                let me=this;
                var url= '/solicitudResultadoId?idSolicitud=' + idSolicitud;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    console.log(respuesta,'respuesta');
                    me.arrayResultado = respuesta.resultado.data;
                    console.log(me.arrayResultado,'resul array resul');
                    me.soporte_impreso = me.arrayResultado[0].soporte_impreso;
                    me.correo = me.arrayResultado[0].correo;
                    me.destinatario = me.arrayResultado[0].destinatario;
                    me.correo_destinatario = me.arrayResultado[0].correo_destino;
                    me.observ_resultado = me.arrayResultado[0].observaciones;
                    me.disposiciones = me.arrayResultado[0].disp_finales;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            listarConformidadId(idSolicitud){
                let me=this;
                var url= '/solicitudConformidadId?idSolicitud=' + idSolicitud;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    console.log(respuesta,'respuesta');
                    me.arrayConformidad = respuesta.conformidad.data;
                    console.log(me.arrayConformidad,'resul array CONFORMI');
                    me.fecha_atendida = me.arrayConformidad[0].fecha_atendida;
                    me.fecha_solicitante = me.arrayConformidad[0].fecha_solicitante;
                    me.nombre_atendida = me.arrayConformidad[0].per_atendida;
                    me.cargo_per_atendida = me.arrayConformidad[0].cargo_per_atendida;
                    me.nombre_solicitante = me.arrayConformidad[0].per_solicitante;
                    me.cargo_per_solicitante = me.arrayConformidad[0].cargo_per_solicitante;

                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            crearModificaciones () {   
                 if (this.validarModificaciones()){
                    this.verificaError=1;
                    this.popToastError();
                    return;
                }             
                this.arrayModificaciones.push({
                    fecha_mod: this.fecha_mod,  
                    nombre_mod: this.nombre_mod, 
                    cargo_mod: this.cargo_mod,
                    descripcion_mod: this.descripcion_mod,
                });
                this.cerrarModificaciones();

            },
            actualizarModificaciones(idModificaciones){
                console.log('entra mod',idModificaciones);
                    this.idActualizar = idModificaciones;
                    this.fecha_mod= this.fecha_mod;
                    this.nombre_mod= this.nombre_mod;
                    this.cargo_mod= this.cargo_mod;
                    this.descripcion_mod= this.descripcion_mod;
                    this.formActualizar = true;
            },
            eliminarModificaciones(idModificaciones){
                console.log(idModificaciones,'id eliminar ');
                // Borramos de la lista
                this.arrayModificaciones.splice(idModificaciones, 1);
            },

            guardarModificacionesTabla(){

                console.log(this.arrayModificaciones,'mod..array...*');
                this.idSolRegistroMod = this.arrayBusqueda[0].idSol_ensayo;
               /* if (this.validarModificaciones()){
                    this.verificaError=1;
                    this.popToastError();
                    return;
                }*/
                console.log(this.idSolRegistroMod,'this.idSolRegistroMod......')
                var fechaModificaciones=this.fecha_mod;
                this.fecha_mod = this.customFormatterModif(fechaModificaciones);
                
                let me = this;
                for (let i = 0; i < this.arrayModificaciones.length; i++) {
                    console.log(this.arrayModificaciones[i].fecha_mod,'fecha dato');
                    
                    axios.post('/solicitud/registrarModificaciones',{
                    // 'idModificaciones': me.idModificaciones, 
                        'fecha': this.arrayModificaciones[i].fecha_mod,
                        'solicitante': this.arrayModificaciones[i].nombre_mod,
                        'cargo': this.arrayModificaciones[i].cargo_mod,
                        'descripcion': this.arrayModificaciones[i].descripcion_mod,
                        'idsol_ensayo': this.idSolRegistroMod,  //38
                        'usr_id':1
                    }).then(function (response) {
                        //me.listarPreparacion(1,'','codigo_lab');
                        //me.popToastR();
                        console.log(response,'response glosa guardar');
                        //me.modal4=0;
                    }).catch(function (error) {
                        console.log(error);
                    });
                }

                if (this.verificaError!=1) {
                    me.modal4=0;
                    console.log(this.arrayBusqueda,'busqueda***');
                    console.log(this.arrayBusqueda[0].idSol_ensayo,'busqueda***2');
                    this.idSolRegistroMod = this.arrayBusqueda[0].idSol_ensayo;
                    var idSolRegistro = this.arrayBusqueda[0].idSol_ensayo;  //**
                    var idUnidad_sol = this.arrayBusqueda[0].idUnidad_sol;
                    var idInforsol = this.arrayBusqueda[0].idInforsol;
                    var idRevision = this.arrayBusqueda[0].idRevision;
                    var idResultado = this.arrayBusqueda[0].idResultado;
                    var idRecomendaciones = this.arrayBusqueda[0].idRecomendaciones;
                    var idConformidad = this.arrayBusqueda[0].idConformidad;
                    console.log(idSolRegistro,'idddddd sol ensayo');
                    this.desactivar_InfSolicitud(idInforsol);    
                    this.desactivar_Revision(idRevision);
                    this.desactivar_Resultado(idResultado);
                    this.desactivar_Recomendaciones(idRecomendaciones);
                    this.desactivar_Conformidad(idConformidad);

                    this.desactivar_UnidadSol(idUnidad_sol);
                    this.desactivar_SolEnsayo(idSolRegistro);

                    this.registrarUnidadSolicitante();
                    console.log('registro ..  pruebas....');
                }else{
                    this.popToastError();
                }

            },


















            crearInfSolicitud () {    
                if (this.validarInfSolicitud()){
                    return;
                }                             
                this.arrayinfoSolicitud.push({
                    cantidad: this.cantidad,
                    flujo: this.flujo,
                    matriz: this.matriz,
                    analito: this.analito,
                    des_procedencia: this.des_procedencia
                });
                this.modal2=0;
            },
              actualizarInfSolicitud (idsolicitud) {
                  if (this.validarInfSolicitud()){
                    return;
                }                 
                    this.idActualizar = idsolicitud;
                    this.cantidad= this.cantidad;
                    this.flujo= this.flujo;
                    this.matriz= this.matriz;
                    this.analito= this.analito;
                    this.des_procedencia= this.des_procedencia;
                    this.formActualizar = true;
                    this.modal2=0;
            },
                        
            crearRecomendaciones () {  
                if (this.validarRecomendaciones()){
                    return;
                } 
                var fechaRecom=this.fecha_recom;
                this.fecha_recom = this.customFormatterRecom(fechaRecom);
                console.log(this.fecha_recom,'fecha recom');              
                this.arrayRecomendaciones.push({
                    recomendaciones: this.recomendaciones,
                    respuesta: this.respuesta, 
                    fecha_recom: this.fecha_recom,
                    vobo: this.vobo,
                });
                this.modal3=0;
            },
            actualizarRecomendaciones (idrecomendaciones) {
                    if (this.validarRecomendaciones()){
                    return;
                    } 
                    this.idActualizar = idrecomendaciones;
                    this.fecha_recom= this.fecha_recom;
                    this.recomendaciones= this.recomendaciones;
                    this.respuesta= this.respuesta;
                    this.vobo= this.vobo;
                    this.formActualizar = true;
                    this.modal3=0;
            },
            eliminarRecomendaciones (idrecomendaciones) {
                // Borramos de la lista
                this.arrayRecomendaciones.splice(idrecomendaciones, 1);
            },
           
            // VALIDACIONES DE CAMPOS  
             
           validarModificaciones(){
                this.errorModificaciones=0;
                this.errorMostrarMsjSolicitud =[];  
//fecha_registro  nro_registro unidad telefono_unidad ciRes ciEnc
               // if (!this.fecha_mod) this.errorMostrarMsjSolicitud.push("Debe ingresar la Unidad solicitante.");
                if (!this.nombre_mod) this.errorMostrarMsjSolicitud.push("Debe ingresar nombre.");
                if (!this.cargo_mod) this.errorMostrarMsjSolicitud.push("Debe ingresar el cargo.");
                if (!this.descripcion_mod) this.errorMostrarMsjSolicitud.push("Debe ingresar descripción.");
  
                if (this.errorMostrarMsjSolicitud.length) this.errorModificaciones = 1;
                return this.errorModificaciones;
            },
           validarSolicitudEnsayo(){
                this.errorSolicitud=0;
                this.errorMostrarMsjSolicitud =[];
//fecha_registro  nro_registro unidad telefono_unidad ciRes ciEnc
                if (!this.unidad) this.errorMostrarMsjSolicitud.push("Debe ingresar la Unidad solicitante.");
                if (!this.telefono_unidad) this.errorMostrarMsjSolicitud.push("Debe ingresar el teléfono.");
                if (!this.nombreResponsable) this.errorMostrarMsjSolicitud.push("Debe ingresar el responsable de la solicitud.");
                if (!this.nombreEncargado) this.errorMostrarMsjSolicitud.push("Debe ingresar el encargado  de la solicitud.");
  
                if (this.errorMostrarMsjSolicitud.length) this.errorSolicitud = 1;
                return this.errorSolicitud;
            },
              validarPersona(){
                this.errorPersona=0;
                this.errorMostrarMsjPersona =[];
                if (!this.nombre) this.errorMostrarMsjPersona.push("Debe ingresar el nombre de la persona.");
                if (!this.ciResponsable) this.errorMostrarMsjPersona.push("Debe ingresar el C.I. de la persona.");
                if (!this.paterno) this.errorMostrarMsjPersona.push("Debe ingresar el apellido paterno de la persona.");
                if (this.errorMostrarMsjPersona.length) this.errorPersona = 1;
                return this.errorPersona;
            },
            validarInfSolicitud(){
                this.errorInfSolicitud=0;//cantidad flujo matriz analito des_procedencia
                this.errorMostrarMsjSolicitud =[];
                if (!this.cantidad) this.errorMostrarMsjSolicitud.push("Debe ingresar la cantidad.");
                if (!this.matriz) this.errorMostrarMsjSolicitud.push("Debe ingresar la matriz.");
                if (!this.analito) this.errorMostrarMsjSolicitud.push("Debe ingresar analito de interés.");
                if (!this.des_procedencia) this.errorMostrarMsjSolicitud.push("Debe ingresar la descripción de la procedencia.");
                if (this.errorMostrarMsjSolicitud.length) this.errorInfSolicitud = 1;
                return this.errorInfSolicitud;
            },
            validarRevision(){  
                this.errorRevision=0;  //aceptado rechazado
                this.errorMostrarMsjSolicitud =[];
                if (!this.aceptado && !this.rechazado) this.errorMostrarMsjSolicitud.push("Marque la opción de aceptado o rechazado de la solicitud.");
                if (this.errorMostrarMsjSolicitud.length) this.errorRevision = 1;
                return this.errorRevision;
            },
            validarResultados(){
                this.errorResultados=0;  //aceptado rechazado
                this.errorMostrarMsjSolicitud =[];
                if (!this.soporte_impreso && !this.correo) this.errorMostrarMsjSolicitud.push("Marque la opción de soporte impreso o correo electrónico.");
                if (this.errorMostrarMsjSolicitud.length) this.errorResultados = 1;
                return this.errorResultados;
            },                                    
            validarRecomendaciones(){
                this.errorRecomendaciones=0;
                this.errorMostrarMsjSolicitud =[];
                if (!this.fecha_recom) this.errorMostrarMsjSolicitud.push("Debe ingresar la fecha.");
                if (!this.recomendaciones) this.errorMostrarMsjSolicitud.push("Debe ingresar las recomendaciones.");
                if (!this.respuesta) this.errorMostrarMsjSolicitud.push("Debe ingresar la respuesta correspondiente.");
                if (!this.vobo) this.errorMostrarMsjSolicitud.push("Debe ingresar vobo correspondiente.");
                if (this.errorMostrarMsjSolicitud.length) this.errorRecomendaciones = 1;
                return this.errorRecomendaciones;
            },
            validarConformidad(){
                this.errorConformidad=0; //nombre_atendida nombre_solicitante cargo_per_atendida cargo_per_solicitante
                this.errorMostrarMsjSolicitud =[];
                if (!this.nombre_atendida) this.errorMostrarMsjSolicitud.push("Debe ingresar el nombre de la persona que atendio la solicitud.");
                if (!this.nombre_solicitante) this.errorMostrarMsjSolicitud.push("Debe ingresar el nombre de la persona solicitante de la solicitud.");
                if (!this.cargo_per_atendida) this.errorMostrarMsjSolicitud.push("Debe ingresar el cargo de la persona que atendio la solicitud.");
                if (!this.cargo_per_solicitante) this.errorMostrarMsjSolicitud.push("Debe ingresar el cargo de la persona que solicitante la solicitud.");
                if (this.errorMostrarMsjSolicitud.length) this.errorConformidad = 1;
                return this.errorConformidad;
            },
            cerrarModal(){
                this.modal1=0;
                this.modal2=0;
                this.modal3=0;
                this.modal4=0;
                this.modal5=0;
                this.tituloModal='';
                this.fecha='';
                this.nombre='';                
                this.paterno='';
                this.materno='';
                this.ci='';
                this.direccion='';
                this.telefono='';
                this.email='';
                this.errorSolicitud=0;
            },

             abrirModalPersonaRes(modelo, accion, data = []){
                switch(modelo){
                    case "solicitud":
                    {
                        switch(accion){
                            case 'registrarResponsable':
                            {
                                this.modal1 = 1;
                                this.tituloModal = 'Registrar Responsable';
                                    this.nombre='';
                                    this.paterno='';
                                    this.materno='';
                                    this.ciResponsable=this.ciPersona;
                                    this.email='';
                                    this.telefono='';
                                    this.direccion='';
                                    this.direccion='';
                                    this.telefono='';
                                    this.email='';
                                    this.identrega=1;
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'registrarEncargado':
                            {
                                this.modal1=1;
                                this.tituloModal = 'Registrar Encargado';
                                    this.nombre='';
                                    this.paterno='';
                                    this.materno='';
                                    this.ciResponsable = this.ciPersona
                                    this.email='';
                                    this.telefono='';
                                    this.direccion='';
                                    this.direccion='';
                                    this.telefono='';
                                    this.email='';
                                    this.identrega=1;
                                this.tipoAccion = 1;
                                break;
                            }
                        }
                    }
                }
            },

            //crearInfSolicitud
            abrirModalInfSol(modelo, accion, data = []){
                switch(modelo){
                    case "solicitud":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal2 = 1;
                                this.tituloModal = 'Registrar solicitud';
                                    this.cantidad='';
                                    this.matriz='';
                                    this.analito='';
                                    this.flujo='';
                                    this.des_procedencia='';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal2=1;
                                this.tituloModal='Actualizar solicitud';
                                this.tipoAccion=2;
                                this.solicitud_id=data['id'];
                                this.cantidad = data['cantidad'];
                                this.matriz = data['matriz'];
                                this.analito = data['analito'];
                                this.des_procedencia = data['des_procedencia'];
                                break;
                            }
                        }
                    }
                }
            },
                 
            //crear Recomendaciones
            abrirModalRecomend(modelo, accion, data = []){
                switch(modelo){
                    case "recomendaciones":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal3 = 1;
                                this.tituloModal = 'Registrar recomendaciones';
                                    this.fecha_recom='';
                                    this.recomendaciones='';
                                    this.respuesta='';
                                    this.vobo='';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal3=1;
                                this.tituloModal='Actualizar recomendaciones';
                                this.tipoAccion=2;
                                this.fecha_recom=data['fecha_recom']
                                this.recomendaciones_id=data['id'];
                                this.recomendaciones = data['recomendaciones'];
                                this.respuesta = data['respuesta'];
                                this.vobo = data['vobo'];
                                break;
                            }
                        }
                    }
                }
            },
            //crear Modificaciones tabla
            cerrarModificaciones(){
                this.fecha_mod='';
                this.nombre_mod='';
                this.cargo_mod='';
                this.descripcion_mod='';
            },
            //actualizarModificaciones
            /*abrirModalModificaciones(modelo, accion, data = []){
                switch(modelo){
                    case "modificaciones":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal5 = 1;
                                this.tituloModal = 'Registrar modificaciones';
                                this.fecha_mod='';
                                this.nombre_mod='';
                                this.cargo_mod='';
                                this.descripcion_mod='';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal5=1;
                                this.tituloModal='Actualizar modificaciones';
                                this.tipoAccion=2;
                                this.modificacion_id=data['id'];
                                this.fecha_mod = data['fecha_mod'];
                                this.cargo_mod = data['cargo_mod'];
                                this.descripcion_mod = data['descripcion_mod'];
                                break;
                            }
                        }
                    }
                }
            },    */             
                             
            selectPersona(search,loading){
                let me=this;
                loading(true)

                var url= '/solicitudPersona/selectPersonaCi?filtro='+search;
                axios.get(url).then(function (response) {
                  console.log(response,'res');
                    let respuesta= response.data;
                    console.log(respuesta,'respuesta');
                    q: search
                    me.arrayPersonaci= respuesta.personas;
                    if (me.arrayPersonaci!='') {
                      me.responsable=1;
                      me.encargado=1;
                    }
                    console.log(me.arrayPersonaci,'select 3');
                    loading(false);
                    me.ciPersona = search;
                    console.log(me.ciPersona);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getDatosResponsable(val1){
              console.log(val1,'dato val1..CCC');
              let me = this;
              me.loading = true;
              console.log(val1.id,'id **//***we');
              me.idresponsable = val1.id; 
              console.log(me.idresponsable,'me.idresp onsable ****');            
              if (val1 =='') {
                 me.nombreResponsable='';
              }else{
                  if (val1.materno=='' || val1.materno==null) {
                    me.nombreResponsable = val1.paterno +' '+ val1.nombre;   
                  }else{
                    me.nombreResponsable = val1.paterno +' '+ val1.materno +' '+ val1.nombre;
                  }
              } 

               if(me.verifica1==1){
                    me.nombreResponsable = me.busquedaResponsable;
                 } //else{
                    // me.nombreResponsable='';}
              me.verifica1=0; 
            },
            getDatosEncargado(val2){
              console.log(val2,'dato val2');
              let me = this;
              me.loading = true;
              me.idencargado = val2.id;
              if (val2 =='') {
                 me.nombreEncargado='';
                 if(me.verifica1==1){
                    me.nombreEncargado = me.busquedaEncargado;
                 }
                 me.verifica1=0;
              }else{
                  if (val2.materno=='' || val2.materno==null) {
                    me.nombreEncargado = val2.paterno +' '+ val2.nombre;   
                  }else{ 
                    me.nombreEncargado = val2.paterno +' '+ val2.materno +' '+ val2.nombre;
                  }
              } 
              console.log('entro   123');
               if(me.verifica2==1){
                    me.nombreEncargado = me.busquedaEncargado;
                    console.log(me.busquedaEncargado,'nombre res');
                    console.log('entrooooooo');
                    console.log(me.busquedaEncargado,'ressssss');
                 } else{
                     me.busquedaEncargado='';}
              me.verifica2=0;                          
            },
            checkBoxSol(val){
               if (val==0) {
                  if (this.aceptado == true) {
                    this.rechazado = false;
                }  
               }else if(val==1){
                   if (this.rechazado == true) {
                     this.aceptado = false;}
               }     
           },
           checkBoxResul(val){
               if (val==0) {
                  if (this.soporte_impreso == true) {
                    this.correo = false;
                }  
               }else if(val==1){
                   if (this.correo == true) {
                     this.soporte_impreso = false;}
               }     
           },
           
           
             // Registro --->BD  
             registrarPersona(){
                if (this.validarPersona()){
                    this.popToastError();
                    return;
                }                
                let me = this;

                  
                axios.post('/persona/registrar',{
                    'nombre': this.nombre,
                    'paterno': this.paterno,
                    'materno' : this.materno,
                    'ci' : this.ciResponsable,
                    'telefono' : this.telefono,
                    'email' : this.email,
                    'direccion' : this.direccion,
                    'usr_id':1,

                }).then(function (response) {
                    console.log(me.nombreResponsable,'123');
                    if (me.nombreResponsable !='') {
                        me.nombreResponsable=me.nombre+' '+ me.paterno+' '+me.materno
                        console.log(me.nombreResponsable,'res123');
                        me.ciRes = me.ciResponsable;
                    }else if (me.nombreResponsable !='') {
                        me.nombreResponsable=me.nombre+' '+ me.paterno+' '+me.materno
                         me.ciRes = me.ciResponsable;  
                    }          
              
                me.cerrarModal();
               }).catch(function (error) {
                   this.popToastError();
                    console.log(error);
            });

           },

            //bd solicitud   .....
            //empieza **  *****************************
            //************************************** */
            ///////////////////////////////////////////

               RegistrarSolicitudMod(){
                if (this.validarSolicitudEnsayo()){   
                    this.verificaError=1;
                    this.popToastError();  
                    console.log('entro*****');   
                                  
                    return;
                }  
                if (this.validarRevision()){
                    this.verificaError=1;
                    this.popToastError();
                    return;
                }
                if (this.validarResultados()){
                    this.verificaError=1;
                    this.popToastError();
                    return;
                }
                if (this.validarConformidad()){
                    this.verificaError=1;
                    this.popToastError();
                    return;
                }
                if ( this.verificaError==1) {
                    this.popToastError();
                }else{
                    this.modal4=1;
                }
               
              },

              /////////////////////////////registrar//////
            registrarUnidadSolicitante(){
                /*if (this.validarUnidadSol()){
                    return;
                }*/  
                if (this.idresponsable == ''|| this.idresponsable == null) {
                    this.idresponsable = this.idResponsableBusq;
                }
                if (this.idencargado == ''|| this.idencargado == null) {
                    this.idencargado = this.idEncargadoBusq;
                }              
                let me = this;
                axios.post('/solicitud/registrarUnidadSol',{
                    'unidad': this.unidad,
                    'telefono': this.telefono_unidad,
                    'idresponsable' : this.idresponsable,
                    'idencargado' : this.idencargado,
                    'usr_id':1,

                }).then(function (response) {
                    console.log(response,'entra response 1');
                    me.registrarSolEnsayo();
                    me.registraDatos=1;              
               }).catch(function (error) {
                   this.popToastError();
                    console.log(error);
            });

           }, 
           registrarSolEnsayo (){
                console.log('entro');
                var fechaRegistro=this.fecha_registro;
                this.fecha_registro = this.customFormatterSolEn(fechaRegistro);
                var fechaAtendida=this.fecha_atendida;
                this.fecha_atendida = this.customFormatterAtend(fechaAtendida);
                var fechaSolicitante=this.fecha_solicitante;
                this.fecha_solicitante = this.customFormatterSolici(fechaSolicitante);
                
                let me=this;
                var url= '/solicitudUnidadSol';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayUnidadSol = respuesta.unidad_solicitante.data;
                    console.log(me.arrayUnidadSol,'array...');
                    for (let i = 0; i < me.arrayUnidadSol.length; i++) { 
                        console.log(me.unidad,'unidad**');
                        if (me.arrayUnidadSol[i].unidad == me.unidad) {
                            me.idUnidadSol = me.arrayUnidadSol[i].id;
                            console.log(me.arrayUnidadSol[i].unidad,'unidad');
                            console.log(me.idUnidadSol,'id this.idUnidadSol');
                            console.log(me.idSolRegistroMod,'idSolRegistroMod ***');
                             axios.post('/solicitud/registrarSolEnsayo',{
                            'idunidad': me.idUnidadSol,
                            'nro_registro' : me.idSolRegistroMod,
                            'fecha_registro' : me.fecha_registro,
                            'usr_id':1,
                        }).then(function (response) {
                            console.log(response,'r4esponse sol ensayo');
                            me.verificaMod=1;
                            
                            /*me.registrarRevision();
                            me.registrarResultado();
                            me.registrarRecomendaciones();
                            me.registrarConformidad();
                           */ me.registraDatos=1;
                        }).catch(function (error) {
                            me.verificaMod=0;
                            me.popToastError();

                            console.log(error,'e');
                        });
                            
                        }                                               
                    }
                    if (me.verificaMod==1) {
                        console.log('entra if   .');
                        me.registrarInfSolicitud();
                    }
                   // return this.idUnidadSol;
                }).catch(function (error) {
                    console.log(error);
                });
               // console.log(this.idUnidadSol,'------------------');
            },
                                              
            registrarInfSolicitud (){  
                let me=this;
                var url= '/solicitudSolEnsayo';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arraySolEnsayo = respuesta.solicitud_ensayo.data;
                    console.log(me.arraySolEnsayo,'array...');
                    for (let i = 0; i < me.arraySolEnsayo.length; i++) { 
                        if (me.arraySolEnsayo[i].nro_registro == me.nro_registro) {
                            me.idSolEnsayo = me.arraySolEnsayo[i].id;
                            console.log(me.arraySolEnsayo[i].nro_registro,'nro registro');
                            console.log(me.idSolEnsayo,'id solensayo');
                            axios.post('/solicitud/registrarInfSolicitud',{
                                'idsol_ensayo': me.idSolEnsayo,
                                'cantidad' : me.cantidad,
                                'matriz' : me.matriz,
                                'analito' : me.analito,
                                'flujo': me.flujo,
                                'des_procedencia': me.des_procedencia,
                                'usr_id':1,

                            }).then(function (response) {
                                console.log(response,'response inf solicitud');
                                me.registrarRevision();
                                me.registrarResultado();
                                me.registrarRecomendaciones();
                                me.registrarConformidad();
                                me.registraDatos=1;
                            }).catch(function (error) {
                                this.popToastError();
                                console.log(error);
                            });
                        }                                                                       
                    }               
                 }).catch(function (error) {
                    console.log(error);
                });
            },
            
            registrarRevision(){
                this.registraDatos = 0;
               /* if (this.validarInfSolicitud()){
                    return;
                }*/     
                console.log('ENTRA REVISION');          
                let me = this;
                axios.post('/solicitud/registrarRevision',{
                    'idsol_ensayo': me.idSolEnsayo,
                    'personal_capacitado': this.personal_capacitado,
                    'disponibilidad' : this.disponibilidad,
                    'materiales' : this.materiales,
                    'equipos' : this.equipos,
                    'instalaciones' : this.instalaciones,
                    'metodo' : this.metodo,
                    'observaciones' : this.observ_revision,
                    'aclaraciones' : this.aclaraciones,
                    'trabajo_aceptado' : this.aceptado,
                    'usr_id':1,

                }).then(function (response) {
                    console.log(response,'response revision');
                   // me.listarsolicitud(1,'','codigo');
                }).catch(function (error) {
                    console.log(error);
                });
            },
              
            registrarResultado(){
                this.registraDatos = 0;
               /* if (this.validarInfSolicitud()){
                    return;
                }       */         
                let me = this;
                axios.post('/solicitud/registrarResultado',{
                    'idsol_ensayo': me.idSolEnsayo,
                    'soporte_impreso' : this.soporte_impreso,
                    'correo' : this.correo,
                    'destinatario' : this.destinatario,
                    'correo_destino' : this.correo_destinatario,
                    'observaciones' : this.observ_resultado,
                    'disp_finales' : this.disposiciones,
                    'usr_id':1,

                }).then(function (response) {
                    console.log(response,'response resultado');
                }).catch(function (error) {
                    this.popToastError();
                    console.log(error);
                });
            },
            registrarRecomendaciones(){
                this.registraDatos = 0;
                /*if (this.validarInfSolicitud()){
                    return;
                } */               
                let me = this;
                axios.post('/solicitud/registrarRecomendaciones',{
                    'idsol_ensayo' : me.idSolEnsayo,
                    'fecha' : me.fecha_recom,
                    'recomendaciones' : me.recomendaciones,
                    'respuesta' : me.respuesta,
                    'vobo' : me.vobo,
                    'usr_id':1,

                }).then(function (response) {
                    console.log(response,'reponse recomendaciones');
                   // me.listarsolicitud(1,'','codigo');
                }).catch(function (error) {
                    this.popToastError();
                    console.log(error);
                });
            },
            registrarConformidad(){
                this.registraDatos = 0;
               /* if (this.validarInfSolicitud()){
                    return;
                }      */          
                let me = this;
                axios.post('/solicitud/registrarConformidad',{
                    'idsol_ensayo': me.idSolEnsayo,
                    'fecha_atendida' : this.fecha_atendida,
                    'fecha_solicitante' : this.fecha_solicitante,
                    'per_atendida' : this.nombre_atendida,
                    'cargo_per_atendida' : this.cargo_per_atendida,
                    'per_solicitante' : this.nombre_solicitante,                
                    'cargo_per_solicitante':this.cargo_per_solicitante,
                    'usr_id':1,

                }).then(function (response) {
                    console.log(response,'response conformidad');
                   // me.listarsolicitud(1,'','codigo');
                }).catch(function (error) {
                    this.popToastError();
                    console.log(error);
                });
            },
            desactivar_UnidadSol(id){              
                let me = this;
                axios.put('/solicitud/desactivarUnidadSol',{
                    'id': id
                }).then(function (response) {
                   console.log(response);
                }).catch(function (error) {
                    console.log(error);
                });                                    
            },
            desactivar_SolEnsayo(id){              
                let me = this;
                axios.put('/solicitud/desactivarSolEnsayo',{
                    'id': id
                }).then(function (response) {
                   console.log(response);
                }).catch(function (error) {
                    console.log(error);
                });                                    
            },
            desactivar_InfSolicitud(id){          
                let me = this;
                axios.put('/solicitud/desactivarInfSolicitud',{
                    'id': id
                }).then(function (response) {
                   console.log(response);
                }).catch(function (error) {
                    console.log(error);
                });                                    
            },
            desactivar_Revision(id){              
                let me = this;
                axios.put('/solicitud/desactivarRevision',{
                    'id': id
                }).then(function (response) {
                   console.log(response);
                }).catch(function (error) {
                    console.log(error);
                });                                    
            },
            desactivar_Resultado(id){              
                let me = this;
                axios.put('/solicitud/desactivarResultado',{
                    'id': id
                }).then(function (response) {
                   console.log(response);
                }).catch(function (error) {
                    console.log(error);
                });                                    
            }, 
            desactivar_Recomendaciones(id){              
                let me = this;
                axios.put('/solicitud/desactivarRecomendaciones',{
                    'id': id
                }).then(function (response) {
                   console.log(response);
                }).catch(function (error) {
                    console.log(error);
                });                                    
            }, 
            desactivar_Conformidad(id){              
                let me = this;
                axios.put('/solicitud/desactivarConformidad',{
                    'id': id
                }).then(function (response) {
                   console.log(response);
                }).catch(function (error) {
                    console.log(error);
                });                                    
            },  
            popToastReg() {
                const h = this.$createElement
                this.count++
                const vNodesMsg = h(
                'p',
                { class: ['text-center', 'mb-0'] },
                [
                    h('b-spinner', { props: { type: 'grow', small: true } }),
                    ' Se Se registraron los datos',
                ])
                const vNodesTitle = h(
                'div',
                { class: ['d-flex', 'flex-grow-1', 'align-items-baseline', 'mr-2'] },
                [
                    h('small', { class: 'ml-auto text-italics' }, '3 minutes ago')
                ])
                this.$bvToast.toast([vNodesMsg], {
                title: 'Se ejecuto correctamente',
                solid: true,
                variant: 'success'
                })
             }, 
              popToastMod() {
                const h = this.$createElement
                this.count++
                const vNodesMsg = h(
                'p',
                { class: ['text-center', 'mb-0'] },
                [
                    h('b-spinner', { props: { type: 'grow', small: true } }),
                    ' Se  actualizaron los datos',
                ])
                const vNodesTitle = h(
                'div',
                { class: ['d-flex', 'flex-grow-1', 'align-items-baseline', 'mr-2'] },
                [
                    h('small', { class: 'ml-auto text-italics' }, '3 minutes ago')
                ])
                this.$bvToast.toast([vNodesMsg], {
                title: 'Se ejecuto correctamente',
                solid: true,
                variant: 'success'
                })
             }, 
              popToastError() {
                const h = this.$createElement
                this.count++
                const vNodesMsg = h(
                'p',
                { class: ['text-center', 'mb-0'] },
                [
                    h('b-spinner', { props: { type: 'grow', small: true } }),
                    ' Verifique los datos',
                ])
                const vNodesTitle = h(
                'div',
                { class: ['d-flex', 'flex-grow-1', 'align-items-baseline', 'mr-2'] },
                [
                    h('small', { class: 'ml-auto text-italics' }, '3 minutes ago')
                ])
                this.$bvToast.toast([vNodesMsg], {
                title: 'Error al guardar',
                solid: true,
                variant: 'danger'
                })
             }, 
                       
            },
            mounted() {
             //
            //     ///php artisan serve --host=192.168.1.5

        }
    }
    
</script>
<style>   
 /*.mostrar{
    display: list-item !important;
    opacity: 1 !important;
    position: relative !important;
    background-color: #3c29297a !important;
}*/
	
.mostrar1 {
    display: list-item !important;
    opacity: 1 !important;
    position: fixed !important;
    background-color: #3c29297a !important;
}

.modal-content {
    display: list-item !important;
    width: 100%;   
    margin: 40px auto 0;
    padding: 50px 30px;
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
    transition: all .3s ease;
    font-family: Helvetica, Arial, sans-serif;
}


.modal-body {
    margin: 20px 0;
}




/* Estilos otros */

    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }

  .datepicker1 {
    background-color:#5d998f; 
    border-radius:15px; 
    overflow:hidden; 
    display:block; 
    margin-bottom:10px; 
    box-shadow:0 0 10px #45b2d3; 
    margin:0 auto; 
    margin-top:10px;
    font-family: 'Lato', sans-serif;
    color:rgb(46, 93, 155);
    }

</style>
<style lang="scss"> @import './resources/assets/scss/bootstrap.scss';
@import './resources/assets/scss/_modal.scss';
@import './resources/assets/scss/coreui.scss';
 .mostrar{
    display: list-item !important;
    opacity: 1 !important;
    position: relative !important;
    background-color: #3c29297a !important;
}

$body-font-family: 'Open Sans', sans-serif;

$checkbox-bg-color-checked: #00bbd6;
$checkbox-border-color-checked: $checkbox-bg-color-checked;
$checkbox-bg-color-unchecked: #fff;
$checkbox-border-color-unchecked:  #757575;

body {
  font-family: $body-font-family;

  .container  {
   // display: flex;
   // flex-wrap: wrap;
   // justify-content: center;

    .box {
      //text-align: center;
     /// background-color: #fff;
      width: 250px;
      padding: 10px;
      border-radius: 0px;
      
    }
  }
 
  .ta {
    padding-left: 25px;
  }

  .checkbox-group {
    input[type=checkbox] {
      display: none;

      @mixin checkbox-structure($width: 25px, $height: 25px, $top: -1px, $left: '', $border-color: '', $background-color: '') {
        content: "";
        position: absolute;
        width: $width;
        height: $height;
        top: $top;
        border-radius: 2px;

        @if $border-color!='' {
          border: 2px solid $border-color;
        }

        @if $background-color!='' {
          background-color: $background-color;
        }

        transition: .2s;
      }

      &:not(:checked) + label::before {
        @include checkbox-structure($border-color: $checkbox-border-color-unchecked, $background-color: $checkbox-bg-color-unchecked);
         left: 0;
      }

      &:checked + label {
        &::before {
          @include checkbox-structure($border-color: $checkbox-border-color-checked, $background-color: $checkbox-bg-color-checked);

          left: 0;
        }
        &::after {
          @include checkbox-structure($width: 15px, $height: 19px);
          left: 5px;
          border-top: 2px solid transparent;
          border-left: 2px solid transparent;
          border-right: 2px solid #fff;
          border-bottom: 2px solid #fff;
          -webkit-transform: rotate(36deg);
          -ms-transform: rotate(36deg);
          transform: rotate(36deg);
         // animation: fade-in .5s;
        }
      }
    }
    label {
      cursor: pointer;
      position: relative;
    }
  }  
}

/*@keyframes fade-in {
  from { opacity: 0; }
  to { opacity: 1; }
}*/
h1 {
	font-size: 2rem;
	font-weight: bolder;
	margin-bottom: 1rem;
}
</style>