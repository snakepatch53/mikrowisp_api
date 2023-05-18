<?php
class ServicioDao
{
    private MysqlAdapter $mysqlAdapter;
    public function __construct(MysqlAdapter $mysqlAdapter)
    {
        $this->mysqlAdapter = $mysqlAdapter;
    }

    /** Retorna una lista de servicios
     * @return Servicio[]
     */
    public function select(): array
    {
        $resultset = ($this->mysqlAdapter)->query("SELECT * FROM servicios");
        $servicios = [];
        while ($row = mysqli_fetch_assoc($resultset)) {
            $servicios[] = $row;
        }
        return $servicios;
    }

    /** Retorna una lista de servicios
     * @return Servicio[]
     */
    public function selectLimit($limit): array
    {
        $resultset = ($this->mysqlAdapter)->query("SELECT * FROM servicios LIMIT $limit");
        $servicios = [];
        while ($row = mysqli_fetch_assoc($resultset)) {
            $servicios[] = $row;
        }
        return $servicios;
    }

    /** Retorna un servicio por su id */
    public function selectById($id)
    {
        $resultset = ($this->mysqlAdapter)->query("SELECT * FROM servicios WHERE servicio_id = $id");
        $row = mysqli_fetch_assoc($resultset);
        return $row;
    }

    /** Inserta un nuevo servicio */
    public function insert(
        string $servicio_nombre,
        string $servicio_imagen,
        string $servicio_descripcion
    ): int | bool {
        $servicio_last = date("Y-m-d H:i:s");
        $servicio_created = date("Y-m-d H:i:s");
        $resultset = ($this->mysqlAdapter)->query("
            INSERT INTO 
                servicios (servicio_nombre, servicio_imagen, servicio_descripcion, servicio_last, servicio_created) 
                VALUES ('$servicio_nombre', '$servicio_imagen', '$servicio_descripcion', '$servicio_last', '$servicio_created')
        ");
        if (!$resultset) return false;
        return $this->mysqlAdapter->getLastId();
    }


    /** Atualiza un Servicio
     * @return Boolean
     */
    public function update(
        string $servicio_id,
        string $servicio_nombre,
        string $servicio_imagen,
        string $servicio_descripcion
    ): bool {
        $servicio_last = date("Y-m-d H:i:s");
        $resultset = ($this->mysqlAdapter)->query("
            UPDATE servicios SET 
                servicio_nombre = '$servicio_nombre', 
                servicio_imagen = '$servicio_imagen', 
                servicio_descripcion = '$servicio_descripcion', 
                servicio_last = '$servicio_last'
            WHERE servicio_id = $servicio_id
        ");
        if (!$resultset) return false;
        return true;
    }

    /** Elimina un Servicio
     * @return Boolean
     */
    public function deleteById($id): bool
    {
        $resultset = ($this->mysqlAdapter)->query("DELETE FROM servicios WHERE servicio_id = $id");
        if (!$resultset) {
            return false;
        }
        return true;
    }
}
