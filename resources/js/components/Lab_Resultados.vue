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
                    <h3> Resultados</h3>                        
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
                        :items="arrayResultados"
                        :fields="columnas"
                        :current-page="currentPage"
                        :per-page="perPage"
                        :filter="filter"
                        :filterIncludedFields="filterOn"
                        :sort-by.sync="sortBy"
                        :sort-desc.sync="sortDesc"
                        :sort-direction="sortDirection"                     
                    >
                    <template v-slot:cell(index)="data">
                        {{ data.index + 1 }}
                    </template>
                    <template v-slot:cell(name)="data">
                        {{ data.fecha_muestreo }}
                    </template>


                        <template v-slot:head(paterno)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>  
                        <template v-slot:head(materno)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>  
                        <template v-slot:head(nombre)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>  
                        <template v-slot:head(ci)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template> 
                        <template v-slot:head(acciones)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>                          
                        <template v-slot:cell(acciones)="row">
                        <!--a href="#" @click="abrirModal('personas','actualizar',row.item)" v-b-tooltip.hover title="Actualizar">
                            <b-icon-pencil-square variant="info" font-scale="1.5"></b-icon-pencil-square>
                        </a-->
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
  </main>
</template>

<script>

    export default {
        data (){            
            return {
                personas_id: 0,
                nombre:'',
                paterno:'',
                materno:'',
                telefono : '',
                direccion: '',
                email:'',
                ci:'',
                verificaCi:0,
                arrayResultados : [],
                arrayResultadosTab : [],
                tituloModal : '',

                modal : 0,                
                tipoAccion : 0,
                dismissSecs: 5,
                dismissCountDown: 0,
                show: true,
                columnas: [ 
                  { key: 'codigo_lab', label: 'Cod. lab', sortable: true, sortDirection: 'desc' },
                    'index',
                  { key: 'codigo_muestraR', label: 'Cod. muestra', sortable: true, sortDirection: 'desc' },
                  { key: 'codigo_muestraR', label: 'Fecha Muestreo', sortable: true, sortDirection: 'desc' },
                  { key: 'fecha_recepcionR', label: 'Fecha Recepcion', sortable: true, sortDirection: 'desc' },
                  { key: 'fecha_analisisP', label: 'Fecha Análisis', sortable: true, class: 'text-justify' },                 
                  { key: 'vol_gastado', label: 'Vol. gastado', sortable: true },                 
                  { key: 'vol_muestra', label: 'Alic.', sortable: true },                 
                  { key: 'dilucion', label: 'FD', sortable: true },                 
                  { key: 'conc_tit', label: 'Conc. tit.', sortable: true },                 
                  { key: 'resultado', label: 'resultado', sortable: true },                 
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
              // Trigger pagination to update the number of buttons/pages due to filtering
              this.totalRows = filteredItems.length;
              this.currentPage = 1
            },
            listarResultados(){
                let me=this;
                var url= '/lab_resultados';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    console.log(respuesta,'respuesta');
                    me.arrayResultados = respuesta.datos.data;
                    me.totalRows = me.arrayResultados.length;
                    console.log(me.arrayResultados,'me.arrayResultados...');
                })
                .catch(function (error) {
                    console.log(error);
                });
            },          
            countDownChanged(dismissCountDown) {  //alert ci
                this.dismissCountDown = dismissCountDown
            },
            onSubmit(evt) {
                evt.preventDefault()  //val. form
            },
            registrarPersona(){  
                let me = this;
                for (let i = 0; i < this.arrayResultados.length; i++) {
                    if ( this.ci == me.arrayResultados[i].ci ) {
                      this.verificaCi = 1;   
                    }                   
                }
                if (this.verificaCi == 0 && this.ci!='') {
                    console.log('entra 0');
                        axios.post('/persona/registrar',{
                        'nombre': this.nombre,
                        'paterno': this.paterno,
                        'materno' : this.materno,
                        'ci' : this.ci,
                        'telefono' : this.telefono,
                        'email' : this.email,
                        'direccion' : this.direccion,
                        'usr_id':1,

                        }).then(function (response) {                   
                        me.listarResultados();
                        me.cerrarModal();   
                    }).catch(function (error) {
                            console.log(error);
                    });
                }else if(this.verificaCi == 1 && this.ci!=''){ 
                    this.dismissCountDown = this.dismissSecs;
                    this.verificaCi = 0;}                
           },
            
            actualizarPersona(){             
                let me = this;
                 for (let i = 0; i < this.arrayResultados.length; i++) {
                    if ( this.ci == me.arrayResultados[i].ci ) {
                      this.verificaCi = 1;   
                    }                   
                }
                if (this.verificaCi == 0 && this.ci!='') {
                axios.put('/persona/actualizar',{
                    'idpersona': this.idpersona, 
                    'nombre': this.nombre,
                    'paterno': this.paterno,
                    'materno' : this.materno,
                    'ci' : this.ci,
                    'telefono' : this.telefono,
                    'email' : this.email,
                    'direccion' : this.direccion,
                    'usr_id':1,
                    'id': this.personas_id                    
                }).then(function (response) {
                    me.listarResultados();
                    me.cerrarModal();
                }).catch(function (error) {
                    console.log(error);
                }); 
                }else if(this.verificaCi == 1 && this.ci!=''){ 
                this.dismissCountDown = this.dismissSecs;
                this.verificaCi = 0;} 
            },
            
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.idpreparacion= 0;
                this.paterno='',
                this.materno = '';
                this.nombre = '';
                this.ci = '';
                this.direccion = '';
                this.email= '';
                this.telefono= '';
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "personas":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar datos de Persona';
                                this.idpersona= 0;
                                this.paterno='',
                                this.materno = '';
                                this.nombre = '';
                                this.ci = '';
                                this.direccion = '';
                                this.email= '';
                                this.telefono= '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal=1;
                                this.tituloModal='Actualizar datos de Persona';
                                this.tipoAccion=2;
                                this.personas_id=data['id'];
                                this.idpreparacion=data['idpreparacion'];
                                this.paterno = data['paterno'];
                                this.materno=data['materno'];
                                this.nombre=data['nombre'];
                                this.ci=data['ci'];
                                this.direccion=data['direccion'];
                                this.email= data['email'];
                                this.telefono= data['telefono'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {            
            this.listarResultados();            
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



