    <body>
        
        <!-- BODY -->
           
            <div class="container my-3">
            
               <!-- Botón regresar -->
                <div class="row mx-auto mt-5">
                    <div class="col-md-5">
                        <a href="<?php echo site_url('Supervisor/load_reunion?r=').$this->input->get('r').'&p='.$this->input->get('p'); ?>">
                            <button type="button" class="btn btn-danger rounded-0"><i class="fas fa-undo-alt"></i> Reunión</button>
                        </a>
                    </div>
                </div>
                <!-- / Botón regresar -->
                
            <?php
                foreach ($contenido as $c)
                {
            ?>
                <div class="row justify-content-center mx-auto mt-5">
                    <h2><?php echo $c->nombre; ?></h2>
                </div>
            <?php
                    switch ($c->tipo)
                    {
                        //https://drive.google.com/viewerng/viewer?embedded=true&url=http://example.com/the.pdf
                        case 'Documento':
            ?>
                <div class="row justify-content-center mt-3">
                    <div class="col-md-12">
                        <div class="embed-responsive embed-responsive-1by1">
                            <iframe class="embed-responsive-item" src="<?php echo base_url($c->ruta); ?>" allowfullscreen></iframe>
                            <!--<iframe class="embed-responsive-item" src="<?php //echo 'https://drive.google.com/viewerng/viewer?embedded=true&url='.base_url($c->ruta); ?>" allowfullscreen></iframe>-->
                        </div>
                    </div>
                </div>
            <?php
                            break; // documento
                        case 'Vídeo':
            ?>
                <div class="row justify-content-center mt-3">
                    <div class="col-md-12">
                        <div class="embed-responsive embed-responsive-16by9">
                            <video class="embed-responsive-item" src="<?php echo base_url($c->ruta); ?>" allowfullscreen controls />
                        </div>
                    </div>
                </div>
            <?php
                            break; // video
                        case 'Imagen':
            ?>
                <div class="row justify-content-center mt-3">
                    <div class="col-md-12">
                        <div class="embed-responsive embed-responsive-1by1">
                            <image class="embed-responsive-item" src="<?php echo base_url($c->ruta); ?>" allowfullscreen controls />
                        </div>
                    </div>
                </div>
            <?php
                            break; // imagen
                    } // cierra switch de tipo
                } // cierra foreach contenido
            ?>
                
                <div class="row justify-content-center my-5">
                    <div class="col-md-3">
                        <a href="<?php echo site_url('Supervisor/load_reunion?r=').$this->input->get('r').'&p='.$this->input->get('p'); ?>">
                            <button type="button" class="btn btn-warning btn-block rounded-0"><i class="fas fa-sign-in-alt"></i> Continuar</button>
                        </a>
                    </div>
                </div>
            
            </div>
        
        <!-- /BODY  -->