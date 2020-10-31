<?php 
    define("REST_SERVER", "mu-rest-server.herokuapp.com");    
    define("IMAGE_TEMPLATE", "templates/imageTemplate.php");
    define("DATA_LINE_TEMPLATE", "templates/dataLineTemplate.php");
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST['getMovie'])){
    		 $query = http_build_query(array('title'=>$_POST['title'],'year'=>$_POST['year'],'plotType'=>$_POST['plotType']));
    		 $ch = curl_init(REST_SERVER."/getMovie?".$query);
    		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    		 curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer".$_COOKIE['token']));
    		 $response = curl_exec($ch);
    		 curl_close($ch);
    		 $data = json_decode($response,JSON_OBJECT_AS_ARRAY);
    		 
    		 if($data['Response']=='False'){
    		     echo 'No matches found';
    		 } else {
    		     if($data["Poster"]!="N/A"){
    		         //$imgUrl is used in IMAGE_TEMPLATE
    		         $imgUrl = $data["Poster"];
    		         include IMAGE_TEMPLATE;
    		     }
    		     printData("",$data);
    		 }
        } elseif (isset($_POST['getBook'])){
    		  $ch = curl_init(REST_SERVER."/getBook?isbn=".$_POST['isbn']);
    		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    		  curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer".$_COOKIE['token']));
    		  $response = curl_exec($ch);
    		  curl_close($ch);
    		  $data = json_decode($response,JSON_OBJECT_AS_ARRAY);
   
    		  if(key_exists('status', $data) && $data['status']!=200){
    		      echo "No matches found";
    		  } else {
    		      //$imgUrl is used in IMAGE_TEMPLATE
    		      $imgUrl = "http://covers.openlibrary.org/b/isbn/".$_POST['isbn']."-L.jpg";
    		      include IMAGE_TEMPLATE;
    		      printData("", $data);
    		  }	  
    	} elseif (isset($_POST['logout'])){
    	      //Deletes the cookie containing JWT on logout
    		  setcookie("token","",time()-3600);
    		  header("Location: login.php");
        }
    }
    
    /*Prints elements in array $data one by one using DATA_LINE_TEMPLATE to format the output.
    Parameter $indent is used if the element of $data is itself an array to indent the output. */
    function printData($indent,$data){
        foreach ($data as $d){
            if(is_string(key($data))&&key($data)=="Poster"){
                /*Poster is printed as image outside of this function using IMAGE_TEMPLATE
                It must be printed first for correct positioning*/
            } elseif(is_array($d)){ 
                if(is_string(key($data))){
                    include DATA_LINE_TEMPLATE;
                }
                printData($indent."    ",$d);     
            } else{
                include DATA_LINE_TEMPLATE;
            }
            /*next($data) moves the internal pointer to the next element of $data array,
            which enables key($data) to iterate through the keys in the array*/
            next($data);
        }
    }
    
?>