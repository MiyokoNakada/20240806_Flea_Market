//image-preview(出品ページ、プロフィール編集ページ)
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
    const favouriteButtons = document.querySelectorAll('.favourite-icon');

    favouriteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.dataset.itemId;  
            const isFavourited = this.classList.contains('favourited'); 

            const url = isFavourited ? `/unfavourite/${itemId}` : `/favourite/${itemId}`;
            const method = isFavourited ? 'DELETE' : 'POST';

            fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                // お気に入り削除の場合に body を送信しない
                body: method === 'POST' ? JSON.stringify({ item_id: itemId }) : null
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.classList.toggle('favourited');
                    return fetch(`/favourite_count/${itemId}`);
                }
            })
            .then(response => response.json())
            .then(data => {
                const favouriteCountElement = document.querySelector(`#favourite-count-${itemId}`);
                if (favouriteCountElement) {
                    favouriteCountElement.textContent = data.count;
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});

