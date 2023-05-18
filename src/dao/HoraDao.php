<?php
class HoraDao
{
    private MysqlAdapter $mysqlAdapter;
    public function __construct(MysqlAdapter $mysqlAdapter)
    {
        $this->mysqlAdapter = $mysqlAdapter;
    }

    /** Retorna una lista de redes sociales
     * @return Hora[]
     */
    public function select(): array
    {
        $resultset = ($this->mysqlAdapter)->query("SELECT * FROM horas");
        $horas = [];
        while ($row = mysqli_fetch_assoc($resultset)) {
            $horas[] = $row;
        }
        return $horas;
    }

    public function selectById(int $hora_id)
    {
        $resultset = ($this->mysqlAdapter)->query("SELECT * FROM horas WHERE hora_id = $hora_id");
        $row = mysqli_fetch_assoc($resultset);
        return $row;
    }

    public function insert(string $hora_hora): int | bool
    {
        $hora_last = date('Y-m-d H:i:s');
        $hora_created = date('Y-m-d H:i:s');
        $resultset = ($this->mysqlAdapter)->query("
            INSERT INTO 
                horas (hora_hora, hora_last, hora_created) 
                VALUES ('$hora_hora', '$hora_last', '$hora_created')
        ");
        if (!$resultset) return false;
        return $this->mysqlAdapter->getLastId();
    }

    public function update(int $hora_id, string $hora_hora): bool
    {
        $hora_last = date('Y-m-d H:i:s');
        $resultset = ($this->mysqlAdapter)->query("
            UPDATE horas SET 
                hora_hora = '$hora_hora',
                hora_last = '$hora_last'
            WHERE hora_id = $hora_id
        ");
        if (!$resultset) return false;
        return true;
    }

    public function delete(int $hora_id): bool
    {
        $resultset = ($this->mysqlAdapter)->query("DELETE FROM horas WHERE hora_id = $hora_id");
        if (!$resultset) return false;
        return true;
    }
}
