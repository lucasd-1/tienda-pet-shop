
<h1>Área de reportes</h1>

<div class="container" >
    <h4 style="padding-bottom: 10px;">Exportar pedidos por rango de fecha</h4>
    <form action="<?=base_url?>reporte/getReporte" method="POST" enctype="multipart/form-data">
        <div class='col-sm-3' style="margin-left: -10px;">
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' name="dateDesde" class="form-control" placeholder="Desde" />
                    <span class="input-group-addon">
                         <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class='col-sm-3' style="margin-left: -10px;">
            <div class="form-group">
                <div class='input-group date' id='datetimepicker2'>
                    <input type='text' name="dateHasta" class="form-control" placeholder="Hasta" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class='col-sm-3' style="margin-left: -10px;">
            <div class="form-group">
                <button type="submit" class="btn btn-info mx-auto">Exportar (CSV)</button>
            </div>
        </div>
    </form>
</div>

<hr />

<div class="container mt-5 d-flex">
    <div class="row" style="padding: 10px;">
        <div class='col-sm-3' style="margin-left: -10px;">
            <h4>Exportar todos los pedidos</h4>
        </div>
        <div class='col-sm-3' style="margin-left: -10px;">
        </div>
        <div class='col-sm-3' style="margin-left: -10px;">
            <a href="<?= base_url ?>reporte/getReporte&button=pedidos" class="btn btn-info mx-auto">Exportar (CSV)</a>
        </div>
    </div>
    <hr />
    <div class="row" style="padding: 10px;">
        <div class='col-sm-3' style="margin-left: -10px;">
            <h4>Exportar todos los productos</h4>
        </div>
        <div class='col-sm-3' style="margin-left: -10px;">
        </div>
        <div class='col-sm-3' style="margin-left: -10px;">
            <a href="<?= base_url ?>reporte/getReporte&button=productos" class="btn btn-info mx-auto">Exportar (CSV)</a>
        </div>
    </div>
</div>

