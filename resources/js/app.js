
/*import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'*/
require('./bootstrap');

window.Vue = require('vue');
window.axios = axios;
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

Vue.component('solicitud', require('./components/solicitud/Solicitud.vue').default);  
Vue.component('solicitudInf', require('./components/solicitud/Sol_InformacionSol.vue').default);  
Vue.component('sol_adjuntar_archivo', require('./components/solicitud/Adjuntar_Archivo.vue').default);  
//Vue.component('solPDF', require('./components/solicitud/solPDF.vue').default);  
Vue.component('modificacion', require('./components/solicitud/Modificacion.vue').default);
Vue.component('codigo_lab', require('./components/Codigo_Lab.vue').default); 


//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('recepcion', require('./components/Recepcion.vue').default);
Vue.component('preparacion', require('./components/Preparacion.vue').default);
Vue.component('cloruros_vol', require('./components/Cloruros_vol.vue').default);
Vue.component('sulfatos_turb', require('./components/Sulfatos_Turb.vue').default);
Vue.component('sulfatos_grav', require('./components/Sulfatos_Grav.vue').default);
Vue.component('ph_densidad', require('./components/Ph_Densidad.vue').default);
Vue.component('humedad', require('./components/Humedad.vue').default);
Vue.component('alcalinidad', require('./components/Alcalinidad.vue').default);
Vue.component('carbonatos_pcl', require('./components/Carbonatos_Pcl.vue').default);
Vue.component('espectrometria', require('./components/Espectrometria.vue').default);
Vue.component('granulometrico', require('./components/Granulometrico.vue').default);
Vue.component('oxido_calcio', require('./components/Oxido_Calcio.vue').default);
Vue.component('muestreo_cal', require('./components/Muestreo_Cal.vue').default);
Vue.component('correccion_metrologica', require('./components/Correccion_Metrologica.vue').default);
Vue.component('cloruros_pspv', require('./components/Cloruros_Pspv.vue').default);
Vue.component('boro_volumetria', require('./components/boro_volumetria.vue').default);
Vue.component('cal_mg_complexometria', require('./components/Cal_Mg_Complexometria.vue').default);
Vue.component('ph_densidad_solidas', require('./components/Ph_Densidad_Solidas.vue').default);
Vue.component('carbonatos_mssv', require('./components/Carbonatos_Mssv.vue').default);
Vue.component('carbonatos_oxidrilos', require('./components/Carbonatos_Oxidrilos.vue').default);
Vue.component('turbidez_conductividad', require('./components/Turbidez_Conductividad.vue').default);
Vue.component('potasio_valoracion', require('./components/Potasio_Valoracion.vue').default);
Vue.component('potasio_gravimetria', require('./components/Potasio_Gravimetria.vue').default);
Vue.component('trazas_aa', require('./components/Trazas_Aa.vue').default);

Vue.component('lab_resultados', require('./components/Lab_Resultados.vue').default);

Vue.component('personas', require('./components/Personas.vue').default);
Vue.component('analitos', require('./components/Analitos.vue').default);
Vue.component('rol', require('./components/Rol.vue').default);
Vue.component('user', require('./components/User.vue').default);
/*Vue.component('rol', require('./components/Rol.vue').default);
Vue.component('user', require('./components/User.vue').default);
*///Vue.component('prueba', require('./components/User.vue').default);
//Vue.component('solicitud2', require('./components/User.vue').default);


import swal from 'sweetalert2'
window.swal = swal;

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
//import './custom.scss';

import { BootstrapVueIcons } from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue-icons.min.css'

Vue.use(BootstrapVueIcons)


const app = new Vue({
    el: '#app',
    data : {
        menu : 0,
        
    },
});
