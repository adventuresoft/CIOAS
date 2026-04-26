
function getChange(thisref,option){
	var id=thisref.getAttribute('id');
	if(option=="programtogroup"){
		getValue(id,option,"#groupid",1);
	}else if(option=="admissiongroup"){
		getValue(id,option,"#groupid",1);
	}else if(option=="RcreatorToRole"){
		getValue(id,option,"#output",1);
	}else if(option=="editRcreatorToRole"){
		getValueWith(id,option,"#output",1);
	}else if(option=="divisionToDistrict"){
		getAddress(id,option,"#districtid",1);
		getAddress(0,option,"#thanaid",2);
		getAddress(0,option,"#postofficeid",3);
		getAddress(0,option,"#localgovid",4);
	}else if(option=="districtToThana"){
		getAddress(id,option,"#thanaid",1);
		getAddress(0,option,"#postofficeid",2);
		getAddress(0,option,"#localgovid",3);
	}else if(option=="thanaToPostofficeandlocalgov"){
		getAddress(id,option,"#postofficeid",1);
		getAddress(id,option,"#localgovid",2);
	}
}
function getValue(id,option,output,methodid){
	var idvalue=$("#"+id).val();
	$.ajax({
		type:'get',
		url: "http://localhost/school2019/public/getValue",
		dataType: "html",
		data: {'idvalue':idvalue,'option':option,'methodid':methodid},
		success: function( result ) {
			// console.log(result);
			$(output).empty().append(result);
		}
	});
}
function getValueWith(id,option,output,methodid){
	var idvalue=$("#"+id).val();
	var id=$("#id").val();
	$.ajax({
		type:'get',
		url: "http://localhost/school2019/public/getValueWith",
		dataType: "html",
		data: {'idvalue':idvalue,'id':id,'option':option,'methodid':methodid},
		success: function( result ) {
			$(output).empty().append(result);
		}
	});
}
// for Address 
function getAddress(id,option,output,methodid){
	var idvalue=$("#"+id).val();
	$.ajax({
		type:'get',
		url: "http://localhost/school2019/public/getFValue",
		dataType: "html",
		data: {'idvalue':idvalue,'option':option,'methodid':methodid},
		success: function( result ) {
			// console.log(result);
			$(output).empty().append(result);
		}
	});
}
// ===================================================
function getChangeForAdmission(thisref,option){
	var id=thisref.getAttribute('id');
	if(option=="vprogramtogroup"){
		getValueForAdmission(id,option,"#groupid",1);
		getValueForAdmission(id,option,"#mediumid",2);
		getValueForAdmission(id,option,"#shiftid",3);
	}else if(option=="vgrouptomedium"){
		getValueForMedium(id,option,"#mediumid",1);
		getValueForMedium(id,option,"#shiftid",2);
	}else if(option=="vmediumtoshift"){
		getValueForShift(id,option,"#shiftid",1);
	}
}
function getValueForAdmission(id,option,output,methodid){
	var idvalue=$("#"+id).val();
	$.ajax({
		type:'get',
		url: "http://localhost/school2019/public/getFValue",
		dataType: "html",
		data: {'idvalue':idvalue,'option':option,'methodid':methodid},
		success: function( result ) {
			// console.log(result);
			$(output).empty().append(result);
		}
	});
}
function getValueForMedium(id,option,output,methodid){
	var idvalue=$("#"+id).val();
	var programid=$("#programid").val();
	$.ajax({
		type:'get',
		url: "http://localhost/school2019/public/getValueForMedium",
		dataType: "html",
		data: {'programid':programid,'idvalue':idvalue,'option':option,'methodid':methodid},
		success: function( result ) {
			$(output).empty().append(result);
		}
	});
}
function getValueForShift(id,option,output,methodid){
	var idvalue=$("#"+id).val();
	var programid=$("#programid").val();
	var groupid=$("#groupid").val();
	// console.log(programid+" "+groupid+" "+idvalue);
	$.ajax({
		type:'get',
		url: "http://localhost/school2019/public/getValueForShift",
		dataType: "html",
		data: {'programid':programid,'groupid':groupid,'idvalue':idvalue,'option':option,'methodid':methodid},
		success: function( result ) {
			// console.log(result);
			$(output).empty().append(result);
		}
	});
}
/////////////////////////////