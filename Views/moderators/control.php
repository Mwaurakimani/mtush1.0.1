<?php
require_once "../../app/php/Modal.php";

session_start();

if(isset($_SESSION['TOKEN'])){

    //get the sent data
    $data = $_REQUEST['data'];
    $token = $_REQUEST['token'];
    $action = $_REQUEST['action'];

    //verify user
    $verified = $System->verifyUser($token);

    if($verified){
        if($action == "addUser"){
            foreach($data as $key => $value){
                $data[$key] = $System->encodeToHTML($value);
            }
            $userAccount = new userAccount();

            $password = $userAccount->encryptPassword('password');

            //getting fields
            $fields = [
                'firstName',
                'lastName',
                'otherName',
                'username',
                'nationalID',
                'dateOfBirth',
                'moderatorEmail',
                'password',
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
                $password,
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

            $response = $userAccount->addUserToDatabase($combined,$moderator);

            echo json_encode($response);
            exit();
        }elseif($action == "update"){
            foreach ($data as $key => $value) {
                $data[$key] = $System->encodeToHTML($value);
            }
            $userAccount = new userAccount();

            $password = $userAccount->encryptPassword($data['password']);

            

            //getting fields
            $fields = [
                'firstName',
                'lastName',
                'otherName',
                'username',
                'nationalID',
                'dateOfBirth',
                'moderatorEmail',
                'password',
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
                $password,
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
            exit();
        }
    }else{
        echo "unverified";
    }
}else{
    echo "not set";
}


