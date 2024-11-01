<?php
require_once( dirname( __FILE__ ) . '/functions.php' );

if ( ! function_exists( 'load_wfs_easy_demo_website' ) ) 
{
	function load_wfs_easy_demo_website() 	
	{ 
		$setting = get_setting_wfs_easy_demo_website();	  
		?>

		<?php 		
		// load cripts
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'wfs_easy_demo_website_ajax' );
		?> 	

		<div style="padding-right: 10px;">	
			<h2>WFS Easy Demo Website</h2>
			<h4>Version 0.5 - Minimum control panel</h4>   
			<fieldset style="border: 1px solid #DFDFDF; padding: 10px; margin-top: 10px; max-width: 800px;">
				<legend>Folder Setting:</legend> 
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row">Folder path to restore all system demo files:</th>
							<td>
								<span id="wfsDemoFolderSaved"><?php echo $setting['demoFolder'];?></span> 
							</td>
						</tr>
						<tr valign="top">
							<th scope="row">Demo link:</th>
							<td> 
								<a id="wfsDemoURL" target="_blank" wp_url="<?php echo get_site_url(); ?>" href=" <?php echo get_site_url().'/'.$setting['demoFolder']; ?> "> <?php echo get_site_url().'/'.$setting['demoFolder']; ?> </a>
							</td>
						</tr>
						<tr valign="top">
							<th scope="row"></th>
							<td>
								<a id="wfsApplyDefault" href="javascript:void();" class="button">Apply default</a>
								<p class="description">Copy system demo files at the first time of configuration or restore the default system files if you want</p>
							</td>
						</tr>
					</tbody>
				</table>				
			</fieldset>  
			<fieldset style="border: 1px solid #DFDFDF; padding: 10px; margin-top: 10px; max-width: 800px;">
				<legend>Setting:</legend> 
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row">Folder path to restore all system demo files: <span style="color:red;">*</span></th>
							<td>
								<input id="wfsDemoFolder" class="regular-text" value="<?php echo $setting['demoFolder'];?>">
								<p class="description">Enter the folder path (relates to the root host), 
									example: your wordpress site is <strong>http://webfacescript.com</strong> 
									and the demo is <strong>http://webfacescript.com/demo</strong> 
									=> enter the <strong>demo</strong>
									<br/>
									Notes:
									<br/>
									- Folder name must be different the wordpress's folders
									<br/>
									- Plugin only supports 1 level folder
									<br/>
									- When you want to change demo folder, the old folder is still exist 
								</p>
							</td>
						</tr> 
						<tr valign="top">
							<th scope="row">Menu name: <span style="color:red;">*</span></th>
							<td>
								<input id="wfsDemoMenu" class="regular-text" value="<?php echo $setting['demoMenu'];?>">
								<p class="description">The menu that is created to contain demo menu links</p>
							</td>
						</tr> 
						<tr valign="top">
							<th scope="row">Logo:</th>
							<td>
								<input id="wfsDemoLogo" class="regular-text" value="<?php echo $setting['demoLogo'];?>">
								<p class="description">Enter your website logo url</p>
							</td>
						</tr> 
						<tr valign="top">
							<th scope="row">Logo link:</th>
							<td>
								<input id="wfsDemoLogoLink" class="regular-text" value="<?php echo $setting['demoLogoLink'];?>">
								<p class="description">Enter the link you want to click on logo</p>
							</td>
						</tr> 
						<tr valign="top">
							<th scope="row">Custom field name of Page/Post demo link:</th>
							<td>
								<input id="wfsDemoCustomField" class="regular-text" value="<?php echo $setting['demoCustomField'];?>">
								<p class="description"> 
									Default, plugin will get the url from menu item. 
									But, if your post (with ID=<strong>1001</strong>) is a product and it has demo link that is stored in custom field named <strong>'demo_url'</strong>, 
									and you would re-use the demo link, here is the steps:
									<br/>
									- Enter here the custom field name <strong>demo_url</strong> (only example) 
									<br/>
									- In wordpress 'demo menu' you created, insert Menu Links with URL is <strong>wfs_post_id=1001</strong> (only example)
								</p>
							</td>
						</tr> 						
						<tr valign="top">
							<th scope="row">Google Analytics:</th>
							<td>
								<textarea id="wfsDemoGoogleAnalytics" class="large-text code"><?php echo $setting['demoGoogleAnalytics'];?></textarea>
								<p class="description">Enter your Google Analytics script</p>
							</td>
						</tr> 					
						<tr valign="top">
							<th scope="row"></th>
							<td>
								<a id="wfsSaveSetting" href="javascript:void();" class="button">Save</a>
							</td>
						</tr> 
					</tbody>
				</table>				
			</fieldset> 
		</div>
		<?php
	}
} 
?>