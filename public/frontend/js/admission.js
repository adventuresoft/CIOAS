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
	}else if(option=="divisionToDistrict"){
		// For present Address
		getValue(id,option,"#districtid",1);
		getValue(0,option,"#thanaid",2);
		getValue(0,option,"#postofficeid",3);
		getValue(0,option,"#localgovid",4);
	}else if(option=="districtToThana"){
		getValue(id,option,"#thanaid",1);
		getValue(0,option,"#postofficeid",2);
		getValue(0,option,"#localgovid",3);
	}else if(option=="thanaToPostofficeandlocalgov"){
		getValue(id,option,"#postofficeid",1);
		getValue(id,option,"#localgovid",2);
	}else if(option=="divisionToDistrict2"){
		// For Permanent Address
		getValue(id,option,"#districtid2",1);
		getValue(0,option,"#thanaid2",2);
		getValue(0,option,"#postofficeid2",3);
		getValue(0,option,"#localgovid2",4);
	}else if(option=="districtToThana2"){
		getValue(id,option,"#thanaid2",1);
		getValue(0,option,"#postofficeid2",2);
		getValue(0,option,"#localgovid2",3);
	}else if(option=="thanaToPostofficeandlocalgov2"){
		getValue(id,option,"#postofficeid2",1);
		getValue(id,option,"#localgovid2",2);
	}else if(option=="g_divisionToDistrict"){
		// For Guardian Address
		getValue(id,option,"#g_districtid",1);
		getValue(0,option,"#g_thanaid",2);
		getValue(0,option,"#g_postofficeid",3);
		getValue(0,option,"#g_localgovid",4);
	}else if(option=="g_districtToThana"){
		getValue(id,option,"#g_thanaid",1);
		getValue(0,option,"#g_postofficeid",2);
		getValue(0,option,"#g_localgovid",3);
	}else if(option=="g_thanaToPostofficeandlocalgov"){
		getValue(id,option,"#g_postofficeid",1);
		getValue(id,option,"#g_localgovid",2);
	}
}
function getValue(id,option,output,methodid){
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

function getChangeOnProgram(id,option,output,methodid){
  	var idvalue=$("#"+id).val();
	var programid=0;
	var groupid=0;
	$.ajax({
		type:'get',
		url: "http://localhost/school2019/public/admission/getValue",
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
		url: "http://localhost/school2019/public/admission/getValue",
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
		url: "http://localhost/school2019/public/admission/getValue",
		dataType: "html",
		data: {'programid':programid,'groupid':groupid,'idvalue':idvalue,'option':option,'methodid':methodid},
		success: function( result ) {
			$(output).empty().append(result);
		}
	});
}