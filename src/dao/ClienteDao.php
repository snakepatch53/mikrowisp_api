<?php
class ClienteDao
{
    private MysqlAdapter $mysqlAdapter;
    public function __construct(MysqlAdapter $mysqlAdapter)
    {
        $this->mysqlAdapter = $mysqlAdapter;
    }

    public function select(): array
    {
        $registers = [];
        $resultset = ($this->mysqlAdapter)->query("SELECT * FROM clientes");
        while ($row = mysqli_fetch_assoc($resultset)) {
            $registers[] = $row;
        }
        return $registers;
    }

    public function selectById($id)
    {
        $resultset = ($this->mysqlAdapter)->query("SELECT * FROM clientes WHERE cliente_id = $id");
        $row = mysqli_fetch_assoc($resultset);
        return $row;
    }

    public function insert(
        string $cliente_nombre,
        string $cliente_cedula,
        string $cliente_celular,
        string $cliente_email,
        string $cliente_direccion
    ): int {
        $cliente_last = date('Y-m-d H:i:s');
        $cliente_created = date('Y-m-d H:i:s');
        $resultset = ($this->mysqlAdapter)->query("
            INSERT INTO clientes (cliente_nombre, cliente_cedula, cliente_celular, cliente_email, cliente_direccion, cliente_last, cliente_created) 
            VALUES ('$cliente_nombre', '$cliente_cedula', '$cliente_celular', '$cliente_email', '$cliente_direccion', '$cliente_last', '$cliente_created')
        ");
        if (!$resultset) return false;
        $cliente_id = $this->mysqlAdapter->getLastId();
        return $cliente_id;
    }

    /** Actualiza un usuario
     * @param User $user
     * @return User
     */
    public function update(
        string $cliente_id,
        string $cliente_nombre,
        string $cliente_cedula,
        string $cliente_celular,
        string $cliente_email,
        string $cliente_direccion
    ): bool {
        $cliente_last = date('Y-m-d H:i:s');
        $resultset = ($this->mysqlAdapter)->query("
            UPDATE clientes SET 
                cliente_nombre = '$cliente_nombre', 
                cliente_cedula = '$cliente_cedula', 
                cliente_celular = '$cliente_celular', 
                cliente_email = '$cliente_email', 
                cliente_direccion = '$cliente_direccion',
                cliente_last = '$cliente_last'
            WHERE cliente_id = '$cliente_id'
        ");
        if (!$resultset) return false;
        return true;
    }

    /** Elimina un usuario por id
     * @param User $user
     * @return User
     */
    public function deleteById(string $id): bool
    {
        $resultset = ($this->mysqlAdapter)->query("DELETE FROM clientes WHERE cliente_id = '$id'");
        if (!$resultset) {
            return true;
        }
        return true;
    }
}
