<?php 

if(!function_exists('apply_wfs_easy_demo_website'))
{
	function recurse_copy($src,$dst) 
	{
		$dir = opendir($src);
		@mkdir($dst);
		while(false !== ( $file = readdir($dir)) ) {
			if (( $file != '.' ) && ( $file != '..' )) {
				if ( is_dir($src . '/' . $file) ) {
					recurse_copy($src . '/' . $file,$dst . '/' . $file);
				}
				else {
					copy($src . '/' . $file,$dst . '/' . $file);
				}
			}
		}
		closedir($dir);
	} 
	
	function apply_wfs_easy_demo_website()
	{ 
		if(current_user_can('edit_posts') === false) 
		{
			echo 'access_denined';
		}
		else
		{
			$posts = get_posts(array(
					'post_type' => 'wfs_easy_demo'));

			if(count($posts) > 0)
			{ 
				$wfsSeparateKey = '{{wfs_separate_key}}';
				$arr = explode($wfsSeparateKey, $posts[0]->post_content);
				$demoFolder = $arr[0];
				
				if($demoFolder == 'wp-admin' || $demoFolder == 'wp-content' || $demoFolder == 'wp-includes')
				{
					echo 'false';
				}
				else
				{
					$srcFolder = plugin_dir_path( __FILE__ ).'assets/demo';
					$destFolder = ABSPATH.'/'.$demoFolder;
					recurse_copy($srcFolder, $destFolder);

					echo 'true';
				}
			}
			else{
				echo 'false';
			}
		}
		
		die();		
	}
}

if(!function_exists('save_wfs_easy_demo_website'))
{
	function save_wfs_easy_demo_website()
	{
		if(current_user_can('edit_posts') === false) 
		{
			echo 'access_denined';
		}
		else
		{
			$demoFolder = $_REQUEST["demo_folder"];
			$demoMenu = $_REQUEST["demo_menu"];
			$demoLogo = $_REQUEST["demo_logo"];
			$demoLogoLink = $_REQUEST["demo_logo_link"];
			$demoCustomField = $_REQUEST["demo_custome_field"];
			$demoGoogleAnalytics = $_REQUEST["demo_google_analytics"];

			if($demoFolder == '' || $demoMenu == '')
			{
				echo 'false';			
			}
			else
			{			
				$wfsSeparateKey = '{{wfs_separate_key}}';
				$setting = $demoFolder.$wfsSeparateKey
						.$demoMenu.$wfsSeparateKey
						.$demoLogo.$wfsSeparateKey
						.$demoLogoLink.$wfsSeparateKey
						.$demoCustomField.$wfsSeparateKey
						.$demoGoogleAnalytics;

				$posts = get_posts(array(
					'post_type' => 'wfs_easy_demo'));

				if(count($posts) > 0)
				{
					$postID = $posts[0]->ID;
					wp_update_post(array(
						'ID'			=> $postID,
						'post_content'	=> $setting
					));

					echo 'true';
				}
				else
				{
					wp_insert_post(array( 
						'post_content'	=> $setting,
						'post_type'		=> 'wfs_easy_demo',
						'post_title'	=> 'wfs_easy_demo_website',
						'post_status'	=> 'publish'
					));

					echo 'true';
				}
			}
		}
		
		die();		
	}
}
?>