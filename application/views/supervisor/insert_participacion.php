    <body>

        <!-- BODY -->

            <div class="container my-3">

                <div class="row justify-content-center mx-auto mt-5">
                    <label class="participacion_headline">Empleado:</label>
                </div>
                <div class="row justify-content-center mx-auto mt-1">
                    <label class="font-weight-bold participacion_line"><?php echo $empleado[0]->nombre; ?></label>
                </div>

                <div class="row justify-content-center mx-auto mt-2">
                    <label class="participacion_headline">Puesto:</label>
                </div>
                <div class="row justify-content-center mx-auto mt-1">
                    <label class="font-weight-bold participacion_line"><?php echo $empleado[0]->Descripcion; ?></label>
                </div>

                <div class="row justify-content-center mx-auto mt-3">
                    <p class="text-center">Acepto haber leído y entendido el contenido de la Plática de 5 minutos.</p>
                </div>

                <form role="form" method="post" action="<?php echo site_url('Supervisor/insert_participacion'); ?>">
                    <div class="row justify-content-center mx-auto mt-3">
                        <input type="hidden" name="codigo" value="<?php echo $empleado[0]->codigo; ?>">
                        <input type="hidden" name="nombre" value="<?php echo $empleado[0]->nombre; ?>">
                        <input type="hidden" name="puesto" value="<?php echo $empleado[0]->Descripcion; ?>">
                        <input type="hidden" name="reunion" value="<?php echo $reunion[0]->id; ?>">
                        <input type="hidden" name="metodo" value="Código">
                        <input type="hidden" name="platica" value="<?php echo $this->input->get('p'); ?>">
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-success btn-block rounded-0"><i class="fas fa-check"></i> Acepto</button>
                        </div>
                    </div>
                </form>

            </div>

        <!-- /BODY  -->