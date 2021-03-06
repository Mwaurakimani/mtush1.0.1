<?php
require_once "../../app/php/Modal.php";

session_start();

if(isset($_SESSION['TOKEN'])){
    $System = new System();

    //get the sent data
    $data = $_REQUEST['data'];
    $token = $_REQUEST['token'];
    $action = $_REQUEST['action'];

    //verify user
    $verified = true;

    if($verified){
        if($action == "openUser"){
            $data = htmlentities($data);
            $Products = new products();

            $table = 'tbl_moderators';
        
            $fields = [
                'password'
            ];
        
            $type = "i";
        
            $reference = [
                array("UUID", $_SESSION['LOGGED_USER'])
            ];
            
            $user = $Products->readProductsByReference($moderator, $table, $reference, $fields, $type);

            if($user[0] == true){
                $password = $user[1][0]['password'];

                $set_var = array(
                    $user = $_SESSION['LOGGED_USER'],
                    $mode = "update" 
                );
                $response = array(
                    "status"=>false,
                    "response" => ""
                );

                $set_var = json_encode($set_var);

                if(password_verify($data,$password)){
                    $url = ROOT . "/Views/userAccount/userAccountInput.php";
                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $set_var );
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    # Send request.
                    $result = curl_exec($ch);
                    curl_close($ch);
                    # Print response.

                    $response['response'] = $result;
                    $response['status'] = $result;

                    echo json_encode($response);
                } else {
                    $response['response'] = "Invalid password";
                    echo json_encode($response);
                }
            }else{
                
            }

        }elseif($action == "update_password"){
            $url = ROOT . "/Views/userAccount/passwordChange.php";
            $ch = curl_init();
            $set_var = "hi";

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $set_var );
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            # Send request.
            $result = curl_exec($ch);
            curl_close($ch);
            # Print response.

            $response['response'] = $result;
            $response['status'] = $result;

            echo $result;
            // echo json_encode($response);
        }elseif($action == "change"){
            foreach ($data as $key => $value) {
                $data[$key] = htmlentities($value);
            }
            $userAccount = new userAccount();

            //getting fields
            $fields = [
                'firstName',
                'lastName',
                'otherName',
                'username',
                'nationalID',
                'dateOfBirth',
                'moderatorEmail',
                'phoneNumber1',
                'phoneNumber2',
                'Address',
                'Role',
                'accountStatus',
                'nextOfKinFirstName',
                'nextOfKinLastName',
                'nextOfKinRelation',
                'nextOfKinNumber',
                'nextOfKinAddress'
            ];

            $values = [
                $data['firstName'],
                $data['lastName'],
                $data['otherName'],
                $data['userName'],
                $data['IdNumber'],
                $data['dateOfBirth'],
                $data['email'],
                $data['phone1'],
                $data['phone2'],
                $data['address'],
                $data['accountType'],
                $data['accountStatus'],
                $data['nextOfKinFirstName'],
                $data['nextOfKinLastName'],
                $data['nextOfKinRelation'],
                $data['nextOfKinNumber'],
                $data['nextOfKinAddress']
            ];

            $combined  = array_combine($fields, $values);
            $id = $_REQUEST['user'];

            $response = $userAccount->updateUser($combined, $moderator,$id);

            echo json_encode($response);
        }else if("confirm_change_password"){
            $data = json_decode($data);

            $Products = new products();

            $table = 'tbl_moderators';
        
            $fields = [
                'password'
            ];
        
            $type = "i";
        
            $reference = [
                array("UUID", $_SESSION['LOGGED_USER'])
            ];
            
            $user = $Products->readProductsByReference($moderator, $table, $reference, $fields, $type);

            if($user[0]){
                if($data->New_password != $data->Confirm_password){
                    $result = array (
                        "status"=>101,
                        "response"=>"Passwords Don't Match"
                    );
                    echo json_encode($result);

                    exit();
                }elseif($data->current_password == $data->Confirm_password){
                    $result = array (
                        "status"=>102,
                        "response"=>"Cannot Use the same password"
                    );

                    echo json_encode($result);

                    exit();
                }else{
                    if (password_verify($data->current_password, $user[1][0]['password'])) {
                        $result = array (
                            "status"=>1,
                            "response"=>"Changing password"
                        );

                        // encode html
                        $newPassword = password_hash($data->New_password, PASSWORD_DEFAULT);

                        $conn = $moderator->getConnection();
                        
                        $stmt = $conn->prepare("UPDATE tbl_moderators SET password=? WHERE UUID=?");
                        $stmt->bind_param("si", $newPassword,$_SESSION['LOGGED_USER']);
                        $stmt->execute();
                        $stmt->close();

                        $result = array (
                            "status"=>1,
                            "response"=>"Password changed"
                        );

                        echo json_encode($result);

                        exit();
                    } else {
                        $result = array (
                            "status"=>102,
                            "response"=>"Invalid Password"
                        );
    
                        echo json_encode($result);
    
                        exit(); 
                    }
                }
            }else{
                echo "Not found";
            }

        }else{
            echo "Options don't match";
        }
    }else{
        echo "unverified";
    }
}else{
    echo "not set";
}


