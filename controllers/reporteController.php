<?php
require_once 'models/reporte.php';

class reporteController {

    public function index(){
        echo "Controlador Reportes, Acción index";
    }

    public function ver() {
        require_once 'views/reportes/reportes.php';
    }

    public function getReporte() {
        $reporte = new Reporte();

        if(isset($_GET['button'])) {
            switch($_GET['button']) {
                case 'pedidos':
                    $dbResult = $reporte->getReportePedidos();
                    Utils::getCsv($dbResult, "pedidos-".date("YmdHis"));
                    break;
                case 'productos':
                    $dbResult = $reporte->getReporteProductos();
                    Utils::getCsv($dbResult, "productos-".date("YmdHis"));
                    break;
            }
        }
    }

}