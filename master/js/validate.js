let form_elem = document.getElementById('form1');
let all_inputs_tags = document.querySelectorAll(".validate");
let validate_messages = document.querySelectorAll('.validate-message');
form_elem.onsubmit = function(event){
    for(let i = 0; i < all_inputs_tags.length; i++){
        let x = all_inputs_tags[i].value ;
        if( x == "" || x == null ){
            event.preventDefault();
            validate_messages[i].classList.remove("hide-show")
        }
        else{
            validate_messages[i].classList.add("hide-show")
        }
    }
}