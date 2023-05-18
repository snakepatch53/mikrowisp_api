<?php
class SocialDao
{
    private MysqlAdapter $mysqlAdapter;
    public function __construct(MysqlAdapter $mysqlAdapter)
    {
        $this->mysqlAdapter = $mysqlAdapter;
    }

    /** Retorna una lista de redes sociales
     * @return Social[]
     */
    public function select(): array
    {
        $resultset = ($this->mysqlAdapter)->query("SELECT * FROM social");
        $socials = [];
        while ($row = mysqli_fetch_assoc($resultset)) {
            $icon = $row['social_icon'];
            if (strpos($icon, '<i') === false) {
                $icon = '<i class="' . $icon . '" i></i>';
            }
            $color = $row['social_color'];
            if (strpos($color, '#') === false) {
                $color = '#' . $color;
            }
            $row['social_icon'] = $icon;
            $row['social_color'] = $color;
            $socials[] = $row;
        }
        return $socials;
    }

    public function selectById($id)
    {
        $resultset = ($this->mysqlAdapter)->query("SELECT * FROM social WHERE social_id = $id");
        $social = mysqli_fetch_assoc($resultset);
        $icon = $social['social_icon'];
        if (strpos($icon, '<i') === false) {
            $icon = '<i class="' . $icon . '" i></i>';
        }
        $color = $social['social_color'];
        if (strpos($color, '#') === false) {
            $color = '#' . $color;
        }
        $social['social_icon'] = $icon;
        $social['social_color'] = $color;
        return $social;
    }

    public function insert(
        string $social_nombre,
        string $social_url,
        string $social_icon,
        string $social_color
    ): int | bool {
        $social_last = date('Y-m-d H:i:s');
        $social_created = date('Y-m-d H:i:s');
        $resultset = ($this->mysqlAdapter)->query("
            INSERT INTO 
                social (social_nombre, social_url, social_icon, social_color, social_last, social_created) 
                VALUES ('$social_nombre', '$social_url', '$social_icon', '$social_color', '$social_last', '$social_created')
        ");
        if (!$resultset) return false;
        return $this->mysqlAdapter->getLastId();
    }

    public function update(
        int $social_id,
        string $social_nombre,
        string $social_url,
        string $social_icon,
        string $social_color
    ): bool {
        $social_last = date('Y-m-d H:i:s');
        $resultset = ($this->mysqlAdapter)->query("
            UPDATE social SET 
                social_nombre = '$social_nombre',
                social_url = '$social_url',
                social_icon = '$social_icon',
                social_color = '$social_color',
                social_last = '$social_last'
            WHERE social_id = $social_id
        ");
        if (!$resultset) return false;
        return true;
    }

    public function delete(int $social_id): bool
    {
        $resultset = ($this->mysqlAdapter)->query("DELETE FROM social WHERE social_id = $social_id");
        if (!$resultset) return false;
        return true;
    }
}
