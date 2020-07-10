<template>
  <main class="main"> 
    <!-- Breadcrumb -->
   <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
   </ol>            
      <div class="col-lg-12">
        <div class="card">
             <div class="col-sm-10">
                <!--h1 class="titulo" style="text-align:center">Solicitud de ensayo y atención al cliente</h1-->
                <h1><b-badge variant="light">Solicitud de ensayo y atención al cliente</b-badge></h1>
                <hr style="border-color:blue;">
                <!--h2><p>F-A4-01-02 </p></h2-->
             </div>   
        <div class="col-sm-12">
        <div class="card">
            
            <div class="card-header"><strong>Solicitud de ensayo</strong></div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="city">Fecha</label>
                        <!--input class="form-control" v-model="fecha_registro" type="text" placeholder="Fecha de registro"-->
                        <datepicker 
                            :bootstrap-styling="true"
                            :language="es"
                            calendar-class="datepicker1"                            
                            input-class="form-control col-sm-6"
                            div-class="form-group col-lg-6"
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
                <div v-if="verificaError == 1" v-show="errorSolicitud" class="form-group row div-error">
                    <div class="text-center text-error">
                        <div v-for="error in errorMostrarMsjSolicitud" :key="error" v-text="error">

                        </div>  
                    </div>
                </div>  
            <!-- /.row-->                      
            </div>
        </div> 
        <!-- /. solicitud-->  
        </div>   
        <solicitudInf @resultadosInf="resultadoInforSol"></solicitudInf>
       
        <div class="col-sm-12">
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
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header"><i class="fa fa-align-justify"></i><strong>Reporte de Resultados</strong> 
                    <button type="button" data-toggle="modal" @click="abrirModalResul('resultados','registrar')" class="btn btn-info pull-right" style="right:0;">
                        <font bold>+ Nuevo</font>
                    </button>
                </div> 
                <div class="card-body">
                    <table class="table table-responsive-sm table-bordered table-striped table-sm">
                    <thead>
                        <tr>                   
                        <th>Soporte impreso</th>
                        <th>Correo electrónico</th>
                        <th>otro</th>
                        <th>Observaciones</th>
                        <th>Disposiciones finales</th>                            
                        <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="resultados in arrayResultados" :key="resultados.id">                                    
                            <td v-text="resultados.soporte_impreso"></td>
                            <td v-text="resultados.correo_electronico"></td>
                            <td v-text="resultados.otro"></td>
                            <td v-text="resultados.observ_resultado"></td>
                            <td v-text="resultados.disposiciones"></td>
                            <td>                            
                                <a href="#" data-toggle="modal" @click="abrirModalInfSol('resultados','actualizar',resultados)">
                                    <i class="fa fa-edit info" style="font-size: 23px"></i>
                                </a>                            
                                <a href="#" @click="eliminarResul(resultados.id)">
                                    <i class="fa fa-trash" style="font-size: 23px"></i>
                                </a>
                            </td>                                    
                            </tr>                                                                                   
                    </tbody>
                </table>                
            </div>
        </div>
        <!--div class="col-sm-12">
            <div class="card">
              <div class="card-header"><strong>Reporte de Resultados</strong></div>
                <div class="card-body">                                                      
                    <div class="form-group row">                                               
                        <div class="container">
                            <div class="box">
                                <div class="checkbox-group"> correo
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
        </div--> 
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
                            <a href="#" @click="abrirModalRecomend('recomendaciones','actualizar',recomendaciones)" v-b-tooltip.hover title="Actualizar">
                                <i class="fa fa-edit info" style="font-size: 23px"></i>
                            </a>                            
                            <a href="#" @click="eliminarRecomendaciones(recomendaciones.id)" v-b-tooltip.hover title="Eliminar">
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
    <!-- Inicio conformidad-->
    <div class="col-sm-12">
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
<!--form action={{route('contact')}} method="POST">
     {{ csrf_field() }}
    <div class="form-group">
        <label for="name">Nombre</label>
        <input name="name" type="text">
    </div>
    <div class="form-group">
        <label for="name">Mensaje</label>
                                <input name="msg" type="text">
    </div>
    <div class="form-group">
        <button type="submit" id='btn-contact' class="btn">Enviar</button>
    </div>
</form-->                                     
        
        <div class="col-sm-12" style="justify-content: center;">        
            <button type="button" class="btn btn-secondary" @click="cerrarModal()"><font color="white">Cancelar</font></button>
            <!--button type="button" class="btn btn-primary" ><font color="white">Guardar Datos</font></button-->
            <b-button variant="info" @click="RegistrarSolicitud()">Guardar Datos</b-button>
        </div>
        
      </div>
    <!-- /.col-->
    </div>
    <!-- /.row-->


    <!--Inicio del modal agregar/  persona-->
    <div class="modal fade" :class="{'mostrarr' : modal1}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
    <!--Inicio del modal agregar/actualizar  recomdendaciones-->
    <div class="modal fade" :class="{'mostrarr' : modal3}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
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
                            <div class="form-group col-lg-6">
                                <label for="city">Fecha</label>
                                <!--input class="form-control" v-model="fecha_recom" type="text" placeholder="Fecha"-->
                                 <b-form-datepicker id="example-datepicker" v-model="fecha_recom" class="mb-2"></b-form-datepicker>
   <!--datepicker 
                                    :bootstrap-styling="true"
                                    :language="es"
                                    calendar-class="datepicker1"                                    
                                    input-class="form-control col-md-6"
                                    :open-date="openDate"
                                    :format="customFormatterRecom"
                                    v-model="fecha_recom">
                                </datepicker-->
                            </div>
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
                                <div v-for="error in errorMostrarMsjSolicitud" :key="error" v-text="error">
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
        <!-- /.modal-dialvue- revision -->
    </div>
    <!--Fin del modal-->

    <!--Inicio del modal agregar/actualizar  recomdendaciones-->
    <div class="modal fade" :class="{'mostrarr' : modal4}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
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
                            <div class="form-group col-sm-4">
                                <div class="container">
                                    <div class="box">
                                        <div class="checkbox-group">
                                            <input id="checkboxName9" type="checkbox" v-model="soporte_impreso" @change="checkBoxResul(0)"/>
                                            <label for="checkboxName9" class="ta"> SOPORTE IMPRESO </label>                                                
                                        </div> 
                                    </div>
                                </div>
                            </div>                                  
                            <div class="form-group col-sm-4">
                                <div class="container">
                                    <div class="box">
                                        <div class="checkbox-group">
                                            <input id="checkboxName10" type="checkbox" v-model="correo" @change="checkBoxResul(1)"/>
                                            <label for="checkboxName10" class="ta"> CORREO ELECTRÓNICO </label>                                                
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <div class="container">
                                    <div class="box">
                                        <div class="checkbox-group">
                                            <input id="checkboxName11" type="checkbox" v-model="checkOtro" @change="checkBoxResul(2)"/>
                                            <label for="checkboxName11" class="ta"> Otro </label>                                                
                                            <input v-if="checkOtro" class="form-control" v-model="otro" type="text" placeholder="">
                                        </div> 
                                    </div>
                                </div>
                            </div> 
                        </div>        
                        <!-- /.row-->
                        <div class="row">  
                            <div class="form-group col-sm-6" v-if="correo">
                                <label for="postal-code">Destinatario</label>
                                <input class="form-control" v-model="destinatario" type="text" placeholder="Destinatario">
                            </div>
                            <div class="form-group col-sm-6" v-if="correo">
                                <label for="postal-code">Correo Electrónico</label>
                                <textarea cols="90" rows="5" v-model="correo_electronico" placeholder="Correo Electrónico" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row">  
                            <div class="form-group col-sm-6">
                                <label for="postal-code">Observaciones</label>
                                <textarea cols="90" rows="4" v-model="observ_resultado" placeholder="Observaciones" class="form-control"></textarea>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="postal-code">Disposiciones finales</label>
                                <textarea cols="90" rows="4" v-model="disposiciones" placeholder="Disposiciones" class="form-control"></textarea>
                            </div>
                        </div>
                        <div v-show="errorResultados" class="form-group row div-error">
                            <div class="text-center text-error">
                                <div v-for="error in errorMostrarMsjSolicitud" :key="error" v-text="error">
                                </div>
                            </div>
                        </div>
                    </form> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                    <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="crearResultados()">Guardar</button>
                    <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarResultados(recomendaciones.id)">Actualizar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialvue-datepickerog -->
    </div>
    <!--Fin del modal-->   
      </div>         
  </main>         
</template>

<script>
   // import datables from 'datatables'
    import vSelect from 'vue-select';
    import Datepicker from 'vuejs-datepicker';
    import { es } from 'vuejs-datepicker/dist/locale';
    import moment from "moment";
    
   import infSolicitud from './Sol_InformacionSol.vue';
    
    export default {
        data (){         
            return {
                es: es,
                openDate: new Date(),
                selectedDate: '',

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
               datosInformacionSol: [],

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

               //resultados
               soporte_impreso:'',
               correo:'',
               correo_destinatario:'',
               destinatario:'',               
               disposiciones:'',
               Observaciones_rev:'',
               equipos:'',
               arrayResultados:[],
               checkOtro:'',

               //recomendaciones

               recomendaciones_id:0,
               arrayRecomendaciones:[],
               recomendaciones:'',
               respuesta:'',
               vobo:'',  
               fecha_recom: new Date(),                            
               
               //CONFORMIDAD
               fecha_atendida:new Date(),
               fecha_solicitante:new Date(),
               nombre_atendida:'',
               nombre_solicitante:'',
               cargo_per_atendida:'',
               cargo_per_solicitante:'',


               //solicitud de ensayo
               fecha_registro: new Date(),
               nro_registro:'',               
               registraDatos:0,
               disp_finales:'',
               codigo:'',
               cantidad:0,
               //fecha:'',
               arraySolEnsayo:[],
               idSolEnsayo:'',
               solEnsayoUlt:'',
              
               
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
               descripcion:'',
               responsable:'',
               modal1:0,
               modal2:0,
               modal3:0,
               modal4:0,
               tituloModal:'',
               tipoAccion:0,
               errorSolicitud: 0,
               errorPersona: 0,
               errorInfSolicitud:0,
               errorRecomendaciones: 0,
               errorRevision: 0,
               errorResultados: 0,
               errorResultado: 0,
               errorConformidad: 0,
               errorMostrarMsjSolicitud:[],
               verificaError:0,               
            }
        },
        components: {
            vSelect,
            Datepicker,
            infSolicitud
          },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            
        },
        //props: ['olicitudInf'],
        methods : {
            resultadoInforSol(v){
                this.datosInformacionSol = v;
                console.log(this.datosInformacionSol);
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
                                 
            listarSolNroRegistro(){
                let me=this;
                var url= '/solicitudSolEnsayo/nroRegistro';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    console.log(respuesta,'respuesta');
                    if(respuesta.solicitud_ensayo==null ){
                        me.nro_registro = 1;    
                    }else{
                    me.nro_registro = respuesta.solicitud_ensayo;
                    me.nro_registro = me.nro_registro+1;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
          
            crearResultados() {
               /* if (this.validarResultados()){
                    return;
                }*/  
             
                this.arrayResultados.push({
                    soporte_impreso: this.soporte_impreso,
                    correo: this.correo, 
                    otro: this.otro, 
                    destinatario: this.destinatario, 
                    correo_electronico: this.correo_electronico, 
                    observ_resultado: this.observ_resultado, 
                    disposiciones: this.disposiciones,
                });
                console.log(this.arrayResultados,'resul***');
                this.modal4=0;
            },
            actualizarResultados (idResultados) {
                if (this.validarResultados()){
                    return;
                }
                this.idActualizar = idResultados;
                this.soporte_impreso = this.soporte_impreso;
                this.correo= this.correo;
                this.destinatario= this.destinatario;
                this.correo_electronico = this.correo_electronico;
                this.observ_resultado = this.observ_resultado;
                this.disposiciones = this.disposiciones;
                this.formActualizar = true;
                this.modal3=0;
            },
            eliminarResultados (idResultados) {
                // Borramos de la lista
                this.arrayResultados.splice(idResultados, 1);
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
                console.log(this.arrayRecomendaciones,'recomen***');
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
                console.log('ENTRA INF E');
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
                //if (!this.rechazado) this.errorMostrarMsjSolicitud.push("Debe ingresar las recomendaciones.");
               if (this.errorMostrarMsjSolicitud.length) this.errorRevision = 1;
                return this.errorRevision;
            },
            validarResultados(){
                this.errorResultados=0;  //aceptado rechazado
                this.errorMostrarMsjSolicitud =[];
                if (!this.soporte_impreso && !this.correo) this.errorMostrarMsjSolicitud.push("Marque la opción de soporte impreso o correo electrónico.");
                //if (!this.rechazado) this.errorMostrarMsjSolicitud.push("Debe ingresar las recomendaciones.");
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
                //this.data-dismiss="modal";
                this.modal1=0;
                this.modal2=0;
                this.modal3=0;
                this.modal4=0;
                this.tituloModal='';
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
                 
             //crear Resultados
            abrirModalResul(modelo, accion, data = []){
                switch(modelo){
                    case "resultados":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal4 = 1;
                                this.tituloModal = 'Registrar resultados';
                                    this.correo='';
                                    this.soporte_impreso='';
                                    this.otro='';
                                    this.correo_electronico='';
                                    this.destinatario='';
                                    this.observ_resultado='';
                                    this.disposiciones='';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal4=1;
                                this.tituloModal='Actualizar resultados';
                                this.tipoAccion=2;
                                this.soporte_impreso = data['soporte_impreso'];
                                this.resultados_id=data['id'];
                                this.correo = data['correo'];
                                this.otro = data['otro'];
                                this.destinatario = data['destinatario'];
                                this.correo_electronico = data['correo_electronico'];
                                this.observ_resultado = data['observ_resultado'];
                                this.disposiciones = data['disposiciones'];
                                break;
                            }
                        }
                    }
                }
            }, 
            abrirModalRecomend(modelo, accion, data = []){
                switch(modelo){
                    case "recomendaciones":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal3 = 1;
                                this.tituloModal = 'Registrar recomendaciones';
                                    this.recomendaciones='';
                                    this.respuesta='';
                                    this.vobo='';
                                    this.fecha='';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal3=1;
                                this.tituloModal='Actualizar recomendaciones';
                                this.tipoAccion=2;
                                this.fecha_recom = data['fecha_recom'];
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
              console.log(val1,'dato val1');
              let me = this;
              me.loading = true;
              me.idresponsable = val1.id;
              if (val1 =='') {
                 me.nombreResponsable='';
              }else{
                   if (val1.materno=='' || val1.materno==null) {
                    me.nombreResponsable = val1.paterno +' '+ val1.nombre;   
                  }else{
                 me.nombreResponsable = val1.paterno +' '+ val1.materno +' '+ val1. nombre;
                  }             
              }              
            },
            getDatosEncargado(val2){
              console.log(val2,'dato val2');
              let me = this;
              me.loading = true;
              me.idencargado = val2.id;
              if (val2 =='') {
                 me.nombreEncargado='';
              }else{
                  if (val2.materno=='' || val2.materno==null) {
                    me.nombreEncargado = val2.paterno +' '+ val2.nombre;   
                  }else{
                    me.nombreEncargado = val2.nombre +' '+ val2.paterno +' '+ val2.materno;
                 }
              }              
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
                    console.log(error);
            });

           },

            //BD solicitud   .....
            //Inicia **  *****************************
            //************************************** */
            registrarUnidadSolicitante(){
                /*if (this.validarUnidadSol()){
                    return;
                }*/
                
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
                   me.popToastError();
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
                        if (me.arrayUnidadSol[i].unidad == me.unidad) {
                            me.idUnidadSol = me.arrayUnidadSol[i].id;
                            console.log(me.arrayUnidadSol[i].unidad,'unidad');
                            console.log(me.idUnidadSol,'id this.idUnidadSol');
                            
                             axios.post('/solicitud/registrarSolEnsayo',{
                            'idunidad': me.idUnidadSol,
                            'nro_registro' : me.nro_registro,
                            'fecha_registro' : me.fecha_registro,
                            'usr_id':1,
                        }).then(function (response) {
                            console.log(response,'r4esponse sol ensayo');
                            me.registrarInfSolicitud();
                            /*me.registrarRevision();
                            me.registrarResultado();
                            me.registrarRecomendaciones();
                            me.registrarConformidad();
                           */ me.registraDatos=1;
                        }).catch(function (error) {
                            me.popToastError();
                            console.log(error,'e');
                        });
                            
                        }                                               
                    }
                   // return this.idUnidadSol;
                }).catch(function (error) {
                    console.log(error);
                });
            },
           
            RegistrarSolicitud(){
                //this.popToastReg();
                if (this.validarSolicitudEnsayo()){   
                    this.verificaError=1;
                    this.popToastError();  
                    console.log('entro*****1');   
                                  
                    return;
                }  
                if (this.validarRevision()){
                    this.verificaError=1;
                    this.popToastError();
                    console.log('entro*****2');
                    return;
                }
                if (this.validarResultados()){
                    this.verificaError=1;
                    this.popToastError();
                    console.log('entro*****3');
                    return;
                }
                if (this.validarConformidad()){
                    this.verificaError=1;
                    this.popToastError();
                    console.log('entro*****4');
                    return;
                }
                this.registrarUnidadSolicitante();
                //this.listarUnidadSolicitante();
                //location.reload();
                //this.registrarSolEnsayo();
                console.log('registro ..  fin');
              },
            registrarInfSolicitud(){
                console.log('entra..**************');

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
                            for (let i = 0; i < me.datosInformacionSol.length; i++) {                               
                                axios.post('/solicitud/registrarInfSolicitud',{
                                    'idsol_ensayo': me.idSolEnsayo,
                                    'cantidad' : me.datosInformacionSol[i].cantidad,
                                    'matriz' : me.datosInformacionSol[i].matriz,
                                    'analito' : me.datosInformacionSol[i].analito,
                                    'flujo': me.datosInformacionSol[i].flujo,
                                    'des_procedencia': me.datosInformacionSol[i].des_procedencia,
                                    'usr_id':1,
                                }).then(function (response) {
                                    console.log(response,'response inf solicitud');
                                    
                                    me.registraDatos=1;
                                // me.resetDatos();                                                                   
                                }).catch(function (error) {
                                    console.log(error);
                                    me.popToastError();
                                });
                            }
                            if (me.registraDatos == 1) {
                                me.registrarRevision();
                                me.registrarResultado();
                                me.registrarRecomendaciones();
                                me.registrarConformidad();
                                me.popToastReg();
                                location.reload();
                            }
                        }                                                                       
                    }               
                 }).catch(function (error) {
                    console.log(error);
                });
            },
            
            registrarRevision(){
                this.registraDatos = 0;     
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
                    me.popToastError();
                    console.log(error);
                });
            },
              
            registrarResultado(){
                this.registraDatos = 0;
        
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
                    me.popToastError();
                    console.log(error);
                });
            },
            registrarRecomendaciones(){
                this.registraDatos = 0;
                let me = this;
                console.log(me.fecha_recom,'fecha recoom *-*-*-');
                console.log(me.idSolEnsayo,'sol ensayo *-*-*-*-*-');
                
                axios.post('/solicitud/registrarRecomendaciones',{
                    'idsol_ensayo': me.idSolEnsayo,
                    'fecha' : me.fecha_recom,
                    'recomendaciones' : me.recomendaciones,
                    'respuesta' : me.respuesta,
                    'vobo' : me.vobo,
                    'usr_id':1,

                }).then(function (response) {

                    console.log(response,'reponse recomendaciones');
                }).catch(function (error) {
                    me.popToastError();
                    console.log(error);
                });
            },
            registrarConformidad(){
                this.registraDatos = 0;
                console.log(this.fecha_atendida,'fecha_atendida conformidad');
                console.log(this.fecha_solicitante,'fecha_solicitante conformidad');
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
                  // location.reload();
                }).catch(function (error) {
                    me.popToastError();
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
                    ' Se registraron los datos',
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
            this.listarSolNroRegistro();

        }
    }
    
</script>
<style>    
    .modal-content{
        width:100%;
        padding: 10px 20px;
        margin: 20% auto;
        position: absolute;
    }
    .mostrarr{
        display: list-item !important;
        opacity: 1 !important;
        position: fixed !important;
        background-color: #7e7c7c7a !important;
    }
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
@import './resources/assets/scss/coreui.scss';
/*@import 'node_modules/bootstrap/scss/bootstrap';
@import 'node_modules/bootstrap-vue/src/index.scss';*/

//$body-font-family: 'Open Sans', sans-serif;

$checkbox-bg-color-checked: #00bbd6;
$checkbox-border-color-checked: $checkbox-bg-color-checked;
$checkbox-bg-color-unchecked: #fff;
$checkbox-border-color-unchecked:  #757575;

body {
 // font-family: $body-font-family;

  .container  {
   // display: flex;
   // flex-wrap: wrap;
   // justify-content: center;
    .box {
      //text-align: center;
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

</style>