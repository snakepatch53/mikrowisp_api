<?php

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->setPaper('A4', 'letter');
$html = getHTML($DATA);
$dompdf->loadHtml($html);
$dompdf->setPaper([0, 0, 400, 640]);
$dompdf->render();
$dompdf->stream("archivo.pdf", array("Attachment" => false));



function getHTML($DATA)
{
    $fecha = getFecha($DATA['cita']['cita_fecha']);
    $hora = getHora($DATA['cita']['hora_hora']);
    $cliente_nombre = $DATA['cita']['cliente_nombre'];
    $cliente_celular = $DATA['cita']['cliente_celular'];
    $doctor_nombre = $DATA['cita']['user_nombre'];
    $tipo_servicio = $DATA['cita']['servicio_nombre'];

    // HTML del ticket
    return '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Ticket de Cita</title>
        <style>
            @page:first{
                size: auto 700px !important;
                margin: 0;
            }
            body {
                font-family: Arial, sans-serif;
                font-size: 14px;
                line-height: 1.5;
                margin: 0;
                padding: 0;
                background-color: #f5f5f5;
            }
    
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                border: 1px solid #ccc;
                background-color: #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            }
    
            .header {
                text-align: center;
                margin-bottom: 20px;
            }
    
            h1 {
                font-size: 24px;
                margin: 0;
                color: #333;
                text-shadow: 1px 1px #fff;
            }
    
            .info {
                display: flex;
                flex-wrap: wrap;
                margin-bottom: 20px;
                padding: 10px;
                background-color: #f2f2f2;
                border-radius: 5px;
            }
    
            .info > div {
                flex: 1;
                margin-right: 10px;
            }
    
            .info > div:last-child {
                margin-right: 0;
            }
    
            label {
                font-weight: bold;
                display: block;
                color: #555;
            }
            
            p {
                margin: 0;
                margin-bottom: 10px;
                line-height: 1.5;
                color: #333;
            }
    
            .footer {
                text-align: center;
                margin-top: 20px;
                color: #555;
            }
    
            .service {
                margin-top: 20px;
                background-color: #fff;
                border: 1px solid #ccc;
                padding: 10px;
                border-radius: 5px;
            }
    
            .service h2 {
                font-size: 18px;
                margin: 0;
                color: #333;
                text-shadow: 1px 1px #fff;
                margin-bottom: 10px;
            }
    
            .service p {
                margin-top: 0;
                color: #555;
            }
    
            .service ul {
                list-style: none;
                margin: 0;
                padding: 0;
            }
    
            .service li {
                margin-bottom: 5px;
                color: #333;
            }
    
            .service li span {
                font-weight: bold;
                margin-right: 10px;
            }
    
            .success {
                background-color: #d4edda;
                color: #155724;
                border: 1px solid #c3e6cb;
                padding: 10px;
                border-radius: 5px;
                margin-top: 20px;
                text-align: center;
            }

            .success h2 {
                font-size: 18px;
                margin: 0;
                color: #155724;
                text-shadow: 1px 1px #fff;
                margin-bottom: 10px;
            }

            .success p {
                margin: 0;
                line-height: 1.5;
                color: #155724;
                font-weight: bold;
                font-size: 16px;
                text-shadow: 1px 1px #fff;
            }
        </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>Ticket de Cita</h1>
                </div>
                <div class="info">
                    <div>
                        <label>Fecha:</label>
                        <p>' . $fecha . '</p>
                    </div>
                    <div>
                        <label>Hora:</label>
                        <p>' . $hora . '</p>
                    </div>
                    <div>
                        <label>Cliente:</label>
                        <p>' . $cliente_nombre . '</p>
                    </div>
                    <div>
                        <label>Celular:</label>
                        <p>' . $cliente_celular . '</p>
                    </div>
                    <div>
                        <label>Doctor:</label>
                        <p>' . $doctor_nombre . '</p>
                    </div>
                </div>
                <div class="service">
                    <h2>Servicio Solicitado:</h2>
                    <p>' . $tipo_servicio . '</p>
                </div>
                <div class="success">
                    <h2>¡Cita Agendada!</h2>
                    <p>Gracias por confiar en nosotros</p>
                </div>
                <div class="footer">
                    <p>Consultorio Odontológico ' . $DATA['info']['info_nombre'] . '</p>
                    <p>' . $DATA['info']['info_direccion'] . ' - ' . $DATA['info']['info_ciudad'] . '</p>
                    <p>Contactenos: ' . $DATA['info']['info_telefono'] . ' - ' . $DATA['info']['info_celular'] . '</p>
                </div>
            </div>
        </body>
        </html>
    ';
}


function getFecha(string $strFecha)
{
    $fecha = $strFecha; // fecha en formato '000-00-00'
    $date = new DateTime($fecha);
    $formatter = new IntlDateFormatter('es_ES', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
    $formatter->setPattern('EEEE d \'de\' MMMM \'del\' y');
    $fecha_formateada = $formatter->format($date);

    // Añadir 0 delante de día y mes si son menores a 10
    $dia = str_pad($date->format('d'), 2, '0', STR_PAD_LEFT);
    $mes = str_pad($date->format('m'), 2, '0', STR_PAD_LEFT);
    $fecha_formateada = str_replace($date->format('d'), $dia, $fecha_formateada);
    $fecha_formateada = str_replace($date->format('m'), $mes, $fecha_formateada);

    $fecha_formateada = ucfirst($fecha_formateada); // Convertir la primera letra del día a mayúscula
    return $fecha_formateada;
}

function getHora(string $strHora)
{
    $hora_12 = date('h:i A', strtotime($strHora));
    return $hora_12;
}
