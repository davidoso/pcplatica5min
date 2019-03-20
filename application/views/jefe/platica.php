    <body>

        <!-- BODY -->

            <div class="container my-3">

                <div class="row justify-content-center mt-5">
                    <h3>Plática de cinco minutos</h3>
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
                                    <tr>
                                        <td class="text-center align-middle"><?php echo $platica[0]->tema; ?></td>
                                        <td class="text-center align-middle"><?php echo $platica[0]->fecha_inicio; ?></td>
                                        <td class="text-center align-middle"><?php echo $platica[0]->fecha_final; ?></td>
                                        <th class="text-center align-middle <?php if($platica[0]->estatus=='VIGENTE'){echo 'text-success';}else{echo 'text-danger';} ?> "><?php echo $platica[0]->estatus; ?></th>
                                        <td class="text-center align-middle" width="5%">
                                            <button type="button" class="btn btn-warning rounded-0" data-toggle="modal" data-target="#editar_platica"><i class="fas fa-edit"></i> Editar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row mt-5 justify-content-center">
                    <h3>Contenido</h3>
                    <div class="col-md-12">
                        <div class="table-responsive mt-4">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center align-middle">Nombre</th>
                                        <th scope="col" class="text-center align-middle">Tipo</th>
                                        <th scope="col" class="text-center align-middle">Formato</th>
                                        <th scope="col" class="text-center align-middle" width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    foreach ($contenido as $c)
                                    {
                                ?>
                                    <tr <?php if($c->erased!=0){echo 'class="table-danger"';} ?> >
                                        <td class="text-center align-middle">
                                            <a href="<?php echo base_url($c->ruta); ?>" target="_blank">
                                                <?php echo $c->nombre; ?>
                                            </a>
                                        </td>
                                        <td class="text-center align-middle"><?php echo $c->tipo; ?></td>
                                        <td class="text-center align-middle"><?php echo $c->formato; ?></td>
                                        <td class="text-center align-middle" width="5%">
                                        <?php
                                            if($c->erased!=0)
                                            {
                                        ?>
                                            <i class="fas fa-trash-alt"></i> Este elemento fue eliminado. <a href="<?php echo site_url('Jefe/undelete_contenido?c=').$c->id.'&p='.$c->id_platica; ?>">Deshacer</a>
                                        <?php
                                            } // cierra if de botón de eliminar
                                            else
                                            {
                                        ?>
                                            <button type="button" class="btn btn-warning rounded-0" data-toggle="modal" data-target="<?php echo '#editar_contenido'.$c->id ?>"><i class="fas fa-edit"></i> Editar</button>
                                        <?php
                                            } // cierra else de botón eliminar
                                        ?>
                                        </td>
                                    </tr>

                                    <!-- Modal "editar contenido" -->
                                    <form role="form" method="POST" action="<?php echo site_url('Jefe/update_contenido'); ?>">
                                        <div class="modal fade" id="<?php echo 'editar_contenido'.$c->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Editar contenido</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                         <div class="col-md-12 mb-3">
                                                            <label class="font-weight-bold">Tipo de archivo</label>
                                                            <div class="input-group">
                                                                <select class="custom-select rounded-0" name="tipo_contenido" required>
                                                                    <option value="" selected disabled></option>
                                                                <?php
                                                                    //$fam_equipos=$this->session->userdata('fam_equipos');
                                                                    $aux='';
                                                                    foreach($tipo_contenido as $tc)
                                                                    {
                                                                        if ($tc->tipo!=$aux)
                                                                        {
                                                                            $aux=$tc->tipo;
                                                                ?>
                                                                    <option disabled><?php echo '-- '.$tc->tipo.' --'; ?></option>
                                                                <?php
                                                                        } // cierra if para hacer el cambio de tipo
                                                                ?>
                                                                    <option value="<?php echo $tc->id; ?>" <?php if($c->id_tipo_contenido==$tc->id){echo 'selected';} ?> ><?php echo $tc->formato; ?></option>
                                                                <?php
                                                                    } // foreach de tipo_contenido
                                                                ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label class="font-weight-bold">Nombre del contenido</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control rounded-0" name="nombre_contenido" placeholder="Max. 100 caracteres" maxlength="100" value="<?php echo $c->nombre; ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1" name="eliminar">
                                                                <label class="form-check-label" for="exampleCheck1">Eliminar contenido</label>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="contenido" value="<?php echo $c->id; ?>">
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
                                    <!-- /Modal "editar contenido" -->

                                    <?php
                                        } // cierra foreach contenido
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-primary btn-block rounded-0" data-toggle="modal" data-target="#new_contenido"><i class="fas fa-plus-square"></i> Añadir contenido</button>
                    </div>
                </div>

            </div>

            <!-- Modal "editar plática" -->
            <form role="form" method="POST" action="<?php echo site_url('Jefe/update_platica'); ?>">
                <div class="modal fade" id="editar_platica" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-warning">
                                <h5 class="modal-title" id="exampleModalLongTitle">Editar plática</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-12 mb-3">
                                    <label class="font-weight-bold">Tema</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text rounded-0" id="basic-addon1"><i class="fa fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control rounded-0" name="tema" placeholder="Max. 150 caracteres" maxlength="150" value="<?php echo $platica[0]->tema; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="font-weight-bold">Fecha de inicio</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text rounded-0" id="basic-addon1"><i class="fa fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" class="form-control rounded-0" name="fecha_inicio" placeholder="Fecha" value="<?php echo $platica[0]->u_fi; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="font-weight-bold">Fecha de término</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text rounded-0" id="basic-addon1"><i class="fa fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" class="form-control rounded-0" name="fecha_final" placeholder="Fecha" value="<?php echo $platica[0]->u_ff; ?>" required>
                                    </div>
                                </div>
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

            <!-- Modal "añadir contenido" -->
            <!--<form role="form" method="POST" action="<?php //echo site_url('Jefe/insert_contenido'); ?>">-->
            <?php echo form_open_multipart('Jefe/insert_contenido'); ?>
                <div class="modal fade" id="new_contenido" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="exampleModalLongTitle">Añadir contenido</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                 <div class="col-md-12 mb-3">
                                    <label class="font-weight-bold">Tipo de archivo</label>
                                    <div class="input-group">
                                        <select class="custom-select rounded-0" name="tipo_contenido" required>
                                            <option value="" selected disabled></option>
                                        <?php
                                            //$fam_equipos=$this->session->userdata('fam_equipos');
                                            $aux='';
                                            foreach($tipo_contenido as $tc)
                                            {
                                                if ($tc->tipo!=$aux)
                                                {
                                                    $aux=$tc->tipo;
                                        ?>
                                            <option disabled><?php echo '-- '.$tc->tipo.' --'; ?></option>
                                        <?php
                                                } // cierra if para hacer el cambio de tipo
                                        ?>
                                            <option value="<?php echo $tc->id; ?>"><?php echo $tc->formato; ?></option>
                                        <?php
                                            } // foreach de tipo_contenido
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="font-weight-bold">Nombre del contenido</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control rounded-0" name="nombre_contenido" placeholder="Max. 100 caracteres" maxlength="100" required>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="font-weight-bold">Archivo</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control-file" name="userfile">
                                    </div>
                                </div>
                                <input type="hidden" name="platica" value="<?php echo $platica[0]->id; ?>">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                                <button type="submit" class="btn btn-primary rounded-0"><i class="fas fa-check"></i> Aceptar</button>
                            </div>
                        </div>
                    </div>
                </div>
            <!--</form>-->
            <?php echo form_close(); ?>
            <!-- /Modal "añadir contenido" -->

        <!-- /BODY  -->