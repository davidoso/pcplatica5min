    <body>
        
        <!-- BODY -->
            <div class="container">
                            
                <div class="row justify-content-center my-4">
                    <h1>Trabajos registrados</h1>
                </div>
                    
                <!-- Orden -->
                <form role="form" id="filtro" action="<?php echo site_url('Principal/trabajos_registrados'); ?>" method="get">
                    <div class="row mt-3 align-items-end">
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-bold">Fecha Inicio</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text rounded-0" id="basic-addon1"><i class="fa fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="date" class="form-control rounded-0" name="fi" id="fi" placeholder="Fecha" value="<?php echo $this->input->get('fi') ?>">
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-bold">Fecha término</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text rounded-0" id="basic-addon1"><i class="fa fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="date" class="form-control rounded-0" name="ft" id="ft" placeholder="Fecha" value="<?php echo $this->input->get('ft') ?>">
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-bold">Equipo</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text rounded-0" id="basic-addon1"><i class="fas fa-truck"></i></span>
                                    </div>
                                    <select class="custom-select rounded-0" name="fa" id="fa">
                                        <option value="" selected>Todos</option>
                                    <?php
                                        //$fam_equipos=$this->session->userdata('fam_equipos');
                                        foreach($this->session->userdata('fam_equipos') as $key => $fe)
                                        {
                                    ?>
                                        <option disabled><?php echo '-- '.$key.' --'; ?></option>
                                    <?php
                                            foreach($fe as $e)
                                            {
                                    ?>
                                        <option value="<?php echo $e; ?>" <?php if ($e==$this->input->get('fa')){echo 'selected';} ?> ><?php echo $e; ?></option>
                                    <?php
                                            } // foreach de equipos
                                        } // foreach de familias
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <button type="submit" class="btn btn-info btn-block rounded-0 mt-3"><i class="fas fa-search"></i> Buscar</button>
                            </div>
                            <div class="col-md-1 mb-3">
                                <button type="button" class="btn btn-danger btn-block rounded-0 mt-3" onclick="limpiar()"><i class="fas fa-undo-alt"></i></button>
                            </div>
                    </div>
                </form>
                <!-- /Orden -->
                
                <div class="row justify-content-center mt-3">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">Inicio</th>
                                    <th scope="col" class="text-center">Término</th>
                                    <th scope="col" class="text-center">Familia</th>
                                    <th scope="col" class="text-center">Equipo</th>
                                    <th scope="col" class="text-center">Trabajo</th>
                                    <th scope="col" class="text-center">Usuario</th>
                                    <th scope="col" class="text-center">Personal</th>
                                    <th scope="col" class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach ($trabajos as $t)
                                {
                            ?>
                                <tr <?php if($t->estatus=='0'){echo 'class="table-danger"';} ?> >
                                    <th class="align-middle" scope="row"><?php echo $t->fecha; ?></th>
                                    <td class="align-middle"><?php echo $t->fecha_t; ?></td>
                                    <td class="align-middle"><?php echo $t->familia; ?></td>
                                    <td class="align-middle"><?php echo $t->equipo; ?></td>
                                    <td class="align-middle"><?php echo $t->descripcion; ?></td>
                                    <td class="align-middle"><?php echo $t->usuario; ?></td>
                                    <td class="align-middle"><?php echo $t->personal; ?></td>
                                    <td class="align-middle">
                                        <a href="<?php echo site_url('Principal/ver_trabajo?t=').$t->id; ?>">
                                            <button type="button" class="btn btn-secondary">Ver más</button>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                                } // cierra el foreach de trabajos
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            
            <script type="text/javascript">
                function limpiar() {
                    document.getElementById("fi").valueAsDate = null;
                    document.getElementById("ft").valueAsDate = null;
                    document.getElementById("fa").selectedIndex = 0;
                }
            </script>