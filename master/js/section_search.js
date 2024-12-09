let inp_search = document.getElementById("section");
let result = document.getElementById('search-result');

inp_search.onkeyup = function(){
    let inp_value = inp_search.value;
    let dataRequest = new XMLHttpRequest;

    dataRequest.onreadystatechange = function(){
        if( this.readyState == 4 && this.status == 200 ){
            result.innerHTML = this.responseText;
        }
    }

    dataRequest.open("GET", "sec_search.php?q=" + inp_value, true);
    dataRequest.send();
}