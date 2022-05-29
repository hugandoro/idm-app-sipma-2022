<!-- Vista para pantalla de login -->
<div class="row">
    <div class="col-md-12">
        <h2 align="Center"><b>Datos generales del plan en construccion...</b></h2>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <b><?php echo "ID unico del plan : "?><br><br>
        <?php echo "Fecha de construccion : "?><br><br>
        <?php echo "Proceso auditado : "?><br><br>
        <?php echo "Origen de la auditoria : "?><br><br>
    </div>

    <div class="col-md-3">
        <?php echo $plan->id; ?><br><br>
        <?php echo $plan->fecha; ?><br><br>
        <?php echo $plan->proceso; ?><br><br>
        <?php echo $plan->origen; ?><br><br>
    </div>

    <div class="col-md-6">
        <h3 align="Center">Agregar nueva observacion</h3>

        <form method="post" action="?c=Observaciones&a=guardarObservacion&token=<?php echo @$_GET['token']; ?>">
                <input type="hidden" name="id" value="<?php echo $plan->id; ?>" />

                <input type="text" class="form-control form-control-lg" style="font-size: 14pt;" name="descripcion" placeholder="" required autocomplete="off" />
                <small id="emailHelp" class="form-text text-muted">Descripcion del hallazgo | NC | observacion</small><br><br>

                <select class="form-control form-control-lg" style="font-size: 12pt;" name="tipo" placeholder="" required autocomplete="off" />
                <option value="Observacion">Observacion</option>
                <option value="Hallazgo">Hallazgo</option>
                <option value="No conformidad">No conformidad</option>
                </select>
                <small id="emailHelp" class="form-text text-muted">Tipo de novedad</small><br><br>

                <div class="form-group col-md-12" style="display: block;">
                    <button type="submit" class="btn btn-info btn-xl btn-block" name="go" class="btn btn-lg btn-default btn-block">Guardar novedad</button><hr>
                </div>
        </form>
    </div>
</div>

<hr>


<div class="row">

    <div class="col-md-12">
        <h3 align="Center"><b>Listado de novedades vinculadas ( <?php echo count($listadoObservaciones); ?> )</b></h3><br>

        <table class="table table-bordered">
                <tr bgcolor="#58D68D">
                    <td><b>Id</b></td>
                    <td><b>Tipo</b></td>
                    <td><b>Descripcion</b></td>
                    <td></td>
                </tr>
            <tbody>
                <?php foreach ($listadoObservaciones as $r){ ?>

                <tr>
                    <th scope="row"><?php echo $r->id; ?></th>
                    <td><?php echo $r->tipo; ?></td>
                    <td><?php echo $r->descripcion; ?></td>
                    <td>
                        <a onclick="javascript:return confirm('¿ Seguro de BORRAR esta novedad ? Esta accion es irreversible');" href='?c=Observaciones&a=desvincularObservacion&idObservacion=<?php echo $r->id; ?>&id=<?php echo $plan->id; ?>&token=<?php echo @$_GET['token']; ?>'>
                            <button class="btn btn-danger btn-xs" name="borrar" id="borrar">Eliminar novedad</button>
                        </a>
                    </td>

                </tr>

                <?php } ?>


            </tbody>
        </table>
    </div>

</div>


<hr>