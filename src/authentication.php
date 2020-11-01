<?php 
    define("COOKIE_NAME", "token");
    define("REST_SERVER", "mu-rest-server.herokuapp.com");
    
    if ($_SERVER["REQUEST_METHOD"]=="POST"){  
        if(isset($_POST['login'])){
            $credentials = array("username" => $_POST["username"], "password" => $_POST["password"]);
            $ch = curl_init(REST_SERVER."/login");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($credentials));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, TRUE);
            $response = curl_exec($ch);
            $responseCode = curl_getinfo($ch,CURLINFO_RESPONSE_CODE);
            curl_close($ch);
            
            if($responseCode=="200"){            
                $matches = array();
                //Finds JWT from the response using regex and returns it as first element of $matches
                preg_match("/(?<=Authorization: Bearer)(.*?)(?=\s)/",$response,$matches);
                /*Cookie expiration time is time() + validity interval in seconds.
                  It must be the same as JWT expiration time set on the server.*/
                setcookie('token',$matches[0],time()+86400);
                header("Location: index.php");
            } else {
                echo "Login failed, please try again or sign up";
            }      
        } elseif(isset($_POST['signup'])){ 
            $credentials = array("username" => $_POST["username"], "password" => $_POST["password"]);
            $ch = curl_init(REST_SERVER."/users/signup");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($credentials));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, TRUE);
            $response = curl_exec($ch);
            $responseCode = curl_getinfo($ch,CURLINFO_RESPONSE_CODE);
            curl_close($ch);
            
            if($responseCode=="200"){
                echo "Your account is created, please log in.";
            } else {
                echo "Sign up failed, please try again";
            }
        } 
    }
?>