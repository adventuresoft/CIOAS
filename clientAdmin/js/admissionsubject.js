function getChange(thisref,option){
	var id=thisref.getAttribute('id');
	if(option=="admissionsubjectgroup"){
		getChangeOnProgram(id,option,"#groupid",1);
		getChangeOnProgram(id,option,"#mediumid",2);
		getChangeOnProgram(id,option,"#shiftid",3);
	}else if(option=="admissionsubjectmedium"){
		getChangeOnGroup(id,option,"#mediumid",1);
		getChangeOnGroup(id,option,"#shiftid",2);
	}else if(option=="admissionsubjectshift"){
		getChangeOnMedium(id,option,"#shiftid",1);
	}
}
function getChangeOnProgram(id,option,output,methodid){
  	var idvalue=$("#"+id).val();
	var programid=0;
	var groupid=0;
	$.ajax({
		type:'get',
		url: "http://localhost/school2019/public/vadmissionsubject/getValue",
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
		url: "http://localhost/school2019/public/vadmissionsubject/getValue",
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
		url: "http://localhost/school2019/public/vadmissionsubject/getValue",
		dataType: "html",
		data: {'programid':programid,'groupid':groupid,'idvalue':idvalue,'option':option,'methodid':methodid},
		success: function( result ) {
			$(output).empty().append(result);
		}
	});
}