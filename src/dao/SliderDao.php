<?php

class SliderDao
{
    private MysqlAdapter $mysqlAdapter;
    public function __construct(MysqlAdapter $mysqlAdapter)
    {
        $this->mysqlAdapter = $mysqlAdapter;
    }
    public function select(): array
    {
        $resultset = ($this->mysqlAdapter)->query("SELECT * FROM slider");
        $sliders = [];
        while ($row = mysqli_fetch_assoc($resultset)) {
            $sliders[] = $row;
        }
        return $sliders;
    }

    public function selectById(int $slider_id)
    {
        $resultset = ($this->mysqlAdapter)->query("SELECT * FROM slider WHERE slider_id = $slider_id");
        $row = mysqli_fetch_assoc($resultset);
        return $row;
    }

    public function insert(
        string $slider_titulo,
        string $slider_imagen
    ): int | bool {
        $slider_last = date('Y-m-d H:i:s');
        $slider_created = date('Y-m-d H:i:s');
        $resultset = ($this->mysqlAdapter)->query("
            INSERT INTO 
                slider (slider_titulo, slider_imagen, slider_last, slider_created) 
                VALUES ('$slider_titulo', '$slider_imagen', '$slider_last', '$slider_created')
        ");
        if (!$resultset) return false;
        return $this->mysqlAdapter->getLastId();
    }

    public function update(
        int $slider_id,
        string $slider_titulo,
        string $slider_imagen
    ): bool {
        $slider_last = date('Y-m-d H:i:s');
        $resultset = ($this->mysqlAdapter)->query("
            UPDATE slider SET 
                slider_titulo = '$slider_titulo',
                slider_imagen = '$slider_imagen',
                slider_last = '$slider_last'
            WHERE slider_id = $slider_id
        ");
        if (!$resultset) return false;
        return true;
    }

    public function delete(int $slider_id): bool
    {
        $resultset = ($this->mysqlAdapter)->query("DELETE FROM slider WHERE slider_id = $slider_id");
        if (!$resultset) return false;
        return true;
    }
}
