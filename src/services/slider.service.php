<?php
class SliderService
{
    public static function select($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $adapter = $DATA['mysqlAdapter'];
        $sliderDao = new SliderDao($adapter);
        $sliders = $sliderDao->select();
        $result = [
            'status' => 'success',
            'message' => 'Slides obtenidos correctamente',
            'response' => true,
            'data' => $sliders
        ];
        echo json_encode($result);
    }

    public static function insert($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $result = [
            'status' => 'error',
            'message' => 'Faltan datos para ingresar el slide',
            'response' => false,
            'data' => null
        ];
        if (isset(
            $_POST['slider_titulo'],
            $_FILES['slider_imagen']
        )) {
            $adapter = $DATA['mysqlAdapter'];
            $sliderDao = new SliderDao($adapter);
            $slider_titulo = $_POST['slider_titulo'];
            $slider_imagen = uploadFIle($_FILES['slider_imagen'], './public/img.slider/');
            $slider_id = $sliderDao->insert(
                $slider_titulo,
                $slider_imagen
            );
            $result['status'] = 'success';
            $result['message'] = 'Slide insertado correctamente';
            $result['response'] = true;
            $result['data'] = $slider_id;
        }
        echo json_encode($result);
    }

    public static function update($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $result = [
            'status' => 'error',
            'message' => 'Faltan datos para actualizar el slide',
            'response' => false,
            'data' => null
        ];
        if (isset(
            $_POST['slider_id'],
            $_POST['slider_titulo'],
            $_FILES['slider_imagen']
        )) {
            $adapter = $DATA['mysqlAdapter'];
            $sliderDao = new SliderDao($adapter);
            $slider_id = $_POST['slider_id'];
            $current_slider = $sliderDao->selectById($slider_id);

            if (!$current_slider) {
                $result['message'] = 'No existe el slide';
                echo json_encode($result);
                return;
            }

            $slider_titulo = $_POST['slider_titulo'];
            $slider_imagen = $current_slider['slider_imagen'];

            if (isset($_FILES['slider_imagen'])) {
                deleteFile('./public/img.slider/' . $slider_imagen);
                $slider_imagen = uploadFIle($_FILES['slider_imagen'], './public/img.slider/');
            }

            $sliderDao->update(
                $slider_id,
                $slider_titulo,
                $slider_imagen
            );
            $result['status'] = 'success';
            $result['message'] = 'Slide actualizado correctamente';
            $result['response'] = true;
            $result['data'] = $slider_id;
        }
        echo json_encode($result);
    }

    public static function delete($DATA)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $result = [
            'status' => 'error',
            'message' => 'Faltan datos para eliminar el slide',
            'response' => false,
            'data' => null
        ];
        if (isset($_POST['slider_id'])) {
            $adapter = $DATA['mysqlAdapter'];
            $sliderDao = new SliderDao($adapter);
            $slider_id = $_POST['slider_id'];
            $current_slider = $sliderDao->selectById($slider_id);

            if (!$current_slider) {
                $result['message'] = 'No existe el slide';
                echo json_encode($result);
                return;
            }

            $sliderDao->delete($slider_id);
            if ($current_slider['slider_imagen'] != '1.png' && $current_slider['slider_imagen'] != '2.png' && $current_slider['slider_imagen'] != '3.png') {
                deleteFile('./public/img.slider/' . $current_slider['slider_imagen']);
            }
            $result['status'] = 'success';
            $result['message'] = 'Slider eliminado correctamente';
            $result['response'] = true;
            $result['data'] = $slider_id;
        }
        echo json_encode($result);
    }
}
