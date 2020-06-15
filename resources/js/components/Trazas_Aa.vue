<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                            <i class="fa fa-align-justify"></i> Determinación de Carbonatos en producto de Carbonato de litio
                        <button type="button" @click="abrirModal('carbonatos_pcl','registrar')" class="btn btn-info pull-right" style="right:0;">
                            <font bold color="white">+ Nuevo</font>                            
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="codigo_lab">codigo laboratorio</option>
                                      <option value="fecha">Fecha</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarCarbonatos_pcl(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarCarbonatos_pcl(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Fecha</th>
                                    <th>Código Lab.o</th>
                                    <th>Masa Recipiente</th>
                                    <th>Masa Muestra</th>
                                    <!--th>Cod. Balanza</th-->
                                    <th>Vol. Gastado HCI</th>
                                    <th>Dato</th>
                                    <th>Cumple</th>
                                    <th>Observaciones</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="carbonatos_pcl in arrayCarbonatos_pcl" :key="carbonatos_pcl.id">
                                    <td>
                                        <button type="button" title="Editar" @click="abrirModal('carbonatos_pcl','actualizar',carbonatos_pcl)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil" style="color:white"></i>
                                        </button> &nbsp;
                                        <template v-if="carbonatos_pcl.estado">
                                            <button type="button" title="Eliminar" class="btn btn-danger btn-sm" @click="desActivarCarbonatos_pcl(carbonatos_pcl.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="Activarcarbonatos_pcl(carbonatos_pcl.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                    <td v-text="carbonatos_pcl.fecha"></td>
                                    <td v-text="carbonatos_pcl.codigo_lab"></td>
                                    <td v-text="carbonatos_pcl.masa_recipiente"></td>
                                    <td v-text="carbonatos_pcl.masa_muestra"></td>
                                    <!--td v-text="carbonatos_pcl.cod_balanza"></td-->
                                    <td v-text="carbonatos_pcl.vol_gastado_hci"></td>
                                    <td v-text="carbonatos_pcl.dato"></td>
                                     <td v-if="carbonatos_pcl.cumple==true"><input type="checkbox" :checked="carbonatos_pcl.cumple" v-text="carbonatos_pcl.cumple" disabled></td>                
                                    <td v-else v-text="carbonatos_pcl.cumple"></td>                                    
                                    <td v-text="carbonatos_pcl.observaciones"></td>
                                    <td>
                                        <div v-if="carbonatos_pcl.estado">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-info modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">                                        
                                <div class="form-group row">                                
                                    <label class="col-md-2 form-control-label" for="text-input">Fecha</label>
                                    <div class="col-md-4">
                                        <input type="text" v-model="fecha" class="form-control" placeholder="Fecha">
                                    </div>
                                     <label class="col-md-2 form-control-label" for="text-input">Codigo Laboratorio</label>
                                    <div class="col-md-4">
                                        <select class="form-control" v-model="idpreparacion">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="preparacion in arrayPreparacion" :key="preparacion.id" :value="preparacion.id" v-text="preparacion.codigo_lab"></option>
                                        </select>                                             </div>
                                </div>                              
                                <div class="form-group row">                                
                                    <label class="col-md-1 form-control-label" for="text-input">Masa recipiente</label>
                                    <div class="col-md-3">
                                        <input type="text" v-model="masa_recipiente" class="form-control" placeholder="Masa recipiente">
                                    </div>
                                    <label class="col-md-1 form-control-label" for="text-input">Masa muestra</label>
                                    <div class="col-md-3">
                                        <input type="text" v-model="masa_muestra" class="form-control" placeholder="Masa muestra">
                                    </div>
                                    <label class="col-md-1 form-control-label" for="text-input">Cod. balanza</label>
                                    <div class="col-md-3">
                                        <input type="text" v-model="cod_balanza" class="form-control" placeholder="Cod. balanza">
                                    </div>
                                </div>                              
                                <div class="form-group row">                                
                                    <label class="col-md-1 form-control-label" for="text-input">Vol. gastado</label>
                                    <div class="col-md-3">
                                        <input type="text" v-model="vol_gastado_hci" class="form-control" placeholder="Vol. gastado">
                                    </div>
                                    <label class="col-md-1 form-control-label" for="text-input">Cod. bureta</label>
                                    <div class="col-md-3">
                                        <input type="text" v-model="cod_bureta" class="form-control" placeholder="Cod. bureta">
                                    </div>
                                    <label class="col-md-1 form-control-label" for="text-input">Conc. HCI</label>
                                    <div class="col-md-3">
                                        <input type="text" v-model="conc_hci" class="form-control" placeholder="Conc. HCI">
                                    </div>
                                </div>                               
                                <div class="form-group row">                                
                                    <label class="col-md-1 form-control-label" for="text-input">Dato</label>
                                    <div class="col-md-3">
                                        <input type="text" v-model="dato" class="form-control" placeholder="Dato">
                                    </div>
                                    <label class="col-md-1 form-control-label" for="text-input">Cumple</label>
                                    <div class="col-md-2">
                                        <input type="checkbox" v-model="cumple" class="form-control">
                                    </div>
                                </div>                                                                                       
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Observaciones</label>
                                    <div class="col-md-10">
                                            <textarea cols="90" rows="5" placeholder="Observaciones" v-model="observaciones" class="form-control"></textarea>
                                    </div>                                    
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()"><font color="white">Cerrar</font></button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-info active" @click="registrarCarbonatos_pcl()"><font color="white">Guardar</font></button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-info active" @click="actualizarCarbonatos_pcl()"><font color="white">Actualizar</font></button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
        </main>
</template>

<script>
//import VueBarcode from 'vue-barcode';
    export default {
        data (){
            
            return {
                carbonatos_pcl_id: 0,
                idpreparacion : 0,
                codigo_lab:'',
                fecha:'',
                masa_recipiente:'',
                masa_muestra : '',
                cod_balanza : '',
                vol_gastado_hci : '',
                cod_bureta : '',
                conc_hci:'',
                dato:'',
                cumple:'',
                observaciones:'',
                arrayCarbonatos_pcl : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorcarbonatos_pcl : 0,
                errorMostrarMsjcarbonatos_pcl : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'codigo_lab',
                buscar : '',
                arrayPreparacion :[]
            }
        },
         /*components: {
            'barcode': VueBarcode
        },*/
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        },
        methods : {
            listarCarbonatos_pcl (page,buscar,criterio){
                let me=this;
                var url= '/carbonatos_pcl?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    console.log(respuesta,'respuesta');
                    me.arrayCarbonatos_pcl = respuesta.carbonatos_pcl.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectPreparacion(){
                let me=this;
                var url= '/preparacion/selectPreparacion';
                axios.get(url).then(function (response) {
                    console.log(response,'select');
                    var respuesta= response.data;
                    me.arrayPreparacion = respuesta.preparaciones.data;
                    console.log(me.arrayPreparacion,'select 3');
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarCarbonatos_pcl(page,buscar,criterio);
            },
            registrarCarbonatos_pcl(){
                if (this.validarcarbonatos_pcl()){
                    return;
                }
                if (this.cumple!='') {
                    this.cumple=0;
                }
                let me = this;

                axios.post('/carbonatos_pcl/registrar',{
                    'idpreparacion': this.idpreparacion, 
                    'fecha': this.fecha,
                    'masa_recipiente': this.masa_recipiente,
                    'masa_muestra': this.masa_muestra,
                    'cod_balanza': this.vcod_balanza,
                    'vol_gastado_hci': this.vol_gastado_hci,
                    'cod_bureta': this.cod_bureta,
                    'conc_hci': this.conc_hci,
                    'dato': this.dato,
                    'cumple': this.cumple,
                    'observaciones': this.observaciones,
                    'usr_id':1
                }).then(function (response) {
                    console.log('entra reg');
                    console.log(response,'resp');
                    me.cerrarModal();
                    me.listarCarbonatos_pcl(1,'','codigo_lab');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarCarbonatos_pcl(){
               if (this.validarcarbonatos_pcl()){
                    return;
                }
                if (this.cumple=='' || this.cumple==false) {
                    this.cumple='';
                }
                let me = this;

                axios.put('/carbonatos_pcl/actualizar',{
                    'idpreparacion': this.idpreparacion, 
                    'fecha': this.fecha,
                    'masa_recipiente': this.masa_recipiente,
                    'masa_muestra': this.masa_muestra,
                    'cod_balanza': this.vcod_balanza,
                    'vol_gastado_hci': this.vol_gastado_hci,
                    'cod_bureta': this.cod_bureta,
                    'conc_hci': this.conc_hci,
                    'dato': this.dato,
                    'cumple': this.cumple,
                    'observaciones': this.observaciones,
                    'usr_id':1,
                    'id': this.carbonatos_pcl_id
                    
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarCarbonatos_pcl(1,'','codigo_lab');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            desActivarCarbonatos_pcl(id){
                console.log('entra id', id);
               swal.fire({
                title: 'Esta seguro de desactivar el registro?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                    console.log(result,'result');
                if (result.value) {
                    let me = this;
                    console.log('entra');
                    axios.put('/carbonatos_pcl/desactivar',{
                        'id': id
                    }).then(function (response) {
                        console.log(response,'entra resp');
                        me.listarCarbonatos_pcl(1,'','codigo_lab');
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            Activarcarbonatos_pcl(id){
               swal.fire({
                title: 'Esta seguro de activar este registro?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/carbonatos_pcl/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarCarbonatos_pcl(1,'','codigo_lab');
                        swal(
                        'Activado!',
                        'El registro ha sido activado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            validarcarbonatos_pcl(){
                this.errorcarbonatos_pcl=0;
                this.errorMostrarMsjcarbonatos_pcl =[];

                if (this.idpreparacion==0) this.errorMostrarMsjcarbonatos_pcl.push("Seleccione un codigo de preparacion.");
                if (!this.fecha) this.errorMostrarMsjcarbonatos_pcl.push("La fecha no puede estar vacío.");

                if (this.errorMostrarMsjcarbonatos_pcl.length) this.errorClCruros = 1;

                return this.errorcarbonatos_pcl;
    C     },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.idpreparacion= 0;
                this.fecha='',
                this.masa_recipiente = '';
                this.masa_muestra = '';
                this.cod_balanza = '';
                this.vol_gastado_hci = '';
                this.cod_bureta = '';
                this.conc_hci= '';
                this.dato= '';
                this.cumple= '';
                this.observaciones='';
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "carbonatos_pcl":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Detalle carbonatos_pcl';
                                this.idpreparacion= 0;
                                this.fecha='',
                                this.masa_recipiente = '';
                                this.masa_muestra = '';
                                this.cod_balanza = '';
                                this.vol_gastado_hci = '';
                                this.cod_bureta = '';
                                this.conc_hci= '';
                                this.dato= '';
                                this.cumple= '';
                                this.observaciones='';        
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal=1;
                                this.tituloModal='Actualizar Detalle carbonatos_pcl';
                                this.tipoAccion=2;
                                this.carbonatos_pcl_id=data['id'];
                                this.idpreparacion=data['idpreparacion'];
                                this.fecha = data['fecha'];
                                this.masa_muestra=data['masa_muestra'];
                                this.masa_recipiente=data['masa_recipiente'];
                                this.cod_balanza=data['cod_balanza'];
                                this.vol_gastado_hci=data['vol_gastado_hci'];
                                this.cod_bureta=data['cod_bureta'];
                                this.conc_hci= data['conc_hci'];
                                this.dato= data['dato'];
                                this.cumple= data['cumple'];
                                this.observaciones= data['observaciones'];
                                break;
                            }
                        }
                    }
                }
                this.selectPreparacion();
            }
        },
        mounted() {
            this.listarCarbonatos_pcl(1,this.buscar,this.criterio);
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
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>