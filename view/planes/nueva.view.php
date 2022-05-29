<!-- Vista para pantalla de login -->
<div class="row">
    <div class="col-sm-12">
        <h2 align="Center">Nuevo plan de mejoramiento</h2>
    </div>
</div>

<div class="row">
    <div class="col-sm-3">
        <center>
            <picture><img src="/assets/img/logo_idm.png" class="img-fluid" width="100%"></picture>
        </center>
    </div>

    <div class="col-sm-9">

        <form method="post" action="?c=Planes&a=guardarPlan&token=<?php echo @$_GET['token']; ?>">
            <div class="form-group">
                <input type="date" class="form-control form-control-lg" style="font-size: 16pt;" name="fecha" placeholder="" required autocomplete="off" />
                <small id="emailHelp" class="form-text text-muted">Fecha de realizacion</small><br><br>

                <select class="form-control form-control-lg" style="font-size: 12pt;" name="proceso" placeholder="" required autocomplete="off" />
                <option value="Direccionamiento y planeación">Direccionamiento y planeación</option>
                <option value="Gestión del talento humano">Gestión del talento humano</option>
                <option value="Vivienda y urbanismo">Vivienda y urbanismo</option>
                <option value="Obras de interes público">Obras de interes publico</option>
                <option value="Gestión de tecnologías de la información">Gestión de tecnologías de la información</option>
                <option value="Gestión documental y de recursos fisicos">Gestión documental y de recursos fisicos</option>
                <option value="Gestión financiera">Gestión financiera</option>
                <option value="Gestión juridica">Gestión juridica</option>
                <option value="Control y evaluación">Control y evaluación</option>
                </select>
                <small id="emailHelp" class="form-text text-muted">Proceso auditado</small><br><br>

                <select class="form-control form-control-lg" style="font-size: 12pt;" name="origen" placeholder="" required autocomplete="off" />
                <option value="Auditoria de control interno">Auditoria de control interno</option>
                <option value="Auditoria interna de calidad">Auditoria interna de calidad</option>
                <option value="Auditoria externa de controlaria municipal">Auditoria externa de controlaria municipal</option>
                <option value="Auditoria externa de contraloria general de la republica">Auditoria externa de contraloria general de la republica</option>
                <option value="Auditoria externa de la procuraduria">Auditoria externa de la procuraduria</option>
                </select>
                <small id="emailHelp" class="form-text text-muted">Origen del plan a suscribir</small><br><br>

                <br>
            </div>
            <br>
            <button type="submit" class="btn btn-success btn-lg" name="go" class="btn btn-lg btn-default btn-block">Generar borrador plan de mejoramiento</button>
        </form>

    </div>

</div>

<hr>