<?php
class UserDao
{
    private MysqlAdapter $mysqlAdapter;
    public function __construct(MysqlAdapter $mysqlAdapter)
    {
        $this->mysqlAdapter = $mysqlAdapter;
    }

    /** Retorna una lista de usuarios
     * @return User[]
     */
    public function select(): array
    {
        $users = [];
        $resultset = ($this->mysqlAdapter)->query("SELECT * FROM users");
        while ($row = mysqli_fetch_assoc($resultset)) {
            $users[] = $row;
        }
        return $users;
    }

    /** Retorna un usuario por su id
     * @return User
     */
    public function selectById($id)
    {
        $resultset = ($this->mysqlAdapter)->query("SELECT * FROM users WHERE user_id = $id");
        $row = mysqli_fetch_assoc($resultset);
        return $row;
    }

    /** Retorna una lista de doctores
     * @return User[]
     */
    public function selectDoctores(): array
    {
        $users = [];
        $resultset = ($this->mysqlAdapter)->query("SELECT * FROM users WHERE user_tipo = 'doctor'");
        while ($row = mysqli_fetch_assoc($resultset)) {
            $users[] = $row;
        }
        return $users;
    }

    /** Retorna una lista de doctores
     * @return User[]
     */
    public function selectDoctoresLimit($limit): array
    {
        $users = [];
        $resultset = ($this->mysqlAdapter)->query("SELECT * FROM users WHERE user_tipo = 'doctor' LIMIT $limit");
        while ($row = mysqli_fetch_assoc($resultset)) {
            $users[] = $row;
        }
        return $users;
    }

    /** Retorna un usuario
     * @param string $user_user
     * @param string $user_pass
     * @return User
     */
    public function login(string $user_user, string $user_pass)
    {
        $resultset = ($this->mysqlAdapter)->query("SELECT * FROM users WHERE user_user = '$user_user' AND user_pass = '$user_pass'");
        if ($row = mysqli_fetch_assoc($resultset)) {
            return $row;
        }
        return false;
    }

    /** inserta un usuario
     * @param User $user
     * @return User
     */
    public function insert(
        string $user_nombre,
        string $user_especialidad,
        string $user_user,
        string $user_pass,
        string $user_foto,
        string $user_tipo
    ): int {
        $user_last = date('Y-m-d H:i:s');
        $user_created = date('Y-m-d H:i:s');
        $resultset = ($this->mysqlAdapter)->query("
            INSERT INTO users (user_nombre, user_especialidad, user_user, user_pass, user_foto, user_tipo, user_last, user_created) 
            VALUES ('$user_nombre', '$user_especialidad', '$user_user', '$user_pass', '$user_foto', '$user_tipo', '$user_last', '$user_created')
        ");
        $user_id = $this->mysqlAdapter->getLastId();
        return $user_id;
    }

    /** Actualiza un usuario
     * @param User $user
     * @return User
     */
    public function update(
        string $user_id,
        string $user_nombre,
        string $user_especialidad,
        string $user_user,
        string $user_pass,
        string $user_foto,
        string $user_tipo
    ): bool {
        $user_last = date('Y-m-d H:i:s');
        $resultset = ($this->mysqlAdapter)->query("
            UPDATE users SET 
                user_nombre = '$user_nombre', 
                user_especialidad = '$user_especialidad', 
                user_user = '$user_user', 
                user_pass = '$user_pass', 
                user_foto = '$user_foto', 
                user_tipo = '$user_tipo',
                user_last = '$user_last' 
            WHERE user_id = '$user_id'
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
        $resultset = ($this->mysqlAdapter)->query("DELETE FROM users WHERE user_id = '$id'");
        if (!$resultset) {
            return true;
        }
        return true;
    }
}
