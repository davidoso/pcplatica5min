    <body>

        <!-- BODY -->

            <div class="container my-3">

                <div class="row justify-content-center mt-4">
                    <h3>Pláticas disponibles</h3>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive mt-4">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center align-middle">Tema</th>
                                    <th scope="col" class="text-center align-middle">Fecha de término</th>
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
                                    <td class="text-center align-middle"><?php echo $p->fecha_final; ?></td>
                                    <td class="text-center align-middle" width="5%">
                                        <a href="<?php echo site_url('Supervisor/registrar_reunion?p=').$p->id; ?>">
                                            <button type="button" class="btn btn-warning rounded-0"><i class="fas fa-sign-in-alt"></i> Registrar</button>
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