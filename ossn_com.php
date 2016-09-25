<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
//setting up path so we can use it in entire file 
//if your component folder have upper and lower case characters please use same here.
define('__OSSN_HELLO_WORLD_INDEX__', ossn_route()->com . 'HelloWorldIndex/');


//this function is use to initilize ossn
function ossn_hello_world_index() {
  /**
  * Lets add our css to ossn default css file,
  * Lets create css directory in your component directory here our
  * directory name is HelloWorld so lets create new directory name css in HelloWorld
  * directory after that create a file name helloworld.php in it and add css
  * ossn.default is name of css.
  * use following code to add css in ossn default css file
  */
   ossn_extend_view('css/ossn.default', 'css/helloworld');
   
   
  /**
  * For javascript you can do same thing , but instead of css you need to use js see code below:
  */   
   ossn_extend_view('js/opensource.socialnetwork', 'js/helloworld');
  
  /**
  * Sometime you can't extned other css or js file as it creates conflicts in css or js,
  * so for that purpose you need to create seprate js or css file.
  * Now lets create a new directory called standalone in css directory 
  * create a file called helloworld.php in your standalone directory add your css code in that file.
  * To create seprate css link in header you can use following code.
  */
   //this will just tell system that new css file for header is available
   ossn_new_css('hello.world', 'css/standalone/helloworld');
   
   //now tell system to load file in header, here the first argument in function must be same as you 
   //used in ossn_new_css(<argument>) 
   ossn_load_css('hello.world');
   
   //lets create a new page called hello and print hello for that we need to use following code.
   ossn_register_page('hello', 'ossn_hello_page');
   
   //with HelloWorldIndex first unregister the default index page of OSSN
   ossn_unregister_page('index');
   
   //then check if user is logged in or not and register the appropriate custom index page to display
   if(ossn_isLoggedin()){
	   ossn_register_page('index', 'custom_logged_in_index_page');
   } else {
	   ossn_register_page('index', 'custom_logged_off_index_page');
   }

   //since the default Ossn action is to redirect to /home (which is connected to the newsfeed) after a successful login
   //we have to unregister the default action
   ossn_unregister_action('user/login');
   //and overwrite it with our own login action in order to redirect to our custom index page
   ossn_register_action('user/login', __OSSN_HELLO_WORLD_INDEX__. 'actions/user/login.php');
}

//page function that is created by ossn_register_page('hello', 'ossn_hello_page');
//the code below is use to print hello world in page.
// vist http://mysite.com/hello to view page
function ossn_hello_page(){
  echo "Hello World";
}

// in opposite of php inline coding as above, we call a separate file to load here
function custom_logged_off_index_page(){
  $title = 'Index (offline)';
  $content = ossn_set_page_layout('contents', array(
								   'content' => ossn_view('components/HelloWorldIndex/pages/logged_off_index'),
								));
  echo ossn_view_page($title, $content);		
}

function custom_logged_in_index_page(){
  $title = 'Index (online)';
  $content = ossn_set_page_layout('contents', array(
								   'content' => ossn_view('components/HelloWorldIndex/pages/logged_in_index'),
								));
  echo ossn_view_page($title, $content);		
}

//this line is used to register initliize function to ossn system
ossn_register_callback('ossn', 'init', 'ossn_hello_world_index');
