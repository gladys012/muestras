<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Solicitud</title>
</head>
<body>
    <div>
        <h2>Formulario de solicitud</h2>
    </div>
    <div>
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
    </div>
</body>
</html>