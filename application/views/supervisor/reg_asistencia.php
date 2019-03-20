    <body>

        <!-- BODY -->

            <div class="container my-3">

                <!-- Botón regresar -->
                <div class="row mx-auto mt-5">
                    <div class="col-md-5">
                        <a href="<?php echo site_url('Supervisor/load_reunion?r=').$this->input->get('r').'&p='.$this->input->get('p'); ?>">
                            <button type="button" class="btn btn-danger rounded-0"><i class="fas fa-undo-alt"></i> Reunión</button>
                        </a>
                    </div>
                </div>
                <!-- / Botón regresar -->

                <form role="form" method="get" action="<?php echo site_url('Supervisor/reg_participacion_tarjeta'); ?>">
                    <div class="row justify-content-center mx-auto mt-3">
                        <div class="col-md-12">
                            <label class="font-weight-bold">Código</label>
                            <div class="input-group">
                                <input type="number" class="form-control rounded-0" name="c" placeholder="Pase la tarjeta por el escáner" required autofocus>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="r" value="<?php echo  $this->input->get('r'); ?>">
                    <input type="hidden" name="p" value="<?php echo  $this->input->get('p'); ?>">
                    <div class="row justify-content-center mx-auto mt-3">
                        <div class="col-md-5">
                            <button type="submit" class="btn btn-warning btn-block rounded-0"><i class="fas fa-pencil-alt"></i> Registrar</button>
                        </div>
                    </div>
                </form>

                <form role="form" method="get" action="<?php echo site_url('Supervisor/reg_participacion_codigo'); ?>">
                    <div class="row justify-content-center mx-auto mt-5">
                        <a href="#codigo_empleado" data-toggle="collapse">
                            <h6>Registrar mediante el código del empleado</h6>
                        </a>
                    </div>
                    <div id="codigo_empleado" class="collapse">
                        <div class="row justify-content-center mx-auto mt-2">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="number" class="form-control rounded-0" name="ce" placeholder="Escriba el código de empleado" required autofocus>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="r" value="<?php echo  $this->input->get('r'); ?>">
                        <input type="hidden" name="p" value="<?php echo  $this->input->get('p'); ?>">
                        <div class="row justify-content-center mx-auto mt-3">
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-info btn-block rounded-0"><i class="fas fa-pencil-alt"></i> Registrar</button>
                            </div>
                        </div>
                    </div>
                </form>

                 <!-- Participación -->

                <div class="row justify-content-center mx-auto mt-5">
                    <h4>Evidencia de participación</h4>
                </div>

                <div class="row justify-content-center mx-auto mt-1">
                    <div class="col-md-12">
                        <div class="table-responsive mt-2">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <!--<th scope="col" class="text-center">Código</th>-->
                                        <th scope="col" class="text-center">Nombre</th>
                                        <!--<th scope="col" class="text-center">Puesto</th>-->
                                        <!--<th scope="col" class="text-center">Supervisor</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    foreach ($participaciones as $p)
                                    {
                                ?>
                                    <tr>
                                        <td class="text-center align-middle"><?php echo $p->empleado; ?></td>
                                        <!--<td class="text-center align-middle"><?php //echo $p->puesto; ?></td>-->
                                        <!--<td class="text-center align-middle"><?php //echo $reunion[0]->supervisor; ?></td>-->
                                    </tr>
                                <?php
                                    } // cierra foreach de participaciones
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        <!-- /BODY  -->