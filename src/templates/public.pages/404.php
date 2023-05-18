<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Error 404!</title>
    <link rel="shortcut icon" href="<?= $DATA['http_domain'] ?>public/img/logo1.png?last=<?= $DATA['info']['info_last'] ?>" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f8f8f8;
            font-family: sans-serif;
            padding: 20px 0;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        h1 {
            font-size: 8rem;
            color: #777;
            margin: 0;
            line-height: 1;
            text-shadow: 2px 2px 0 #eee;
        }

        h2 {
            font-size: 3rem;
            color: #333;
            margin: 1rem 0;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        p {
            font-size: 1.5rem;
            color: #555;
        }

        a {
            background-color: #007bff;
            color: #fff;
            padding: 1rem 2rem;
            border: none;
            border-radius: 4px;
            font-size: 1.5rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        a:hover {
            transform: translateY(-2px);
            transition: all 0.2s ease;
            box-shadow: 0 3px 6px 0 rgba(0, 0, 0, 0.16);
        }

        img {
            width: 100%;
            height: 100%;
            max-height: 500px;
            object-fit: contain;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 6rem;
            }

            h2 {
                font-size: 2rem;
            }

            p {
                font-size: 1.2rem;
            }

            a {
                font-size: 1.2rem;
            }

            img {
                max-height: 300px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="<?= $DATA['http_domain'] ?>public/img/404.png" alt="Ilustracion 404">
        <h2>Oops, la página que buscas no existe.</h2>
        <p>Parece que has llegado a una página que no está disponible o se ha eliminado.</p>
        <br><br>
        <a href="<?= $DATA['http_domain'] ?>">
            <i class="fas fa-arrow-left"></i>
            <span>Volver al inicio</span>
        </a>
    </div>
</body>

</html>