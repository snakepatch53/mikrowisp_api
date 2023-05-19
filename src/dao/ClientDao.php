<?php
class ClientDao
{
    private MysqlAdapter $mysqlAdapter;
    public function __construct(MysqlAdapter $mysqlAdapter)
    {
        $this->mysqlAdapter = $mysqlAdapter;
    }

    public function select(): array
    {
        $clients = [];
        $resultset = ($this->mysqlAdapter)->query("SELECT * FROM clients");
        while ($row = mysqli_fetch_assoc($resultset)) {
            $clients[] = $this->schematize($row);
        }
        return $clients;
    }

    public function selectById($id)
    {
        $resultset = ($this->mysqlAdapter)->query("SELECT * FROM clients WHERE client_id = $id");
        $row = mysqli_fetch_assoc($resultset);
        return $this->schematize($row);
    }

    public function selectByMkwDni($id)
    {
        $resultset = ($this->mysqlAdapter)->query("SELECT * FROM clients WHERE client_mkw_dni = $id");
        $row = mysqli_fetch_assoc($resultset);
        return $this->schematize($row);
    }

    public function insert(
        string $client_name,
        string $client_mkw_id,
        string $client_mkw_dni
    ) {
        $client_last = date('Y-m-d H:i:s');
        $client_created = date('Y-m-d H:i:s');
        $resultset = ($this->mysqlAdapter)->query("
            INSERT INTO clients SET
                client_name = '$client_name',
                client_mkw_id = '$client_mkw_id',
                client_mkw_dni = '$client_mkw_dni',
                client_last = '$client_last',
                client_created = '$client_created'
        ");

        if (!$resultset) return false;
        return $this->mysqlAdapter->getLastId();
    }

    public function update(
        string $client_id,
        string $client_mkw_id,
        string $client_mkw_dni,
        string $client_name
    ) {
        $client_last = date('Y-m-d H:i:s');
        $resultset = ($this->mysqlAdapter)->query("
            UPDATE clients SET 
                client_mkw_id = '$client_mkw_id,
                client_mkw_dni = '$client_mkw_dni,
                client_name = '$client_name,
                client_last = '$client_last
            WHERE client_id = '$client_id'
        ");
        if (!$resultset) return false;
        return true;
    }

    public function deleteById(string $id): bool
    {
        $resultset = ($this->mysqlAdapter)->query("DELETE FROM clients WHERE client_id = '$id'");
        if (!$resultset) return true;
        return false;
    }

    public function deleteByMkwDni(string $mkwDni)
    {
        $resultset = ($this->mysqlAdapter)->query("DELETE FROM clients WHERE client_mkw_dni = '$mkwDni'");
        if (!$resultset) return true;
        return false;
    }

    private function schematize($row)
    {
        $client_id = $row['client_id'];
        $row['client_files'] = [];
        $resultset = ($this->mysqlAdapter)->query("SELECT * FROM client_files WHERE client_id = '$client_id'");
        while ($rowFile = mysqli_fetch_assoc($resultset)) {
            $row['client_files'][] = $rowFile;
        }
        return $row;
    }
}
