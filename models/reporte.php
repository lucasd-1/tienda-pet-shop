<?php

class reporte {

    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getReportePedidos() {
        $sql    = "SELECT 
                    id,
                    usuario_id,
                    provincia,
                    localidad,
                    direccion,
                    coste,
                    id_estado_pedido,
                    fecha,
                    forma_pago,
                    comprobante,
                    saldo 
                    FROM pedidos";
        return $this->db->query($sql);
    }

    public function getReporteProductos() {
        $sql    = "SELECT 
                    id,
                    nombre,
                    precio,
                    stock,
                    oferta,
                    fecha,
                    imagen,
                    subcategoria_id,
                    proveedor,
                    tags,
                    precio_venta
                    FROM productos";
        return $this->db->query($sql);
    }

}