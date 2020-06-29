var pictureIndex = 0;
showPicture(pictureIndex);

function currentPicture(n) {
  showPicture(pictureIndex = n);
}

function showPicture(n) {
  var i;
  var picture = document.getElementsByClassName("picture");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < picture.length; i++) {
      picture[i].style.display = "none";  
  }
  pictureIndex++;
  if (pictureIndex>picture.length) {pictureIndex=1}
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  picture[pictureIndex-1].style.display = "block";  
  dots[pictureIndex-1].className += " active";
  
}