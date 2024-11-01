<?php
if(!function_exists('get_setting_wfs_easy_demo_website'))
{
	function get_setting_wfs_easy_demo_website()
	{
		$wfsSeparateKey = '{{wfs_separate_key}}';

		$posts = get_posts(array(
					'post_type' => 'wfs_easy_demo'));
				
		if(count($posts) > 0)
		{  
			$setting = $posts[0]->post_content;
			$arr = explode($wfsSeparateKey, $setting);
			
			return array(
				'demoFolder'			=> $arr[0],
				'demoMenu'				=> $arr[1],
				'demoLogo'				=> $arr[2],
				'demoLogoLink'			=> $arr[3],
				'demoCustomField'		=> $arr[4],
				'demoGoogleAnalytics'	=> $arr[5]
			);
		}
		else
		{			
			return array(
				'demoFolder'			=> '',
				'demoMenu'				=> '',
				'demoLogo'				=> '',
				'demoLogoLink'				=> '',
				'demoCustomField'		=> '',
				'demoGoogleAnalytics'	=> ''
			);
		}
	}
}
?>
