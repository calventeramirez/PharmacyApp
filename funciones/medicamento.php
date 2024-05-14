<?php 
class Medicamento {
    public int $idMedicamento;
    public string $nombre;
    public string $descripcion;
    public float $precio;
    public int $cantidad;
    public string $imagen;

    function __construct($idMedicamento, $nombre, $descripcion, $precio, $cantidad, $imagen) {
        $this -> idMedicamento = $idMedicamento;
        $this -> nombre = $nombre;
        $this -> precio = $precio;
        $this -> descripcion = $descripcion;
        $this -> cantidad = $cantidad;
        $this -> imagen = $imagen;
    }
}