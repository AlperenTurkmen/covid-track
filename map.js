map.onclick = function(e) {
    var ratioX = e.target.naturalWidth / e.target.offsetWidth;
    var ratioY = e.target.naturalHeight / e.target.offsetHeight;
  
    var domX = e.x + window.pageXOffset - e.target.offsetLeft;
    var domY = e.y + window.pageYOffset - e.target.offsetTop;
  
    var imgX = Math.round(domX * ratioX);
    var imgY = Math.round(domY * ratioY);
    document.getElementById("x").value = imgX ;
    document.getElementById("y").value = imgY;
 
 
    with(document.getElementById("marker"))
    {
         style.left = e.pageX-15+ 'px' ;
         style.top = e.pageY-30 + 'px';
         style.display = 'block';        
    }
     

  };
function checkCoordinates(){
  if(document.getElementById("x").value=='' || document.getElementById("y").value==''){
    alert('You should choose a point from the map!');
    
}
  }
  

function clearForm(){
    document.getElementById("form").reset();
    marker.style.display = 'none';
    
};

