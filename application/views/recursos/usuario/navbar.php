        <!-- NavBar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <span class="navbar-brand mb-0 h1"><img src="<?php echo base_url('assets/img/logo_peco.png'); ?>" width="95" height="40"></span>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse collapse" id="navbarsExampleDefault" style="">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('Supervisor/platicas'); ?>"><i class="fas fa-fw fa-list-alt"></i> Ver Pláticas Vigentes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('Supervisor/platicas_registradas'); ?>"><i class="fas fa-fw fa-list-alt"></i> Ver Reuniones Registradas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('Supervisor/buscar_platicas'); ?>"><i class="fas fa-fw fa-search"></i> Buscar Pláticas</a>
                    </li>
                    <li class="nav-item">
                        <!-- <a class="nav-link" href="https://vdbdelta.pc.cmbjpc.com.mx/Reports_DBDELTA/Pages/Report.aspx?ItemPath=%2fSegurida%2fHISTORIAL+DE+PLATICAS" target="_blank"><i class="far fa-fw fa-calendar"></i>Reporte Historial de Pláticas</a> -->
                        <a class="nav-link" href="<?php echo site_url('Supervisor/reporte_platicas'); ?>"><i class="far fa-fw fa-calendar""></i> Reporte Historial de Pláticas</a>
                    </li>
                </ul>

                <!-- Información del usuario -->
                <h6 class="text-white"><i class="fas fa-fw fa-user-circle mr-2"></i><?php echo $this->session->userdata('nombre'); ?></h6>
                <!-- /Información del usuario -->

                <!-- Cerrar sesión -->
                <a href="<?php echo site_url('Login/cerrar_sesion'); ?>">
                    <h6 class="text-warning ml-3"><i class="fas fa-fw fa-sign-out-alt mr-2"></i>Cerrar sesión</h6>
                </a>
                <!-- /Cerrar sesión -->
            </div>
        </nav>
        <!-- /NavBar -->