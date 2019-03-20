    <body>

        <!-- BODY -->

            <div class="container my-3">

                <div class="row justify-content-center mx-auto mt-5">
                    <h4 class="text-muted">Tema</h4>
                </div>

                <div class="row justify-content-center mx-auto">
                    <h2><?php echo $platica[0]->tema; ?></h2>
                </div>

                <form role="form" method="POST" action="<?php echo site_url('Supervisor/insert_reunion'); ?>">
                    <div class="row justify-content-center mt-3">
                        <div class="col-lg-6">
                            <label class="font-weight-bold">Fecha</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0" id="basic-addon1"><i class="fa fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" class="form-control rounded-0" name="fecha" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <div class="col-lg-6">
                            <label class="font-weight-bold">Hora</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0" id="basic-addon1"><i class="far fa-clock"></i></span>
                                </div>
                                <input type="time" class="form-control rounded-0" name="hora" value="<?php echo date('H:i:00'); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <div class="col-lg-6">
                            <label class="font-weight-bold">Semana</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0" id="basic-addon1"><i class="far fa-clock"></i></span>
                                </div>
                                <input type="number" class="form-control rounded-0" name="semana" value="<?php echo date('W'); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <div class="col-lg-6">
                            <label class="font-weight-bold">Empresa</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0" id="basic-addon1"><i class="far fa-clock"></i></span>
                                </div>
                                <select class="form-control rounded-0" name="empresa">
                                    <option value="Peña Colorada">Peña Colorada</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="platica" value="<?php echo $this->input->get('p'); ?>">
                    <div class="row justify-content-center my-5">
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-warning btn-block rounded-0"><i class="fas fa-sign-in-alt"></i> Continuar</button>
                        </div>
                    </div>
                </form>

            </div>

        <!-- /BODY  -->