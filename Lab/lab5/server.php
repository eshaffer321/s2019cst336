<?php
  session_start();
  
  // Taken usernames
  $userNames = array("daft01", "jrios10", "frandTheTank");

  $httpMethod = strtoupper($_SERVER['REQUEST_METHOD']);

  switch($httpMethod) {
    case "OPTIONS":
      // Allows anyone to hit your API, not just this c9 domain
      header("Access-Control-Allow-Headers: X-ACCESS_TOKEN, Access-Control-Allow-Origin, Authorization, Origin, X-Requested-With, Content-Type, Content-Range, Content-Disposition, Content-Description");
      header("Access-Control-Allow-Methods: POST, GET");
      header("Access-Control-Max-Age: 3600");
      exit();
    case "GET":
      // Allow any client to access
      header("Access-Control-Allow-Origin: *");
      // Let the client know the format of the data being returned
      header("Content-Type: application/json");

      // TODO: do stuff to get the $results which is an associative array
      $password = "";
      $length =  rand(7, 13);
      $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
      
      // Getting the password
      for($i = 0; $i < $length; $i++){
          $password .= $characters[rand(0, 61)];
      }

      // Sending back down as JSON
      echo json_encode($password);

      break;
    case 'POST':
      // Get the body json that was sent
      $rawJsonString = file_get_contents("php://input");

      // string to array map
      parse_str($rawJsonString, $data);
      
      // Make it a associative array (true, second param)
      $jsonData = json_decode($rawJsonString, true);
      
      // TODO: do stuff to get the $results which is an associative array
      $validPassword = true;
      $validUsername = true;
      
      // Checking if username is valid
      foreach($userNames as $user){
        if($user === $data[userName]){
          $validUsername = false;
        }
      }
      
      // Checking if password is valid
      if (strpos($data[password], $data[userName]) !== false) {
        $validPassword = false;
      }
      
      // Adding username to the array of usernames if the account if valid
      if($validUsername && $validPassword){
        array_push($userNames, $data[userName]);
      }
      
      // Making array map
      $info = array("validUsername" => $validUsername, "validPassword" => $validPassword);
      
      // Allow any client to access
      header("Access-Control-Allow-Origin: *");
      // Let the client know the format of the data being returned
      header("Content-Type: application/json");

      // Sending back down as JSON
      echo json_encode($info);

      break;
    case 'PUT':
      // TODO: Access-Control-Allow-Origin
      http_response_code(401);
      echo "Not Supported";
      break;
    case 'DELETE':
      // TODO: Access-Control-Allow-Origin
      http_response_code(401);
      break;
  }
?>