<!-- Vista para pantalla de login -->
<div class="row">
    <div class="col-md-12">
        <h2 align="Center">Plan de mejoramiento - Etapa de observaciones - Previo para presentar al auditado</h2>
        <hr>
    </div>
</div>

<!-- Mancheta -->
<div class="row">

    <div class="col-md-12">

        <table class="table table-bordered">
            <tr>
                <td style="width:20%"><b>PROCESO</b></td>
                <td style="width:60%">Control y evaluación</td>
                <td rowspan="4" style="width:20%">
                    <center>
                        <picture><img src="assets/img/logo_idm.png" class="img-fluid" width="100%"></picture>
                    </center>
                </td>
            </tr>
            <tr>
                <td><b>DOCUMENTO</b></td>
                <td>Plan de Mejoramiento</td>
            </tr>
            <tr>
                <td><b>FECHA</b></td>
                <td>01/09/2018</td>
            </tr>
            <tr>
                <td><b>VERSION</b></td>
                <td>1.0</td>
            </tr>

        </table>
    </div>

</div>

<!-- Encabezado -->
<div class="row">
    <div class="col-md-12">

        <form method="post" action="?c=Planes&a=Index&token=<?php echo @$_GET['token']; ?>">
            <div class="form-group">
                <input readonly type="hidden" name="id" value="<?php echo $plan->id; ?>" />

                <table class="table table-bordered">
                    <tr>
                        <td style="width:30%"><b>Proceso auditado</b></td>
                        <td>
                            <select readonly class="form-control form-control-lg" style="font-size: 12pt;" name="proceso" placeholder="" required autocomplete="off" />
                            <option value="<?php echo $plan->proceso; ?>" selected><?php echo $plan->proceso; ?></option>
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
                        </td>
                    </tr>

                    <tr>
                        <td style="width:30%"><b>Origen del plan de mejoramiento</b></td>
                        <td>
                            <select readonly class="form-control form-control-lg" style="font-size: 12pt;" name="origen" placeholder="" required autocomplete="off" />
                            <option value="<?php echo $plan->origen; ?>" selected><?php echo $plan->origen; ?></option>
                            <option value="Control interno">Control interno</option>
                            <option value="Auditoria interna de calidad">Auditoria interna de calidad</option>
                            <option value="Auditoria externa de contraloria">Auditoria externa de contraloria</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="width:30%"><b>Fecha de suscripción ( Pendiente de presentar )</b></td>
                        <td>
                            <input readonly type="date" class="form-control form-control-lg" style="font-size: 12pt;" name="fecha" placeholder="" required value="<?php echo $plan->fecha; ?>" autocomplete="off" />
                        </td>
                    </tr>

                </table>
            </div>
        </form>
    </div>

</div>

<!-- Novedades vinculadas -->
<div class="row">

    <div class="col-md-12">
        <!-- <h3 align="Center"><b>Listado de novedades vinculadas ( <?php echo count($listadoObservaciones); ?> )</b></h3><br> -->

        <table class="table table-bordered">
            <tr>
                <td bgcolor="#81D9EA"><b>N°</b></td>
                <td bgcolor="#81D9EA"><b>HALLAZGO / NC / OBSERVACIÓN</b></td>
                <td bgcolor="#F4D9BF"><b>REACCION</b></td>
                <td bgcolor="#F4D9BF"><b>CAUSA</b></td>
                <td bgcolor="#F4D9BF"><b>NC SIMILARES O POTENCIALES</b></td>
                <td bgcolor="#F4D9BF"><b>ACCIÓN DE MEJORAMIENTO</b></td>
                <td bgcolor="#F4D9BF"><b>PLAZO</b></td>
                <td bgcolor="#F4D9BF"><b>RESPONSABLE</b></td>
            </tr>

            <tbody>
                
                <?php foreach ($listadoObservaciones as $r) { ?>
                    <tr>
                        <td><?php echo $r->id; ?></td>
                        <td><?php echo $r->descripcion; ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>

</div>

<hr>