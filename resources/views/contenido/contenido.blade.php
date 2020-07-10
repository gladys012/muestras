    @extends('principal')
    @section('contenido')
    
    @if(Auth::check())
        @if(Auth::user()->idrol == 1)
        <!--template v-if="menu==0">
           <example-component></example-component>
        </template-->
        <template v-if="menu==1">
                <solicitud></solicitud>
        </template>
        <template v-if="menu==101">
                <sol_adjuntar_archivo></sol_adjuntar_archivo>
        </template>
        <template v-if="menu==111">
                <modificacion></modificacion>
        </template>
        <template v-if="menu==555">
                <codigo_lab></codigo_lab>
        </template>
        <template v-if="menu==2">
                <recepcion></recepcion>
        </template>
        <template v-if="menu==222">
                <preparacion></preparacion>
        </template>
        <template v-if="menu==3">
                <cloruros_vol></cloruros_vol>
        </template>
        <template v-if="menu==4">
                <sulfatos_turb></sulfatos_turb>
        </template>
        <template v-if="menu==5">
                <sulfatos_grav></sulfatos_grav>
        </template>
        <template v-if="menu==6">
                <ph_densidad></ph_densidad>
        </template>
        <template v-if="menu==7">
                <humedad></humedad>
        </template>
        <template v-if="menu==8">
                <alcalinidad></alcalinidad>
        </template>

        <template v-if="menu==9">
                <carbonatos_pcl></carbonatos_pcl>
        </template>
        <template v-if="menu==10">
                <espectrometria></espectrometria>
        </template>
        <template v-if="menu==11">
                <granulometrico></granulometrico>
        </template>
        <template v-if="menu==12">
                <oxido_calcio></oxido_calcio>
        </template>
        <template v-if="menu==13">
                <muestreo_cal></muestreo_cal>
        </template>
        <template v-if="menu==14">
                <correccion_metrologica></correccion_metrologica>
        </template>
        <template v-if="menu==15">
                <cloruros_pspv></cloruros_pspv>
        </template>
        <template v-if="menu==16">
                <boro_volumetria></boro_volumetria>
        </template>
        <template v-if="menu==17">
                <cal_mg_complexometria></cal_mg_complexometria>
        </template>
        <template v-if="menu==18">
                <ph_densidad_solidas></ph_densidad_solidas>
        </template>
        <template v-if="menu==19">
                <carbonatos_mssv></carbonatos_mssv>
        </template>
        <template v-if="menu==20">
                <carbonatos_oxidrilos></carbonatos_oxidrilos>
        </template>
        <template v-if="menu==21">
                <turbidez_conductividad></turbidez_conductividad>
        </template>
        <template v-if="menu==22">
                <potasio_valoracion></potasio_valoracion>
        </template>
        <template v-if="menu==25">
                <potasio_gravimetria></potasio_gravimetria>
        </template>
        <template v-if="menu==26">
                <trazas_aa></trazas_aa>
        </template>
        <template v-if="menu==30">
                <personas></personas>
        </template>
        <template v-if="menu==31">
                <analitos></analitos>
        </template>
        <template v-if="menu==40">
                <rol></rol>
        </template>
        <template v-if="menu==41">
                <user></user>
        </template>
        <template v-if="menu==43">
                <reportes></reportes>
        </template>     
        <template v-if="menu==50">
                <h1>Ayuda</h1>
        </template>        
        <template v-if="menu==51">
                <h1>Acerca de:</h1>
        </template>
        @elseif(Auth::user()->idrol == 2)
        <template v-if="menu==0">
                <example-component></example-component>
        </template>
        <!--template v-if="menu==1">
                <solicitud></solicitud>
        </template>
        <template v-if="menu==111">
                <modificacion></modificacion>
        </template-->
        <template v-if="menu==2">
                <recepcion></recepcion>
        </template>
        <template v-if="menu==222">
                <preparacion></preparacion>
        </template>
        <template v-if="menu==3">
                <cloruros_vol></cloruros_vol>
        </template>
        <template v-if="menu==4">
                <sulfatos_turb></sulfatos_turb>
        </template>
        <template v-if="menu==5">
                <sulfatos_grav></sulfatos_grav>
        </template>
        <template v-if="menu==6">
                <ph_densidad></ph_densidad>
        </template>
        <template v-if="menu==7">
                <humedad></humedad>
        </template>
        <template v-if="menu==8">
                <alcalinidad></alcalinidad>
        </template>

        <template v-if="menu==9">
                <carbonatos_pcl></carbonatos_pcl>
        </template>
        <template v-if="menu==10">
                <espectrometria></espectrometria>
        </template>
        <template v-if="menu==11">
                <granulometrico></granulometrico>
        </template>
        <template v-if="menu==12">
                <oxido_calcio></oxido_calcio>
        </template>
        <template v-if="menu==13">
                <muestreo_cal></muestreo_cal>
        </template>
        <template v-if="menu==14">
                <correccion_metrologica></correccion_metrologica>
        </template>
        <template v-if="menu==15">
                <cloruros_pspv></cloruros_pspv>
        </template>
        <template v-if="menu==16">
                <boro_volumetria></boro_volumetria>
        </template>
        <template v-if="menu==17">
                <cal_mg_complexometria></cal_mg_complexometria>
        </template>
        <template v-if="menu==18">
                <ph_densidad_solidas></ph_densidad_solidas>
        </template>
        <template v-if="menu==19">
                <carbonatos_mssv></carbonatos_mssv>
        </template>
        <template v-if="menu==20">
                <carbonatos_oxidrilos></carbonatos_oxidrilos>
        </template>
        <template v-if="menu==21">
                <turbidez_conductividad></turbidez_conductividad>
        </template>
        <template v-if="menu==22">
                <potasio_valoracion></potasio_valoracion>
        </template>
        <template v-if="menu==25">
                <potasio_gravimetria></potasio_gravimetria>
        </template>
        <template v-if="menu==26">
                <trazas_aa></trazas_aa>
        </template>
        <template v-if="menu==30">
                <personas></personas>
        </template>
        <template v-if="menu==43">
                <reportes></reportes>
        </template>     
        <template v-if="menu==50">
                <h1>Ayuda</h1>
        </template>        
        <template v-if="menu==51">
                <h1>Acerca de:</h1>
        </template>
        @elseif(Auth::user()->idrol == 3)
        <!--template v-if="menu==0">
                <example-component></example-component>
        </template-->
        <template v-if="menu==1">
                <solicitud></solicitud>
        </template>
        <template v-if="menu==111">
                <modificacion></modificacion>
        </template>
        <template v-if="menu==2">
                <recepcion></recepcion>
        </template>
        <template v-if="menu==222">
                <preparacion></preparacion>
        </template>
        <template v-if="menu==3">
                <cloruros_vol></cloruros_vol>
        </template>
        <template v-if="menu==4">
                <sulfatos_turb></sulfatos_turb>
        </template>
        <template v-if="menu==5">
                <sulfatos_grav></sulfatos_grav>
        </template>
        <template v-if="menu==6">
                <ph_densidad></ph_densidad>
        </template>
        <template v-if="menu==7">
                <humedad></humedad>
        </template>
        <template v-if="menu==8">
                <alcalinidad></alcalinidad>
        </template>

        <template v-if="menu==9">
                <carbonatos_pcl></carbonatos_pcl>
        </template>
        <template v-if="menu==10">
                <espectrometria></espectrometria>
        </template>
        <template v-if="menu==11">
                <granulometrico></granulometrico>
        </template>
        <template v-if="menu==12">
                <oxido_calcio></oxido_calcio>
        </template>
        <template v-if="menu==13">
                <muestreo_cal></muestreo_cal>
        </template>
        <template v-if="menu==14">
                <correccion_metrologica></correccion_metrologica>
        </template>
        <template v-if="menu==15">
                <cloruros_pspv></cloruros_pspv>
        </template>
        <template v-if="menu==16">
                <boro_volumetria></boro_volumetria>
        </template>
        <template v-if="menu==17">
                <cal_mg_complexometria></cal_mg_complexometria>
        </template>
        <template v-if="menu==18">
                <ph_densidad_solidas></ph_densidad_solidas>
        </template>
        <template v-if="menu==19">
                <carbonatos_mssv></carbonatos_mssv>
        </template>
        <template v-if="menu==20">
                <carbonatos_oxidrilos></carbonatos_oxidrilos>
        </template>
        <template v-if="menu==21">
                <turbidez_conductividad></turbidez_conductividad>
        </template>
        <template v-if="menu==22">
                <potasio_valoracion></potasio_valoracion>
        </template>
        <template v-if="menu==25">
                <potasio_gravimetria></potasio_gravimetria>
        </template>
        <template v-if="menu==26">
                <trazas_aa></trazas_aa>
        </template>
        <template v-if="menu==30">
                <personas></personas>
        </template> 
        <template v-if="menu==50">
                <h1>Ayuda</h1>
        </template>        
        <template v-if="menu==51">
                <h1>Acerca de:</h1>
        </template>
        @else
        @endif    
      @endif

        
    @endsection