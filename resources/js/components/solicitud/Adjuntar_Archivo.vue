<template>
  <main class="main"> 
    <!-- Breadcrumb -->
   <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
   </ol>            
      <!--div class="col-lg-12">
        <div class="card"-->
                
        <div class="col-sm-12">
        <div class="card">            
            <div class="card-header"><strong>Solicitud de ensayo/Adjuntar archivo</strong></div>
            <div class="card-body">
                <div class="row">
                <b-form-file
                v-model="file"
                :state="Boolean(file)"
                placeholder="Seleccionar"
                drop-placeholder="Drop file here..."
                ></b-form-file>
                <div class="mt-3">Selected file: {{ file ? file.name : '' }}</div>

                <!-- Plain mode -->
                <b-form-file v-model="file2" class="mt-3" plain></b-form-file>
                <div class="mt-3">Selected file: {{ file2 ? file2.name : '' }}</div>
            </div>                                    
                                     
            </div>
        </div> 
        <!-- /. solicitud-->  
        </div>                
  </main>         
</template>

<script>

    export default {
        data (){         
            return {
                
               errorMostrarMsjSolicitud:[],
               verificaError:0,  
               file: null,
               file2: null             
            }
        },
        components: {

          },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            
        },
        //props: ['olicitudInf'],
        methods : {

                                 
           
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
              popToastMod() {
                const h = this.$createElement
                this.count++
                const vNodesMsg = h(
                'p',
                { class: ['text-center', 'mb-0'] },
                [
                    h('b-spinner', { props: { type: 'grow', small: true } }),
                    ' Se  actualizaron los datos',
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
             //
            //     ///php artisan serve --host=192.168.1.5
            //this.listarSolNroRegistro();

        }
    }
    
</script>
<style>    
    .modal-content{
        width:100%;
        padding: 10px 20px;
        margin: 20% auto;
        position: absolute;
    }
    .mostrarr{
        display: list-item !important;
        opacity: 1 !important;
        position: fixed !important;
        background-color: #7e7c7c7a !important;
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
