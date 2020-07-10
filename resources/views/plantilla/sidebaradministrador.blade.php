<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li @click="menu=0" class="nav-item">
                        <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Escritorio</a>
                    </li>
                    <li class="nav-title">
                        Servicios de Muestras
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-pie-chart"></i> Solicitud de Ensayo</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=1" class="nav-item">
                                <a class="nav-link" href="#"><i class="c-icon cil-circle"></i> Solicitud</a>
                            </li>
                            <li @click="menu=101" class="nav-item">
                                <a class="nav-link" href="#"><i class="c-icon cil-circle"></i> Adjuntar archivo</a>
                            </li>
                            <li @click="menu=111" class="nav-item">
                                <a class="nav-link" href="#"><i class="c-icon cil-circle"></i> Modificaciones</a>
                            </li>
                            <li @click="menu=555" class="nav-item">
                                <a class="nav-link" href="#"><i class="c-icon cil-circle"></i> Asignación de código</a>
                            </li>                            
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i> Registro de Muestras</a>
                        <ul class="nav-dropdown-items">
                        <li @click="menu=2" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-circle"></i> Recepción</a>
                            </li>
                            <li @click="menu=222" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-circle"></i> Preparación</a>
                            </li>                            
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i>Laboratorios</a>
                        <ul class="nav-dropdown-items">                            
                            <li @click="menu=3" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-circle"></i> Cloruros Vol.</a>
                            </li>
                            <li @click="menu=4" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-circle"></i> Sulfatos Turb.</a>
                            </li>
                            <li @click="menu=5" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-circle"></i> Sulfatos Grav.</a>
                            </li>
                            <li @click="menu=6" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-circle"></i> PH y Densidad</a>
                            </li>
                            <li @click="menu=7" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-circle"></i> Humedad</a>
                            </li>
                            <li @click="menu=8" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-circle"></i> Alcalinidad</a>
                            </li>
                            <li @click="menu=9" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-circle"></i> Carbonatos PCL</a>
                            </li>
                            <li @click="menu=10" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-circle"></i> Espectrometría</a>
                            </li>
                            <li @click="menu=11" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-circle"></i> Granulométrico</a>
                            </li>
                            <li @click="menu=12" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-circle"></i> Óxido de Calcio</a>
                            </li>
                            <li @click="menu=13" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-circle"></i> Muestreo de Cal</a>
                            </li>
                            <li @click="menu=14" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-circle"></i> Corrección Metrológica</a>
                            </li>
                            <li @click="menu=15" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-circle"></i> Cloruros en PSPV</a>
                            </li>
                            <li @click="menu=16" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-circle"></i> Boro por Volumetría</a>
                            </li>
                            <li @click="menu=17" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-circle"></i> Ca - Mg por Complexometria</a>
                            </li>
                            <li @click="menu=18" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-circle"></i> Ph Densidad muestras sólidas</a>
                            </li>
                            <li @click="menu=19" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-circle"></i> Carbonatos en MSSV</a>
                            </li>
                            <li @click="menu=20" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-circle"></i> Carbonatos y oxidrilos de LE</a>
                            </li>
                            <li @click="menu=21" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-circle"></i> Turbidez y Conductividad</a>
                            </li>
                            <li @click="menu=22" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-circle"></i> Potasio por valoración</a>
                            </li>
                            <li @click="menu=25" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-circle"></i> Potasio por Gravimetría</a>
                            </li>
                            <li @click="menu=26" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-circle"></i> Trazas por AA</a>
                            </li>

                        </ul>
                    </li>
                    <!--li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-wallet"></i> Compras</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=3" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-wallet"></i> Ingresos</a>
                            </li>
                            <li @click="menu=4" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-notebook"></i> Proveedores</a>
                            </li>
                        </ul>
                    </li-->
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-wallet"></i> Mantenimiento</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=30" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-circle"></i> Personas</a>
                            </li>
                            <li @click="menu=31" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-circle"></i> Analitos</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Acceso</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=41" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user"></i> Usuarios</a>
                            </li>
                            <li @click="menu=40" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user-following"></i> Roles</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-pie-chart"></i> Reportes</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=32" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-chart"></i> Reporte Ingresos</a>
                            </li>                            
                        </ul>
                    </li>
                    <li @click="menu=11" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-book-open"></i> Ayuda <span class="badge badge-danger">PDF</span></a>
                    </li>
                    <li @click="menu=12" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-info"></i> Acerca de...<span class="badge badge-info">IT</span></a>
                    </li>
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>