<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Solicitud de Ensayo</title>
    <style>
        body {
        /*position: relative;*/
        width: 100%;  
        /*height: 29.7cm; */
        /*margin: 0 auto; */
        /*color: #555555;*/
        /*background: #FFFFFF; */
        font-family: Arial, sans-serif; 
        font-size: 14px;
        /*font-family: SourceSansPro;*/
        }
        #logo{
        float: left;
        margin-top: 1%;
        margin-left: 2%;
        margin-right: 2%;
        }
        #imagen{
        width: 100px;
        }
        #datos{
        float: left;
        margin-top: 0%;
        margin-left: 2%;
        margin-right: 2%;
        /*text-align: justify;*/
        }
        #encabezado{
        text-align: center;
        margin-left: 10%;
        margin-right: 35%;
        font-size: 15px;
        }
        #fact{
        /*position: relative;*/
        float: right;
        margin-top: 2%;
        margin-left: 2%;
        margin-right: 2%;
        font-size: 20px;
        }
       /* section{
        clear: left;
        }*/
        #cliente{
        text-align: left;
        }
        #facliente{
        width: 100%
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #fac, #fv, #fa{
        color: #FFFFFF;
        /*font-size: 15px;*/
        }

        #facliente thead{
        padding: 20px;
        background: #2183E3;
        text-align: left;
        border-bottom: 1px solid #FFFFFF;  
        }

        #facvendedor{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #facvendedor thead{
        padding: 20px;
        background: #2183E3;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }
        #facarticulo{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }
        #facarticulo thead{
        padding: 20px;
        background: #2183E3;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }
    </style>
    <body>

     @foreach ($unidad_solicitante as $unidad)
     @foreach ($unidad as $u)
        
        <header>
            <div id="logo">
                <img src="img/logo2.png" alt="incanatoIT" id="imagen">
            </div>
            <div id="datos">
                <p id="encabezado">
                    <b>Solicitud de Ensayo</b><br>
                </p>
            </div>
            <div id="facvendedor"><br>
                <p>Nro de registro: {{$u}}</p>
                <p>Unidad: {{$u->unidad}}<br></p>
                <p>Nombre Responsable: {{$u->paternoR}} {{$u->maternoR}} {{$u->nombreR}}       Nombre Encargado: {{$u->paternoE}} {{$u->maternoE}} {{$u->nombreE}}</p><br>
            </div>
        </header>
        <br>
        <section>
            <div>
                <table id="facvendedor">
                    <thead>                        
                        <tr>
                            <th id="fv">Información de la Solicitud</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th><p>Cantidad: {{$u->cantidad}}
                            Flujo:{{$u->flujo}}   Matriz: {{$u->matriz}}   Descripción: {{$u->des_procedencia}}<br>
                            Analito: {{$u->analito}}</p><br>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>        
        <br>
        <section>
            <div id="facvendedor"> 
                <h4>Revisión de la oferta</h4>
                <p>PERSONAL TECNICO CAPACITADO: {{$u->personal_capacitado}}</p>
                <p>DISPONIBILIDAD DE TIEMPO: {{$u->disponibilidad}}</p>
                <p>MATERIALES Y REACTIVOS DISPONIBLES: {{$u->materiales}}</p>
                <p>EQUIPOS CON CALIBRACIONES VIGENTES: {{$u->equipos}}</p>
                <p>INSTALACIONES (MANIPULACION Y MANTENIMIENTO): {{$u->instalaciones}}</p>
                <p>METODO DE ENSAYO DOCUMENTADO Y VALIDADO: {{$u->metodo}}</p>
                <p>Observaciones: {{$u->observacionesRev}}</p>
                <p>Aclaraciones: {{$u->aclaraciones}}</p>
                <p>Aceptado: {{$u->trabajo_aceptado}}</p>                               
            </div>
        </section>

        @endforeach
        @endforeach
        <br>
        <br>
        <br>
        <footer>
            <div id="gracias">
                <p><b>Gracias por su compra!</b></p>
            </div>
        </footer>
    </body>
</html>