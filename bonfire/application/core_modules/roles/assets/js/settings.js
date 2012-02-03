$('#permission_table').tableHover({colClass: 'hover', ignoreCols: [1]}); 


$('#permission_table input:checkbox').change(function() {
	$('#permission_table_result').removeClass();
	$('#permission_table_result').addClass('notification');
	$('#permission_table_result').addClass('information');
	var val = $(this).attr('value');
	var what = $(this).is(':checked');
	var r_name = $(this).closest('td').attr('title');
	var p_name = $(this).closest('tr').attr('title');
	$.post(window.g_url +"/",
			{ "role_perm": val, "action": what }, function(data) {
				var newtext = data.replace(/g_permission/i, '"'+p_name+'"');
				newtext = newtext.replace(/g_role/i, '"'+r_name+'" role');
				if (newtext.search(':') >= 1) {
					$('#permission_table_result').removeClass('information');
					$('#permission_table_result').addClass('attention');
				} else {
					$('#permission_table_result').addClass('success');
				}
				$('#permission_table_result').text(newtext);
			});
});

// Horizontal Check-all
$('.matrix-title a').click(function(){
	var rows 		= $(this).parents('tr');
	var checked 	= false;
	var found		= false;
	var checkbox	= false;
	
	for (i=0; i < rows.length; i++)
	{
	
		checkbox = $(rows[i]).find(":checkbox");
		
		if(!found && checkbox.length > 0){
			found=true;
			checked = $(checkbox).attr('checked');
		}
		if(checked) {
			checkbox.removeAttr('checked');
		}
		else
		{
			checkbox.attr('checked','checked');
		}
	}
	
	return false;
});

//--------------------------------------------------------------------

// Vertical Check All
$('.matrix th a').click(function(){
	var rows 		= $(this).parents('table').find('tbody tr');;
	var checked 	= false;
	var found		= false;
	var checkbox	= false;
	var columnIndex	= $(this).parent('th').attr('cellIndex');
			
	for (i=0; i < rows.length; i++)
	{
		checkbox = $(rows[i]).find('td:eq('+(columnIndex)+')').find(":checkbox");
		
		if(!found && checkbox.length > 0){
			found=true;
			checked = $(checkbox).attr('checked');
		}
		if(checked) {
			checkbox.removeAttr('checked');
		}
		else
		{
			checkbox.attr('checked','checked');
		}
	}
	
	return false;
});

//--------------------------------------------------------------------
	
