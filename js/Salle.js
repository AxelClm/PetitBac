function getUpdatedSalle() {
	var xhr = new XMLHttpRequest();
        xhr.open('GET','redirection.php?getPublicSalles=',true);
        xhr.addEventListener('readystatechange', function () {
            if((xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200)){
               console.log(xhr.responseText);
            }});
        xhr.send();
}