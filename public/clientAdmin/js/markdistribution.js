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
		getChangeOnShift(id,option,"#output",1);
	}
}
function getChangeOnProgram(id,option,output,methodid){
	var programid=$("#"+id).val();
	var groupid=0;
	var mediumid=0;
	var shiftid=0;
	$.ajax({
		type:'get',
		url: "http://localhost/school2019/public/sectionoffer/getValue",
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
		url: "http://localhost/school2019/public/sectionoffer/getValue",
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
		url: "http://localhost/school2019/public/sectionoffer/getValue",
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
		url: "http://localhost/school2019/public/sectionoffer/getValue",
		dataType: "html",
		data: {'programid':programid,'groupid':groupid,'mediumid':mediumid,'shiftid':shiftid,'option':option,'methodid':methodid},
		success: function( result ) {
			$(output).empty().append(result);
		}
	});
}
// ========================Check box========================
let markcheckid=document.getElementById("markcheckid");
let markcheckClass=document.getElementsByClassName("markcheck");
function checkUncheck(){
	if(markcheckid.checked===true){
		for(let i=0;i<markcheckClass.length;i++){
			markcheckClass[i].checked=true;
		}
	}else{
		for(let i=0;i<markcheckClass.length;i++){
			markcheckClass[i].checked=false;
		}
	}
}
markcheckid.addEventListener("click",function(e){
	checkUncheck();
});
