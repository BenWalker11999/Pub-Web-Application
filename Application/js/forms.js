/*These functions are used on the add pub page, if a user wants to add another live sports channel or sports facility for a pub they can click a button and a new select field will appear on the form,
these functions hide buttons and show new buttons and fields, a user can add up to 3 live sports channels and 4 sports facilities */
$(document).ready(function(){
	$("#livesportsadd").click(function(){
		$('#livesportschannelb').css('display','block');
		$('#livesportsadd').css('display','none');
		$('#livesportsadd2').css('display','block');
	});
	$("#livesportsadd2").click(function(){
		$('#livesportschannelc').css('display','block');
		$('#livesportsadd2').css('display','none');
	});
	$("#sportsfacilityadd").click(function(){
		$('#sportsfacilitiesb').css('display','block');
		$('#sportsfacilityadd').css('display','none');
		$('#sportsfacilityadd2').css('display','block');
	});
	$("#sportsfacilityadd2").click(function(){
		$('#sportsfacilitiesc').css('display','block');
		$('#sportsfacilityadd2').css('display','none');
		$('#sportsfacilityadd3').css('display','block');
	});
	$("#sportsfacilityadd3").click(function(){
		$('#sportsfacilitiesd').css('display','block');
		$('#sportsfacilityadd3').css('display','none');
	});
});

	