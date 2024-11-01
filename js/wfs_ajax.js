jQuery(document).ready(function($)
{	
	// events
	if($('#wfsApplyDefault'))
	{
		$('#wfsApplyDefault').unbind('click');
		$('#wfsApplyDefault').bind('click', function()
		{  
			if($('#wfsDemoFolderSaved').text() == '')
			{
				alert('Demo folder must be not blank.');
				return;
			}
			
			if (confirm('Do you want to copy default files to demo folder?', 'Copy'))   
				wfsEasyDemoWebsiteAjax.applyDefault(); 
		});
	}
	
	if($('#wfsSaveSetting'))
	{
		$('#wfsSaveSetting').unbind('click');
		$('#wfsSaveSetting').bind('click', function()
		{
			demoFolder = $('#wfsDemoFolder').val().trim();
			demoMenu = $('#wfsDemoMenu').val().trim();
			demoLogo = $('#wfsDemoLogo').val().trim();
			demoLogoLink = $('#wfsDemoLogoLink').val().trim();
			demoCustomField = $('#wfsDemoCustomField').val().trim();
			demoGoogleAnalytics = $('#wfsDemoGoogleAnalytics').val().trim();
			
			if(demoFolder.trim() == '' || demoMenu.trim() == '')
			{
				alert('Please enter the required fileds.')
				return;
			}			
			if(demoFolder == 'wp-admin' || demoFolder == 'wp-content' || demoFolder == 'wp-includes')
			{
				alert("Folder name must be different wordpress's folders.");
				return;
			}
			
			successFunc = function()
			{ 
				$('#wfsDemoFolderSaved').html(demoFolder);
				//
				$('#wfsDemoURL').attr('href', $('#wfsDemoURL').attr('wp_url')+'/'+demoFolder)
					.text($('#wfsDemoURL').attr('wp_url')+'/'+demoFolder);
			};
			wfsEasyDemoWebsiteAjax.saveSetting(demoFolder, demoMenu, demoLogo, demoLogoLink, demoCustomField, demoGoogleAnalytics, successFunc);
		});
	}
	
	// ajax object
	var wfsEasyDemoWebsiteAjax = 
	{
		applyDefault: function()
		{
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: myAjax.ajaxUrl,
				data: {
					action: 'apply_wfs_easy_demo_website'
				},			
				success: function(data)
				{  
					if(data == 'access_denined')
						alert('Access denined.')
					else if(data == true) 
						alert('Applying successfully.'); 
					else
						alert('There has a problem when applying.');
				},
				error: function(errorThrown){
					alert(errorThrown.responseText);
				}
			}); 
		},
		
		saveSetting:function(demoFolder, demoMenu, demoLogo, demoLogoLink, demoCustomField, demoGoogleAnalytics, successFunc)
		{
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: myAjax.ajaxUrl,
				data: {
					action: 'save_wfs_easy_demo_website',
					demo_folder: demoFolder,
					demo_menu: demoMenu,
					demo_logo: demoLogo,
					demo_logo_link: demoLogoLink,
					demo_custom_field: demoCustomField,
					demo_google_analytics: demoGoogleAnalytics
				},			
				success: function(data)
				{  
					if(data == 'access_denined')
						alert('Access denined.')
					else if(data == true)
					{	
						successFunc();
						alert('Saveing successfully.');						
					}
					else
						alert('There has a problem when saving.');
				},
				error: function(errorThrown){
					alert(errorThrown.responseText);
				}
			});
		}
	}
});

