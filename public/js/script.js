// jQuery(document).ready(function ($) {
//     let colorArr = [];
//     let productId = +$('.products').attr('data-product-id');
//     // console.log(productId)
//     // $('.color').on("click", function () {
//     //     let colorId = $(this).parents('.color-div').find('input');
//     //
//     //     if (colorId.is(':checked')) {
//     //        let id = +colorId.val()
//             // $.ajaxSetup({
//             //     headers: {
//             //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             //     }
//             // });
//             // $.ajax({
//             //     url: `/product/update/color/${productId}/${id}`,
//             //     type: 'POST',
//             //     dataType: 'json',
//             //     // data: productId,
//             //     cache: false,
//             //     processData: false,
//             //     contentType: false,
//             //     success: function (data) {
//             //     },
//             // })
//     //     }
//     // })
//
//     $('.products .color').on("click", function () {
//         $(this).attr('new-border');
//         $(this).toggleClass('new-border');
//
//         const a = $(this).parents('.color-div').find("input");
//         a.prop("checked", !a.prop("checked"));
//
//         if (a.prop("checked")) {
//             colorArr.push(+a.val());
//         } else {
//             colorArr = colorArr.filter(function (item, index, array) {
//                 if (item != a.val()) return true;
//             });
//         }
//     });
// ////////////////////////////////////////////////////
//     let categoryValue = $('#category').val();
//
//     if (categoryValue == null) {
//         categoryValue = '';
//     }
//     let sizeValue = $('#size').val();
//     if (sizeValue == null) {
//         sizeValue = '';
//     }
//
//     $("#category").change(function () {
//         categoryValue = $(this).val();
//     })
//
//     $('#size').change(function () {
//         sizeValue = $(this).val();
//     });
//
//     /////////////////////////////////////////////////////////
//
//     let inputArr = [];
//     let isMain = '';
//
//     let images = function (input, imgPreview) {
//
//         if (input.files) {
//             let filesAmount = input.files.length;
//             inputArr = [...input.files];
//
//             for (let i = 0; i < filesAmount; i++) {
//                 let reader = new FileReader();
//
//                 reader.addEventListener("load", function (event) {
//                     let imgDiv = $($.parseHTML("<div class='img-div'>"))
//                     $($.parseHTML("<i>")).html('x').appendTo(imgDiv);
//                     $($.parseHTML("<img>")).attr({
//                         'src': event.target.result,
//                         'data-id': i
//                     }).appendTo(imgDiv);
//                     imgDiv.appendTo(imgPreview);
//
//                     // Img choose main
//                     $('.preview img').on("click", function (event) {
//                         $('.preview img').attr('class', '');
//                         event.target.setAttribute('class', 'img-style');
//                     })
//
//                     // Img delete
//                     $('.preview i').on("click", function (event) {
//                         let a = $(this).parents('.img-div').find('img').attr('data-id');
//                         delete inputArr[a];
//                         $(this).parents('.img-div').remove();
//                     })
//
//                 })
//                 reader.readAsDataURL(input.files[i]);
//             }
//         }
//     };
//
//     $('#upload_images').on('change', function () {
//         images(this, '.preview');
//     });
//
//
// ////////////////////////
//
//     $('.preview i').on("click", function () {
//         let imageId = +$(this).parents('.img-div').find('img').attr('data-id');
//         $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         });
//         $.ajax({
//             url: `/product/delete/image/${imageId}`,
//             type: 'POST',
//             dataType: 'json',
//             cache: false,
//             processData: false,
//             contentType: false,
//             success: function (data) {
//             },
//         })
//
//         $(this).parents('.img-div').remove();
//     })
// //////////////////////////////////////////////////
//
//     let formData = new FormData();
//
//     function dataAjax() {
//         let name = document.querySelector('#name').value;
//         let description = document.querySelector('#description').value;
//         let brand = document.querySelector('#brand').value;
//         let price = document.querySelector('#price').value;
//         let imagesArr = inputArr.filter(function (el) {
//             if (el != null) {
//                 return el
//             }
//         });
//         let images = document.querySelectorAll('.preview img')
//         images.forEach(elm => {
//             if (elm.getAttribute('class') === 'img-style') {
//                 let data_id = +elm.getAttribute('data-id');
//                 isMain = data_id;
//             }
//         })
//
//         formData.append('category_id', categoryValue);
//         formData.append('name', name);
//         formData.append('description', description);
//         formData.append('brand', brand);
//         formData.append('price', price);
//         formData.append('sizeValue', sizeValue);
//         for (let i = 0; i < imagesArr.length; i++) {
//             formData.append('imagesArr[]', imagesArr[i]);
//         }
//     }
//
//     ////////////////////////////  create
//
//     $('#create-button').on("click", function () {
//
//         dataAjax();
//         for (let i = 0; i < colorArr.length; i++) {
//             formData.append('colorArr[]', colorArr[i]);
//         }
//         formData.append('isMain', isMain);
//
//         $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         });
//
//         $.ajax({
//             url: '/product/create/submit',
//             type: 'POST',
//             dataType: 'json',
//             data: formData,
//             cache: false,
//             processData: false,
//             contentType: false,
//             success: function (data) {
//                 console.log(data);
//             },
//             error: function (data) {
//                 let errors = $.parseJSON(JSON.stringify(data));
//                 let errorData = errors['responseJSON']['errors'];
//                 let errorEm = document.querySelectorAll('.main em');
//
//                 $.each(errorData, function (key, value) {
//                     for (let i = 0; i < errorEm.length; i++) {
//                         if (errorEm[i].getAttribute('data-error') === key) {
//                             errorEm[i].innerHTML = value;
//                             errorEm[i].setAttribute('class', 'alert-danger');
//                         }
//                     }
//                 });
//
//             }
//         })
//
//     })
//
//
//     ////////////////////////////////////////// edit
//     $('.preview img').on("click", function (event) {
//             $('.preview img').attr('class', '');
//             event.target.setAttribute('class', 'img-style');
//     })
//
//     $('#update-button').on("click", function () {
//
//         colorArr = [];
//         let newArrColor = document.querySelectorAll('.input-check');
//         newArrColor.forEach(item =>{
//             if (item.checked) {
//                 colorArr.push(+item.value);
//                 formData.append('colorArr[]', +item.value);
//             }
//         })
//         dataAjax();
//         if($('.preview img').attr('data-main') !== undefined){
//          isMain = '';
//         }
//         formData.append('isMain', isMain);
//         $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         });
//
//         $.ajax({
//             url: `/product/update/data/${productId}`,
//             type: 'POST',
//             dataType: 'json',
//             data: formData,
//             cache: false,
//             processData: false,
//             contentType: false,
//             success: function (data) {
//                 console.log(data);
//             },
//             error: function (data) {
//                 let errors = $.parseJSON(JSON.stringify(data));
//                 console.log(errors)
//                 // let errorData = errors['responseJSON']['errors'];
//                 let errorEm = document.querySelectorAll('.main em');
//                 // console.log(errorData)
//                 // $.each(errorData, function (key, value) {
//                     // for (let i = 0; i < errorEm.length; i++) {
//                     //     if (errorEm[i].getAttribute('data-error') === key) {
//                     //         errorEm[i].innerHTML = value;
//                     //         errorEm[i].setAttribute('class', 'alert-danger');
//                     //     }
//                     // }
//                 // });
//
//             }
//         })
//
//     })
//
//
// })
