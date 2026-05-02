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
	}
}
function getChangeOnProgram(id,option,output,methodid){
  	var idvalue=$("#"+id).val();
	var programid=0;
	var groupid=0;
	$.ajax({
		type:'get',
		url: "http://localhost/school2019/public/admissionmarkentry/getValue",
		dataType: "html",
		data: {'programid':programid,'groupid':groupid,'idvalue':idvalue,'option':option,'methodid':methodid},
		success: function( result ) {
			$(output).empty().append(result);
		}
	});
}
function getChangeOnGroup(id,option,output,methodid){
	var idvalue=$("#"+id).val();
	var programid=$("#programid").val();
	var groupid=0;
	$.ajax({
		type:'get',
		url: "http://localhost/school2019/public/admissionmarkentry/getValue",
		dataType: "html",
		data: {'programid':programid,'groupid':groupid,'idvalue':idvalue,'option':option,'methodid':methodid},
		success: function( result ) {
			$(output).empty().append(result);
		}
	});
}
function getChangeOnMedium(id,option,output,methodid){
	var idvalue=$("#"+id).val();
	var programid=$("#programid").val();
	var groupid=$("#groupid").val();
	$.ajax({
		type:'get',
		url: "http://localhost/school2019/public/admissionmarkentry/getValue",
		dataType: "html",
		data: {'programid':programid,'groupid':groupid,'idvalue':idvalue,'option':option,'methodid':methodid},
		success: function( result ) {
			$(output).empty().append(result);
		}
	});
}
// ================================================
let admissionmark=document.getElementById("admissionmark");
if(admissionmark!=null){
let trarray=admissionmark.children[1].getElementsByTagName("tr");
let subjectmarks=document.getElementsByClassName("subjectmarks");
for(var tr of trarray){
	var tdarray=tr.children;
	var tdclass;
	for(var td of tdarray){
		if(td.getAttribute("class")!=null){
			tdclass=td.getAttribute("class");
		}
	}
	let markfield=document.getElementsByClassName(tdclass);
	let duplicate=[];
	for (let x=0;x<markfield.length-1;x++) {
		duplicate.push(markfield[x].children[0].value);
	}
	for(let x=0;x<markfield.length-1;x++){
		markfield[x].children[0].addEventListener("keyup",function(e){
			if(markfield[x].children[0].value!=""){
				if (parseInt(markfield[x].children[0].value)>parseInt(subjectmarks[x].innerHTML)) {
					markfield[x].children[0].value=duplicate[x];
					confirm("Input must be less than or equil : "+subjectmarks[x].innerHTML);
				}
			}
			let sum=0;
			for(let i=0;i<markfield.length-1;i++){
				if(markfield[i].children[0].value!=""){
					sum=parseInt(sum)+parseInt(markfield[i].children[0].value);
					markfield[markfield.length-1].children[0].innerHTML=sum;
				}else{
					sum=parseInt(sum)+0;
					markfield[markfield.length-1].children[0].innerHTML=sum;
				}
			}
		});
	}
}

// for chekbox
let markcheckid=document.getElementById("markcheck");
let markcheckClass=document.getElementsByClassName("markcheck");
markcheckid.addEventListener("click",function(e){
	if(markcheckid.checked===true){
		for(let i=0;i<markcheckClass.length;i++){
			markcheckClass[i].checked=true;
		}
	}else{
		for(let i=0;i<markcheckClass.length;i++){
			markcheckClass[i].checked=false;
		}
	}
	
});
}