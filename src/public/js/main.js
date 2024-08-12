//search function(Menu2、Menu3)
// document.addEventListener('DOMContentLoaded', function() {
//     document.querySelectorAll('.search__option').forEach(function(element) {
//         element.addEventListener('change', function() {
//             document.querySelector('.search__form').submit();
//         });
//     });
// });


//image-preview(出品ページ)
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('imagePreview');
        output.src = reader.result;
        output.style.display = 'block';
    }
    reader.readAsDataURL(event.target.files[0]);
}



//favourite function
document.addEventListener('DOMContentLoaded', function() {
    const favouriteButtons = document.querySelectorAll('.shops-cards__favourite');

    favouriteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.dataset.userId;
            const shopId = this.dataset.shopId;
            const isFavourited = this.classList.contains('favourited');

            const url = isFavourited ? '/unfavourite' : '/favourite';

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    user_id: userId,
                    shop_id: shopId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.classList.toggle('favourited');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
