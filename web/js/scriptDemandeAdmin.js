$(function(){
	var selectedClass = "";
	$(".cat").click(function(){
		selectedClass = $(this).attr("data-rel");

	$(".jContainerAdminDemande").fadeTo(100, 0.1);
		$(".all").not("."+selectedClass).fadeOut().removeClass('animation');
		setTimeout(function(){
			$("."+selectedClass).fadeIn().addClass('animation');
			$(".jContainerAdminDemande").fadeTo(300, 2);
		}, 300);
	});
});