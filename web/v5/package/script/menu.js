$(document).ready
(
	function()
	{
		var id = location.href.split("&id=")[1];
		var page = location.href.split("page=")[1].split("&")[0];
		var view = location.href.split("?")[1];
		var arr = $('.m_'+page).attr('class');
		var css = "bc_pri fc_white";
		if ( arr.indexOf('expand') > -1 )
		{
			$('.expand-list-' + page).show();
			$('a[href="./?' + view + '"]').addClass(css);
			if ( page == "station" )
			{			
				$('a[href="./?page=station&id='+id+'"]').addClass(css);
			}
		}
		else
		{
			$('.m_'+page).addClass('active ' + css);
		}
	}
);

function expand(target)
{
	var x = '.expand-list-' + target;
	$(x).slideToggle('fast');
}