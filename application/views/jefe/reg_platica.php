    <body>

        <!-- BODY -->

            <div class="container my-3">

                <div class="row">
                    <div class="col-md-4 mt-3"> <!-- Formulario para el registro de las platicas -->
                        <div class="row justify-content-center">
                            <h3>Nueva Plática</h3>
                        </div>
                        <form role="form" method="POST" action="<?php echo site_url('Jefe/insert_platica'); ?>">
                            <div class="col-md-12 my-2">
                                <label class="font-weight-bold">Tema</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text rounded-0" id="basic-addon1"><i class="fa fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control rounded-0" name="tema" placeholder="Max. 150 caracteres" maxlength="150" required>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label class="font-weight-bold">Fecha de inicio</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text rounded-0" id="basic-addon1"><i class="fa fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="date" class="form-control rounded-0" name="fecha_inicio" placeholder="Fecha" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="font-weight-bold">Fecha de término</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text rounded-0" id="basic-addon1"><i class="fa fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="date" class="form-control rounded-0" name="fecha_final" placeholder="Fecha" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-warning btn-block rounded-0"><i class="fas fa-pencil-alt"></i> Registrar</button>
                            </div>
                        </form>
                    </div> <!-- / Formulario para el registro de las platicas -->
                    <div class="col-md-8 mt-3"> <!-- Platicas registradas -->
                        <div class="row justify-content-center">
                            <h3>Últimas Pláticas Registradas</h3>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive mt-4">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center align-middle">Tema</th>
                                            <th scope="col" class="text-center align-middle">Fecha de inicio</th>
                                            <th scope="col" class="text-center align-middle">Fecha de término</th>
                                            <th scope="col" class="text-center align-middle" width="5%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        foreach ($platicas as $p)
                                        {
                                    ?>
                                        <tr>
                                            <td class="text-center align-middle"><?php echo $p->tema; ?></td>
                                            <td class="text-center align-middle"><?php echo $p->fecha_inicio; ?></td>
                                            <td class="text-center align-middle"><?php echo $p->fecha_final; ?></td>
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
                        <div class="row justify-content-center">
                            <a href="<?php echo site_url('Jefe/platicas') ?>">
                                <button type="button" class="btn btn-primary rounded-0"><i class="fas fa-plus-square"></i> Ver todas</button>
                            </a>
                        </div>
                    </div> <!-- / Platicas registradas -->
                </div>
            </div>

        <!-- /BODY  -->