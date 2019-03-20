    <body>

        <!-- BODY -->

            <div class="container my-3">

                <div class="row">
                    <div class="col-md-4 mt-3"> <!-- Formulario para el registro de las platicas -->
                        <div class="row justify-content-center">
                            <h3>Nuevo Usuario</h3>
                        </div>
                        <form role="form" method="POST" action="<?php echo site_url('Jefe/insert_usuario'); ?>">
                            <div class="col-md-12 my-2">
                                <label class="font-weight-bold">Clave de usuario</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text rounded-0" id="basic-addon1"><i class="fa fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control rounded-0" name="usuario" placeholder="Ejemplo: jjimenez" maxlength="20" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-warning btn-block rounded-0"><i class="fas fa-pencil-alt"></i> Registrar</button>
                            </div>
                        </form>
                    </div> <!-- / Formulario para el registro de las platicas -->
                    <div class="col-md-8 mt-3"> <!-- Platicas registradas -->
                        <div class="row justify-content-center">
                            <h3>Usuarios Registrados</h3>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive mt-4">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">Clave</th>
                                            <th scope="col" class="text-center">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        foreach ($usuarios as $u)
                                        {
                                    ?>
                                        <tr <?php if($u->erased!=0){echo 'class="table-danger"';} ?> >
                                            <td class="text-center align-middle"><?php echo $u->codigo; ?></td>
                                            <td class="text-center align-middle">
                                                <?php
                                                    if ($u->erased!=0)
                                                    {
                                                ?>
                                                <a href="<?php echo site_url('Jefe/delete_usuario?u=').$u->id.'&e=0'; ?>">
                                                    <h5>Activar</h5>
                                                </a>
                                                <?php
                                                    } // cierra if
                                                    else
                                                    {
                                                ?>
                                                <a href="<?php echo site_url('Jefe/delete_usuario?u=').$u->id.'&e=1'; ?>">
                                                    <button type="button" class="btn btn-danger rounded-0"><i class="fas fa-trash-alt"></i></button>
                                                </a>
                                                <?php
                                                    } // cierra else
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                        } // cierra foreach platicas
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- / Platicas registradas -->
                </div>
            </div>

        <!-- /BODY  -->