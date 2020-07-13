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
                    <h3>Preparación de Muestras</h3>                        
                    <b-button variant="info  pull-right" @click="abrirModal('recepcion','registrar')" style="right:0;"><b-icon-plus font-scale="1.5"></b-icon-plus>Nuevo</b-button>
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
                        :items="arrayPreparacion"
                        :fields="columnas"
                        :current-page="currentPage"
                        :per-page="perPage"
                        :filter="filter"
                        :filterIncludedFields="filterOn"
                        :sort-by.sync="sortBy"
                        :sort-desc.sync="sortDesc"
                        :sort-direction="sortDirection"                     
                    >
                        <template v-slot:head(fecha_analisis)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template> 
                        <template v-slot:head(fecha_muestreo)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>  
                        <template v-slot:head(codigo)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>  
                        <template v-slot:head(codigo_laboratorio)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>  
                        <template v-slot:head(peso)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>   
                        <template v-slot:head(acciones)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>                       
                        <template v-slot:cell(acciones)="row">
                        <a href="#" @click="abrirModal('recepcion','actualizar',row.item)" v-b-tooltip.hover title="Actualizar">
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
                            <b-form-group id="input-group-1"  label="Fecha análisis:" label-for="input-2" >
                                <datepicker 
                                    :bootstrap-styling="true"
                                    :language="es"                                     
                                    calendar-class="datepicker1"                            
                                    :open-date="openDate"
                                    format="dd/MM/yyyy"
                                    v-model="fecha_analisis"  
                                    calendar-button
                                    calendar-button-icon="fa fa-calendar"   
                                ></datepicker>
                            </b-form-group>
                         </div>
                         <div class="form-group col-sm-4">
                            <b-form-group id="input-group-1"  label="Fecha muestreo:" label-for="input-2" >
                                <datepicker 
                                    :bootstrap-styling="true"
                                    :language="es"                                     
                                    calendar-class="datepicker1"                            
                                    :open-date="openDate"
                                    format="dd/MM/yyyy"
                                    v-model="fecha_muestreo"  
                                    calendar-button
                                    calendar-button-icon="fa fa-calendar"   
                                ></datepicker>
                            </b-form-group>
                         </div>
                         <div class="form-group col-sm-4">
                            <b-form-group id="input-group-2"  label="Codigo recepción:" label-for="input-2" >                                                              
                                <b-form-select v-model="idrecepcion" class="mb-3" @change="selectCodigoLab(idrecepcion)" required>
                                    <b-form-select-option value="0" disabled>-- Seleccionar --</b-form-select-option>
                                    <b-form-select-option v-for="recepcion in arrayRecepcion" :key="recepcion.id" :value="recepcion.id" v-text="recepcion.codigo_cliente"></b-form-select-option>
                                </b-form-select> 
                            </b-form-group>
                         </div>                                                 
                       </div>                    
                       <div class="row">    
                       <div class="form-group col-sm-4">
                            <b-form-group id="input-group-2"  label="Codigo laboratorio:" label-for="input-2" >                                                              
                                <b-form-select v-model="idcodigo_lab" class="mb-3" @change="selectCodigoLabid(idcodigo_lab)" required> 
                                    <b-form-select-option value="0" disabled>-- Seleccionar --</b-form-select-option>
                                    <b-form-select-option v-for="codigo in arrayCodigoLab" :key="codigo.id" :value="codigo.id" v-text="codigo.codigo_lab"></b-form-select-option>
                                </b-form-select> 
                            </b-form-group>
                         </div>                       
                          <!--div class="form-group col-sm-4">
                          
                            <b-form-group id="input-group-3"  label="Código Laboratorio:" label-for="input-2" >
                                <b-form-input id="input-3" v-model="codigo_lab" placeholder="Código Laboratorio" required                            
                                ></b-form-input>
                            </b-form-group>
                         </div--> 
                         <div class="form-group col-sm-4">
                            <b-form-group id="input-group-3"  label="Peso:" label-for="input-2" >
                                <b-form-input id="input-3" v-model="peso" placeholder="Peso" required                            
                                ></b-form-input>
                            </b-form-group>
                         </div>
                         <div class="form-group col-sm-4">                           
                            <div class="container">
                                <div class="box">
                                    <div class="checkbox-group">
                                    <input id="checkboxName1" type="checkbox" v-model="vs" @change="checkBoxSol(0)"/>
                                    <label for="checkboxName1" class="ta">VS</label>
                                    <input id="checkboxName2" type="checkbox" v-model="vh" @change="checkBoxSol(1)"/>
                                    <label for="checkboxName2" class="ta">VH</label> 
                                    </div>
                                </div>
                            </div> 
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
                        <b-button type="submit" v-if="tipoAccion==1" variant="primary" @click="registrarPreparacion()">Guardar</b-button>
                        <b-button type="submit" v-if="tipoAccion==2" variant="primary" @click="actualizarPreparacion()">Actualizar</b-button>
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

                preparacion_id: 0,
                idrecepcion : 0,
                codigo_lab:'',
                codigo_lab:'',
                fecha_analisis: new Date(),
                fecha_muestreo: new Date(),
                idcodigo_lab:'',
                vs : '',
                observaciones: '',
                vh:'',
                peso:'',
                arrayCodigoLab:[],
                arrayPreparacion : [],
                arrayRecepcion :[],
                tituloModal : '',

                modal : 0,                
                tipoAccion : 0,
                dismissSecs: 5,
                dismissCountDown: 0,
                show: true, 
                columnas: [
                  { key: 'fecha_analisis', label: 'Fecha análisis', sortable: true, sortDirection: 'desc' },
                  { key: 'fecha_muestreo', label: 'Fecha muestreo', sortable: true, sortDirection: 'desc' },
                  { key: 'codigo', label: 'Cod. recepción', sortable: true, class: 'text-justify' },                 
                  { key: 'codigo_lab', label: 'Código laboratorio', sortable: true },                 
                  { key: 'peso', label: 'Peso', sortable: true },                 
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

            listarPreparacion (){
                let me=this;
                var url= '/preparacion';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayPreparacion = respuesta.preparaciones.data;
                    me.totalRows = me.arrayPreparacion.length;
                    console.log(me.arrayPreparacion,'me.arrayPreparacion...');
                })
                .catch(function (error) {
                    console.log(error);
                });
            },          

            onSubmit(evt) {
                evt.preventDefault()  //val. form
            },
            registrarPreparacion(){ 
                /*for (let i = 0; i < this.arrayPreparacion; i++) {
                    const codigo = this.arrayPreparacion[i].codigo_lab;
                    
                }*/
                console.log(this.fecha_analisis,'entra fecha');
                this.fecha_analisis = moment(this.fecha_analisis).format('D/MM/YYYY');
                console.log(this.fecha_analisis,'fechaaaaaa');
                let me = this;
                    console.log('entra 0');
                        axios.post('/preparacion/registrar',{
                        'idrecepcion': this.idrecepcion, 
                        'codigo_lab': this.codigo_lab,
                        'fecha_analisis': this.fecha_analisis,
                        'fecha_muestreo': this.fecha_muestreo,
                        'peso': this.peso,
                        'vs': this.vs,
                        'vh': this.vh,
                        'observaciones': this.observaciones,
                        'usr_id':1,

                        }).then(function (response) {                   
                        me.listarPreparacion();
                        me.cerrarModal();   
                    }).catch(function (error) {
                        console.log(error);
                    });              
            },
            
            actualizarPreparacion(){             
                let me = this;
                this.fecha_analisis = moment(this.fecha_analisis).format('D/MM/YYYY');
                axios.put('/preparacion/actualizar',{
                    'idrecepcion': this.idrecepcion,
                    'codigo_lab': this.codigo_lab,
                    'fecha_analisis': this.fecha_analisis,
                    'fecha_muestreo': this.fecha_muestreo,
                    'peso': this.peso,
                    'vs': this.vs,
                    'vh': this.vh,
                    'observaciones': this.observaciones,
                    'id': this.preparacion_id,
                    'usr_id':1,
                }).then(function (response) {
                    me.listarPreparacion();
                    me.cerrarModal();
                }).catch(function (error) {
                    console.log(error);
                });               
            },
            
            selectRecepcion(){
                let me=this;
                var url= '/recepcion/selectRecepcion';
                axios.get(url).then(function (response) {
                    console.log(response,'select');
                    var respuesta= response.data;                                        
                    me.arrayRecepcion = respuesta.recepcion;
                    console.log('ENTRO A ARRAY');
                    console.log(me.arrayRecepcion,'select 3 array ');
                   // console.log(me.arrayRecepcion.filter(distinct),'unique ......');

                   
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            
            selectCodigoLab(idrecepcion){
                console.log(idrecepcion,'idrecepcion codigo+++++');  
               // var c=0;
                for (let i = 0; i < this.arrayRecepcion.length; i++) {
                    console.log(this.arrayRecepcion[i].id,'arrary id');
                    if (idrecepcion == this.arrayRecepcion[i].id) {
                        var codigo = this.arrayRecepcion[i].codigo_cliente;   
                        
                        console.log(codigo,'codigo.');                     
                    }                    
                }
                console.log(codigo,'codigo--');
                let me=this;
                var url= '/recepcion/selectCodigoLab?filtro='+codigo;
                axios.get(url).then(function (response) {
                    console.log(response,'select');
                    var respuesta= response.data;                                        
                    me.arrayCodigoLab = respuesta.recepcion;
                    console.log(me.arrayCodigoLab,'select 4     cod lab');
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            selectCodigoLabid(idcod){
                console.log(this.arrayCodigoLab,'*************');
                for (let i = 0; i < this.arrayCodigoLab.length; i++) {
                    console.log(this.arrayCodigoLab[i],'djvjdvjdbv');
                    console.log(this.arrayCodigoLab[i].id,'arrary id');
                    if (idcod == this.arrayCodigoLab[i].id) {
                        var codigo = this.arrayCodigoLab[i].codigo_lab;   
                        this.codigo_lab = codigo;
                        
                        console.log(codigo,'codigo.');                     
                        console.log(this.codigo_lab,'codigo. lab');  
                    }                    
                }
            },

            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.idrecepcion= 0;
                this.idcodigo_lab = '';
                this.codigo_recepcion = '';
                this.peso = '';
                this.fecha_muestreo = '';
                this.fecha_analisis = '';
                this.vh= '';
                this.vs='';
                this.observaciones='';
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "recepcion":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Preparación';
                                this.idrecepcion= 0;
                                this.idcodigo_lab = 0;
                              //  this.codigo_recepcion = '';
                                this.peso = '';
                                this.fecha_muestreo = new Date();
                                this.fecha_analisis = new Date();
                                this.vh= '';
                                this.vs='';
                                this.observaciones='';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal=1;
                                this.tituloModal='Actualizar Preparación';
                                this.tipoAccion=2;
                                this.preparacion_id=data['id'];
                                this.idrecepcion=data['idrecepcion'];
                               // this.codigo_analisis=data['codigo_analisis'];
                                this.idcodigo_lab = data['idcodigo_lab'];
                                this.peso=data['peso'];
                                this.fecha_analisis=data['fecha_analisis'];
                                this.fecha_muestreo=data['fecha_muestreo'];
                                this.vs= data['vs'];
                                this.vh= data['vh'];
                                this.observaciones= data['observaciones'];
                                break;
                            }
                        }
                    }
                }
                this.selectRecepcion();
            },
            checkBoxSol(val){
               if (val==0) {
                  if (this.vs == true) {
                    this.vh = false;
                }  
               }else if(val==1){
                   if (this.vh == true) {
                     this.vs = false;}
               }     
           },           
        },
        mounted() {            
            this.listarPreparacion();            
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
        position: fixed !important;
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
