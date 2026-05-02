function createMessage(isTrue,messageType,message){
    this.isTrue=isTrue;
    this.messageType=messageType;
    this.message=message;
}
function validate(){
    let inputfiles = document.querySelectorAll('input[type="file"]');
    let data=[];
    inputfiles.forEach(function(item,index){
        if(item.files.length!=0){
             if(item.files[0].size>item.dataset.size){
                //  Block 2
                let isTrue=true;
                let messageType=2;
                let message=item.previousElementSibling.innerHTML+" should be less than "+(Math.round((item.dataset.size)/1024))+"KB";
                data.push(new createMessage(isTrue,messageType,message));
             }
            //  else{
            //     //  Block 3
            //     var _URL = window.URL || window.webkitURL;
            //     let img = new Image();
            //     img.src=_URL.createObjectURL(item.files[0]);
            //     img.onload=function(){
            //         if(this.width>item.dataset.width && this.height>item.dataset.height){
            //             let isTrue=true;
            //             let messageType=3;
            //             let message=item.previousElementSibling.innerHTML+" Width and height should be ("+item.dataset.width+"*"+item.dataset.height+")";
            //             data.push(new createMessage(isTrue,messageType,message));
            //             console.log(data);
            //         }
            //     }
            //  }
        }else{
            // block 1
            let isTrue=true;
            let messageType=1;
            let message="Select "+item.previousElementSibling.innerHTML;
            data.push(new createMessage(isTrue,messageType,message));
        }
    });
    if(data.length>0){
        confirm(data[0].message);
        return false;
    }
    // console.log(data);
    return true;
}

function validateForm(){
    let picture=document.getElementById('picture');
    if(picture.files.length!=0){
        let fileSize = picture.files[0].size;
        let x="";
        if(fileSize>19046.4){
            x=" your Picture too learge";
            confirm(x);
            picture.value="";
            return false;
        }else{
            return true;
        }
    }else{
        x="Select picture";
        confirm(x);
        return false;
    }
}
let education=document.getElementById('education');
let tbody=document.getElementById('tbody');
let hiddenContent=document.getElementById('hiddenContent');
let content="";
education.addEventListener('click',function(){
    content=content+hiddenContent.innerHTML;
    tbody.innerHTML=content;
    for(let tr of tbody.children){
        for(let td of tr.children){
            if(td.children[0].nodeName=='SPAN')
            td.children[0].addEventListener('click',function(){
                let deleterow=this.parentNode.parentNode;
                deleterow.parentNode.removeChild(deleterow);
                content=tbody.innerHTML;
            });
        }
    }
});









// ==========================

// $(document).ready(function(){
//     $(document).on("click", "#education", function() {
//         $("#rowparent").append($("#hiddenContent").html());
//     });
//     $(document).on("click", "#rowparent tr td span", function() {
//         $(this).parents("tr").remove();
//     });
// });
