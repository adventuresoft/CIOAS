function txtChange(thisPointer) {
    var isChecked = document.getElementById("isChecked");
    var presentaddresstxt = thisPointer.value;
    var permanentaddress = document.getElementById("address2");
    if (isChecked.checked == true) {
        permanentaddress.value = presentaddresstxt;
    }
}

function check(thisPointer) {
    // Present address field Id
    var devisionid=document.getElementById("divisionid");
    var districtid=document.getElementById("districtid");
    var thanaid=document.getElementById("thanaid");
    var postofficeid=document.getElementById("postofficeid");
    var localgovid=document.getElementById("localgovid");
    var presentaddress = document.getElementById("address");
    var presentaddresstxt = presentaddress.value;
    // Permanent Address Field Id
    var permanentaddress = document.getElementById("address2");
    var devisionid2=document.getElementById("devisionid2");
    var districtid2=document.getElementById("districtid2");
    var thanaid2=document.getElementById("thanaid2");
    var postofficeid2=document.getElementById("postofficeid2");
    var localgovid2=document.getElementById("localgovid2");
    if (thisPointer.checked == true) {
        devisionid2.disabled=true;
        devisionid2.value=devisionid.value;
        districtid2.disabled=true;
        districtid2.value=districtid.value;
        thanaid2.disabled=true;
        thanaid2.value=thanaid.value;
        postofficeid2.disabled=true;
        postofficeid2.value=postofficeid2.value;
        localgovid2.disabled=true;
        localgovid2.value=localgovid.value;
        // console.log(localgovid.value);
        permanentaddress.value = presentaddresstxt;
        permanentaddress.disabled=true;
    } else {
        permanentaddress.value = "";
        permanentaddress.disabled=false;
        devisionid2.disabled=false;
        districtid2.disabled=false;
        thanaid2.disabled=false;
        postofficeid2.disabled=false;
        localgovid2.disabled=false;
    }
}

//Miltiple Step From

// var currentTab = 0;
// showTab(currentTab);
// function showTab(n) {
//     var x = document.getElementsByClassName("formsegment");
//     x[n].style.display = "block";
//     if (n == 0) {
//         document.getElementById("prevBtn").style.display = "none";
//     } else {
//         document.getElementById("prevBtn").style.display = "inline";
//     }
//     if (n == (x.length - 1)) {
//         document.getElementById("nextBtn").innerHTML = "Submit";
//     } else {
//         document.getElementById("nextBtn").innerHTML = "Next";
//     }
// }

// function nextPrev(n) {
//     var x = document.getElementsByClassName("formsegment");
//     x[currentTab].style.display = "none";
//     currentTab = currentTab + n;
//     // console.log(n);
//     // console.log("Current form segment :" + currentTab);
//     // console.log("Total form segment :" + x.length);
//     if (currentTab >= x.length) {
//         document.getElementById("regForm").submit();
//         return false;
//     }
//     showTab(currentTab);
// }
function agecalculate(thisref){
    // var id=thisref.getAttribute('id');
    // var value=$("#"+id).val();
    // var age=$('#age');
    // var d = new Date();
    // console.log(d);
}
