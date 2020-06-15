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
                        <template v-slot:head(fecha)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>  
                        <template v-slot:head(codigo_lab)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>  
                        <template v-slot:head(nro_vaso)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>  
                        <template v-slot:head(cantidad)="data">
                            <span class="text-primary">{{ data.label }}</span>
                        </template>   
                        <template v-slot:head(codigo)="data">
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
                            <b-form-group id="input-group-2"  label="Hora:" label-for="input-2" >
                                <b-form-timepicker v-model="hora" placeholder="Seleccione hora" local="es"></b-form-timepicker> 
                            </b-form-group>
                         </div> 
                         <div class="form-group col-sm-4">
                            <b-form-group id="input-group-4"  label="Cantidad:" label-for="input-4" >
                                <b-form-input id="input-4" v-model="cantidad" placeholder="Cantidad" required                            
                                ></b-form-input>
                            </b-form-group>
                         </div>                                                
                       </div>                    
                       <div class="row">                                                                              
                                                     
                          <div class="form-group col-sm-4">
                            <b-form-group id="input-group-3"  label="Cliente:" label-for="input-2" >
                                <b-form-input id="input-3" v-model="cliente" placeholder="Cliente" required                            
                                ></b-form-input>
                            </b-form-group>
                         </div>                                                                                                                                
                       </div>
                       <div class="row">
                           <div class="form-group col-sm-4">                           
                            <div class="container">
                                <div class="box">
                                    <div class="checkbox-group">
                                    <input id="checkboxName1" type="checkbox" v-model="liquido"/>
                                    <label for="checkboxName1" class="ta">Líquido</label>
                                    <input id="checkboxName2" type="checkbox" v-model="solido"/>
                                    <label for="checkboxName2" class="ta">Sólido</label> 
                                    </div>
                                </div>
                            </div> 
                         </div>
                          <div class="form-group col-sm-8">
                              <b-form-group id="input-group-8" label="Observaciones:" label-for="input-6">                                
                                <b-form-textarea
                                    id="textarea"
                                    v-model="observaciones"
                                    placeholder="Observaciones"
                                    rows="3" max-rows="4"
                                    ></b-form-textarea>
                            </b-form-group>
                          </div>
                       </div> 
                       <div class="row">
                           <div class="form-group col-sm-4">
                                <label for="">Persona entrega </label>
                                <v-select
                                    :on-search="selectPersona"
                                    label="ci"
                                    :options="arrayPersonaci"
                                    placeholder="Buscar Personas por CI."
                                    :onChange="getDatosPersona"    
                                    v-model="ciEntrega"                                        
                                >
                                <span slot="no-options">No existen registros</span>
                                <!--input slot="no-options" v-if="responsable==1" @click="abrirModalPersonaRes('solicitud','registrarResponsable')" class="form-control btn btn-info" type="button" value="Adicionar Persona" /-->
                                </v-select>  
                            </div>
                            <b-form-group id="input-group-4"  label="Nombre:" label-for="input-4" >
                                <b-form-input id="input-4" v-model="nombrePersona" placeholder="Nombre" disabled                            
                                ></b-form-input>
                            </b-form-group>
                            <div class="form-group col-sm-4">
                            <b-form-group id="input-group-5"  label="Código muestra:" label-for="input-5" >
                                <b-form-input id="input-5" v-model="codigo" placeholder=" Código muestra" disabled                            
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
                fechaD: new Date(),
                hora:'',
                codigo : '',
                observaciones: '',
                identrega:1,
                cliente:'',
                cantidad:'',
                paterno:'',
                materno:'',
                nombre:'',
                liquido:'',
                solido:'',
                cliente:'',
                direccion:'',
                telefono:'',
                email:'',
                errorPersona:'',
                ci:'',
                arrayRecepcion : [],
                arrayPreparacion :[],
                errorMostrarMsjPersona:[],
                tituloModal : '',

                modal : 0,                
                modal2 : 0,                
                tipoAccion : 0,
                errorRecepcion: 0,
                errorMostrarMsjRecepcion:[],
                arrayPersonaci:[],
                idresponsable:1, 
                responsable:0,
                nombrePersona:'',
                ciEntrega:'',
                errorPersona:'',

                personaEntrega:'',
                nroEntregaPersona:'',
               
                dismissSecs: 5,
                dismissCountDown: 0,
                show: true,
                columnas: [
                  { key: 'fecha', label: 'Fecha', sortable: true, sortDirection: 'desc' },
                  { key: 'codigo', label: 'Cod. muestra', sortable: true, class: 'text-justify' },                 
                  { key: 'cantidad', label: 'Cantidad', sortable: true },                 
                  { key: 'codigo', label: 'Código muestra', sortable: true },                 
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

        },
        methods : {

            onFiltered(filteredItems) {
              // Trigger pagination to update the number of buttons/pages due to filtering
              this.totalRows = filteredItems.length;
              this.currentPage = 1
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
                console.log(this.fechaD,'entra fecha');
                this.fechaD = moment(this.fechaD).format('D/MM/YYYY');
                console.log(this.fechaD,'fechaaaaaa');
                let me = this;
                        axios.post('/recepcion/registrar',{
                            'codigo': this.codigo,
                            'cantidad': 5,
                            'fecha' : this.fecha,
                            'hora' : this.hora,
                            'liquido' : this.liquido,
                            'solido' : this.solido,
                            'usr_id':1,
                            'identrega': 1,
                            'cliente':this.idresponsable,
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
                this.fechaD = moment(this.fechaD).format('D/MM/YYYY');
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
            
              actualizarDatoPersona(){             
                let me = this;                 
                axios.put('/persona/actualizar',{
                    //'idpersona': this.idpersona, 
                    'nro_entrega': this.nroEntregaPersona,
                    'usr_id':1,
                    'id': this.idresponsable                    
                }).then(function (response) {
                    me.cerrarModal();
                }).catch(function (error) {
                    console.log(error);
                });                
            },
            cerrarModal(){
                this.modal=0;
                this.modal2=0;
                this.tituloModal='';
                this.fecha = new Date();
                this.hora='';
                this.codigo='';
                this.cantidad=0;
                this.liquido='';
                this.solido='';
                this.nombre='';                
                this.paterno='';
                this.materno='';
                this.ci='';
                this.direccion='';
                this.telefono='';
                this.email='';
                this.observaciones='';
                this.errorRecepcion=0;
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "recepcion":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Recepción';
                                this.fecha=new Date();
                                this.hora='';
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
            },
            abrirModalPersona(modelo, accion, data = []){

                switch(modelo){
                    case "recepcion":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal2 = 1;
                                this.tituloModal = 'Registrar Recepcion';
                                    this.fecha= new Date();
                                    this.hora='';
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
                                this.modal2=1;
                                this.tituloModal='Actualizar Recepcion';
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
            getDatosPersona(val1){
              console.log(val1,'dato val1');
              console.log(val1.nro_entrega,'nro entrega');
              let me = this;
              me.loading = true;
              me.idresponsable = val1.id;
              if (val1 =='') {
                 me.nombrePersona='';
              }else{
                   if (val1.materno=='' || val1.materno==null) {
                    me.nombrePersona = val1.paterno +' '+ val1.nombre;   
                  }else{
                 me.nombrePersona = val1.paterno +' '+ val1.materno +' '+ val1. nombre;
                 console.log(me.nombrePersona,'nom per');
                    console.log(val1.paterno.substring(0,1),'***********');
                    let persona = val1.paterno.substring(0,1) + val1.materno.substring(0,1) + val1.nombre.substring(0,1)
                   
                    this.personaEntrega = persona.toUpperCase();
                    console.log(persona,'persona');
                    if (val1.nro_entrega=='' || val1.nro_entrega==null) {
                        this.nroEntregaPersona=1;
                        this.personaEntrega=this.personaEntrega+this.nroEntregaPersona;
                        console.log(this.personaEntrega,'123 codigo');
                    }else{
                         this.nroEntregaPersona = val1.nro_entrega+1;
                         console.log(this.nroEntregaPersona,'nrooooo');
                         this.personaEntrega=this.personaEntrega+this.nroEntregaPersona;
                         console.log(this.personaEntrega,'codigo +1');
                    }
                    this.codigo=this.personaEntrega;

                  }             
              }              
            },
            validarPersona(){
                this.errorPersona=0;
                this.errorMostrarMsjPersona =[];
                if (!this.nombre) this.errorMostrarMsjPersona.push("Debe ingresar el nombre de la persona.");
                if (!this.ciEntrega) this.errorMostrarMsjPersona.push("Debe ingresar el C.I. de la persona.");
                if (!this.paterno) this.errorMostrarMsjPersona.push("Debe ingresar el apellido paterno de la persona.");
                if (this.errorMostrarMsjPersona.length) this.errorPersona = 1;
                return this.errorPersona;
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
                    'ci' : this.ciEntrega,
                    'telefono' : this.telefono,
                    'email' : this.email,
                    'direccion' : this.direccion,
                    'usr_id':1,

                }).then(function (response) {
                    console.log(me.nombrePersona,'123');
                    if (me.nombrePersona !='') {
                        me.nombrePersona=me.nombre+' '+ me.paterno+' '+me.materno
                        console.log(me.nombrePersona,'res123');
                        me.ciRes = me.ciEntrega;
                    }else if (me.nombrePersona !='') {
                        me.nombrePersona=me.nombre+' '+ me.paterno+' '+me.materno
                         me.ciRes = me.ciEntrega;  
                    }          
              
                me.cerrarModal();
               }).catch(function (error) {
                    console.log(error);
            });

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
</style>
