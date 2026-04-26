function getChange(thisref,option){
	var id=thisref.getAttribute('id');
	if(option=="program"){
		getChangeOnProgram(id,option,"#groupid",1);
		getChangeOnProgram(id,option,"#mediumid",2);
        getChangeOnProgram(id,option,"#shiftid",3);
	}else if(option=="group"){
		getChangeOnGroup(id,option,"#mediumid",1);
        getChangeOnGroup(id,option,"#shiftid",2);
	}else if(option=="medium"){
        getChangeOnMedium(id,option,"#shiftid",1);
	}else if(option=="shift"){
        getChangeOnShift(id,option,"#firstsubjectcodeid",1);
        getChangeOnShift(id,option,"#secondsubjectcodeid",2);
    }
}
function getChangeOnProgram(id,option,output,methodid){
	var programid=$("#"+id).val();
    var groupid=0;
	var mediumid=0;
	var shiftid=0;
	$.ajax({
		type:'get',
		url: "http://localhost/school2019/public/courseoffercreate/getValue",
		dataType: "html",
		data: {'programid':programid,'groupid':groupid,'mediumid':mediumid,'shiftid':shiftid,'option':option,'methodid':methodid},
		success: function( result ) {
			$(output).empty().append(result);
		}
	});
}
function getChangeOnGroup(id,option,output,methodid){
	var programid=$("#programid").val();
    var groupid=$("#"+id).val();
	var mediumid=0;
	var shiftid=0;
	$.ajax({
		type:'get',
		url: "http://localhost/school2019/public/courseoffercreate/getValue",
		dataType: "html",
		data: {'programid':programid,'groupid':groupid,'mediumid':mediumid,'shiftid':shiftid,'option':option,'methodid':methodid},
		success: function( result ) {
			$(output).empty().append(result);
		}
	});
}
function getChangeOnMedium(id,option,output,methodid){
	var programid=$("#programid").val();
    var groupid=$("#groupid").val();
	var mediumid=$("#"+id).val();
	var shiftid=0;
	$.ajax({
		type:'get',
		url: "http://localhost/school2019/public/courseoffercreate/getValue",
		dataType: "html",
		data: {'programid':programid,'groupid':groupid,'mediumid':mediumid,'shiftid':shiftid,'option':option,'methodid':methodid},
		success: function( result ) {
			$(output).empty().append(result);
		}
	});
}
function getChangeOnShift(id,option,output,methodid){
	var programid=$("#programid").val();
    var groupid=$("#groupid").val();
	var mediumid=$("#mediumid").val();
	var shiftid=$("#"+id).val();
	$.ajax({
		type:'get',
		url: "http://localhost/school2019/public/courseoffercreate/getValue",
		dataType: "html",
		data: {'programid':programid,'groupid':groupid,'mediumid':mediumid,'shiftid':shiftid,'option':option,'methodid':methodid},
		success: function( result ) {
			$(output).empty().append(result);
		}
	});
}
/////////////////////////////

// ========================Courseoffer Check box========================
let admissionmark=document.getElementById("courseoffer");
if(admissionmark!=null){
// for chekbox
let markcheckid=document.getElementById("markcheckid");
let markcheckClass=document.getElementsByClassName("markcheck");
function disableOrEnable(){
	if(markcheckid.checked===true){
		for(let i=0;i<markcheckClass.length;i++){
			markcheckClass[i].checked=true;
			rowToggle(markcheckClass[i]);
		}
	}else{
		for(let i=0;i<markcheckClass.length;i++){
			markcheckClass[i].checked=false;
			rowToggle(markcheckClass[i]);
		}
	}
}
disableOrEnable();
markcheckid.addEventListener("click",function(e){
	disableOrEnable();
});

let chechdid=1;
let uncheckid=1;
function rowToggle(thisref){
	let list=[];
	if(thisref.checked){
		let tdcollection=thisref.parentNode.parentNode.children;
		Array.from(tdcollection).forEach(item => {
			let inputList=item.getElementsByTagName('input');
			let selectList=item.getElementsByTagName('select');
			if(inputList.length>0)
			for(let input of inputList){
				if(input.getAttribute('type')=='text'|| input.getAttribute('type')=='hidden')
				list.push(input);
			}
			for(let select of selectList){
				list.push(select);
			}
		});
		for(let x of list){
			x.disabled=false;
			// console.log(x);
		}
	}else{
		let tdcollection=thisref.parentNode.parentNode.children;
		Array.from(tdcollection).forEach(item => {
			let inputList=item.getElementsByTagName('input');
			let selectList=item.getElementsByTagName('select');
			if(inputList.length>0)
			for(let input of inputList){
				if(input.getAttribute('type')=='text'|| input.getAttribute('type')=='hidden')
				list.push(input);
			}
			for(let select of selectList){
				list.push(select);
			}
		});
		for(let x of list){
			x.disabled=true;
			// console.log(x);
		}
	}
}
function markCheckAction(){
	for(let i=0;i<markcheckClass.length;i++){
		markcheckClass[i].addEventListener("click",function(){
			rowToggle(this);
		});
	}
}
markCheckAction();
}
// ========================Secrion offer And teacher Assign ========================
// let sectionofferbtn=document.getElementById('sectionofferbtn');
// let tbody=document.getElementById('tbody');
// let content=tbody.innerHTML;
// sectionofferbtn.addEventListener('click',function(){
// 	actionOn(true);
// });
// function actionOn(isTrue){
// 	if(isTrue){
// 		tbody.innerHTML+=content;
// 	}
// 	for(let tr of tbody.children){
//         for(let td of tr.children){
//             if(td.children[0].nodeName=='SPAN')
//             td.children[0].addEventListener('click',function(){
// 				if(tbody.children.length>1){
// 					let deleterow=this.parentNode.parentNode;
// 					deleterow.parentNode.removeChild(deleterow);
// 					content=tbody.innerHTML;
// 				}
//             });
//         }
//     }
// }
// actionOn(false);