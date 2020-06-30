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
                    <h3> Lista de Analitos registrados</h3>                        
                    <b-button variant="info  pull-right" @click="abrirModal('analitos','registrar')" style="right:0;"><b-icon-plus font-scale="1.5"></b-icon-plus>Nuevo</b-button>
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
                        :items="arrayAnalitos"
                        :fields="columnas"
                        :current-page="currentPage"
                        :per-page="perPage"
                        :filter="filter"
                        :filterIncludedFields="filterOn"
                        :sort-by.sync="sortBy"
                        :sort-desc.sync="sortDesc"
                        :sort-direction="sortDirection"                     
                    >
                        <template v-slot:head(nombre)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>  
                        <template v-slot:head(acciones)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>   
                        <template v-slot:head(acciones)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>                         
                        <template v-slot:cell(acciones)="row">
                        <a href="#" @click="abrirModal('analitos','actualizar',row.item)" v-b-tooltip.hover title="Actualizar">
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
         <div class="modal-dialog modal-sm" role="document">
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
                         <div class="form-group col-sm-12">
                            <b-form-group id="input-group-1"  label="Nombre:" label-for="input-2" >
                                <b-form-input id="input-1" v-model="nombre" placeholder="Nombre" required                            
                                ></b-form-input>
                            </b-form-group>
                         </div>                         
                       <div class="form-group col-sm-12">
                        <b-alert
                            :show="dismissCountDown"
                            dismissible
                            variant="danger"
                            @dismiss-count-down="countDownChanged">
                                Ingreso un Analito existente
                            </b-alert>
                        </div> 
                       </div>     
                      <div class="modal-footer">
                        <b-button type="reset" variant="secondary" @click="cerrarModal()">Cerrar</b-button>
                        <b-button type="submit" v-if="tipoAccion==1" variant="primary" @click="registrarAnalito()">Guardar</b-button>
                        <b-button type="submit" v-if="tipoAccion==2" variant="primary" @click="actualizarAnalito()">Actualizar</b-button>
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
                analitos_id: 0,
                nombre:'',               
                verificaAnalito:0,
                arrayAnalitos : [],
                arrayAnalitosTab : [],
                tituloModal : '',

                modal : 0,                
                tipoAccion : 0,
                dismissSecs: 5,
                dismissCountDown: 0,
                show: true,
                columnas: [
                  { key: 'nombre', label: 'nombre', sortable: true, sortDirection: 'desc' },
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
        },
        methods : {

            onFiltered(filteredItems) {
              this.totalRows = filteredItems.length;
              this.currentPage = 1
            },
            listarAnalitos (){
                let me=this;
                var url= '/analito';
                axios.get(url).then(function (response) {
                    console.log(response,'res');
                    var respuesta= response.data;
                    console.log(respuesta,'resp data');
                    me.arrayAnalitos = respuesta.analito.data;
                    me.totalRows = me.arrayAnalitos.length;
                    console.log(me.arrayAnalitos,'me.arrayAnalitos...');
                })
                .catch(function (error) {
                    console.log(error);
                });
            },          
            countDownChanged(dismissCountDown) {  //alert nombre analito
                this.dismissCountDown = dismissCountDown
            },
            onSubmit(evt) {
                evt.preventDefault()  //val. form
            },
            registrarAnalito(){  
                let me = this;
                for (let i = 0; i < this.arrayAnalitos.length; i++) {
                    if ( this.nombre == me.arrayAnalitos[i].nombre ) {
                      this.verificaAnalito = 1;   
                    }                   
                }
                if (this.verificaAnalito == 0 && this.nombre!='') {
                    console.log('entra 0');
                        axios.post('/analito/registrar',{
                        'nombre': this.nombre,
                        'usr_id':1,

                        }).then(function (response) {                   
                        me.listarAnalitos();
                        me.cerrarModal();   
                    }).catch(function (error) {
                            console.log(error);
                    });
                }else if(this.verificaAnalito == 1 && this.nombre!=''){ 
                    this.dismissCountDown = this.dismissSecs;
                    this.verificaAnalito = 0;}                
           },
            
            actualizarAnalito(){             
                let me = this;
                 for (let i = 0; i < this.arrayAnalitos.length; i++) {
                    if ( this.nombre == me.arrayAnalitos[i].nombre ) {
                      this.verificaAnalito = 1;   
                    }                   
                }
                if (this.verificaAnalito == 0 && this.nombre!='') {
                axios.put('/analito/actualizar',{
                   // 'idanalitos': this.idanalitos, 
                    'nombre': this.nombre,
                    'usr_id':1,
                    'id': this.analitos_id                    
                }).then(function (response) {
                    me.listarAnalitos();
                    me.cerrarModal();
                }).catch(function (error) {
                    console.log(error);
                }); 
                }else if(this.verificaAnalito == 1 && this.nombre!=''){ 
                this.dismissCountDown = this.dismissSecs;
                this.verificaAnalito = 0;} 
            },
            
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre='';
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "analitos":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Analito';
                                this.idanalitos= 0;
                                this.nombre='',
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal=1;
                                this.tituloModal='Actualizar Analito';
                                this.tipoAccion=2;
                                this.analitos_id=data['id'];
                                this.nombre = data['nombre'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {            
            this.listarAnalitos();            
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
