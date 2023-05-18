<?php
class MensajeDao
{
    private MysqlAdapter $mysqlAdapter;
    public function __construct(MysqlAdapter $mysqlAdapter)
    {
        $this->mysqlAdapter = $mysqlAdapter;
    }

    public function select(): array
    {
        $mensajes = [];
        $resultset = ($this->mysqlAdapter)->query("SELECT * FROM mensajes");
        while ($row = mysqli_fetch_assoc($resultset)) {
            $mensajes[] = $row;
        }
        return $mensajes;
    }

    public function selectById($id)
    {
        $resultset = ($this->mysqlAdapter)->query("SELECT * FROM mensajes WHERE mensaje_id = $id");
        $row = mysqli_fetch_assoc($resultset);
        return $row;
    }

    public function insert(
        string $mensaje_nombre,
        string $mensaje_celular,
        string $mensaje_email,
        string $mensaje_mensaje
    ): int | bool {
        $mensaje_last = date('Y-m-d H:i:s');
        $mensaje_created = date('Y-m-d H:i:s');
        $resultset = ($this->mysqlAdapter)->query("
            INSERT INTO mensajes (
                mensaje_nombre, 
                mensaje_celular, 
                mensaje_email, 
                mensaje_mensaje, 
                mensaje_last, 
                mensaje_created
            ) 
            VALUES (
                '$mensaje_nombre', 
                '$mensaje_celular', 
                '$mensaje_email', 
                '$mensaje_mensaje', 
                '$mensaje_last', 
                '$mensaje_created'
            )
        ");
        if (!$resultset) return false;
        $mensaje_id = $this->mysqlAdapter->getLastId();
        return $mensaje_id;
    }

    public function update(
        string $mensaje_id,
        string $mensaje_nombre,
        string $mensaje_celular,
        string $mensaje_email,
        string $mensaje_mensaje
    ): bool {
        $mensaje_last = date('Y-m-d H:i:s');
        $resultset = ($this->mysqlAdapter)->query("
            UPDATE mensajes SET 
                mensaje_nombre = '$mensaje_nombre', 
                mensaje_celular = '$mensaje_celular', 
                mensaje_email = '$mensaje_email', 
                mensaje_mensaje = '$mensaje_mensaje', 
                mensaje_last = '$mensaje_last'
            WHERE mensaje_id = '$mensaje_id'
        ");
        if (!$resultset) return false;
        return true;
    }

    public function deleteById(string $id): bool
    {
        $resultset = ($this->mysqlAdapter)->query("DELETE FROM mensajes WHERE mensaje_id = '$id'");
        if (!$resultset) {
            return true;
        }
        return true;
    }
}
