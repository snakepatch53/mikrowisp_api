<?php
class CitaDao
{
    private MysqlAdapter $mysqlAdapter;
    public function __construct(MysqlAdapter $mysqlAdapter)
    {
        $this->mysqlAdapter = $mysqlAdapter;
    }
    public function select(): array
    {
        $citas = [];
        $resultset = ($this->mysqlAdapter)->query("
            SELECT * FROM citas
                INNER JOIN clientes ON citas.cliente_id = clientes.cliente_id
                INNER JOIN users ON citas.user_id = users.user_id
                INNER JOIN horas ON citas.hora_id = horas.hora_id
                INNER JOIN servicios ON citas.servicio_id = servicios.servicio_id
        ");
        while ($row = mysqli_fetch_assoc($resultset)) {
            $citas[] = $row;
        }
        return $citas;
    }

    public function selectById($id)
    {
        $resultset = ($this->mysqlAdapter)->query("
            SELECT * FROM citas 
                INNER JOIN clientes ON citas.cliente_id = clientes.cliente_id
                INNER JOIN users ON citas.user_id = users.user_id
                INNER JOIN horas ON citas.hora_id = horas.hora_id
                INNER JOIN servicios ON citas.servicio_id = servicios.servicio_id
            WHERE cita_id = $id
        ");
        $row = mysqli_fetch_assoc($resultset);
        return $row;
    }

    public function insert(
        string $cita_fecha,
        string $cliente_id,
        string $user_id,
        string $hora_id,
        string $servicio_id
    ): int | bool {
        $cita_last = date('Y-m-d H:i:s');
        $cita_created = date('Y-m-d H:i:s');
        $resultset = ($this->mysqlAdapter)->query("
            INSERT INTO citas (cita_fecha, cliente_id, user_id, hora_id, servicio_id, cita_last, cita_created)
            VALUES ('$cita_fecha', '$cliente_id', '$user_id', '$hora_id', '$servicio_id', '$cita_last', '$cita_created')
        ");
        if (!$resultset) return false;
        $cita_id = $this->mysqlAdapter->getLastId();
        return $cita_id;
    }

    public function update(
        string $cita_id,
        string $cita_fecha,
        string $cliente_id,
        string $user_id,
        string $hora_id,
        string $servicio_id
    ): bool {
        $user_last = date('Y-m-d H:i:s');
        $resultset = ($this->mysqlAdapter)->query("
            UPDATE citas SET
                cita_fecha = '$cita_fecha',
                cliente_id = '$cliente_id',
                user_id = '$user_id',
                hora_id = '$hora_id',
                servicio_id = '$servicio_id',
                cita_last = '$user_last'
            WHERE cita_id = '$cita_id'
        ");
        if (!$resultset) return false;
        return true;
    }

    public function deleteById(string $id): bool
    {
        $resultset = ($this->mysqlAdapter)->query("DELETE FROM citas WHERE cita_id = '$id'");
        if (!$resultset) return true;
        return true;
    }
}
