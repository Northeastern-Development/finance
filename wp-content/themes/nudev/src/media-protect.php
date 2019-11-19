<?php

  // this document adds a catch to EVERY media item managed through the media library to see if it is set as a status of protected or not
  // if protected it will require users to be logged in before they can see/download the item
  // the initial check for media is done in htaccess
  // thanks to 0to5.com


  require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');	// call in WP core





  // this class handles sorting out if media items exist, and whether they should be protected or not
  class NUMediaProtect{

    var $file
        ,$dir
        ,$fileObject;

    function __construct($a){

      $this->file                               = $a; // the file that was requested and passed into the class
      $this->dir                                = wp_upload_dir();  // the location of the wp uploads directory
      $this->fileObject                         = null; // prep a file object to work with

      if(is_admin()){ // we are somewhere in the admin, so we can simply show the media item as we know the user is logged in
        $this->buildMedia();
      }else{  // request came from the front-end of the site so we need to check a few things first
        if($this->getObject()){ // valid object, check the file status
          $this->checkStatus();
        }else{  // Houston, there is a problem and we do not know what it is
          die('ERROR: An unknown error has occurred.');
        }
      }
    }

    // figure out what the file object should be to use for checking status
    private function getObject(){
      $obj = get_post(attachment_url_to_postid($this->dir['baseurl'].'/'.$this->file));
      if(!is_object($obj)){ // it was not an object, check for a parent object next
        $ext = pathinfo($this->file, PATHINFO_EXTENSION); // file extension type value
        $path = substr($this->file,0,strrpos($this->file,'-')); // remove everything AFTER the last dash to find the parent media item
        $this->fileObject = get_post(attachment_url_to_postid($this->dir['baseurl'].'/'.$path.'.'.$ext)); // find the parent object
        unset($path,$ext,$obj);  // clean up
        return true;
      }else if(is_object($obj)){  // we have an object, set the file object and return true
        $this->fileObject = $obj;
        unset($obj);  // clean up
        return true;
      }else{  // straight up error
        unset($obj);  // clean up
        return false;
      }
    }





    // this will check to see if the file object should be protected or not based on categories assigned
    private function checkStatus(){

      if(is_object($this->fileObject)){ // is this a real, functional object that we have to work with?
        $mCats = get_the_terms($this->fileObject->ID,'attachment_category');
        $protect = false;

        // loop through the cats for the media item
        if(!empty($mCats)){ // make sure that we have some category data to look at
          foreach($mCats as $mC){
            if($mC->slug == 'protected'){ // does this media item include the protected category?
              $protect = true;
              break;  // break if we find the protected cat, no need to look further
            }
          }
        } // if no cats, we leave protect set to default of false

        unset($mCats,$mC);  // clean up

        if($protect){ // this is a protected file, make sure the user is logged in
          unset($protect,$this->fileObject);  // clean up
          $this->checkUser();
        }else{  // not a protected file, show it to the user
          unset($protect,$this->fileObject);  // clean up
          $this->buildMedia();
        }
      }else{ // for some reason this is NOT an object, so just don't do anything

      }
    }





    // check to see if the user is logged in or not, and allowed to see protected files
    private function checkUser(){
      if(!is_user_logged_in()){ // the user is not logged in, bounce them to the login screen and pass the file they were after as a callback
        wp_redirect(wp_login_url($this->dir['baseurl'].'/'.$this->file));
        exit();
      }else{  // the user is logged in
        $this->buildMedia();
      }
    }





    // this will build the media item to be returned
    private function buildMedia(){

      list($basedir) = array_values(array_intersect_key(wp_upload_dir(),array('basedir' => 1)))+array(NULL);
      $this->file = rtrim($basedir,'/').'/'.str_replace('..','',isset($this->file)?$this->file:'');

      // make sure that this is a valid file and dir
      if(!$basedir || !is_file($this->file)){
        unset($basedir,$this->file);  // clean up
        status_header(404); // update header to denote that the file cannot be found
        die('ERROR: File not found.');
      }


      // get the mime type of the file that was requested
      $mime = wp_check_filetype($this->file);
      if(false === $mime['type'] && function_exists('mime_content_type')){
        if(mime_content_type($this->file)){
          $mime = $mime['type'];
        }else{
          $mime = 'image/'.substr($this->file,strrpos($this->file,'.') + 1);
        }
      }

      // start building out the header content
      header('Content-Type: '.$mime['type']); // always send this

      unset($mime); // clean up

      // if we are hosting over IIS, need to add some more info
      if(false === strpos($_SERVER['SERVER_SOFTWARE'],'Microsoft-IIS')){
        header('Content-Length: '.filesize($this->file));
      }

      $last_modified = gmdate('D, d M Y H:i:s',filemtime($this->file));
      $etag = '"'.md5($last_modified).'"';
      header('Last-Modified: '.$last_modified.' GMT');
      header('ETag: '.$etag);
      header('Expires: '.gmdate('D, d M Y H:i:s',time() + 100000000).' GMT');

      // Support for Conditional GET
      $client_etag = (isset($_SERVER['HTTP_IF_NONE_MATCH'])?stripslashes($_SERVER['HTTP_IF_NONE_MATCH']):false);

      if(!isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])){
        $_SERVER['HTTP_IF_MODIFIED_SINCE'] = false;
      }

      $client_last_modified = trim($_SERVER['HTTP_IF_MODIFIED_SINCE']);
      // If string is empty, return 0. If not, attempt to parse into a timestamp
      $client_modified_timestamp = ($client_last_modified ? strtotime($client_last_modified):0);

      // Make a timestamp for our most recent modification…
      $modified_timestamp = strtotime($last_modified);

      if ( ( $client_last_modified && $client_etag )
      ? ( ( $client_modified_timestamp >= $modified_timestamp) && ( $client_etag == $etag ) )
      : ( ( $client_modified_timestamp >= $modified_timestamp) || ( $client_etag == $etag ) )
      ){
        unset($last_modified,$etag,$client_etag,$client_last_modified,$client_modified_timestamp,$modified_timestamp,$NUMP);  // clean up
        status_header(304); // set the header to denote that the item has NOT been modified
        exit;
      }

      // If we made it this far, do some clean up and serve the file
      unset($last_modified,$etag,$client_etag,$client_last_modified,$client_modified_timestamp,$modified_timestamp,$NUMP);  // clean up
      readfile($this->file);
    }
  }





  // initiate a new media protect object to check the file being requested
  $NUMP = new NUMediaProtect($_GET['file']);


?>
