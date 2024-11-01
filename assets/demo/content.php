<?php
require_once(ABSPATH.'/wp-content/plugins/wfs_easy_demo_website/functions.php'); 

function megaMenu($menuName, $optionArr)
{
	/*
		$optionArr[0]: logo url,
		$optionArr[1]: home url
	*/
	
	$menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );

	foreach ( $menus as $menu )
	{
		if($menu->name == $menuName)
		{
			$menu_items = wp_get_nav_menu_items($menu->term_id);
			//
			$levelSize = 99;
			$levelIdArr = array();
			for($i=0; $i<$levelSize; $i++)
				array_push($levelIdArr, 0);
				
			//
			$curLevel = 0;
			$prevLevel = 0;
			$liNeedClose = false;
		
			$menu_list = '<ul id="menu-' . $menuName . '" class="wfs_main_menu">';

			foreach ( (array) $menu_items as $menu_item ) 
			{   			
				$levelID = $menu_item->menu_item_parent;
				
				$newLevel = true;
				for($i=$curLevel; $i>=0; $i--)
				{
					if($levelID == $levelIdArr[$i])
					{
						$prevLevel = $curLevel; 
						
						$curLevel = $i;
						$newLevel = false;
						break;
					}
				}
				
				if($newLevel && $curLevel < $levelSize - 1) 
				{
					$prevLevel = $curLevel; 
					
					$curLevel++; 
					$levelIdArr[$curLevel] = $levelID;
				}  
				
				if($prevLevel == $curLevel)
				{	
					if($liNeedClose) 	
						$menu_list .= '</li>';	 
					
					$menu_list .= '<li>';
					$liNeedClose = true;
				}
				if($prevLevel < $curLevel)
				{
					if($prevLevel == 0)
						$menu_list .= '<ul class="wfs_first_sub_menu"><li>';
					else
					{
						$menu_list .= '<span style="float: right;"> >> </span>';
						$menu_list .= '<ul class="wfs_sub_menu"><li>';					
					}
					$liNeedClose = true;
				}
				if($prevLevel > $curLevel)
				{ 	
					for($i=$prevLevel; $i>$curLevel; $i--)
					{
						$menu_list .= '</li>'; 
						$menu_list .= '</ul>';	
					}
					
					$menu_list .= '</li><li>';
					$liNeedClose = true;
				}
				
				// display menu item
				$url = $menu_item->url;
				if(strpos($url, 'wfs_post_id') !== false)
				{
					$url = str_replace('http://', '', $url);
					$url = str_replace('wfs_post_id=', '', $url);
					$postID = $url;
					$arr = get_post_custom_values('wfs_demo', $postID);
					
					if(count($arr) > 0)
						$url = $arr[0];
					else
						$url = '#';
				}
				
				$menu_list .= '<a class="wfs_menu_link" href="javascript:void(0); return false;" demo_url="' . $url . '">'.$menu_item->title.'</a>'; 				
			}
			 
			// close levels
			for($i = $curLevel; $i>0;$i--)
			{
				$menu_list .= '</li>';
				$menu_list .= '</ul>';	 
			}
			
			// logo
			if($optionArr[0] != '') 
				$menu_list .= '<li style="float: right; padding: 0;"><a href="'.$optionArr[1].'" style="padding:0; line-height:0;"><img height="38px" src="'.$optionArr[0].'"/></a></li>'; 
			
			$menu_list .= '</ul>';				
			
			break;
		}
	}
	?>
	<div id="wfs_demo_nav">	
		<link rel="stylesheet" href="css/style.css" type="text/css"/><?php
		echo $menu_list;?>
	</div>
	<iframe id="wfs_demo_iframe" frameborder="0" noresize="noresize" src="" style="border:0; padding:0; margin:0; width:100%; height: 600px;">
	</iframe><?php
}
$setting = get_setting_wfs_easy_demo_website();	
megaMenu($setting['demoMenu'], 
	array($setting['demoLogo'], $setting['demoLogoLink']));

?> 
	
<?php 
	wp_enqueue_script('jquery');
?>
	
<script>
function getURLParameter(name) 
{
    return decodeURI(
        (RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]
    );
}

jQuery(document).ready(function($)
{
	//
	// Events
	//
	// menu click
	var menuClickFunc = function()
	{
		var url = $(this).attr('demo_url');  
		$('#wfs_demo_iframe').attr('src', url); 
		
		var menuLink = this;
		$('.wfs_main_menu').children('li').removeClass('current');
		$('.wfs_main_menu').children('li').each(function(){
			if($(this).find(menuLink).length > 0)
			{
				$(this).addClass('current'); 
				return false;
			}
		});
	};
	$('.wfs_menu_link').unbind('click', menuClickFunc);
	$('.wfs_menu_link').bind('click', menuClickFunc);
	
	// change iframe height
	var windowResizeFunc = function()
	{
		$('#wfs_demo_iframe').css('height', $(window).height() - 65);
	};
	$(window).resize(function()
	{
		windowResizeFunc();
	});
	windowResizeFunc();
	
	//
	// first demo
	//
	var demoLink = getURLParameter('demo_link'); 
	if(demoLink != '' && demoLink != 'null')
		$('#wfs_demo_iframe').attr('src', demoLink); 
});
</script> 

<div style="display:none;"><?php
	echo $setting['demoGoogleAnalytics'];?>
</div>
</body>
</html>