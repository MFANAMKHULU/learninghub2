document.addEventListener("DOMContentLoaded", function () {
  // Make an AJAX call to the PHP script
  fetch("getimage.php")
      .then(response => response.json())
      .then(data => displayImages(data))
      .catch(error => console.error("Error fetching image data:", error));
});

function displayImages(imagePaths) {
  // Get the image container element
  var imageContainer = document.getElementById("image-container");

  // Loop through the image paths and create image elements
  imagePaths.forEach(imagePath => {
      var imgElement = document.createElement("img");
      imgElement.src = imagePath;
      imgElement.alt = "Bus Image";
      imgElement.className = "img-fluid";
      imageContainer.appendChild(imgElement);
  });
}
