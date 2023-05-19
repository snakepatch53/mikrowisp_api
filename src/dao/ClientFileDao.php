<?php
class ClientFileDao
{
    private MysqlAdapter $mysqlAdapter;
    public function __construct(MysqlAdapter $mysqlAdapter)
    {
        $this->mysqlAdapter = $mysqlAdapter;
    }

    public function select(): array
    {
        $client_files = [];
        $resultset = ($this->mysqlAdapter)->query("SELECT * FROM client_files");
        while ($row = mysqli_fetch_assoc($resultset)) {
            $client_files[] = $this->schematize($row);
        }
        return $client_files;
    }

    public function selectById($id)
    {
        $resultset = ($this->mysqlAdapter)->query("SELECT * FROM client_files WHERE client_file_id = $id");
        $row = mysqli_fetch_assoc($resultset);
        return $this->schematize($row);
    }

    public function insert(
        string $client_file_name,
        string $client_file_desc,
        string $client_file_stored,
        string $client_id
    ) {
        $client_file_last = date('Y-m-d H:i:s');
        $client_file_created = date('Y-m-d H:i:s');
        $resultset = ($this->mysqlAdapter)->query("
            INSERT INTO client_files SET
                client_file_name = '$client_file_name',
                client_file_desc = '$client_file_desc',
                client_file_stored = '$client_file_stored',
                client_file_last = '$client_file_last',
                client_file_created = '$client_file_created',
                client_id = '$client_id'
        ");

        if (!$resultset) return false;
        return $this->mysqlAdapter->getLastId();
    }

    public function update(
        string $client_file_id,
        string $client_file_name,
        string $client_file_desc,
        string $client_file_stored,
        string $client_id
    ) {
        $client_file_last = date('Y-m-d H:i:s');
        $resultset = ($this->mysqlAdapter)->query("
            UPDATE client_files SET 
                client_file_name = '$client_file_name',
                client_file_desc = '$client_file_desc',
                client_file_stored = '$client_file_stored',
                client_file_last = '$client_file_last',
                client_id = '$client_id'
            WHERE client_file_id = '$client_file_id'
        ");
        if (!$resultset) return false;
        return true;
    }

    public function deleteById(string $id): bool
    {
        $resultset = ($this->mysqlAdapter)->query("DELETE FROM client_files WHERE client_file_id = '$id'");
        if (!$resultset) {
            return true;
        }
        return true;
    }

    private function schematize($row)
    {
        $row['client_file_stored_url'] = $_ENV['HTTP_DOMAIN'] . "public/file.client_files/" . $row['client_file_stored'];
        return $row;
    }
}
