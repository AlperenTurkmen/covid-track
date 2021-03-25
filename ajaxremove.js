function removeRecord(id) {
    
    if (id.length == 0) {
        return;
      } else {
        
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            //document.getElementById("txtHint").innerText = this.responseText;
            alert(this.responseText + " record Deleted. ");
            location.reload(); 
            
          }
        };
        
        xmlhttp.open("GET", "deletevisit.php?id=" + id, true); 
        xmlhttp.send();
        
      }

}