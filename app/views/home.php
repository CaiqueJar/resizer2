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
    <?php if (isset($_SESSION['download-zip-link'])) : ?>
        <div class="modal-wrap modal-download" id="modal-download">
            <div class="overflow close-fun"></div>
            <div class="modal">
                <div class="header">
                    <h3>Arquivos estão prontos!</h3>
                    <span class="close close-fun">✖</span>
                </div>
                <div class="body">
                    <p>
                        Faça o download do seu zip. <?= $_SESSION['download-zip-link'] ?>
                    </p>
                </div>
                <div class="footer">
                    <a id="download-btn" href="/download-zip" target="_blank">Baixar</a>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <header>
        <h1>RES<span>IZER</span></h1>
    </header>
    <main>
        <form class="upload-section" action="/submit-images" method="POST" enctype="multipart/form-data">
            <div class="">
                <div for="uploader-image" class="drop-image-area">
                    <div class="text">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <p>Arraste e solte as imagens nesta área</p>
                    </div>
                </div>
                <div class="buttons">
                    <div class="input">
                        <label for="uploader-image" class="btn-uploader-image"><i class="fa-solid fa-cloud-arrow-up"></i> Enviar imagem</label>
                        <input type="file" id="uploader-image" accept="image/*" multiple>
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
            $('#uploader-image').change(function(e) {
                const files = Array.from(e.target.files);

                files.forEach(file => {
                    let currentCounter = counter;

                    let card = `
                    <div class="card-image" id="card-${currentCounter}">
                        <img src="" id="card-img-${currentCounter}" alt="">
                        <div class="options">
                            <div class="inputs">
                                <label for="image-input-${currentCounter}">
                                    <i class="fa-solid fa-image"></i>
                                    <input type="file" class="image-input" name="images[]" id="image-input-${currentCounter}" data-id="${currentCounter}">
                                </label>
                                <i class="fa-solid fa-trash del" data-id="${currentCounter}"></i>
                            </div>
                            <select name="formats[]" id="format-input-${currentCounter}">
                                <option value="webp">WEBP</option>
                                <option value="jpeg">JPEG</option>
                                <option value="png">PNG</option>
                            </select>
                            <input type="text" name="width[]" id="width-${currentCounter}">
                            <input type="text" name="height[]" id="height-${currentCounter}">
                        </div>
                    </div>
                    `;

                    $('#card-grid').append(card);

                    if (file) {
                        let imageURL = URL.createObjectURL(file);
                        $('#card-img-' + currentCounter).attr('src', imageURL);


                        let img = new Image();
                        img.src = imageURL;

                        img.onload = function() {
                            let intrinsicWidth = img.naturalWidth;
                            let intrinsicHeight = img.naturalHeight;

                            $('#width-' + currentCounter).val(intrinsicWidth);
                            $('#height-' + currentCounter).val(intrinsicHeight);
                            
                        };

                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        document.getElementById(`image-input-${currentCounter}`).files = dataTransfer.files;
                    }
                    counter++;
                });

                preview_image();
                delete_image();
            });

            function preview_image() {
                $(document).on('change', '.image-input', function(e) {
                    const [file] = e.target.files;
                    let id = $(this).attr('data-id');

                    if (file) {
                        let imageURL = URL.createObjectURL(file);
                        $('#card-img-' + id).attr('src', imageURL);
                    }
                });
            }

            function delete_image() {
                $(document).on('click', '.del', function() {
                    let id = $(this).attr('data-id');
                    $('#card-' + id).remove();
                });
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#download-btn').click(function() {
                setTimeout(() => {
                    location.reload();
                }, 1);
            });
        });
    </script>
</body>

</html>