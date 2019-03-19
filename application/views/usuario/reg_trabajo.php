    <body>
        
        <!-- BODY -->
            <div class="container">
                            
                <div class="row justify-content-center my-4">
                    <div class="col-md-12">
                        <h2>Registrar nuevo trabajo</h2>
                    </div>
                </div>
                
                <form role="form" method="POST" action="<?php echo site_url('Principal/insert_trabajo'); ?>">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">Familia</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0" id="basic-addon1"><i class="fa fa-users"></i></span>
                                </div>
                                <select class="custom-select rounded-0" id="familia" name="familia" onchange="cambiar_equipos()" required>
                                    <option selected disabled></option>
                                <?php
                                    foreach($familias as $f)
                                    {
                                ?>
                                    <option value="<?php echo $f->FAMILIA; ?>" <?php if ($f->FAMILIA==$this->input->get('f')){echo 'selected';} ?> ><?php echo $f->FAMILIA; ?></option>
                                <?php
                                    }
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">Equipo</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0" id="basic-addon1"><i class="fas fa-sitemap"></i></span>
                                </div>
                                <select class="custom-select rounded-0" id="equipo" name="equipo" required>
                                    <option selected disabled></option>
                                <?php
                                    if (isset($equipos))
                                    {
                                        foreach($equipos as $e)
                                        {
                                    
                                ?>
                                    <option value="<?php echo $e->EQUIPO; ?>"><?php echo $e->EQUIPO; ?></option>
                                <?php
                                        } // cierra foreach
                                    } // cierra if que valida si estan asignados los equipos
                                ?>
                                </select>
                            </div>
                        </div>
                        <!--<div class="col-md-4 mb-3">
                            <label class="font-weight-bold">Tipo</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0" id="basic-addon1"><i class="fas fa-sitemap"></i></span>
                                </div>
                                <select class="custom-select rounded-0" id="tipo" name="tipo">
                                    <option selected disabled>-</option>
                                    <option value="ELÉCTRICO">Eléctrico</option>
                                    <option value="MECÁNICO">Mecánico</option>
                                </select>
                            </div>
                        </div>-->
                        <!--<div class="col-md-4 mb-3">
                            <label class="font-weight-bold">Supervisor</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0" id="basic-addon1"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control rounded-0" name="usuario" placeholder="Clave" aria-describedby="basic-addon1">
                            </div>
                        </div>-->    
                    </div>
                        
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label class="font-weight-bold">Fecha de inicio</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0" id="basic-addon1"><i class="fa fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" class="form-control rounded-0" name="fecha_inicio" placeholder="Fecha" aria-describedby="basic-addon1" required>
                            </div>
                        </div>
                        <div class="col-md-5 mb-3">
                            <label class="font-weight-bold">Hora de inicio</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0" id="basic-addon1"><i class="far fa-clock"></i></span>
                                </div>
                                <input type="time" class="form-control rounded-0" name="hora_inicio" placeholder="" aria-describedby="basic-addon1" required>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="font-weight-bold">Turno</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0" id="basic-addon1"><i class="fa fa-clock"></i></span>
                                </div>
                                <select class="custom-select rounded-0" id="turno" name="turno" required>
                                    <option selected disabled></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="font-weight-bold">Descripción</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0" id="basic-addon1"><i class="fa fa-edit"></i></span>
                                </div>
                                <textarea class="form-control rounded-0" name="descripcion" placeholder="Escriba una descripción" aria-describedby="basic-addon1" rows="8" required></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">Fecha de termino</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0" id="basic-addon1"><i class="fa fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" class="form-control rounded-0" name="fecha_termino" placeholder="Fecha" aria-describedby="basic-addon1" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold">Hora de termino</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0" id="basic-addon1"><i class="far fa-clock"></i></span>
                                </div>
                                <input type="time" class="form-control rounded-0" name="hora_termino" placeholder="" aria-describedby="basic-addon1" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="font-weight-bold">Pendiente(s)</label>
                            <div class="input-group">
                                <!--<div class="input-group-prepend">
                                    <span class="input-group-text rounded-0" id="basic-addon1"><i class="fa fa-pause"></i></span>
                                </div>-->
                                <textarea class="form-control rounded-0" name="pendientes" placeholder="Si no hay pendientes, deje el campo vacio." aria-describedby="basic-addon1" rows="4"></textarea>
                            </div>
                        </div>
                       <div class="col-md-4 mb-3">
                            <label class="font-weight-bold">Personal que realizó el trabajo</label>
                            <div class="input-group">
                                <!--<div class="input-group-prepend">
                                    <span class="input-group-text rounded-0" id="basic-addon1"><i class="fa fa-pause"></i></span>
                                </div>-->
                                <textarea class="form-control rounded-0" name="personal" placeholder="Ej. Juan / Guillermo / Daniel" aria-describedby="basic-addon1" rows="4" required></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row justify-content-center">
                        <div class="col-md-3 mb-3">
                            <button type="submit" class="btn btn-danger btn-block rounded-0"><i class="fa fa-sign-in-alt"></i> Registrar</button>
                        </div>
                    </div>
                </form>
            </div>
            
            <script type="text/javascript">
                function cambiar_equipos()
                {
                    familia=document.getElementById("familia").value;
                    window.location.href="<?php echo site_url('Principal/registrar_trabajo?f='); ?>"+familia;
                }
            </script>
            
            
        <!-- /BODY  -->
        
       
                          <!--<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <h5 class="card-header">Featured</h5>
                                            <div class="card-body">
                                                <h5 class="card-title">Special title treatment</h5>
                                                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                                <a href="#" class="btn btn-primary">Go somewhere</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>-->