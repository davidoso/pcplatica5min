    <body>
        
        <!-- BODY -->
           
            <div class="container my-3">
                
                <!-- Botón regresar -->
                <div class="row mx-auto mt-5">
                    <div class="col-md-8">
                        <a href="<?php echo site_url('Supervisor/platicas_registradas'); ?>">
                            <button type="button" class="btn btn-danger rounded-0"><i class="fas fa-undo-alt"></i> Reuniones Registradas</button>
                        </a>
                    </div>
                </div>
                <!-- / Botón regresar -->
                
                <div class="row justify-content-center mx-auto mt-3">
                    <h3>Tema: <?php echo $platica[0]->tema; ?></h3>
                    <div class="col-md-12">
                        <div class="table-responsive mt-4">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">Fecha</th>
                                        <th scope="col" class="text-center">Hora</th>
                                        <th scope="col" class="text-center">Semana</th>
                                        <th scope="col" class="text-center">Empresa</th>
                                        <!--<th scope="col" class="text-center">Supervisor</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center align-middle"><?php echo $reunion[0]->fecha; ?></td>
                                        <td class="text-center align-middle"><?php echo $reunion[0]->hora; ?></td>
                                        <td class="text-center align-middle"><?php echo $reunion[0]->semana; ?></td>
                                        <td class="text-center align-middle"><?php echo $reunion[0]->empresa; ?></td>
                                        <!--<td class="text-center align-middle"><?php //echo $reunion[0]->supervisor; ?></td>-->
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mx-auto mt-2">
                    <div class="col-md-5">
                        <button type="button" class="btn btn-warning btn-block rounded-0" data-toggle="modal" data-target="#editar_reunion"><i class="fas fa-edit"></i> Editar</button>
                    </div>
                </div>
                
                <!-- Contenido -->
                
                <div class="row justify-content-center mx-auto mt-5">
                    <h2>Contenido</h2>
                </div>
                    <?php
                        foreach ($contenido as $c)
                        {
                    ?>
                <div class="row justify-content-center mx-auto mt-2">
                    <h6><?php echo $c->nombre; ?></h6>
                </div>
                    <?php
                        } // cierra foreach contenido
                    ?>
                <div class="row justify-content-center mx-auto mt-2">
                    <div class="col-md-5">
                        <a href="<?php echo site_url('Supervisor/load_contenido?p='.$this->input->get('p').'&r='.$this->input->get('r')); ?>">
                            <button type="button" class="btn btn-info btn-block rounded-0"><i class="fas fa-eye"></i> Ver contenido</button>
                        </a>
                    </div>
                </div>
                
                <!-- Participación -->
                
                <div class="row justify-content-center mx-auto mt-5">
                    <h2>Evidencia de participación</h2>
                </div>
                
                <div class="row justify-content-center mx-auto mt-2">
                    <div class="col-md-12">
                        <div class="table-responsive mt-4">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <!--<th scope="col" class="text-center">Código</th>-->
                                        <th scope="col" class="text-center">Nombre</th>
                                        <th scope="col" class="text-center">Puesto</th>
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
                                        <td class="text-center align-middle"><?php echo $p->puesto; ?></td>
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
                
                <div class="row justify-content-center mx-auto mt-2">
                    <div class="col-md-5">
                        <a href="<?php echo site_url('Supervisor/reg_participacion?r=').$this->input->get('r').'&p='.$this->input->get('p'); ?>">
                            <button type="button" class="btn btn-danger btn-block rounded-0"><i class="far fa-check-square"></i> Registrar participación</button>
                        </a>
                    </div>
                </div>
            
            <!-- Modal "editar plática" -->
            <form role="form" method="POST" action="<?php echo site_url('Supervisor/update_reunion'); ?>">
                <div class="modal fade" id="editar_reunion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-warning">
                                <h5 class="modal-title" id="exampleModalLongTitle">Editar Reunión</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-12 mb-3">
                                    <label class="font-weight-bold">Fecha</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control rounded-0" name="fecha" placeholder="Fecha" value="<?php echo $reunion[0]->u_fecha; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="font-weight-bold">Hora</label>
                                    <div class="input-group">
                                        <input type="time" class="form-control rounded-0" name="hora" placeholder="Hora" value="<?php echo $reunion[0]->u_hora; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="font-weight-bold">Semana</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control rounded-0" name="semana" placeholder="Semana" value="<?php echo $reunion[0]->semana; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="font-weight-bold">Empresa</label>
                                    <div class="input-group">
                                        <select class="form-control rounded-0" name="empresa">
                                            <option value="Peña Colorada" selected>Peña Colorada</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="reunion" value="<?php echo $reunion[0]->id; ?>">
                                <input type="hidden" name="platica" value="<?php echo $platica[0]->id; ?>">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                                <button type="submit" class="btn btn-warning rounded-0"><i class="fas fa-check"></i> Aceptar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /Modal "editar plática" -->
            
        <!-- /BODY  -->
        
        <script type="text/javascript">
            //window.onbeforeunload = function() { return "Your work will be lost."; };
        </script>