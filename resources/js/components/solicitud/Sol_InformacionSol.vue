<template>
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <i class="fa fa-align-justify"></i>
        <strong>Información de la Solicitud</strong>
        <button
          type="button"
          data-toggle="modal"
          data-target="#modalInformacionSol"
          @click="abrirModalInfSol('solicitud','registrar')"
          class="btn btn-info pull-right"
          style="right:0;"
        >
          <font bold>+ Nuevo</font>
        </button>
      </div>
      <div class="card-body">
        <table class="table table-responsive-sm table-bordered table-striped table-sm">
          <thead>
            <tr>
              <th>Cantidad</th>
              <th>Flujo de muestras</th>
              <th>Matriz</th>
              <th>Analito de interés</th>
              <th>Descripción de la procedencia</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="solicitud in arrayinfoSolicitud" :key="solicitud.id">
              <td v-text="solicitud.cantidad"></td>
              <td v-text="solicitud.flujo"></td>
              <td v-text="solicitud.matriz"></td>
              <td v-text="solicitud.analitoRender"></td>
              <td v-text="solicitud.des_procedencia"></td>
              <td>
                <a
                  href="#"
                  data-toggle="modal"
                  data-target="#modalInformacionSol"
                  @click="abrirModalInfSol('solicitud','actualizar',solicitud)"
                >
                  <i class="fa fa-edit info" style="font-size: 23px"></i>
                </a>
                <a href="#" @click="eliminarInfSol(solicitud.id)">
                  <i class="fa fa-trash" style="font-size: 23px"></i>
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!--Inicio del modal agregar/actualizar  solicitud-->
    <div class="modal fade" :class="{'mostrarr' : modal2}" tabindex="-1" role="dialog" aria-labelledby="modalInformacionSolTit" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-text="tituloModal"></h4>
            <button  type="button" class="close" data-dismiss="modal" @click="cerrarModal()" aria-label="Close" >
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form action method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="row">
                <div class="form-group col-sm-4">
                  <label for="city">Cantidad</label>
                  <input class="form-control" v-model="cantidad" type="text" placeholder="Cantidad" />
                </div>
                <div class="form-group col-sm-4">
                  <label for="postal-code">Flujo de muestras</label>
                  <input
                    class="form-control"
                    v-model="flujo"
                    type="text"
                    placeholder="Flujo de muestras"
                  />
                </div>
                <div class="form-group col-sm-4">
                  <label for="city">Matriz</label>
                  <input class="form-control" v-model="matriz" type="text" placeholder="Matriz" />
                </div>
              </div>
              <!-- /.row-->
              <div class="row">
                <div class="form-group col-sm-12">
                  <label for="postal-code">Descripción de la procedencia</label>
                  <textarea
                    cols="90"
                    rows="4"
                    placeholder="Descripción de la procedencia"
                    v-model="des_procedencia"
                    class="form-control"
                  ></textarea>
                </div>
              </div>
              <div class="row">
                <!--div class="form-group col-sm-6">
                                <label for="postal-code">Analito de interés</label>
                                <input class="form-control" v-model="analito" type="text" placeholder="Analito de interés">
                </div-->
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
              <!--div class="row">
                <div class="form-group col-sm-4">
                  <b-form-group id="input-group-2" label="Analito:" label-for="input-2">
                    <b-form-select v-model="idanalito" class="mb-3" required>
                      <b-form-select-option value="0" disabled>-- Seleccionar --</b-form-select-option>
                      <b-form-select-option
                        v-for="analito in arrayAnalito"
                        :key="analito.id"
                        :value="analito.id"
                        v-text="analito.nombre"
                      ></b-form-select-option>
                    </b-form-select>
                  </b-form-group>
                </div>
              </div-->
              <!-- /.row-->
            </form>
            <div v-show="errorInfSolicitud" class="form-group row div-error">
              <div class="text-center text-error">
                <div v-for="error in errorMostrarMsjSolicitud" :key="error" v-text="error"></div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              @click="cerrarModal()"
              data-dismiss="modal"
            >Cerrar</button>
            <button
              type="button"
              v-if="tipoAccion==1 "
              class="btn btn-primary"
              @click="crearInfSolicitud()"
            >Guardar</button>
            <button
              type="button"
              v-if="tipoAccion==2"
              class="btn btn-primary"
              data-dismiss="modal"
              @click="actualizarInfSolicitud(solicitud.id)"
            >Actualizar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialvue-datepickerog -->
    </div>
    <!--Fin del modal-->
  </div>
</template>

<script>
// import datables from 'datatables'
import vSelect from "vue-select";
import Datepicker from "vuejs-datepicker";
import { es } from "vuejs-datepicker/dist/locale";
import moment from "moment";
import inf from "moment";

export default {
  data() {
    return {
      
      //Informacion solicitud
      arrayinfoSolicitud: [],
      cantidad: "",
      flujo: "",
      matriz: "",
      analito: "",
      des_procedencia: "",
      idActualizar: -1,
      solicitud_id: 0,

      //options: ['Litio', 'Potasio', 'Sodio', 'Calcio', 'Magnesio', 'Boro', 'Cloruros','Sulfatos'],
      search: "",
      value: [],
      arrayA:[],
      columnAnalito:[],

      //modal
      nombre: "",
      nameState: null,
      datosAnalito:[],
      //nuevo analito
      nombreAnalito: "",
      modalInf: 0,
      inputAnalito: 0,

      //prueba select
      arrayAnalito: [],

      modal2: 0,
      tituloModal: "",
      tipoAccion: 0,
      errorSolicitud: 0,
      errorInfSolicitud: 0,
      errorMostrarMsjSolicitud: [],
      verificaError: 0
    };
  },
  components: {
    vSelect
  },
  computed: {
    searchDesc() {
      if (this.criteria && this.arrayAnalitob.nombre.length === 0) {
        return "No hay datos con sus criterios de búsqueda";
      }
      return "";  
    }
  },
  methods: {
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
   
    crearInfSolicitud() {
      if (this.validarInfSolicitud()) {
        return;
      }
      var datosA  = [];
      console.log(this.value,'analito 123');
      //this.columnAnalito = this.value[i],
        for (let i = 0; i < this.value.length; i++) {
          this.columnAnalito = this.value[i];
            datosA.push({
            "nombre": this.value[i]
          });        
              
         } 
      console.log(this.columnAnalito,'this.columnAnalito---------');
      console.log(datosA,'datos **********'); 
      this.datosAnalito = JSON.stringify(datosA);
      console.log(this.datosAnalito,'datos ******123 OBJETO ****'); 
      this.arrayinfoSolicitud.push({
        cantidad: this.cantidad,
        flujo: this.flujo,
        matriz: this.matriz,
        analito: this.datosAnalito,
        des_procedencia: this.des_procedencia
      });
      
      console.log(this.arrayinfoSolicitud,'info array');
            for(let item of this.arrayinfoSolicitud){
                item.analitoRender = [];
                item.analito=JSON.parse(item.analito);
                console.log(item.analito,'analito');
                for (const nombre of item.analito) {
                    item.analitoRender.push(nombre.nombre)
                }                         
            item.analitoRender = item.analitoRender.join("-")
            }
     
     //envio de datos /padre
     let datos = this.arrayinfoSolicitud;
     this.$emit('resultadosInf', datos);
     this.modal2 = 0;
    },
    
    actualizarInfSolicitud(idsolicitud) {
      if (this.validarInfSolicitud()) {
        return;
      }
      this.idActualizar = idsolicitud;
      this.cantidad = this.cantidad;
      this.flujo = this.flujo;
      this.matriz = this.matriz;
      this.analito = this.datosAnalito;
      this.des_procedencia = this.des_procedencia;
      this.formActualizar = true;
      this.modal2 = 0;
    },
    //crearInfSolicitud
    abrirModalInfSol(modelo, accion, data = []) {
      switch (modelo) {
        case "solicitud": {
          switch (accion) {
            case "registrar": {
              this.modal2 = 1;
              this.tituloModal = "Registrar solicitud";
              this.cantidad = "";
              this.matriz = "";
              this.analito = "";
              this.flujo = "";
              this.des_procedencia = "";
              this.tipoAccion = 1;
              break;
            }
            case "actualizar": {
              //console.log(data);
              this.modal2 = 1;
              this.tituloModal = "Actualizar solicitud";
              this.tipoAccion = 2;
              this.solicitud_id = data["id"];
              this.cantidad = data["cantidad"];
              this.matriz = data["matriz"];
              this.analito = data["analito"];
              this.flujo = data["flujo"];
              this.des_procedencia = data["des_procedencia"];
              break;
            }
          }
        }
      }
      this.selectAnalito();
    },
    validarInfSolicitud() {
      this.errorInfSolicitud = 0; //cantidad flujo matriz analito des_procedencia
      this.errorMostrarMsjSolicitud = [];
      console.log("ENTRA INF E");
      if (!this.cantidad)
        this.errorMostrarMsjSolicitud.push("Debe ingresar la cantidad.");
      if (!this.matriz)
        this.errorMostrarMsjSolicitud.push("Debe ingresar la matriz.");
      if (!this.value)
        this.errorMostrarMsjSolicitud.push("Debe ingresar analito de interés.");
      if (!this.des_procedencia)
        this.errorMostrarMsjSolicitud.push(
          "Debe ingresar la descripción de la procedencia."
        );
      if (this.errorMostrarMsjSolicitud.length) this.errorInfSolicitud = 1;
      return this.errorInfSolicitud;
    },

    cerrarModal() {
      //this.data-dismiss="modal";
      this.modal2 = 0;
      this.modalInf = 0;
      this.errorSolicitud = 0;
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
    }
  }
};
</script>