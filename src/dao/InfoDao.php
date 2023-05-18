<?php


class InfoDao
{
    private MysqlAdapter $mysqlAdapter;
    public function __construct(MysqlAdapter $mysqlAdapter)
    {
        $this->mysqlAdapter = $mysqlAdapter;
    }

    public function select()
    {
        $resultset = ($this->mysqlAdapter)->query("SELECT * FROM info");
        $row = mysqli_fetch_assoc($resultset);
        return $this->schematize($row);
    }

    // public function update(
    //     string $info_nombre,
    //     string $info_filosofia,
    //     string $info_resumen,
    //     string $info_mision,
    //     string $info_vision,
    //     string $info_mapa,
    //     string $info_direccion,
    //     string $info_ciudad,
    //     string $info_telefono,
    //     string $info_celular,
    //     string $info_email
    // ): bool {
    //     $info_nombre = addslashes($info_nombre);
    //     $info_filosofia = addslashes($info_filosofia);
    //     $info_resumen = addslashes($info_resumen);
    //     $info_mision = addslashes($info_mision);
    //     $info_vision = addslashes($info_vision);
    //     $last = date("Y-m-d H:i:s");
    //     $resultset = ($this->mysqlAdapter)->query("
    //         UPDATE info SET     
    //             info_nombre = '$info_nombre', 
    //             info_filosofia = '$info_filosofia', 
    //             info_resumen = '$info_resumen', 
    //             info_mision = '$info_mision', 
    //             info_vision = '$info_vision', 
    //             info_mapa = '$info_mapa', 
    //             info_direccion = '$info_direccion', 
    //             info_ciudad = '$info_ciudad', 
    //             info_telefono = '$info_telefono', 
    //             info_celular = '$info_celular', 
    //             info_email = '$info_email',
    //             info_last = '$last'
    //         ");
    //     if ($resultset) {
    //         return true;
    //     }
    //     return false;
    // }

    public function schematize($row)
    {
        return $row;
    }
}
