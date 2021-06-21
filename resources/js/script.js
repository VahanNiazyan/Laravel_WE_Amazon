jQuery(document).ready(function ($) {

    ///////////////////////  The image changes when clicked  ////////////////////////////

    $(".preview img").on("click", function () {
        let images = "";

        images = $(this).attr("src");
        $('.modal-img').attr('src', images)
    });


    ///////////////////////  Create and Update colors  ////////////////////////////
    let colorArr = [];
    let productId = +$('.products').attr('data-product-id');

    $('.products .color').on("click", function () {
        // console.log('color')
        $(this).attr('new-border');
        $(this).toggleClass('new-border');

        const a = $(this).parents('.color-div').find("input");
        a.prop("checked", !a.prop("checked"));

        if (a.prop("checked")) {
            colorArr.push(+a.val());
        } else {
            colorArr = colorArr.filter(function (item, index, array) {
                if (item != a.val()) return true;
            });
        }
    });

    ///////////////////////  Update Category and Size  ////////////////////////////
    let categoryValue = $('#category').val();
    if (categoryValue == null) {
        categoryValue = '';
    }
    let sizeValue = $('#size').val();
    if (sizeValue == null) {
        sizeValue = '';
    }
    ///////////////////////  Create Category and Size  ////////////////////////////
    $("#category").change(function () {
        categoryValue = $(this).val();
    })
    $('#size').change(function () {
        sizeValue = $(this).val();
    });

    ///////////////////////  Create product images  ////////////////////////////
    let inputArr = [];
    let isMain = '';

    let images = function (input, imgPreview) {

        if (input.files) {
            const filesAmount = input.files.length;
            inputArr = [...input.files];

            for (let i = 0; i < filesAmount; i++) {
                const reader = new FileReader();

                reader.addEventListener("load", function (event) {
                    let imgDiv = $($.parseHTML("<div class='img-div'>"))
                    $($.parseHTML("<i>")).html('x').appendTo(imgDiv);
                    $($.parseHTML("<img>")).attr({
                        'src': event.target.result,
                        'data-id': i
                    }).appendTo(imgDiv);
                    imgDiv.appendTo(imgPreview);

                    // Select the main image
                    $('.preview img').on("click", function (event) {
                        $('.preview img').attr('class', '');
                        event.target.setAttribute('class', 'img-style');
                        let images = "";
                        images = $(this).attr("src");
                        $('.modal-img').attr('src', images)
                    })
                    // Delete while creating the image
                    $('.preview i').on("click", function (event) {
                        let a = $(this).parents('.img-div').find('img').attr('data-id');
                        delete inputArr[a];
                        $(this).parents('.img-div').remove();
                    })

                })
                reader.readAsDataURL(input.files[i]);
            }
        }
    };

    $('#upload_images').on('change', function () {
        images(this, '.preview');
    });


    ///////////////////////  image style and isMain  ////////////////////////////
    $('.preview img').on("click", function (event) {
        $('.preview img').attr('class', '');
        event.target.setAttribute('class', 'img-style');

        //     const newImg = $(this).attr('data-id')
        //
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        //     $.ajax({
        //         url: `/product/update/image/${productId}/${newImg}`,
        //         type: 'POST',
        //         dataType: 'json',
        //         cache: false,
        //         processData: false,
        //         contentType: false,
        //         success: function (data) {
        //         },
        //     })
        //
    })

    ///////////////////////  Delete while updating the image  ////////////////////////////

    $('.preview i').on("click", function () {
        let imageId = +$(this).parents('.img-div').find('img').attr('data-id');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: `/product/delete/image/${imageId}`,
            type: 'POST',
            dataType: 'json',
            cache: false,
            processData: false,
            contentType: false,
            success: function (data) {
            },
        })

        $(this).parents('.img-div').remove();
    })

    ///////////////////////  function to add data  ////////////////////////////
    let formData = new FormData();

    function dataAjax() {

        const name = document.querySelector('#name').value;
        const description = document.querySelector('#description').value;
        const brand = document.querySelector('#brand').value;
        const price = document.querySelector('#price').value;

        formData.append('category_id', categoryValue);
        formData.append('name', name);
        formData.append('description', description);
        formData.append('brand', brand);
        formData.append('price', price);
        formData.append('sizeValue', sizeValue);
    }

    ///////////////////////  Create product  ////////////////////////////
    $('#create-button').on("click", function () {

        dataAjax();

        let newArrColor = document.querySelectorAll('.input-check');
        newArrColor.forEach(item => {
            if (item.checked) {
                formData.append('colorArr[]', +item.value);
            }
        })
        let imagesArr = inputArr.filter(function (el) {
            if (el != null) {
                return el;
            }
        });
        for(let i = 0; i < imagesArr.length;i++){
            formData.append('imagesArr[]', imagesArr[i]);
        }

        let images = document.querySelectorAll('.preview img')
        for (let i = 0; i < images.length; i++) {
            if (images[i].getAttribute('class') === 'img-style') {
                let data_id = images[i].getAttribute('data-id');
                isMain = data_id;
            }
        }
        formData.append('isMain', isMain);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/product/create/submit',
            type: 'POST',
            dataType: 'json',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function (data) {
                alert('Product creat successfully');
                location.reload();
            },
            error: function (data) {
                let errors = $.parseJSON(JSON.stringify(data));
                let errorData = errors['responseJSON']['errors'];
                let errorEm = document.querySelectorAll('.main em');

                $.each(errorData, function (key, value) {
                    for (let i = 0; i < errorEm.length; i++) {
                        if (errorEm[i].getAttribute('data-error') === key) {
                            errorEm[i].innerHTML = value;
                            errorEm[i].setAttribute('class', 'alert-danger');
                        }
                    }
                });
            }
        })
        formData.forEach(function(val, key, fD){
            formData.delete(key)
        });
    })


    ///////////////////////  Update product  ////////////////////////////
    $('#update-button').on("click", function () {

        let newArrColor = document.querySelectorAll('.input-check');
        newArrColor.forEach(item => {
            if (item.checked) {
                formData.append('colorArr[]', +item.value);
            }
        })
        let imagesArr = inputArr.filter(function (el) {
            if (el != null) {
                formData.append('imagesArr[]', el);
            }
        });

        let images = document.querySelectorAll('.preview img');
        images.forEach((elm, index) => {
            if (elm.getAttribute('class') === 'img-style') {
                isMain = index;
            }
        })
        formData.append('isMain', isMain);
        dataAjax();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: `/product/update/data/${productId}`,
            type: 'POST',
            dataType: 'json',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function () {
                alert('Product updated successfully');
                location.reload();
            },
            error: function (data) {

                let errors = $.parseJSON(JSON.stringify(data));

                if (errors['responseJSON']) {
                    let errorEm = document.querySelectorAll('.main em');

                    $.each(errors['responseJSON']['errors'], function (key, value) {
                        for (let i = 0; i < errorEm.length; i++) {
                            if (errorEm[i].getAttribute('data-error') === key) {
                                errorEm[i].innerHTML = value;
                                errorEm[i].setAttribute('class', 'alert-danger');
                            }
                        }
                    });
                }
            }
        })
    })
})
