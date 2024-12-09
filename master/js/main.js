// rotate and show logout and change password
document.getElementById('set').onclick = function(){
    document.getElementById('sub-ul').classList.toggle("h-s");
    document.getElementById('icon-arrow').classList.toggle("ro");
}

// hide / show links
document.getElementById('go').onclick = function(){
    
    document.getElementById("page").classList.toggle("w-100");
    document.getElementById("icon").classList.toggle("w-none");
    let all_elem = document.getElementById('icon').children;

    for( let i = 0; i < all_elem.length; i++ ){
        all_elem[i].classList.toggle("h-s");
    }
}

// change act class 
let links_title = [
    "Dashboard",
    "Section",
    "Treatment Doctor",
    "Patient",
    "Job",
    "Department",
    "Employee",
    "Examination",
    "Invoice",
    "Item",
    "Cart",
    "Report"
];

let all_links = document.querySelectorAll("nav a");
let page_title = document.getElementsByClassName("page-title")[0];

for( let i = 0; i < all_links.length; i++ ){
    if( page_title.innerHTML.includes(links_title[i]) ){
        for( let a = 0; a < all_links.length; a++ ){
            all_links[a].classList.remove("act");
            all_links[i].classList.add("act");
        }
    }
}