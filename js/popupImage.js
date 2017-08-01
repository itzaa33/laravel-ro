
var modal;
var modalImg;
var span;

window.onload = function()
{
  // Get the modal
  modal = document.getElementById('myModal');
  modalImg = document.getElementById("myModalImage");

  // Get the <span> element that closes the modal
  span = document.getElementsByClassName("close")[0];

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
      modal.style.display = "none";
  }
}

function show(id)
{
  // Get the image and insert it inside the modal - use its "alt" text as a caption
  var img = document.getElementById(id);

   modal.style.display = "block";
   modalImg.src = img.src;
}
