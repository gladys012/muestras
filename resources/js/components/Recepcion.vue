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
                    <h3> Recepción de Muestras</h3>                        
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
                        :items="arrayRecepcion"
                        :fields="columnas"
                        :current-page="currentPage"
                        :per-page="perPage"
                        :filter="filter"
                        :filterIncludedFields="filterOn"
                        :sort-by.sync="sortBy"
                        :sort-desc.sync="sortDesc"
                        :sort-direction="sortDirection"                     
                    >
                        <template v-slot:head(fecha_recepcion)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>
                        <template v-slot:head(fecha_muestra)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>  
                        <template v-slot:head(codigo_lab)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>  
                        <template v-slot:head(codigo_muestra)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>  
                        <template v-slot:head(cantidad)="data">
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
        <div class="modal fade" :class="{'mostrar' : modal}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                         <div class="form-group col-sm-3">
                            <b-form-group id="input-group-1"  label="Fecha Recepción:" label-for="input-2" >
                                <datepicker 
                                    :bootstrap-styling="true"
                                    :language="es"                                     
                                    calendar-class="datepicker1"                            
                                    :open-date="openDate"
                                    format="dd/MM/yyyy"
                                    v-model="fechaR"  
                                    calendar-button
                                    calendar-button-icon="fa fa-calendar"  
                                    disabled 
                                ></datepicker>
                            </b-form-group>
                         </div>
                         <div class="form-group col-sm-3">
                            <b-form-group id="input-group-2"  label="Hora:" label-for="input-2" >
                                <b-form-timepicker v-model="hora" placeholder="Seleccione hora" local="es"></b-form-timepicker> 
                            </b-form-group>
                         </div> 
                            <div class="form-group col-sm-3">
                                <b-form-group id="input-group-2"  label="Procedencia o Unidad:" label-for="input-2" >                                                              
                                  <b-form-select v-model="idunidad" class="mb-3" @change="selectUnidadCodigo(idunidad)" required>
                                      <b-form-select-option value="0" disabled>-- Seleccionar --</b-form-select-option>
                                      <b-form-select-option v-for="unidad in arrayUnidad" :key="unidad.id" :value="unidad.id" v-text="unidad.unidad" ></b-form-select-option>
                                  </b-form-select> 
                               </b-form-group>
                            </div> 
                            <div class="form-group col-sm-3">
                                <b-form-group id="input-group-2"  label="Codigo cliente:" label-for="input-2" >                                                              
                                  <b-form-select v-model="idcod" class="mb-3" @change="nroCodigoLab(idcod)" required >
                                      <b-form-select-option value="0" disabled>-- Seleccionar --</b-form-select-option>
                                      <b-form-select-option v-for="codigo in arrayCodigo" :key="codigo.id" :value="codigo.id" v-text="codigo.codigo"></b-form-select-option>
                                  </b-form-select> 
                               </b-form-group>
                            </div> 
                         <!--div class="form-group col-sm-3">
                            <b-form-group id="input-group-4"  label="Codigo cliente:" label-for="input-4" >
                                <b-form-input id="input-4" v-model="codigo_cliente" placeholder="Cod. cliente" required                            
                                ></b-form-input>
                            </b-form-group>
                         </div-->                                                
                       </div>
                        <div class="row">
                         <div class="form-group col-sm-3">
                            <b-form-group id="input-group-1"  label="Fecha Muestra:" label-for="input-2" >
                                <datepicker 
                                    :bootstrap-styling="true"
                                    :language="es"                                     
                                    calendar-class="datepicker1"                            
                                    :open-date="openDate"
                                    format="dd/MM/yyyy"
                                    v-model="fechaM"  
                                    calendar-button
                                    calendar-button-icon="fa fa-calendar"                                       
                                ></datepicker>
                            </b-form-group>
                         </div>                         
                         <div class="form-group col-sm-3">                           
                            <div class="container">
                                <div class="box">
                                    <div class="checkbox-group">
                                    <input id="checkboxName1" type="checkbox" v-model="liquido" @change="checkBoxSol(0)"/>
                                    <label for="checkboxName1" class="ta">Líquido</label>
                                    <input id="checkboxName2" type="checkbox" v-model="solido" @change="checkBoxSol(1)"/>
                                    <label for="checkboxName2" class="ta">Sólido</label> 
                                    </div>
                                </div>
                            </div> 
                         </div>
                         <div class="form-group col-sm-3">
                            <b-form-group id="input-group-4"  label="Cantidad:" label-for="input-4" >
                                <b-form-input id="input-4" type="number" v-model="cantidad" placeholder="Cantidad" required                            
                                ></b-form-input>
                            </b-form-group>
                         </div>
                         <div class="form-group col-sm-3">
                            <b-form-group id="input-group-4"  label="Cod. muestra:" label-for="input-4" >
                                <b-form-input id="input-4" v-model="codigo_muestra" placeholder="Cod. muestra" required                            
                                ></b-form-input>
                            </b-form-group>
                         </div>                                                
                       </div>  
                       <div class="row">                                                                                                                                                                                                               
                         
                       </div>                       
                       <div class="row">                                                                                                                                   
                            <!--div class="form-group col-sm-4">                           
                                <div class="container">
                                    <div class="box">
                                        <div class="checkbox-group">
                                        <input id="checkboxName3" type="checkbox" v-model="cristales"/>
                                        <label for="checkboxName3" class="ta">Cristales</label>
                                        <input id="checkboxName4" type="checkbox" v-model="salmueras"/>
                                        <label for="checkboxName4" class="ta">Salmueras</label> 
                                        <input id="checkboxName5" type="checkbox" v-model="aguas"/>
                                        <label for="checkboxName5" class="ta">Aguas</label> 
                                        </div>
                                    </div>
                                </div> 
                         </div>
                         <div class="form-group col-sm-4">
                             <b-form-group id="input-group-2"  label="Diluciones:" label-for="input-2" >                                                              
                                <b-form-select v-model="idunidad" class="mb-3" required>
                                    <b-form-select-option value="0" disabled>-- Seleccionar --</b-form-select-option>
                                    <b-form-select-option v-for="unidad in arrayUnidad" :key="unidad.id" :value="unidad.id" v-text="unidad.unidad2"></b-form-select-option>
                                </b-form-select> 
                            </b-form-group>
                         </div-->                          
                        </div> 
                       <div class="row">
                        <div class="form-group col-sm-9">
                            <b-form-group label="Analito de interés">
                                <b-form-tags v-model="value" no-outer-focus class="mb-2">
                                    <template
                                    v-slot="{ tags, disabled, addTag, removeTag, inputAttrs, inputHandlers}"
                                    >
                                    <ul v-if="tags.length > 0" class="list-inline d-inline-block mb-2">
                                        <li v-for="tag in tags" :key="tag" class="list-inline-item">
                                        <b-form-tag
                                            @remove="removeTag(tag)"
                                            :title="tag"
                                            :disabled="disabled"
                                            variant="info"
                                        >{{ tag }}</b-form-tag>
                                        </li>
                                    </ul>

                                    <b-dropdown size="sm" variant="outline-secondary" block menu-class="w-100">
                                        <template v-slot:button-content>
                                        <b-icon icon="tag-fill"></b-icon>Seleccionar
                                        </template>
                                        <b-dropdown-form @submit.prevent="() => {}">
                                        <b-form-group
                                            label-for="tag-search-input"
                                            label="Buscar"
                                            label-cols-md="auto"
                                            class="mb-0"
                                            label-size="sm"
                                            :description="searchDesc"
                                            :disabled="disabled"
                                        >
                                            <b-form-input
                                            v-model="search"
                                            id="tag-search-input"
                                            type="search"
                                            size="sm"
                                            autocomplete="off"
                                            @keyup="arrayAnalitob"
                                            ></b-form-input>
                                        </b-form-group>
                                        </b-dropdown-form>


                                        <b-dropdown-divider></b-dropdown-divider>
                                        <b-dropdown-item-button
                                        v-for="option in arrayAnalito"
                                        :key="option.id"
                                        @click="onOptionClick({ option, addTag })"
                                        >{{ option.nombre }}</b-dropdown-item-button>
                                        <b-dropdown-text v-if="arrayAnalito.length === 0">
                                        No hay registros
                                        <b-button variant="primary" @click="adicionAnalito()">Registrar</b-button>
                                        </b-dropdown-text>
                                        <div role="group">
                                        <label for="input-live" v-if="inputAnalito==1">Nuevo analito:</label>

                                        <b-input-group class="mb-2">
                                            <b-form-input
                                            v-if="inputAnalito==1"
                                            v-model="nombreAnalito"
                                            v-bind="inputAttrs"
                                            v-on="inputHandlers"
                                            class="form-control"
                                            ></b-form-input>
                                            <b-input-group-append>
                                            <b-button
                                                v-if="inputAnalito==1"
                                                @click="addTag()"
                                                variant="primary"
                                            >Guardar</b-button>
                                            </b-input-group-append>
                                        </b-input-group>
                                        </div>
                                    </b-dropdown>
                                    </template>
                                </b-form-tags>
                                </b-form-group>
                            
                        </div>
                        <div class="form-group col-sm-3">
                            <b-form-group id="input-group-4"  label="Código laboratorio:" label-for="input-4" >
                                <b-form-input id="input-4" v-model="codigo_lab" placeholder="Código laboratorio" disabled                          
                                ></b-form-input>
                            </b-form-group>
                         </div> 
                       </div> 
                       <div class="row">
                           <div class="form-group col-sm-9">
                              <b-form-group id="input-group-8" label="Observaciones:" label-for="input-6">                                
                                <b-form-textarea
                                    id="textarea"
                                    v-model="observaciones"
                                    placeholder="Observaciones"
                                    rows="3" max-rows="4"
                                    ></b-form-textarea>
                            </b-form-group>
                          </div> 
                          <div class="form-group col-sm-3">
                            <b-form-group id="input-group-4"  label="Nombre persona entrega:" label-for="input-4" >
                                <b-form-input id="input-4" v-model="cliente" placeholder="Nombre persona entrega" required                            
                                ></b-form-input>
                            </b-form-group>
                         </div>                       
                       </div>                                
                      <div class="modal-footer">
                        <b-button type="reset" variant="secondary" @click="cerrarModal()">Cerrar</b-button>
                        <b-button type="submit" v-if="tipoAccion==1" variant="primary" @click="registrarRecepcion()">Guardar</b-button>
                        <b-button type="submit" v-if="tipoAccion==2" variant="primary" @click="actualizarRecepcion()">Actualizar</b-button>
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
    import vSelect from 'vue-select';
    import Datepicker from 'vuejs-datepicker';
    import { es } from 'vuejs-datepicker/dist/locale';
    import moment from "moment";
    export default {
        data (){            
            return {
                es: es,
                openDate: new Date(),

                recepcion_id: 0,
                fechaR: new Date(),
                fechaM: new Date(),
                hora: new Date(),
                codigo_cliente: '',
                codigo_muestra: '',
                codigo_lab: '',
                observaciones: '',
                identrega:1,
                cliente:'',
                cantidad:'',
                persona_entrega:'',
                liquido:'',
                solido:'',
                unidad:'',
                
                //esta por verse
                cristales:'',
                salmueras:'',
                aguas:'',
                dato_dilucion:'',

                idcod:'',
                arrayCodigo:[],
                idunidad:0,
                arrayUnidad:[],
                arrayRecepcion : [],
                arrayPreparacion :[],
                errorMostrarMsjPersona:[],
                tituloModal : '',

                modal : 0,                
                tipoAccion : 0,
                errorRecepcion: 0,
                errorMostrarMsjRecepcion:[],

                //analito
                analito: "",
                search: "",
                value: [],
                arrayA:[],
                columnAnalito:[],
                datosAnalito:[],
                arrayAnalito: [],
                //nuevo analito
                nombreAnalito: "",
                modalInf: 0,
                inputAnalito: 0,

                         
                dismissSecs: 5,
                dismissCountDown: 0,
                show: true,
                columnas: [
                  { key: 'fecha_recepcion', label: 'Fecha recepcion', sortable: true, sortDirection: 'desc' },
                  { key: 'fecha_muestra', label: 'Fecha muestra', sortable: true, sortDirection: 'desc' },
                  { key: 'codigo_lab', label: 'Cod. laboratorio', sortable: true, class: 'text-justify' },                 
                  { key: 'codigo_muestra', label: 'Cod. muestra', sortable: true },                 
                  { key: 'cantidad', label: 'Cantidad', sortable: true },                 
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
            Datepicker,
            vSelect,
          },
        computed:{
            searchDesc() {
            if (this.criteria && this.arrayAnalitob.nombre.length === 0) {
                return "No hay datos con sus criterios de búsqueda";
            }
            return "";  
            }
       },
        methods : {

            onFiltered(filteredItems) {
              // Trigger pagination to update the number of buttons/pages due to filtering
              this.totalRows = filteredItems.length;
              this.currentPage = 1
            },
                arrayAnalitob() {
                const criteria = this.search.trim().toLowerCase();
                        if(criteria!==null){
                    let options = this.arrayA.filter(
                    opt => opt.nombre.indexOf(criteria) > -1
                    );
                            if(options.length>0){
                                this.arrayAnalito=options
                            }else{
                    this.arrayAnalito='';
                        } 
                            return options;
                    }                
                },

            onOptionClick({ option, addTag }) {
                addTag(option.nombre);
                console.log(option,'option');
                console.log(option.nombre,'nombre option jkgjh');
                //console.log(this.value,'analito');  
                this.search = "";
            },
            adicionAnalito() {
                this.inputAnalito = 1;
                if (this.nombreAnalito > 1) {
                    this.arrayAnalito();
                    console.log(this.arrayAnalito,'arrayyyy');
                }
            },
            
            listarRecepcion (){
                let me=this;
                var url= '/recepcion';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    console.log(respuesta,'respuesta');
                    me.arrayRecepcion = respuesta.recepcion.data;
                    me.totalRows = me.arrayRecepcion.length;
                    console.log('me.array',me.arrayRecepcion);                   
                })
                .catch(function (error) {
                    console.log(error,'e');
                });
            },                      

            onSubmit(evt) {
                evt.preventDefault()  //val. form
            },
            registrarRecepcion(){ 
                this.fechaR = moment(this.fechaR).format('D/MM/YYYY');
                console.log(this.fechaR,'fechaaaaaa');
                let me = this;
                var datosA  = [];
                    for (let i = 0; i < this.value.length; i++) {
                        datosA.push({
                        "nombre": this.value[i]
                    });                                
                    }      
                   /* for (let i = 0; i < this.arrayUnidad_Codigo.length; i++) {
                        const cod = this.arrayUnidad_Codigo[i].codigo;
                        console.log(cod,'cod ........');
                        if (cod == this.codigo) {
                            this.verificaCod = 1;   
                        }                        
                    }*/  
                    this.datosAnalito = JSON.stringify(datosA);
                    axios.post('/recepcion/registrar',{
                        'fecha_recepcion' : this.fechaR,
                        'fecha_muestra' : this.fechaM,
                        'hora' : this.hora,
                        'codigo_cliente': this.codigo_cliente,
                        'codigo_muestra': this.codigo_muestra,
                        'codigo_lab': this.codigo_lab,
                        'cantidad': this.cantidad,
                        'liquido' : this.liquido,
                        'solido' : this.solido,
                        'usr_id':1,
                        'idunidadcod': this.idunidad,
                        'analito': this.datosAnalito,
                        'cliente':this.cliente,
                        'observaciones': this.observaciones,

                    }).then(function (response) { 
                    // me.actualizarDatoPersona();                      
                    me.listarRecepcion();

                        me.cerrarModal();
                }).catch(function (error) {
                    console.log(error);
                });                                  
            },
            
            actualizarRecepcion(){             
                let me = this;
                this.fechaR = moment(this.fechaR).format('D/MM/YYYY');
                axios.put('/recepcion/actualizar',{
                    'codigo': this.codigo,
                    'cantidad': this.cantidad,
                    'fecha' : this.fecha,
                    'hora' : this.hora,
                    'liquido' : this.liquido,
                    'solido' : this.solido,
                    'cliente': this.cliente,
                    'observaciones': this.observaciones,
                    'identrega' : this.identrega,
                    'usr_id': 1,
                    'id':this.recepcion_id
                }).then(function (response) {
                    me.listarRecepcion();
                    me.cerrarModal();
                }).catch(function (error) {
                    console.log(error);
                });               
            },
            selectUnidad(){
                let me=this;
                var url= '/recepcion/selectUnidad';
                axios.get(url).then(function (response) {
                    console.log(response,'select');
                    var respuesta= response.data;                                        
                    me.arrayUnidad = respuesta.unidad_solicitante;
                    console.log(me.arrayUnidad,'unidad');
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
                        
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "recepcion":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                
                                const moment = require('moment');
                                this.hora = moment().format('hh:mm:ss');

                                this.modal = 1;
                                this.tituloModal = 'Registrar Recepción';
                                this.fecha_recepcion = new Date();
                                this.fecha_muestra = new Date();
                                this.codigo='';
                                this.cantidad=0;
                                this.liquido='';
                                this.solido='';
                                this.cliente='';
                                this.direccion='';
                                this.telefono='';
                                this.email='';
                                this.observaciones='';
                                this.identrega=1;
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                /*var datoA = this.datosAnalito;
                                this.datosAnalito = JSON.parse(datoA);
                                console.log(this.datosAnalito,'datos aaaaaanalito');
                                */
                                this.modal=1;
                                this.tituloModal='Actualizar Recepción';
                                this.tipoAccion=2;
                                this.recepcion_id=data['id'];
                                this.codigo = data['codigo'];
                                this.cantidad = data['cantidad'];
                                this.liquido = data['liquido'];
                                this.solido = data['solido'];
                                this.fecha = data['fecha'];
                                this.hora = data['hora'];
                                this.identrega = 1;
                                this.cliente = data['cliente'];
                                this.observaciones = data['observaciones'];
                                this.usr_id = data['usr_id'];
                                break;
                            }
                        }
                    }
                }
                this.selectUnidad();
                this.selectAnalito();
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                //this.fechaR = new Date();
               // this.hora='';
                this.codigo='';
                this.cantidad=0;
                this.liquido='';
                this.solido='';
                this.persona_entrega='';                
                this.errorRecepcion=0;
            },

            selectAnalito() {
            let me = this;
            var url = "/solicitud/selectAnalito";
            axios
                .get(url)
                .then(function(response) {
                console.log(response, "select");
                var respuesta = response.data;
                me.arrayAnalito = respuesta.analito.data;
                me.arrayA = respuesta.analito.data;
                console.log(me.arrayAnalito, "select 3");
                })
                .catch(function(error) {
                console.log(error);
                });
            },
            buscarDatosSolicitud(unidad){
            console.log('entra11', unidad);
            var ci = '';
            var idpaterno = '';
            var nro_reg = '';
            /*if (unidad=='') {
                    this.dismissCountDown = this.dismissSecs
            }    */           
            let me=this;
            if (unidad!='') {
                var url= '/solicitudModificacion/busquedaDatos?unidad='+ unidad + '&idpaterno='+ idpaterno + '&ci='+ ci + '&nro_reg=' + nro_reg;
            axios.get(url).then(function (response) {
                var respuesta= response.data;
                console.log(respuesta,'respuesta');
                me.arrayBusqueda = respuesta.unidad_solicitante;
                console.log(me.arrayBusqueda,'respuesta busq');
                /* if (me.arrayBusqueda=='') {
                    me.dismissCountDown2 = me.dismissSecs;
                }*/
            })
            .catch(function (error) {
                console.log(error);
            });
            }                
        },
        selectUnidadCodigo(cod){
            console.log(cod,'cod');
            let me=this;
            //var url= '/solicitudPersona/selectPersonaCi?filtro='+search;
            var url= '/unidad_codigo/selectUnidadCodigo?filtro='+cod;
            axios.get(url).then(function (response) {
                console.log(response,'select');
                var respuesta= response.data;                                        
                me.arrayCodigo = respuesta.unidad_codigo;
                console.log(me.arrayCodigo,'unidad codigo');
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        nroCodigoLab(idcod){
            console.log(idcod,'cod.......');
            this.codigo_lab='';
            for (let i = 0; i < this.arrayCodigo.length; i++) {
                if (idcod == this.arrayCodigo[i].id) {
                    this.codigo_cliente = this.arrayCodigo[i].codigo;
                    console.log(this.codigo_cliente,'this.codigo_vliente');
                    
                    if (this.arrayRecepcion.length>0) {  
                        console.log('entra if**');                      
                        for (let j = 0; j < this.arrayRecepcion.length; j++) {
                            //var cod_labCorr = this.arrayRecepcion[i].codigo_lab.substring(0,2);

                                    console.log(this.arrayRecepcion[j].codigo_lab,'000000000000000000000000000 cod lab ');                
                                    var cod_lab_corr = this.arrayRecepcion[j].codigo_lab;
                                if (this.codigo_lab=='') {    
                                    console.log(cod_lab_corr,'corrrrrr');
                                    var parteCod = cod_lab_corr.split("-",1);
                                    parteCod = parteCod[0];                            
                                    console.log(parteCod,'parte cod');
                                    if (this.codigo_cliente == parteCod && this.arrayRecepcion.length) {
                                        var parteNum = cod_lab_corr.split("-",2);
                                        var nro = parteNum[1];
                                        console.log(nro,'parte parteNum');
                                        nro = Number(nro)+1;                                
                                        console.log(nro,'parrrrrrrrrrrrrrrr num');
                                        this.codigo_lab= parteCod+'-'+nro;
                                        console.log(this.codigo_lab,'lab........');
                                    } else{
                                        console.log('entras123121212312121321212313');
                                        //this.codigo_lab=='';
                                        if (this.codigo_lab=='') {
                                            this.codigo_lab = this.codigo_cliente + '-1';
                                            console.log(this.codigo_lab,'entro else');
                                        }
                                        
                                    }
                                }
                        }    
                    }else{
                        console.log('entras1231212123121213212123130000000000');
                        this.codigo_lab = this.codigo_cliente + '-1';
                        console.log(this.codigo_lab,'entro else afuera');
                    }
                   
                
                }                
            }
        },

        checkBoxSol(val){
               if (val==0) {
                  if (this.liquido == true) {
                    this.solido = false;
                }  
               }else if(val==1){
                   if (this.solido == true) {
                     this.liquido = false;}
               }     
           },
           
        },
        mounted() {            
            this.listarRecepcion();            
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
    .modal-lg {
       max-width: 75% !important;
}     
</style>
