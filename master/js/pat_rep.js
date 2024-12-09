let from_inp = document.getElementById('from');
let to_inp = document.getElementById('to');
let rep_res = document.getElementById('report-result');
function patRep(){
    let from_val = from_inp.value;
    let to_val = to_inp.value;
    if( from_val == "" || from_val == null ){
        rep_res.innerHTML = `<div class="error">Please insert from date to display report.</div>`
    }
    else if( to_val == "" || to_val == null  ){
        rep_res.innerHTML = `<div class="error">Please insert to date to display report.</div>`
    }
    else{
        let dateRequest = new XMLHttpRequest;
        dateRequest.onreadystatechange = function(){
            if( this.readyState == 4 && this.status == 200 ){
                rep_res.innerHTML = this.responseText;
            }
        }
        dateRequest.open("GET", "get_pat_rep.php?q_f=" + from_val + "&q_t=" + to_val, true);
        dateRequest.send();
    }
}
to_inp.addEventListener('change', patRep);


function mkPDF(){
    let pdf_content = document.getElementById('pdf-area');
    html2pdf(pdf_content);
}