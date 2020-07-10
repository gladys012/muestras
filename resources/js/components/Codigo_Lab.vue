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
                    <h3> Asignación de Códigos de Laboratorio</h3>                        
                    <b-button variant="info  pull-right" @click="abrirModal('codigoLab','registrar')" style="right:0;"><b-icon-plus font-scale="1.5"></b-icon-plus>Nuevo</b-button>
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
                        :items="arrayUnidad_Codigo"
                        :fields="columnas"
                        :current-page="currentPage"
                        :per-page="perPage"
                        :filter="filter"
                        :filterIncludedFields="filterOn"
                        :sort-by.sync="sortBy"
                        :sort-desc.sync="sortDesc"
                        :sort-direction="sortDirection"                     
                    >
                        <template v-slot:head(unidad)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>  
                        <template v-slot:head(codigo)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>  
                        <template v-slot:head(analitoRender)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>  
                        <template v-slot:head(acciones)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>   
                        <template v-slot:head(acciones)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>                         
                        <template v-slot:cell(acciones)="row">
                        <a href="#" @click="abrirModal('codigoLab','actualizar',row.item)" v-b-tooltip.hover title="Actualizar">
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
                         <div class="form-group col-sm-6">
                                <b-form-group id="input-group-2"  label="Procedencia o Unidad:" label-for="input-2" >                                                              
                                  <b-form-select v-model="idunidad" class="mb-3" :onChange="buscarDatosSolicitud(idunidad)" required>
                                      <b-form-select-option value="0" disabled>-- Seleccionar --</b-form-select-option>
                                      <b-form-select-option v-for="unidad in arrayUnidad" :key="unidad.id" :value="unidad.id" v-text="unidad.unidad" ></b-form-select-option>
                                  </b-form-select> 
                               </b-form-group>
                          </div>
                         <div class="form-group col-sm-6">
                            <b-form-group id="input-group-4"  label="Código:" label-for="input-4" >
                                <b-form-input id="input-4" v-model="codigo" placeholder="Código laboratorio"                            
                                ></b-form-input>
                            </b-form-group>
                         </div>
                         <div class="form-group col-sm-12">
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
                       </div>                                          
                       <div class="form-group col-sm-12">
                        <b-alert
                            :show="dismissCountDown"
                            dismissible
                            variant="danger"
                            @dismiss-count-down="countDownChanged">
                                Ingreso un Código existente en la procedencia o unidad
                            </b-alert>
                        </div>     
                      <div class="modal-footer">
                        <b-button type="reset" variant="secondary" @click="cerrarModal()">Cerrar</b-button>
                        <b-button type="submit" v-if="tipoAccion==1" variant="primary" @click="registrarCodigo()">Guardar</b-button>
                        <b-button type="submit" v-if="tipoAccion==2" variant="primary" @click="actualizarCodigo()">Actualizar</b-button>
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

    export default {
        data (){            
            return {
                unidadCodigo_id: 0,
                analitos:'',
                idunidad:'',
                codigo:'',
                arrayUnidad:[],
                arrayUnidad_Codigo:[],
                //unidad:'',

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

                
                verificaCod:0,
                tituloModal : '',

                modal : 0,                
                tipoAccion : 0,
                dismissSecs: 5,
                dismissCountDown: 0,
                show: true,
                columnas: [
                  { key: 'unidad', label: 'Unidad', sortable: true, sortDirection: 'desc' },
                  { key: 'codigo', label: 'Código', sortable: true, class: 'text-justify' },                 
                  { key: 'analitoRender', label: 'Analitos', sortable: true },
                  { key: 'acciones', label: 'Acciones',  sortable: false}
                ],
                perPage: 10,
                selectedID: null,
                totalRows: 1,
                currentPage: 1,
                pageOptions: [10, 15, 20,50,100,200],
                sortBy: '',
                sortDesc: false,
                sortDirection: 'asc',
                filter: null,
                filterOn: [],
            }
        },

        computed:{
        searchDesc() {
            if (this.criteria && this.arrayAnalitob.analitos.length === 0) {
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
                    /*this.searchDesc();
                    return "No hay datos con sus criterios de búsqueda";*/
                        } 
                            return options;
                    }
                
                },

            onOptionClick({ option, addTag }) {
            addTag(option.nombre);
            console.log(option,'option');
            console.log(option.nombre,'nombre option jkgjh');
            console.log(this.value,'analito');  
            this.search = "";
            },
            adicionAnalito() {
            this.inputAnalito = 1;
            if (this.nombreAnalito > 1) {
                this.arrayAnalito();
                console.log(this.arrayAnalito,'arrayyyy');
                }
            },
          
            countDownChanged(dismissCountDown) {  //alert ci
                this.dismissCountDown = dismissCountDown
            },
            onSubmit(evt) {
                evt.preventDefault()  //val. form
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
                    me.value = me.arrayBusqueda;
                })
                .catch(function (error) {
                    console.log(error);
                });
                }                
            },
            listarUnidad_Codigo(){
                let me=this;
                var url= '/unidad_codigo';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    console.log(respuesta,'respuesta');
                    me.arrayUnidad_Codigo = respuesta.unidad_codigo.data;
                    me.totalRows = me.arrayUnidad_Codigo.length;
                    console.log('me.array arrayUnidad_Codigo',me.arrayUnidad_Codigo);                   
                                                                                
                    for(let item of me.arrayUnidad_Codigo){
                        item.analitoRender = [];
                        item.analito=JSON.parse(item.analito);
                        console.log(item.analito,'analito');
                        for (const nombre of item.analito) {
                            item.analitoRender.push(nombre.nombre)
                        }                         
                    item.analitoRender = item.analitoRender.join("-")
                    }
                    console.log(me.arrayUnidad_Codigo,'ARRAY..');
                })
                .catch(function (error) {
                    console.log(error,'e');
                });
            },
             registrarCodigo(){
                 var datosA  = [];
                 let me = this;
                    for (let i = 0; i < this.value.length; i++) {
                    //this.columnAnalito = this.value[i];
                        datosA.push({
                        "nombre": this.value[i]
                    });                                
                    }      
                    for (let i = 0; i < this.arrayUnidad_Codigo.length; i++) {
                        const cod = this.arrayUnidad_Codigo[i].codigo;
                        console.log(cod,'cod ........');
                        if (cod == this.codigo) {
                            console.log('entra');
                            this.verificaCod = 1;   
                        }
                        
                    }  
                    if (this.verificaCod == 0 && this.codigo!='') {            
                    this.datosAnalito = JSON.stringify(datosA);                    
                        axios.post('/unidad_codigo/registrar',{
                            'idunidad': this.idunidad,
                            'codigo': this.codigo,
                            'analito' : this.datosAnalito,
                            'usr_id':1,
                        }).then(function (response) { 
                       // me.actualizarDatoPersona();                      
                         me.listarUnidad_Codigo();
                         me.cerrarModal();
                    }).catch(function (error) {
                        console.log(error);
                    });   
                  }else if(this.verificaCod == 1 && me.codigo!=''){ 
                this.dismissCountDown = this.dismissSecs;
                this.verificaCod = 0;}                                
            },
            
            actualizarCodigo(){ 
                 var datosA  = [];
                console.log(this.codigo,'codigo.. act');   
                var codigoAct = this.codigo;        
                let me = this;
                for (let i = 0; i < this.value.length; i++) {
                    //this.columnAnalito = this.value[i];
                        datosA.push({
                        "nombre": this.value[i]
                    });                                
                }
                this.datosAnalito = JSON.stringify(datosA);
                /*for (let i = 0; i < this.arrayUnidad_Codigo.length; i++) {
                        const cod = this.arrayUnidad_Codigo[i].codigo;
                        console.log(cod,'cod ........');
                        
                        if (cod == this.codigo && cod ) {
                            console.log('entra');
                            this.verificaCod = 1;   
                        }                        
                    }  */
                if (this.verificaCod == 0 && this.codigo!='') {
                axios.put('/unidad_codigo/actualizar',{
                    'idunidad': this.idunidad,
                    'codigo': this.codigo,
                    'analito' : this.datosAnalito,
                    'usr_id':1,
                    'id': this.unidadCodigo_id                    
                }).then(function (response) {
                    console.log(response,'response act.');
                    me.listarUnidad_Codigo();
                    me.cerrarModal();
                }).catch(function (error) {
                    console.log(error);
                }); 
                }else if(this.verificaCod == 1 && this.ci!=''){ 
                this.dismissCountDown = this.dismissSecs;
                this.verificaCod = 0;} 
            },
            
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.idpreparacion= 0;
                this.idunidad='',
                this.codigo = '';
                this.analito = '';
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "codigoLab":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar datos';
                                this.idpersona= 0;
                                //this.idunidad='',
                                this.codigo = '';
                                //this.analito = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //var datoA = this.datosAnalito;
                               // this.datosAnalito = JSON.parse(datoA);
                                console.log(this.datosAnalito,'datos aaaaaanalito');
                                this.modal=1;
                                this.tituloModal='Actualizar datos';
                                this.tipoAccion=2;
                                this.unidadCodigo_id=data['id'];
                                this.idunidad = data['idunidad'];
                                this.codigo=data['codigo'];
                                this.datosAnalito=data['analito'];
                                break;
                            }
                        }
                    }
                }
                this.selectUnidad();
                this.selectAnalito();
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
        },
        mounted() {            
            this.listarUnidad_Codigo();            
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
</style>
