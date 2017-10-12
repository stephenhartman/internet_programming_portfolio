function showOrigin(input) {
    if (input == "") {
        document.getElementById("output").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("output").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET","output.php?q=" + input, true);
        xmlhttp.send();
    }
}
function modifyRecord(){
		document.table.action = "modify.php";
		document.table.submit();
	}
	
function deleteRecord(){
	document.table.action = "delete.php";
	document.table.submit();
}