// document.querySelectorAll('.remove-item').forEach(function(item) {
//     item.addEventListener('click', function(e) {
//         var id = this.getAttribute('data-id');
//         var xhr = new XMLHttpRequest();
//         xhr.open('DELETE', "/cart/" + id);
//         xhr.setRequestHeader('Content-Type', 'application/json');
//         xhr.onload = function() {
//             if (xhr.status === 200) {
//                 console.log('Response:', xhr.responseText);
//                 var element = document.getElementById(id);
//                 if (element) {
//                     element.parentNode.remove(element);
//                     // element.parentNode.removeChild(element);
//                     console.log('Element removed successfully');
//                 }
//             } else {
//                 console.error('Error:', xhr.statusText);
//             }
//         };
//         xhr.onerror = function() {
//             console.error('Error:', xhr.statusText);
//         };
//         xhr.send(JSON.stringify({_token: csrf_token}));
//     });
// });


(function ($) {

    $('.item-quantity').on('change', function (e) {

        $.ajax({
            url: "/cart/" + $(this).data('id'),
            method:'put',
            data: {
                quantity: $(this).val(),
                _token: csrf_token
                
            }
        });
    });


    $('.remove-item').on('click', function (e) {
        let id = $(this).data('id');
        $.ajax({
            url: "cart/" + id,
            method: 'delete',
            data:{
                _token: csrf_token
            },
            success: function (response) {
                // console.log('Response:', response); // Log the response to check its format
                $('#' + response['tr']).remove();
                // console.log('Element removed successfully');
            },
            // error: function (xhr, status, error) {
            //     console.error(xhr.responseText);
            // }
        }); 
    });
    

})(jQuery);
