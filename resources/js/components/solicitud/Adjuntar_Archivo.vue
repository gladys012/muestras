<template>
  <main class="main"> 
    <!-- Breadcrumb -->
   <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
   </ol>                
        <div class="col-sm-12">
        <div class="card">   
            <b-form  enctype="multipart/form-data">
                <div class="card-header"><strong>Solicitud de ensayo/Adjuntar archivo</strong></div>
                <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <b-form-group id="input-group-2"  label="Procedencia o Unidad:" label-for="input-2" >                                                              
                            <b-form-select v-model="idunidad" class="mb-3" required>
                                <b-form-select-option value="0" disabled>-- Seleccionar --</b-form-select-option>
                                <b-form-select-option v-for="unidad in arrayUnidad" :key="unidad.id" :value="unidad.id" v-text="unidad.unidad" ></b-form-select-option>
                            </b-form-select> 
                        </b-form-group>
                    </div>
                    <b-form-file
                    v-model="file"
                    :state="Boolean(file)" @change="obtenerImagen"
                    placeholder="Seleccionar"
                    drop-placeholder="Adjunte el archivo aqui..."
                    ></b-form-file>
                    <div class="form-group col-sm-12">
                        <div class="mt-3">Archivo seleccionado: {{ file ? file.name : '' }}</div>

                        <figure class="figure" >
                            <img class="figure-img img-fluid" width="200" height="200" :src="imagen">
                        </figure>
                        </div> 
                    </div>    
                    <div class="row">
                    <div class="form-group col-sm-6">
                        <button type="button" class="btn btn-primary" @click="addImagen()">Enviar archivo</button>
                    </div>
                </div>                                                                           
                </div>                
            </b-form>    
        </div> 
        <!-- /. solicitud-->  
        </div>                
  </main>         
</template>

<script>

    export default {
        data (){         
            return {
                
               verificaError:0, 
               imagenMiniatura:'', 
               //imagen:'',
               file: null,
               arrayUnidad:[],
               idunidad:0,
            }
        },
        components: {

          },
        computed:{          
            imagen(){
                return this.imagenMiniatura;
            }
        },
        methods : {

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
        obtenerImagen(e){
            console.log(e,'e  123');
            let file = e.target.files[0];
            console.log(file,'file ...123');

            this.imagen = file;
            this.cargarImagen(file);
        },

        cargarImagen(file){
            let reader = new FileReader();

            reader.onload = (e) =>{
                this.imagenMiniatura = e.target.result;
            }
            reader.readAsDataURL(file);
        },

        addImagen(){
            if (this.idunidad!=0 && this.idunidad!='' && this.file!='') {
                
                let datoImagen = new FormData();
                datoImagen.append('imagen', this.file);
                this.popToastReg();
                location.reload();
                axios.post('/solicitud/adjunto', datoImagen)
                    .then((response) => {
                        this.popToastReg();
                        console.log(response,'response imagen')
                    }).catch((err) => {
                        
                    });
            }else {
                this.popToastError();
            }
        },

            popToastReg() {
                const h = this.$createElement
                this.count++
                const vNodesMsg = h(
                'p',
                { class: ['text-center', 'mb-0'] },
                [
                    h('b-spinner', { props: { type: 'grow', small: true } }),
                    ' Se registraron los datos',
                ])
                const vNodesTitle = h(
                'div',
                { class: ['d-flex', 'flex-grow-1', 'align-items-baseline', 'mr-2'] },
                [
                    h('small', { class: 'ml-auto text-italics' }, '3 minutes ago')
                ])
                this.$bvToast.toast([vNodesMsg], {
                title: 'Se ejecuto correctamente',
                solid: true,
                variant: 'success'
                })
             }, 
              
              popToastError() {
                const h = this.$createElement
                this.count++
                const vNodesMsg = h(
                'p',
                { class: ['text-center', 'mb-0'] },
                [
                    h('b-spinner', { props: { type: 'grow', small: true } }),
                    ' Verifique los datos',
                ])
                const vNodesTitle = h(
                'div',
                { class: ['d-flex', 'flex-grow-1', 'align-items-baseline', 'mr-2'] },
                [
                    h('small', { class: 'ml-auto text-italics' }, '3 minutes ago')
                ])
                this.$bvToast.toast([vNodesMsg], {
                title: 'Error al guardar',
                solid: true,
                variant: 'danger'
                })
             },        
            },
            mounted() {
            //     ///php artisan serve --host=192.168.1.5
            this.selectUnidad()
        }
    }
    
</script>
<style>      

</style>