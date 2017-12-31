$(document).ready(function()
{
	var visible = true;

	$("#menu-icon").click(function()
	{
		visible =! visible;
		if(visible)
		{
			$('#menu').animate({marginLeft: -200}, 'slow');
			$('#main').animate({marginLeft: 0}, 'slow');
			$('#menu-icon').removeClass('active');
		}
		else
		{
			$('#menu').animate({marginLeft: 0}, 'slow');
			$('#main').animate({marginLeft: 200}, 'slow');
			$('#menu-icon').addClass('active');
		}
	});
});