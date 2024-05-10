<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resizer</title>
</head>

<body>
    <form action="/submit-images" method="POST" enctype="multipart/form-data">
        <input type="file" name="imagem[]" id="imagem" multiple>
        <input type="file" name="imagem[]" id="imagem" multiple>
        <input type="file" name="imagem[]" id="imagem" multiple>
        <button type="submit">Enviar</button>
    </form>
</body>

</html>