    <body>
        
        <!-- BODY -->
           
            <div class="container my-3">
                
                <!-- Busqueda -->
                <form role="form" action="<?php echo site_url('Supervisor/buscar_platicas'); ?>" method="get">
                    <div class="row mt-5">
                        <div class="col-md-10">
                            <label class="font-weight-bold">Tema</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text rounded-0" id="basic-addon1"><i class="fa fa-search"></i></span>
                                </div>
                                <select class="custom-select rounded-0" name="fa" id="familia">
                                    <option value="" selected disabled>Todos</option>
                                <?php
                                    //$fam_equipos=$this->session->userdata('fam_equipos');
                                    foreach($platicas as $p)
                                    {
                                ?>
                                    <option value="<?php echo $p->id ?>"><?php echo $p->tema; ?></option>
                                <?php
                                    } // foreach de familias
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 mt-1">
                            <label class="font-weight-bold"></label>
                            <button type="submit" class="btn btn-warning btn-block rounded-0"><i class="fa fa-search"></i> Buscar</button>
                        </div> 
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label class="font-weight-bold">Fecha de inicio</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text rounded-0" id="basic-addon1"><i class="fa fa-search"></i></span>
                                </div>
                                <input type="date" class="form-control rounded-0" name="fi" value="<?php echo $this->input->get('t'); ?>" placeholder="Buscar por tema" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="font-weight-bold">Fecha de termino</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text rounded-0" id="basic-addon1"><i class="fa fa-search"></i></span>
                                </div>
                                <input type="date" class="form-control rounded-0" name="ft" value="<?php echo $this->input->get('t'); ?>" placeholder="Buscar por tema" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="font-weight-bold">Supervisor</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text rounded-0" id="basic-addon1"><i class="fa fa-search"></i></span>
                                </div>
                                <input type="text" class="form-control rounded-0" name="s" value="<?php echo $this->input->get('t'); ?>" placeholder="Ej. gcuevas" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                </form>
                <!-- /Busqueda -->
                
                <div class="row justify-content-center mt-4">
                    <h3>Pláticas registradas</h3>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive mt-4">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">Semana</th>
                                    <th scope="col" class="text-center">Tema</th>
                                    <th scope="col" class="text-center">Fecha</th>
                                    <th scope="col" class="text-center">Hora</th>
                                    <th scope="col" class="text-center">Supervisor</th>
                                    <th scope="col" class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach ($resultados as $r)
                                {
                            ?>
                                <tr <?php if($p->estatus=='VENCIDA'){echo 'class="table-danger"';} ?> >
                                    <td class="text-center align-middle"><?php echo $r->semana; ?></td>
                                    <td class="text-center align-middle"><?php echo $r->tema; ?></td>
                                    <td class="text-center align-middle"><?php echo $r->fecha; ?></td>
                                    <td class="text-center align-middle"><?php echo $r->hora; ?></td>
                                    <th class="text-center align-middle"><?php echo $r->nombre_supervisor; ?></th>
                                    <td class="text-center align-middle">
                                        <a href="<?php echo site_url('Supervisor/load_reunion?r=').$r->id_reunion.'&p='.$r->id_platica; ?>">
                                            <button type="button" class="btn btn-info rounded-0"><i class="fas fa-info-circle"></i> Ver más</button>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                                } // cierra foreach platicas
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            
        <!-- /BODY  -->
        