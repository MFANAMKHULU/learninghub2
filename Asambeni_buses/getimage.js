// getimage.js
document.addEventListener("DOMContentLoaded", function () {
    // Fetch image filenames from the PHP script
    fetch('getimage.php')
        .then(response => response.json())
        .then(data => {
            // Get the container element with the correct ID
            const imageContainer = document.getElementById('imageContainer');

            // Create img elements and append them to the container
            data.image_filenames.forEach(filename => {
                const img = document.createElement('img');
                img.src = 'Asmabeni_buses/images/' + filename;
                img.alt = 'Bus Image';
                imageContainer.appendChild(img);

                const br = document.createElement('br');
                imageContainer.appendChild(br);
            });
        })
        .catch(error => console.error('Error fetching images:', error));
});
