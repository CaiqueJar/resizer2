<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resizer</title>
    <link rel="stylesheet" href="<?= asset('css/style.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <header>
        <h1>RES<span>IZER</span></h1>
    </header>
    <main>
        
        <form action="/submit-images" method="POST" enctype="multipart/form-data">
            <div class="">
                <div class="drop-image-area">
                    <div class="text">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <p>Arraste e solte as imagens nesta área</p>
                    </div>
                </div>
                <div class="buttons">
                    <div class="input">
                        <label for="uploader-image" class="btn-uploader-image"><i class="fa-solid fa-cloud-arrow-up"></i> Enviar imagem</label>
                        <input type="file" name="" id="uploader-image">
                    </div>
                    <button class="btn" type="submit">Converter</button>
                </div>
            </div>

            <div class="card-grid" id="card-grid">
                
            </div>
        </form>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
    <script>
        let counter = 1;
        $(document).ready(function() {
            $('#uploader-image').change(function() {

                let card = `
                    <div class="card-image" id="card-${counter}">
                        <div class="img-wrapper">
                            <img src="" alt="">
                            <i class="fa-solid fa-image"></i>
                            <div class="shadow"></div>
                        </div>
                        <div class="options">
                            <div class="inputs">
                                <i class="fa-solid fa-image"></i>
                                <i class="fa-solid fa-trash del" data-id="${counter}"></i>
                            </div>
                            <select name="convert_type[]" id="convert_type">
                                <option value="webp">WEBP</option>
                                <option value="webp">JPEG</option>
                                <option value="webp">PNG</option>
                            </select>
                        </div>
                    </div>
                `;

                $('#card-grid').append(card);

                counter++;

                delete_image();
            });

            function delete_image() {
                $('.del').click(function () {
                    let id = $(this).attr('data-id');
                    $('#card-'+id).remove();
                });
            }
        });
    </script>
</body>

</html>