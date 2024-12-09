let all_add = document.querySelectorAll(".add-cart");
let all_id = document.querySelectorAll(".p-id");

for( let i = 0; i < all_add.length; i++ ){
    all_add[i].onclick = function(){
        let inp_val = all_id[i].value;
        let dataRequest = new XMLHttpRequest;
        dataRequest.onreadystatechange = function(){
            if( this.readyState == 4 && this.status == 200 ){
                document.getElementById('cart-result').innerHTML = this.responseText;
            }
        }
        dataRequest.open("GET", "add_cart.php?q=" + inp_val, true);
        dataRequest.send();
    }
}