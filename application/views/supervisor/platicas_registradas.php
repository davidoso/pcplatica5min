    <body>
        
        <!-- BODY -->
           
            <div class="container my-3">
                
                <div class="row justify-content-center mt-4">
                    <h3>Reuniones registradas</h3>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive mt-4">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">Tema</th>
                                    <th scope="col" class="text-center">Fecha</th>
                                    <th scope="col" class="text-center">Hora</th>
                                    <th scope="col" class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach ($reuniones as $r)
                                {
                            ?>
                                <tr>
                                    <td class="text-center align-middle"><?php echo $r->tema; ?></td>
                                    <td class="text-center align-middle"><?php echo $r->fecha; ?></td>
                                    <td class="text-center align-middle"><?php echo $r->hora; ?></td>
                                    <td class="text-center align-middle">
                                        <a href="<?php echo site_url('Supervisor/load_reunion?r=').$r->id.'&p='.$r->id_platica; ?>">
                                            <button type="button" class="btn btn-info rounded-0"><i class="fas fa-eye"></i> Ver más</button>
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
        