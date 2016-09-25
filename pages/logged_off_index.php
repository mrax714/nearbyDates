<div class="row ossn-page-contents">
		<div class="col-md-6 left-contents">
			Hello Index HTML 
			<br />
			Come on, log in and have fun ...
			<br />
			<br />
            <div class="buttons">
            	<a href="<?php echo ossn_site_url('login');?>" class="btn btn-primary"><?php echo ossn_print('site:login'); ?></a>
                <a href="<?php echo ossn_site_url('resetlogin');?>" class="btn btn-warning"><?php echo ossn_print('reset:login'); ?></a>
            </div>
		</div>   
        <div class="col-md-6">
    	<?php 
			$contents = ossn_view_form('signup', array(
        					'id' => 'ossn-home-signup',
        				'action' => ossn_site_url('action/user/register')
	   	 	));
			$heading = "<p>".ossn_print('its:free')."</p>";
			echo ossn_plugin_view('widget/view', array(
						'title' => ossn_print('create:account'),
						'contents' => $heading.$contents,
			));
			?>	       			
       </div>     
</div>
