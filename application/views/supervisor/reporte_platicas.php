    <body>

        <!-- BODY -->

            <div class="container my-3">
                <!-- Busqueda -->
                <form role="form" action="" method="post" id="report_form">
                    <div class="row mt-5">
                        <div class="col-md-4">
                            <label class="font-weight-bold">Fecha de inicio</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text rounded-0" id="basic-addon1"><i class="fa fa-search"></i></span>
                                </div>
                                <input type="date" class="form-control rounded-0" name="fi" id="fi" placeholder="Fecha de inicio" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="font-weight-bold">Fecha de término</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text rounded-0" id="basic-addon1"><i class="fa fa-search"></i></span>
                                </div>
                                <input type="date" class="form-control rounded-0" name="ft" id="ft" placeholder="Fecha de término" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="font-weight-bold">Supervisor</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text rounded-0" id="basic-addon1"><i class="fa fa-search"></i></span>
                                </div>
                                <select class="custom-select rounded-0" name="supervisor" id="supervisor">
                                    <option value="-1" selected>[Todos los supervisores]</option>
                                <?php
                                    foreach($supervisores as $sup)
                                    {
                                ?>
                                    <option value="<?php echo $sup->sup_id ?>"><?php echo $sup->sup_nombre; ?></option>
                                <?php
                                    } // foreach de supervisores
                                ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-2 offset-md-8">
                            <button type="button" id="btn_buscar" class="btn btn-warning btn-block rounded-0"><i class="fa fa-fw fa-search"></i> Buscar</button>
                        </div>
                        <div class="col-md-2">
                            <button type="button" id="btn_descargar" class="btn btn-success btn-block rounded-0"><i class="fa fa-fw fa-file-excel"></i> Descargar</button>
                        </div>
                    </div>
                    <div class="row mt-3">
                    <div class="col-md-5" id="myAlertDiv" style="position: fixed; background">
                    </div>
                </div>
                </form>
                <!-- /Busqueda -->

                <div class="row justify-content-center mt-2">
                    <h3 id="report_title" style="display: none;">Participantes registrados</h3>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive mt-4">
                        <table class="table table-striped table-hover" id="report_tbl" style="display: none;">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center align-middle" width="5%">Semana</th>
                                    <th scope="col" class="text-center align-middle" width="10%">Fecha de inicio</th>
                                    <th scope="col" class="text-center align-middle" width="18%">Plática</th>
                                    <th scope="col" class="text-center align-middle" width="17%">Supervisor</th>
                                    <th scope="col" class="text-center align-middle" width="14%">Empresa</th>
                                    <th scope="col" class="text-center align-middle" width="5%">Código</th>
                                    <th scope="col" class="text-center align-middle" width="17%">Empleado</th>
                                    <th scope="col" class="text-center align-middle" width="14%">Puesto</th>
                                </tr>
                            </thead>
                            <tbody id="report_tbody">
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        <!-- /BODY  -->