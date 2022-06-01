<!-- Vista para pantalla de login -->
<div class="row">
    <div class="col-md-12">
        <h2 align="Center"><b>Datos generales del plan en construccion...</b></h2>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <b><?php echo "ID unico del plan : "?><br><br>
        <?php echo "Fecha de construccion : "?><br><br>
        <?php echo "Proceso auditado : "?><br><br>
        <?php echo "Origen de la auditoria : "?><br><br>
    </div>

    <div class="col-md-6">
        <?php echo $plan->id; ?><br><br>
        <?php echo $plan->fecha; ?><br><br>
        <?php echo $plan->proceso; ?><br><br>
        <?php echo $plan->origen; ?><br><br>
    </div>
</div>

<hr>


<div class="row">

    <div class="col-md-12">
        <h3 align="Center"><b>Listado de novedades vinculadas ( <?php echo count($listadoObservaciones); ?> )</b></h3><br>

        <table class="table table-bordered">
                <tr>
                    <td bgcolor="#81D9EA"><b>Id</b></td>
                    <td bgcolor="#81D9EA"><b>Tipo</b></td>
                    <td bgcolor="#81D9EA"><b>Descripcion</b></td>
                    <td bgcolor="#F4D9BF"><b>Reaccion</b></td>
                    <td bgcolor="#F4D9BF"><b>Causa</b></td>
                    <td bgcolor="#F4D9BF"><b>NC Similar</b></td>
                    <td bgcolor="#F4D9BF"><b>Accion de mejoramiento</b></td>
                    <td bgcolor="#F4D9BF"><b>Plazo</b></td>
                    <td bgcolor="#F4D9BF"><b>Responsable</b></td>
                    <td bgcolor="#F4D9BF"></td>
                </tr>
            <tbody>
                <?php foreach ($listadoObservaciones as $r){ ?>

                <tr>
                    <th scope="row"><?php echo $r->id; ?></th>
                    <td><?php echo $r->tipo; ?></td>
                    <td><?php echo $r->descripcion; ?></td>
                    <td style="font-size:10px;"><?php echo $r->reaccion; ?></td>
                    <td style="font-size:10px;"><?php echo $r->causa; ?></td>
                    <td style="font-size:10px;"><?php echo $r->nc_similar; ?></td>
                    <td style="font-size:10px;"><?php echo $r->accion_mejoramiento; ?></td>
                    <td style="font-size:10px;"><?php echo $r->plazo; ?></td>
                    <td style="font-size:10px;"><?php echo $r->responsable; ?></td>
                    <td>
                        <a href='?c=Observaciones&a=retroalimentarObservacionAgregarEditar&id=<?php echo $plan->id; ?>&obs_id=<?php echo $r->id; ?>&token=<?php echo @$_GET['token']; ?>'>
                            <button class="btn btn-info btn-xs" name="retroalimentar" id="retroalimentar">Diligenciar</button>
                        </a>
                    </td>

                </tr>

                <?php } ?>


            </tbody>
        </table>
    </div>

</div>


<hr>