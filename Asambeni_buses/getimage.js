document.addEventListener("DOMContentLoaded", function () {
    // Make an AJAX call to the PHP script
    fetch("getimage.php")
      .then(response => response.json())
      .then(data => displayImages(data.image_data))
      .catch(error => console.error("Error fetching image data:", error));
  });
  
  function displayImages(imageData) {
    // Get the image container element
    var imageContainer = document.getElementById("imageContainer"); 
  
    // Loop through the image data and create image elements
    for (var filename in imageData) {
      if (imageData.hasOwnProperty(filename)) {
        var imgElement = document.createElement("img");
        imgElement.src = "data:image/png;base64," + imageData[filename];
        imgElement.alt = filename;
        imgElement.className = "img-fluid";
        imageContainer.appendChild(imgElement);
      }
    }
  }
  