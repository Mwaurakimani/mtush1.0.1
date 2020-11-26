<?php
  class userAccount extends System
  {
    public function insertID(){
        echo "passing ID";
        return true;
    }
    public function encryptPassword($password)
    {
        $pwd = password_hash($password, PASSWORD_DEFAULT);
        return $pwd;
    }
    public function decryptPassword(){

    }
    public function doesUserExist(){

    }
    public function readUserByReference($moderator,$table, $reference,$fields,$type){

        $conn = $moderator->getConnection();

        $res =  $moderator->get_by_ref($fields, $table, $conn, $reference, $type);

        return $res;
    }
    public function readAllUsers($moderator, $table, $fields){

        $conn = $moderator->getConnection();

        $res =  $moderator->get_by_ref($fields, $table, $conn, $reference = null, $type = null);

        return $res;
    }

    public function addUserToDatabase($data,$moderator){
        $return = null;
        $dataset = $data;
        $conn = $moderator->getConnection();
        $table = 'tbl_moderators';
        $type = 'ssssssssssssssssss';
        $val = '(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';

        $response = $moderator-> add_to_database($dataset,$table,$conn,$type,$val); 
        $return = "";

        if($response['status'] == true){
            $table = 'tbl_moderators';
            $fields=[
                '*'
            ];
            $type = 'i';

            $reference = [
                array("UUID", $response['id']),
            ];
            $return = array(
                'status'=>true,
                'response'=> $response['response'],
                'User'=>$this->readUserByReference($moderator,$table,$reference,$fields,$type)
            );
        }else{
            $return = array(
                'status' => false,
                'response'=> 'Error adding user',
                'User' =>null
            );
        }
        return $return;
        exit();
    }
    public function updateUser($data, $moderator,$id){
        $return = null;
        $dataset = $data;
        $conn = $moderator->getConnection();
        $table = 'tbl_moderators';
        $type = 'ssssssssssssssssss';
        $val = '(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';

        $response = $moderator->updateDatabase($dataset, $table, $conn, $id);
        
        $return = "";

        if ($response['status'] == true) {
            $table = 'tbl_moderators';
            $fields=[
                '*'
            ];
            $type = 'i';

            $reference = [
                array("UUID", $id),
            ];
            $return = array(
                'status' => true,
                'response' => $response['response'],
                'User' => $this->readUserByReference($moderator, $table, $reference, $fields, $type)
            );
        } else {
            $return = array(
                'status' => false,
                'response' => 'Error Updating user',
                'User' => null
            );
        }
        return $return;
        exit();
    }
  }
  