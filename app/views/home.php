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
                        <input type="file" id="uploader-image" accept="image/*">
                    </div>
                    <button class="btn" type="submit">Converter</button>
                </div>
            </div>

            <div class="card-grid" id="card-grid">
                
            </div>
        </form>
    </main>

    <div class="modal-edit" id="modal-edit">
        <div class="overflow close-fun"></div>
        <div class="modal">
            <div class="header">
                <h3>Deseja alterar os dados?</h3>
                <span class="close close-fun">✖</span>
            </div>
            <div class="body">
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis voluptatum eveniet tempora? Suscipit nihil voluptatum aperiam unde excepturi delectus tempore, est error assumenda repellendus natus provident accusamus quas eos itaque?
                </p>
            </div>
            <div class="footer">
                <button>Editar</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
    <script>
        let counter = 1;
        $(document).ready(function() {
            $('#uploader-image').change(function(e) {

                const [file] = e.target.files
                    
                let card = `
                    <div class="card-image" id="card-${counter}">
                        <img src="" id="card-img-${counter}" alt="">
                        <div class="options">
                            <div class="inputs">
                                <label for="image-input-${counter}">
                                    <i class="fa-solid fa-image"></i>
                                    <input type="file" class="image-input" name="images[]" id="image-input-${counter}" data-id="${counter}">
                                </label>
                                <i class="fa-solid fa-pen-to-square edit-btn"></i>
                                <i class="fa-solid fa-trash del" data-id="${counter}"></i>
                            </div>
                            <select name="formats[]" id="format-input-${counter}">
                                <option value="webp">WEBP</option>
                                <option value="jpeg">JPEG</option>
                                <option value="png">PNG</option>
                            </select>
                        </div>

                        
                    </div>
                `;

                $('#card-grid').append(card);

                if (file) {
                    $('#card-img-'+counter).attr('src', URL.createObjectURL(file));
                }
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);

                document.getElementById(`image-input-${counter}`).files = dataTransfer.files;

                counter++;

                preview_image();
                edit_image();
                delete_image();
            });

            function preview_image() {
                $('.image-input').change(function(e) {
                    const [file] = e.target.files;
                    let id = $(this).attr('data-id');
    
                    if (file) {
                        $('#card-img-'+id).attr('src', URL.createObjectURL(file));
                    }
                });
            }
            function edit_image() {
                $('.edit-btn').click(function() {
                    $('#modal-edit').toggleClass('active');
                });
                $('.close-fun').click(function() {
                    $('#modal-edit').removeClass('active');
                });
            }
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