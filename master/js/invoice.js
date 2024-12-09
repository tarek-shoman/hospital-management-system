let date_time = new Date();
let td_age = document.getElementById('age');
let td_mob = document.getElementById('mobile');
let inp_date = document.getElementById('invoice-date');
let inp_time = document.getElementById('invoice-time');
let td_traet = document.getElementById('t-d');
let pat_select = document.getElementById('pat');

// invoice date
inp_date.value = `${date_time.getFullYear()}-${date_time.getMonth() + 1}-${date_time.getDate()}`;

// invoice time
let h = date_time.getHours();
if( h > 12 ){
    inp_time.value = `${h - 12}:${date_time.getMinutes()}:${date_time.getSeconds()} pm`;
}
else{
    inp_time.value = `${date_time.getHours()}:${date_time.getMinutes()}:${date_time.getSeconds()} am`;
}
/*********************************************/
////////////////////////////////////////////////////////////////////////////////
// get mobile BY AJAX
// function getMob(){
//     let patID = pat_select.value;
//     if( patID == "start" ){
//         td_mob.innerHTML = "";
//     }
//     else{
//         let dataRequest = new XMLHttpRequest;
//         dataRequest.onreadystatechange = function(){
//             if( this.readyState == 4 && this.status == 200 ){
//                 td_mob.innerHTML = this.responseText;
//             }
//         }
//         dataRequest.open("GET", "getmob.php?q="+patID, true);
//         dataRequest.send()
//     }
// }
// pat_select.addEventListener("change", getMob);

// get age BY AJAX
// function getAge(){
//     let patID = pat_select.value;
//     if( patID == "start" ){
//         td_age.innerHTML = "";
//     }
//     else{
//         let dataRequest = new XMLHttpRequest;
//         dataRequest.onreadystatechange = function(){
//             if( this.readyState == 4 && this.status == 200 ){
//                 td_age.innerHTML = this.responseText;
//             }
//         }
//         dataRequest.open("GET", "getage.php?q="+patID, true);
//         dataRequest.send()
//     }
// }
// pat_select.addEventListener("change", getAge);

// get treatment doctor BY AJAX
// function getTreat(){
//     let patID = pat_select.value;
//     if( patID == "start" ){
//         td_traet.innerHTML = "";
//     }
//     else{
//         let dataRequest = new XMLHttpRequest;
//         dataRequest.onreadystatechange = function(){
//             if( this.readyState == 4 && this.status == 200 ){
//                 td_traet.innerHTML = this.responseText;
//             }
//         }
//         dataRequest.open("GET", "gettreat.php?q="+patID, true);
//         dataRequest.send()
//     }
// }
// pat_select.addEventListener("change", getTreat);
//////////////////////////////////////////////////////////////////////

function get_pat_data(){
    let dataRequest = new XMLHttpRequest;
    let pat_select_value = pat_select.value;
    dataRequest.onreadystatechange = function(){
        if( this.readyState == 4 && this.status == 200 ){
            let json_txt = this.responseText;
            let pat_obj = JSON.parse(json_txt);
            if( pat_select_value == 'start' ){
                td_age.innerHTML = "";
                td_mob.innerHTML = "";
                td_treat.innerHTML = "";
            }
            else{
                td_age.innerHTML = pat_obj[pat_select_value].pat_age;
                td_mob.innerHTML = pat_obj[pat_select_value].pat_mob;
                td_traet.innerHTML = pat_obj[pat_select_value].treat_name;
            }
        }
    }
    dataRequest.open("GET", "pat.json", true);
    dataRequest.send();
}
pat_select.addEventListener("change", get_pat_data);

/********************** add row *****************/

let all_exam = document.querySelectorAll("tbody select");
let all_price = document.querySelectorAll(".p");
let all_discout = document.querySelectorAll(".d");
let all_amount = document.querySelectorAll(".a");
let invoice_total = document.getElementById("invoice-total");

function addRow(){

    let end_row = document.getElementById('end-row');
    let t_b = document.getElementsByTagName('tbody')[0];
    let examRequest = new XMLHttpRequest;
    examRequest.onreadystatechange = function(){
        if( this.readyState == 4 && this.status == 200 ){
            let exam_arr = JSON.parse(this.responseText);
            let exam_sel_lo = "";
            for( let x in exam_arr){
                exam_sel_lo += `<option value="${x}">${exam_arr[x]}</option>`
            }
            let tr_info = `
            <td colspan="2">
                <select name="exam[]">
                    <option value="start">Select Examination</option>
                    ${exam_sel_lo}
                </select>
                </td>
                <td>
                    <input type="number" name="price[]" class="p" value="0">
                </td>
                <td>
                    <input type="number" name="discount[]" class="d" value="0">
                </td>
                <td>
                    <input type="number" name="amount[]" class="a" readonly value="0">
            </td>`;
        
            let new_tr = document.createElement("tr");
        
            t_b.insertBefore(new_tr, end_row);
        
            new_tr.innerHTML = tr_info;
            
            all_exam = document.querySelectorAll("tbody select");
            all_price = document.querySelectorAll(".p");
            all_discout = document.querySelectorAll(".d");
            all_amount = document.querySelectorAll(".a");
            invoice_total = document.getElementById("invoice-total");

            for( let i = 0; i < all_exam.length; i++ ){
                all_exam[i].onchange = function(){
                    let examID = all_exam[i].value;
                    if( examID == "start" ){
                        all_price[i].value = 0;
                        all_discout[i].value = 0;
                        all_amount[i].value = 0;
                        all_exam[i].parentNode.parentNode.classList.remove('r-h');
                    }
                    else{
                        let dataRequest = new XMLHttpRequest;
                        dataRequest.onreadystatechange = function(){
                            if( this.readyState == 4 && this.status == 200 ){
                                all_price[i].value = this.responseText;
                                all_discout[i].value = 0;
                                all_amount[i].value = parseFloat(all_price[i].value) - parseFloat(all_discout[i].value);
                                let t = 0;
                                for( let a = 0; a < all_amount.length; a++ ){
                                    t += parseFloat(all_amount[a].value);
                                }
                                invoice_total.value = t;    
                            }
                        }
                        dataRequest.open("GET", "getprice.php?q="+examID, true);
                        dataRequest.send()
                        all_exam[i].parentNode.parentNode.classList.add('r-h');
                    }
                }
            }
            
            // calc amount after discount
            for( let i = 0; i < all_discout.length; i++ ){
                all_discout[i].onchange = function(){
                    all_amount[i].value = parseFloat(all_price[i].value) - parseFloat(all_discout[i].value);
                    let t = 0;
                    for( let a = 0; a < all_amount.length; a++ ){
                        t += parseFloat(all_amount[a].value);
                    }
                    invoice_total.value = t;    
            
                }
            }
        }
    }
    examRequest.open("GET", "exam.json", true);
    examRequest.send();

}

/************************************************/

// get exam price BY AJAX and calculate amount and total


for( let i = 0; i < all_exam.length; i++ ){
    all_exam[i].onchange = function(){
        let examID = all_exam[i].value;
        if( examID == "start" ){
            all_price[i].value = 0;
            all_discout[i].value = 0;
            all_amount[i].value = 0;
            all_exam[i].parentNode.parentNode.classList.remove('r-h');
        }
        else{
            let dataRequest = new XMLHttpRequest;
            dataRequest.onreadystatechange = function(){
                if( this.readyState == 4 && this.status == 200 ){
                    all_price[i].value = this.responseText;
                    all_discout[i].value = 0;
                    all_amount[i].value = parseFloat(all_price[i].value) - parseFloat(all_discout[i].value);
                    let t = 0;
                    for( let a = 0; a < all_amount.length; a++ ){
                        t += parseFloat(all_amount[a].value);
                    }
                    invoice_total.value = t;    
                }
            }
            dataRequest.open("GET", "getprice.php?q="+examID, true);
            dataRequest.send()
            all_exam[i].parentNode.parentNode.classList.add('r-h');
        }
    }
}

// calc amount after discount
for( let i = 0; i < all_discout.length; i++ ){
    all_discout[i].onchange = function(){
        all_amount[i].value = parseFloat(all_price[i].value) - parseFloat(all_discout[i].value);
        let t = 0;
        for( let a = 0; a < all_amount.length; a++ ){
            t += parseFloat(all_amount[a].value);
        }
        invoice_total.value = t;    

    }
}

document.getElementById('btn-print').onclick = function(){
    window.print();
}
