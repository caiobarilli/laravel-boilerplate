<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Não Encontrada</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
            color: #343a40;
            font-family: Arial, sans-serif;
        }

        .container {
            text-align: center;
        }

        h1 {
            font-size: 10rem;
            margin: 0;
        }

        p {
            font-size: 1.5rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>404</h1>
        <p>Página não encontrada</p>

        <a href="{{ url()->previous() }}">Voltar</a>

    </div>
</body>

</html>
