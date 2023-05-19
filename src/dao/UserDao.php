<?php
class UserDao
{
    private MysqlAdapter $mysqlAdapter;
    public function __construct(MysqlAdapter $mysqlAdapter)
    {
        $this->mysqlAdapter = $mysqlAdapter;
    }

    public function select(): array
    {
        $users = [];
        $resultset = ($this->mysqlAdapter)->query("SELECT * FROM users");
        while ($row = mysqli_fetch_assoc($resultset)) {
            $users[] = $this->schematize($row);
        }
        return $users;
    }

    public function selectById($id)
    {
        $resultset = ($this->mysqlAdapter)->query("SELECT * FROM users WHERE user_id = $id");
        $row = mysqli_fetch_assoc($resultset);
        return $this->schematize($row);
    }

    public function login(string $user_user, string $user_pass)
    {
        $resultset = ($this->mysqlAdapter)->query("SELECT * FROM users WHERE user_user = '$user_user' AND user_pass = '$user_pass'");
        if ($row = mysqli_fetch_assoc($resultset)) {
            return $this->schematize($row);
        }
        return false;
    }

    public function insert(
        string $user_name,
        string $user_user,
        string $user_pass,
        string $user_photo
    ) {
        $user_last = date('Y-m-d H:i:s');
        $user_created = date('Y-m-d H:i:s');
        $resultset = ($this->mysqlAdapter)->query("
            INSERT INTO users SET
                user_name = '$user_name',
                user_user = '$user_user',
                user_pass = '$user_pass',
                user_photo = '$user_photo',
                user_last = '$user_last',
                user_created = '$user_created'
        ");

        if (!$resultset) return false;
        return $this->mysqlAdapter->getLastId();
    }

    public function update(
        string $user_id,
        string $user_name,
        string $user_user,
        string $user_pass,
        string $user_photo
    ) {
        $user_last = date('Y-m-d H:i:s');
        $resultset = ($this->mysqlAdapter)->query("
            UPDATE users SET 
                user_name = '$user_name',
                user_user = '$user_user',
                user_pass = '$user_pass',
                user_photo = '$user_photo',
                user_last = '$user_last'
            WHERE user_id = '$user_id'
        ");
        if (!$resultset) return false;
        return true;
    }

    public function deleteById(string $id): bool
    {
        $resultset = ($this->mysqlAdapter)->query("DELETE FROM users WHERE user_id = '$id'");
        if (!$resultset) {
            return true;
        }
        return true;
    }

    private function schematize($row)
    {
        $row['user_photo_url'] = $_ENV['HTTP_DOMAIN'] . "public/img.users/" . $row['user_photo'];
        return $row;
    }
}
