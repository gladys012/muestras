<template>
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
        </ol>
        <div class="container-fluid">
            <!--Tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <h3>Determinación de potasio por valoración por retroceso</h3>                        
                    <b-button variant="info  pull-right" @click="abrirModal('potasio_val','registrar')" style="right:0;"><b-icon-plus font-scale="1.5"></b-icon-plus>Nuevo</b-button>
                </div>
                <div class="card-body"> 
                    <b-row>                        
                    <b-col lg="6" class="my-1">
                        <b-form-group
                        label="Filtrar"
                        label-cols-sm="3"
                        label-align-sm="right"
                        label-size="md"
                        label-for="filterInput"
                        class="mb-0"
                        >
                        <b-input-group size="md">
                            <b-form-input
                            v-model="filter"
                            type="search"
                            id="filterInput"
                            placeholder="Introduce la búsqueda"
                            ></b-form-input>
                            <b-input-group-append>
                            <b-button :disabled="!filter" @click="filter = ''" variant="info">Buscar</b-button>
                            </b-input-group-append>
                        </b-input-group>
                        </b-form-group>
                    </b-col> 
                    <b-col sm="4" md="6" class="my-1">
                        <b-form-group
                        label="Mostrar registros"
                        label-cols-sm="6"
                        label-cols-md="4"
                        label-cols-lg="3"
                        label-align-sm="right"
                        label-size="md"
                        label-for="perPageSelect"
                        class="mb-0"
                        >
                        <b-form-select
                            v-model="perPage"
                            id="perPageSelect"
                            size="md"
                            :options="pageOptions"
                        ></b-form-select>
                        </b-form-group>
                    </b-col>                   
                    </b-row>                                                                              
                    <b-table
                        show-empty striped
                        hover responsive 
                        stacked="md"
                        :items="arraySulfato_grav"
                        :fields="columnas"
                        :current-page="currentPage"
                        :per-page="perPage"
                        :filter="filter"
                        :filterIncludedFields="filterOn"
                        :sort-by.sync="sortBy"
                        :sort-desc.sync="sortDesc"
                        :sort-direction="sortDirection"                     
                    >
                        <template v-slot:head(fecha)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>  
                        <template v-slot:head(codigo_lab)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>  
                        <template v-slot:head(dil)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>  
                        <template v-slot:head(masa_muestra)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>   
                        <template v-slot:head(vol_alicuota)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>   
                        <template v-slot:head(acciones)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>                       
                        <template v-slot:cell(acciones)="row">
                        <a href="#" @click="abrirModal('potasio_val','actualizar',row.item)" v-b-tooltip.hover title="Actualizar">
                            <b-icon-pencil-square variant="info" font-scale="1.5"></b-icon-pencil-square>
                        </a>
                        <a href="#" @click="row.toggleDetails" v-b-tooltip.hover.d50 title="Detalles">
                            <b-icon-eye-fill variant="info" font-scale="1.5"></b-icon-eye-fill >
                        </a>                                        
                        </template>
                        <template v-slot:row-details="row">
                            <b-card>
                                <ul>
                                <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value }}</li>
                                </ul>
                            </b-card>
                        </template>
                    </b-table>
                    <b-row>
                    <b-col sm="7" md="6" class="my-1">
                        <b-pagination
                        v-model="currentPage"
                        :total-rows="totalRows"
                        :per-page="perPage"
                        align="fill"
                        size="sm"
                        class="my-0"
                        ></b-pagination>
                    </b-col>
                    </b-row>
                </div>
            </div>
            <!-- Fin -->
        </div>
        <!--Inicio del modal agregar/ modificar-->
        <div class="modal fade" :class="{'mostrarr' : modal}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" v-text="tituloModal"></h4>
                    <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <b-form @submit="onSubmit" v-if="show">
                       <div class="row">
                         <div class="form-group col-sm-4">
                            <b-form-group id="input-group-1"  label="Fecha:" label-for="input-2" >
                                <datepicker 
                                    :bootstrap-styling="true"
                                    :language="es"                                     
                                    calendar-class="datepicker1"                            
                                    :open-date="openDate"
                                    format="dd/MM/yyyy"
                                    v-model="fechaD"  
                                    calendar-button
                                    calendar-button-icon="fa fa-calendar"   
                                ></datepicker>
                            </b-form-group>
                         </div>
                         <div class="form-group col-sm-4">
                            <b-form-group id="input-group-2"  label="Código laboratorio:" label-for="input-2" >                                                              
                            <b-form-select v-model="idpreparacion" class="mb-3" required>
                                <b-form-select-option value="0" disabled>-- Seleccionar --</b-form-select-option>
                                <b-form-select-option v-for="preparacion in arrayPreparacion" :key="preparacion.id" :value="preparacion.id" v-text="preparacion.codigo_lab"></b-form-select-option>
                            </b-form-select> 
                            </b-form-group>
                         </div>
                         <div class="form-group col-sm-4">
                            <b-form-group id="input-group-4"  label="Masa muestra:" label-for="input-4" >
                                <b-form-input id="input-4" v-model="masa_muestra" placeholder="Masa muestra" required                            
                                ></b-form-input>
                            </b-form-group>
                         </div>                                                 
                       </div>                    
                       <div class="row">                                                                               
                         <div class="form-group col-sm-4">
                            <b-form-group id="input-group-3"  label="Dil.:" label-for="input-2" >
                                <b-form-input id="input-3" v-model="dil" placeholder="Dil." required                            
                                ></b-form-input>
                            </b-form-group>
                         </div> 
                         <div class="form-group col-sm-4">
                            <b-form-group id="input-group-5"  label="Vol. alicuota:" label-for="input-5" >
                                <b-form-input id="input-5" v-model="vol_alicuota" placeholder=" Vol. alicuota" required                            
                                ></b-form-input>
                            </b-form-group>
                         </div>
                         <div class="form-group col-sm-4">
                            <b-form-group id="input-group-3"  label="Vol. gast. blanco:" label-for="input-2" >
                                <b-form-input id="input-3" v-model="vol_gastado_blanco" placeholder="Vol. gast. blanco(ml)" required                            
                                ></b-form-input>
                            </b-form-group>
                         </div>                                                                           
                       </div>
                       <div class="row">                                                      
                          <div class="form-group col-sm-4">
                            <b-form-group id="input-group-4"  label="Vol. gastado:" label-for="input-4" >
                                <b-form-input id="input-4" v-model="vol_gastado" placeholder="Vol. gastado(ml)" required  
                                ></b-form-input>
                            </b-form-group>
                         </div>  
                         <div class="form-group col-sm-4">
                            <b-form-group id="input-group-4"  label="Título:" label-for="input-4" >
                                <b-form-input id="input-4" v-model="titulo" placeholder="Título(mg/ml)" required  
                                ></b-form-input>
                            </b-form-group>
                         </div>                                                                          
                       </div>
                       <div class="row">
                          <div class="form-group col-sm-12">
                              <b-form-group id="input-group-6" label="Observaciones:" label-for="input-6">                                
                                <b-form-textarea
                                    id="textarea"
                                    v-model="observaciones"
                                    placeholder="Observaciones"
                                    rows="3" max-rows="4"
                                    ></b-form-textarea>
                            </b-form-group>
                          </div>
                       </div>                           
                      <div class="modal-footer">
                        <b-button type="reset" variant="secondary" @click="cerrarModal()">Cerrar</b-button>
                        <b-button type="submit" v-if="tipoAccion==1" variant="primary" @click="registrarPotasio_Val()">Guardar</b-button>
                        <b-button type="submit" v-if="tipoAccion==2" variant="primary" @click="actualizarPotasio_Val()">Actualizar</b-button>
                      </div>
                    </b-form>                   
                </div>                
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-d -->
    </div>
    <!--Fin del modal-->
  </main>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    import { es } from 'vuejs-datepicker/dist/locale';
    import moment from "moment";
    export default {
        data (){            
            return {
                es: es,
                openDate: new Date(),

                cloruros_vol_id: 0,
                idpreparacion : 0,
                dil:'',
                fechaD: new Date(),
                codigo_lab:'',
                vol_alicuota : '',
                observaciones: '',
                vol_gastado_blanco:'',
                masa_muestra:'',
                vol_gastado:'',
                arraySulfato_grav : [],
                arrayPreparacion :[],
                tituloModal : '',

                modal : 0,                
                tipoAccion : 0,
                dismissSecs: 5,
                dismissCountDown: 0,
                show: true,
                columnas: [
                  { key: 'fecha', label: 'Fecha', sortable: true, sortDirection: 'desc' },
                  { key: 'codigo_lab', label: 'Cod. laboratorio', sortable: true, class: 'text-justify' },                 
                  { key: 'dil', label: 'Dil.', sortable: true },                 
                  { key: 'masa_muestra', label: 'Masa muestra', sortable: true },                 
                  { key: 'vol_alicuota', label: 'Vol. alicuota', sortable: true },                 
                  { key: 'acciones', label: 'Acciones',  sortable: false}
                ],
                perPage: 10,
                selectedID: null,
                totalRows: 1,
                currentPage: 1,
                pageOptions: [10, 15, 20,50,100],
                sortBy: '',
                sortDesc: false,
                sortDirection: 'asc',
                filter: null,
                filterOn: [],
            }
        },
        components: {
            Datepicker
          },
        computed:{

        },
        methods : {

            onFiltered(filteredItems) {
              // Trigger pagination to update the number of buttons/pages due to filtering
              this.totalRows = filteredItems.length;
              this.currentPage = 1
            },

            listarSulfato_grav (){
                let me=this;
                var url= '/potasio_val';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arraySulfato_grav = respuesta.potasio_val.data;
                    me.totalRows = me.arraySulfato_grav.length;
                    console.log(me.arraySulfato_grav,'me.arraySulfato_grav...');
                })
                .catch(function (error) {
                    console.log(error);
                });
            },          

            onSubmit(evt) {
                evt.preventDefault()  //val. form
            },
            registrarPotasio_Val(){ 
                console.log(this.fechaD,'entra fecha');
                this.fechaD = moment(this.fechaD).format('D/MM/YYYY');
                console.log(this.fechaD,'fechaaaaaa');
                let me = this;
                    console.log('entra 0');
                        axios.post('/potasio_val/registrar',{
                        'idpreparacion': this.idpreparacion,    
                        'dil': this.dil,
                        'fecha': this.fechaD,
                        'codigo_lab' : this.codigo_lab,
                        'masa_muestra' : this.masa_muestra,
                        'vol_alicuota' : this.vol_alicuota,
                        'vol_gastado_blanco' : this.vol_gastado_blanco,
                        'vol_gastado' : this.vol_gastado,
                        'observaciones' : this.observaciones,
                        'usr_id':1,

                        }).then(function (response) {                   
                        me.listarSulfato_grav();
                        me.cerrarModal();   
                    }).catch(function (error) {
                        console.log(error);
                    });              
            },
            
            actualizarPotasio_Val(){             
                let me = this;
                this.fechaD = moment(this.fechaD).format('D/MM/YYYY');
                axios.put('/potasio_val/actualizar',{
                    'idpreparacion': this.idpreparacion, 
                    'dil': this.dil,
                    'fecha': this.fechaD,
                    'codigo_lab' : this.codigo_lab,
                    'masa_muestra' : this.masa_muestra,
                    'vol_alicuota' : this.vol_alicuota,
                    'vol_gastado_blanco' : this.vol_gastado_blanco,
                    'vol_gastado' : this.vol_gastado,
                    'observaciones' : this.observaciones,
                    'id': this.cloruros_vol_id,
                    'usr_id':1,
                }).then(function (response) {
                    me.listarSulfato_grav();
                    me.cerrarModal();
                }).catch(function (error) {
                    console.log(error);
                });               
            },
            
            selectPreparacion(){
                let me=this;
                var url= '/preparacion/selectPreparacion';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayPreparacion = respuesta.preparaciones.data;
                    console.log(me.arrayPreparacion,'select 3');
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.idpreparacion= 0;
                this.fechaD = new Date(),
                this.codigo_lab = '';
                this.dil = '';
                this.masa_muestra = '';
                this.vol_gastado = '';
                this.observaciones = '';
                this.vol_gastado_blanco= '';
                this.vol_alicuota= '';
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "potasio_val":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Sulfato por Gravimetría';
                                this.idpersona= 0;
                                this.fechaD = new Date(),
                                this.codigo_lab = '';
                                this.dil = '';
                                this.masa_muestra = '';
                                this.vol_gastado = '';
                                this.observaciones = '';
                                this.vol_gastado_blanco= '';
                                this.vol_alicuota= '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal=1;
                                this.tituloModal='Actualizar Sulfato por Gravimetría';
                                this.tipoAccion=2;
                                this.cloruros_vol_id=data['id'];
                                this.idpreparacion=data['idpreparacion'];
                                this.fechaD = data['fecha'];
                                this.codigo_lab=data['codigo_lab'];
                                this.dil=data['dil'];
                                this.masa_muestra=data['masa_muestra'];
                                this.vol_gastado=data['vol_gastado'];
                                this.observaciones=data['observaciones'];
                                this.vol_gastado_blanco= data['vol_gastado_blanco'];
                                this.vol_alicuota= data['vol_alicuota'];
                                break;
                            }
                        }
                    }
                }
                this.selectPreparacion();
            }
        },
        mounted() {            
            this.listarSulfato_grav();            
        }
    }
</script>
<style>    
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
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
