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
                    <h3>  Determinación de Cloruros por Volumetría</h3>                        
                    <b-button variant="info  pull-right" @click="abrirModal('cloruros_vol','registrar')" style="right:0;"><b-icon-plus font-scale="1.5"></b-icon-plus>Nuevo</b-button>
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
                        :items="arrayCloruros_vol"
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
                        <template v-slot:head(codigo_laboratorio)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>  
                        <template v-slot:head(dilucion)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>  
                        <template v-slot:head(vol_muestra)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>   
                        <template v-slot:head(acciones)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>                         
                        <template v-slot:cell(acciones)="row">
                        <a href="#" @click="abrirModal('cloruros_vol','actualizar',row.item)" v-b-tooltip.hover title="Actualizar">
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
                            <b-form-select v-model="idpreparacion" class="mb-3" required @change="nombreDilucion(idpreparacion)">
                                <b-form-select-option value="0" disabled>-- Seleccionar --</b-form-select-option>
                                <b-form-select-option v-for="preparacion in arrayPreparacion" :key="preparacion.id" :value="preparacion.id" v-text="preparacion.codigo_lab"></b-form-select-option>
                            </b-form-select> 
                            </b-form-group>
                         </div>
                         <div class="form-group col-sm-4">
                            <b-form-group id="input-group-3" label="Dilución:" label-for="input-2" >
                                <b-form-input id="input-3" v-model="dilucion" disabled
                                ></b-form-input>
                            </b-form-group>
                         </div>                         
                       </div>                    
                       <div class="row">
                          <div class="form-group col-sm-4">
                            <b-form-group id="input-group-4"  label="Vol. muestra:" label-for="input-4" >
                                <b-form-input id="input-4" v-model="vol_muestra" placeholder="Vol. muestra" required                            
                                ></b-form-input>
                            </b-form-group>
                         </div> 
                         <div class="form-group col-sm-4">
                            <b-form-group id="input-group-5"  label="Vol. gastado:" label-for="input-5" >
                                <b-form-input id="input-5" v-model="vol_gastado" placeholder=" Vol. gastado" required                            
                                ></b-form-input>
                            </b-form-group>
                         </div>
                         <div class="form-group col-lg-4">
                            <b-form-group id="input-group-6" label="Conc. Tit.:" label-for="input-6">
                                <b-form-input id="input-6" 
                                    v-model="conc_tit"  type="text" placeholder="Conc Tit." required>
                                </b-form-input>
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
                        <b-button type="submit" v-if="tipoAccion==1" variant="primary" @click="registrarCloruros_vol()">Guardar</b-button>
                        <b-button type="submit" v-if="tipoAccion==2" variant="primary" @click="actualizarCloruros_vol()">Actualizar</b-button>
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
                dilucion:'',
                fechaD: new Date(),
                codigo_lab:'',
                vol_gastado : '',
                observaciones: '',
                conc_tit:'',
                vol_muestra:'',
                arrayCloruros_vol : [],
                arrayPreparacion :[],
                tituloModal : '',
                arrayDilucionClo: [],
                v1f:'',
                v2f:'',
                v1i:'',

                modal : 0,                
                tipoAccion : 0,
                dismissSecs: 5,
                dismissCountDown: 0,
                show: true,
                columnas: [
                  { key: 'fecha', label: 'Fecha', sortable: true, sortDirection: 'desc' },
                  { key: 'codigo_laboratorio', label: 'Cod. laboratorio', sortable: true, class: 'text-justify' },                 
                  { key: 'dilucion', label: 'Dilución', sortable: true },                 
                  { key: 'vol_muestra', label: 'Volumen muestra', sortable: true },                 
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

            listarCloruros_vol (){
                let me=this;
                var url= '/cloruros_vol';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayCloruros_vol = respuesta.cloruros_vol.data;
                    me.totalRows = me.arrayCloruros_vol.length;
                    console.log(me.arrayCloruros_vol,'me.arrayCloruros_vol...');
                })
                .catch(function (error) {
                    console.log(error);
                });
            },          

            onSubmit(evt) {
                evt.preventDefault()  //val. form
            },

            registrarCloruros_vol(){ 
                //me.resultadoCloruros_vol();
                console.log(this.fechaD,'fecha***');
                this.fechaD = moment(this.fechaD).format('D/MM/YYYY');
                console.log(this.fechaD,'fechaaaaaa');
                let me = this;
                    console.log('entra 0');
                        axios.post('/cloruros_vol/registrar',{
                        'idpreparacion': this.idpreparacion,    
                        'dilucion': this.dilucion,
                        'fecha': this.fechaD,
                        'codigo_lab' : this.codigo_lab,
                        'vol_muestra' : this.vol_muestra,
                        'vol_gastado' : this.vol_gastado,
                        'conc_tit' : this.conc_tit,
                        'observaciones' : this.observaciones,
                        'usr_id':1,

                        }).then(function (response) {   
                                            
                        me.datosCloruros_vol();
                          
                    }).catch(function (error) {
                        me.fechaD = me.fechaD;
                            console.log(error);
                    });              
            },
            
            actualizarCloruros_vol(){             
                let me = this;
                this.fechaD = moment(this.fechaD).format('D/MM/YYYY');
                axios.put('/cloruros_vol/actualizar',{
                    'idpreparacion': this.idpreparacion, 
                    'dilucion': this.dilucion,
                    'fecha': this.fechaD,
                    'codigo_lab' : this.codigo_lab,
                    'vol_muestra' : this.vol_muestra,
                    'vol_gastado' : this.vol_gastado,
                    'conc_tit' : this.conc_tit,
                    'observaciones' : this.observaciones,
                    'id': this.cloruros_vol_id,
                    'usr_id':1,
                }).then(function (response) {
                    me.listarCloruros_vol();
                    me.cerrarModal();
                }).catch(function (error) {
                    console.log(error);
                });               
            },
            
            datosCloruros_vol(){
                console.log(this.arrayRecepcion,'arrayRecepcion');
                let dil_tipo = this.arrayRecepcion[0].dilucion_tipo;
                let dil_nombre = this.arrayRecepcion[0].dilucion_nombre;
                let me=this;
                if(dil_tipo == 'cristales'){
                var url = "/recepcion/selectCristales";
                axios
                    .get(url)
                    .then(function(response) {
                        console.log(response, "select");
                        var respuesta = response.data;
                        me.arrayDilucion = respuesta.recepcion;
                        console.log(me.arrayDilucion, "select 3 dil cristales");
                        //var datDil = me.arrayDilucion[0].dilucion_nombre;
                        for (let i = 0; i < me.arrayDilucion.length; i++) {
                            const datDilucion = me.arrayDilucion[i].nombre_dilucion;
                            if (dil_nombre == datDilucion) {
                                console.log('entra',me.arrayDilucion[i]);
                                me.v1f = me.arrayDilucion[i].v1f;
                                me.v2i = me.arrayDilucion[i].v2i;
                                me.v2f = me.arrayDilucion[i].v2f;
                                console.log(me.v1f,'v1f fr');
                                me.resultado();
                            }                            
                        }
                    })
                    .catch(function(error) {
                    console.log(error);
                    });
                }
                else if(dil_tipo == 'salmueras'){
                var url = "/recepcion/selectSalmueras";
                axios
                    .get(url)
                    .then(function(response) {
                    console.log(response, "select");
                    var respuesta = response.data;
                    me.arrayDilucion = respuesta.recepcion;
                    console.log(me.arrayDilucion, "select 3 dil salm");
                    })
                    .catch(function(error) {
                    console.log(error);
                    });
                } 
                else if (dil_tipo == 'aguas') {
                    var url = "/recepcion/selectAguas";
                    axios
                    .get(url)
                    .then(function(response) {
                    console.log(response, "select");
                    var respuesta = response.data;
                    me.arrayDilucion = respuesta.recepcion;
                    console.log(me.arrayDilucion, "select 3 dil aguas");

                    })
                    .catch(function(error) {
                    console.log(error);
                    });
                }   
                /*console.log(me.arrayCloruros_vol,'array clorurioas');
                for (let i = 0; i < this.arrayCloruros_vol.length; i++) {
                    if (this.codigo_laboratorio == this.arrayCloruros_vol[i].codigo_laboratorio) {
                        let peso = this.arrayCloruros_vol[i].peso;
                        console.log(peso, 'peso');
                    }
                    
                } 
                */ 
                /*var url= '/cloruros/selectDilucion?dil_tipo='+dil_tipo + '&dil_nombre='+ dil_nombre ;
                axios.get(url).then(function (response) {
                    console.log(response,'select');
                    var respuesta= response.data;
                    me.arrayDilucionClo = respuesta.cloruros_vol;
                    console.log(me.arrayDilucionClo,'select 3 id datos');
                  //  me.dilucion = me.arrayRecepcion[0].dilucion_nombre;
                })
                .catch(function (error) {
                    console.log(error);
                });*/

                
               /*Function Cloruros(RDiluciones, Masa, Dilucion, Alicuota, Vg, Normalidad)
                RDiluciones  = Tabla Cloruros (Selected * from cloruros where dilucion=FD)
                    RDilucionesV1f=V1f
                    RDilucionesV2i = V2i
                    RDilucionesV2f=V2f
                Masa =Peso(g),
                Dilucion=FD,
                Alicuota= Alic(ml),
                Vg=Vol.Gast (ml),
                Normalidad= Conc. Titulante

                Pre = 35453 * Normalidad * Vg / Alicuota
                Cloruros = Pre * RDilucionesV1f * RDilucionesV2f / 10000 / Masa / RDilucionesV2i*/
               
               
               /*console.log('ingresa formula');
                console.log(me.v1f,'v1f form');
                let RDilucionesV1f = this.v1f;
                let RDilucionesV2i = this.v2i;
                let RDilucionesV2f = this.v2f;
                var masa = peso;
                //let dilucionF = this.vol_muestra; //arreglar
                let alicuota = this.vol_muestra;
                let vg = this.vol_gastado;
                let normalidad = this.conc_tit;

                let pre = (35453)*(normalidad)*vg /alicuota;
                console.log(pre,'pre');
                let cloruros = pre*RDilucionesv1f*RDilucionesV2f/10000/masa/RDilucionesV2i;
                console.log(cloruros,'resul cloruros');*/
                //this.resultado();
            },

            resultado(){
                console.log(this.arrayCloruros_vol,'array clorurioas');
                for (let i = 0; i < this.arrayCloruros_vol.length; i++) {
                    if (this.codigo_laboratorio == this.arrayCloruros_vol[i].codigo_laboratorio) {
                        let peso = this.arrayCloruros_vol[i].peso;
                        console.log(peso, 'peso');
                    }
                    
                }
                console.log('ingresa formula');
                console.log(this.v1f,'v1f form');
                //var RDilucionesV1f = this.v1f;
                //console.log(RDilucionesV1f,'RDilucionesV1f');
                var RDilucionesV2i = this.v2i;
                var RDilucionesV2f = this.v2f;
                var masa = 1;
                //let dilucionF = this.vol_muestra; //arreglar
                let alicuota = this.vol_muestra;
                console.log(alicuota,'alicuota');
                console.log(this.vol_muestra,'muestras alidcuota');
                let vg = this.vol_gastado;
                console.log(vg,'vg');
                let normalidad = this.conc_tit;
                console.log(normalidad,'normalidad');

                let pre = (35453)*(normalidad)*vg /alicuota;
                console.log(pre,'pre');

                let RDilucionesV1f = this.v1f;
                console.log(RDilucionesV1f,'RDilucionesV1f 1231');
                let cloruros = (pre)*(RDilucionesV1f)*(RDilucionesV2f)/10000/(masa)/(RDilucionesV2i);
                console.log(cloruros,'resul cloruros');

                this.listarCloruros_vol();                        
                this.cerrarModal(); 
            },

            selectPreparacion(){
                let me=this;
                var url= '/preparacion/selectPreparacion';
                axios.get(url).then(function (response) {
                    console.log(response,'select');
                    var respuesta= response.data;
                    me.arrayPreparacion = respuesta.preparaciones;
                    console.log(me.arrayPreparacion,'select 3');
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            nombreDilucion(id){
                this.dilucion= '';
                let me=this;
                var url= '/recepcion/selectCodigoId?filtro='+id;
                axios.get(url).then(function (response) {
                    console.log(response,'select');
                    var respuesta= response.data;
                    me.arrayRecepcion = respuesta.recepcion;
                    console.log(me.arrayRecepcion,'select 3 id datos');
                    me.dilucion = me.arrayRecepcion[0].dilucion_nombre;
                   // me.datosCloruros_vol();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.idpreparacion= 0;
                this.fechaD= new Date(),
                this.codigo_lab = '';
                this.dilucion = '';
                this.vol_muestra = '';
                this.observaciones = '';
                this.conc_tit= '';
                this.vol_gastado= '';
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "cloruros_vol":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar datos de Cloruros por Volumetría';
                                this.idpersona= 0;
                                this.fechaD=new Date(),
                                this.codigo_lab = '';
                                this.dilucion = '';
                                this.vol_muestra = '';
                                this.observaciones = '';
                                this.conc_tit= '';
                                this.vol_gastado= '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal=1;
                                this.tituloModal='Actualizar datos de Cloruros por Volumetría';
                                this.tipoAccion=2;
                                this.cloruros_vol_id=data['id'];
                                this.idpreparacion=data['idpreparacion'];
                                this.fechaD = data['fecha'];
                                this.codigo_lab=data['codigo_lab'];
                                this.dilucion=data['dilucion'];
                                this.vol_muestra=data['vol_muestra'];
                                this.observaciones=data['observaciones'];
                                this.conc_tit= data['conc_tit'];
                                this.vol_gastado= data['vol_gastado'];
                                break;
                            }
                        }
                    }
                }
                this.selectPreparacion();
            }
        },
        mounted() {            
            this.listarCloruros_vol();            
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
