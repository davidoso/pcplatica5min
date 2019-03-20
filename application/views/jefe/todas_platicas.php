    <body>

        <!-- BODY -->

            <div class="container my-3">

                <!-- Busqueda -->
                <form role="form" action="<?php echo site_url('Jefe/platicas'); ?>" method="get">
                    <div class="row mt-5">
                        <div class="col-md-10">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text rounded-0" id="basic-addon1"><i class="fa fa-search"></i></span>
                                </div>
                                <input type="text" class="form-control rounded-0" name="t" value="<?php echo $this->input->get('t'); ?>" placeholder="Buscar por tema.." aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-warning btn-block rounded-0"><i class="fa fa-search"></i> Buscar</button>
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
                                    <th scope="col" class="text-center align-middle">Tema</th>
                                    <th scope="col" class="text-center align-middle">Fecha de inicio</th>
                                    <th scope="col" class="text-center align-middle">Fecha de término</th>
                                    <th scope="col" class="text-center align-middle">Estatus</th>
                                    <th scope="col" class="text-center align-middle" width="5%"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach ($platicas as $p)
                                {
                            ?>
                                <tr <?php if($p->estatus=='VENCIDA'){echo 'class="table-danger"';} ?> >
                                    <td class="text-center align-middle"><?php echo $p->tema; ?></td>
                                    <td class="text-center align-middle"><?php echo $p->fecha_inicio; ?></td>
                                    <td class="text-center align-middle"><?php echo $p->fecha_final; ?></td>
                                    <th class="text-center align-middle <?php if($p->estatus=='VIGENTE'){echo 'text-success';}else{echo 'text-danger';} ?> "><?php echo $p->estatus; ?></th>
                                    <td class="text-center align-middle" width="5%">
                                        <a href="<?php echo site_url('Jefe/platica?p=').$p->id; ?>">
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