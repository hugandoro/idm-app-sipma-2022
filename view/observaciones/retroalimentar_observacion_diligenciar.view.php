<!-- Vista para pantalla de login -->
<div class="row">
    <div class="col-md-12">
        <h2 align="Center">Retroalimentar observacion</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <center>
            <picture><img src="/assets/img/logo_idm.png" class="img-fluid" width="100%"></picture>
        </center>
    </div>

    <div class="col-md-9">

        <form method="post" action="?c=Observaciones&a=guardarRetroalimentacion&token=<?php echo @$_GET['token']; ?>">
            <div class="form-group">
                <input type="hidden" name="id" value="<?php echo $plan->id; ?>" />

                <input readonly class="form-control" style="font-size: 12pt;" name="id_obs" value="<?php echo $observacion->id; ?>"/>
                <small id="id_observacion" class="form-text text-muted">Id de la observacion</small><br><br>

                <input readonly class="form-control" style="font-size: 12pt;" name="descripcion" value="<?php echo $observacion->descripcion; ?>"/>
                <small id="descripcion_observacion" class="form-text text-muted">Descripcion de la observacion</small><br><br>

                <input readonly class="form-control" style="font-size: 12pt;" name="tipo" value="<?php echo $observacion->tipo; ?>"/>
                <small id="tipo_observacion" class="form-text text-muted">Tipo de observacion</small><br><br>
                <hr>
            </div>

            <div class="form-group">
                <input required class="form-control" style="font-size: 12pt;" name="reaccion" value="<?php echo $observacion->reaccion; ?>"/>
                <small id="reaccion_observacion" class="form-text text-muted">Reaccion</small><br><br>

                <input required class="form-control" style="font-size: 12pt;" name="causa" value="<?php echo $observacion->causa; ?>"/>
                <small id="causa_observacion" class="form-text text-muted">Causa</small><br><br>

                <input required class="form-control" style="font-size: 12pt;" name="nc_similar" value="<?php echo $observacion->nc_similar; ?>"/>
                <small id="nc_similar_observacion" class="form-text text-muted">NC similar</small><br><br>

                <input required class="form-control" style="font-size: 12pt;" name="accion_mejoramiento" value="<?php echo $observacion->accion_mejoramiento; ?>"/>
                <small id="accion_mejoramiento_observacion" class="form-text text-muted">Accion de mejoramiento</small><br><br>

                <input type="date" required class="form-control" style="font-size: 12pt;" name="plazo" value="<?php echo $observacion->plazo; ?>"/>
                <small id="plazo_observacion" class="form-text text-muted">Plazo</small><br><br>

                <input required class="form-control" style="font-size: 12pt;" name="responsable" value="<?php echo $observacion->responsable; ?>"/>
                <small id="responsable_observacion" class="form-text text-muted">Responsable</small><br><br>
            </div>

            <br>
            <button type="submit" class="btn btn-success btn-xl" name="go" class="btn btn-lg btn-default btn-block">Guardar cambios</button>
            
            <a href='?c=Observaciones&a=retroalimentarObservacion&id=<?php echo $plan->id; ?>&token=<?php echo @$_GET['token']; ?>' class="btn btn-warning">Cancelar y regresar</a>
        </form>

    </div>

</div>

<hr>