<!-- Vista para pantalla de login -->
<div class="row">
    <div class="col-sm-12">
        <h2 align="Center">Planes de mejoramiento almacenados</h2>
    </div>
</div>

<div class="row">

    <div class="col-sm-12">

        <br><br>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Proceso</th>
                    <th>Origen</th>
                    <th>Fecha de realizacion</th>
                    <th style="width:40%;">Opciones Planilla</th>
                </tr>
            </thead>
            <tbody>

                <?php
                // Recorrido de todos los registros para clasificar y mover los contadores segun estado de las PQR
                //echo $this->auth->usuario()->identificacion;
                foreach ($this->modelPlan->Listar($this->auth->usuario()->identificacion) as $r) {
                    echo "<tr>";
                    echo "<td>$r->id</td>";
                    echo "<td>$r->proceso</td>";
                    echo "<td>$r->origen</td>";
                    echo "<td>$r->fecha</td>";

                ?>

                    <td>
                        <!-- COLUMNA OPCIONES PLANILLAS -->

                        <!-- ETAPA 1 - Editando el encabezado de la planilla -->
                        <?php if ($r->estado == 'Edicion') { ?>
                            <a href='?c=Planes&a=editarPlan&id=<?php echo $r->id; ?>&token=<?php echo @$_GET['token']; ?>'>
                                <button class="btn btn-info btn-xs" name="btn-filtrar" id="btn-filtrar">Editar</button>
                            </a>

                            <a onclick="javascript:return confirm('¿ Seguro de REGISTRAR y pasar a la fase de OBSERVACIONES ? Despues de registrada solo se podra agregar observaciones del equipo auditor');" href='?c=Planes&a=cerrarPlan&id=<?php echo $r->id; ?>&token=<?php echo @$_GET['token']; ?>'>
                                <button class="btn btn-warning btn-xs" name="btn-filtrar" id="btn-filtrar">Registrar</button>
                            </a>

                            <a onclick="javascript:return confirm('¿ Seguro de ELIMINAR este borrador ? Esta accion es irreversible...');" href='?c=Planes&a=eliminarPlan&id=<?php echo $r->id; ?>&token=<?php echo @$_GET['token']; ?>'>
                                <button class="btn btn-danger btn-xs" name="btn-filtrar" id="btn-filtrar">Borrar</button>
                            </a>
                        <?php } ?>

                        <!-- ETAPA 2 - Agregando observaciones -->
                        <?php if ($r->estado == 'Cerrado') { ?>
                            <a href='?c=Planes&a=verEtapaUno&id=<?php echo $r->id; ?>&token=<?php echo @$_GET['token']; ?>'>
                                <button class="btn btn-success btn-xs" name="btn-filtrar" id="btn-filtrar">Vista previa</button>
                            </a>

                            <a href='?c=Observaciones&a=agregarObservacion&id=<?php echo $r->id; ?>&token=<?php echo @$_GET['token']; ?>'>
                                <button class="btn btn-info btn-xs" name="btn-filtrar" id="btn-filtrar">Agregar Hallazgo | NC | Observacion</button>
                            </a>

                            <a onclick="javascript:return confirm('¿ Seguro de PRESENTAR y pasar a la fase de RETROALIMENTACION DEL AUDITADO ? Despues de presentado solo se podran diligenciar retroalimentaciones por parte del auditado');" href='?c=Planes&a=presentarPlan&id=<?php echo $r->id; ?>&token=<?php echo @$_GET['token']; ?>'>
                                <button class="btn btn-warning btn-xs" name="btn-filtrar" id="btn-filtrar">Presentar al auditado</button>
                            </a>
                        <?php } ?>

                        <!-- ETAPA 3 - Retroalimentando sobre las observaciones -->
                        <?php if ($r->estado == 'Presentado') { ?>
                            <a href='?c=Planes&a=verEtapaDos&id=<?php echo $r->id; ?>&token=<?php echo @$_GET['token']; ?>'>
                                <button class="btn btn-success btn-xs" name="btn-filtrar" id="btn-filtrar">Vista previa</button>
                            </a>

                            <a href='?c=Observaciones&a=retroalimentarObservacion&id=<?php echo $r->id; ?>&token=<?php echo @$_GET['token']; ?>'>
                                <button class="btn btn-primary btn-xs" name="btn-filtrar" id="btn-filtrar">Retroalimentar Hallazgo | NC | Observacion</button>
                            </a>

                            <a onclick="javascript:return confirm('¿ Seguro de PRESENTAR y pasar a la fase de RETROALIMENTACION DEL AUDITADO ? Despues de presentado solo se podran diligenciar retroalimentaciones por parte del auditado');" href='?c=Planes&a=presentarPlan&id=<?php echo $r->id; ?>&token=<?php echo @$_GET['token']; ?>'>
                                <button class="btn btn-warning btn-xs" name="btn-filtrar" id="btn-filtrar">Suscribir plan</button>
                            </a>
                        <?php } ?>

                    </td>

                <?php
                }
                ?>
            </tbody>
        </table>

    </div>

</div>

<hr>