<?php
class products extends System
{
    public function addProductToDatabase($data, $moderator){
        $return = null;
        $dataset = $data;
        $conn = $moderator->getConnection();
        $table = 'tbl_products';
        $type = 'ssddddiisi';
        $val = '(?,?,?,?,?,?,?,?,?,?)';

        $response = $moderator->add_to_database($dataset, $table, $conn, $type, $val);

        $return = "";

        if ($response['status'] == true) {
            $table = 'tbl_products';
            $fields = [
                '*'
            ];
            $type = 'i';

            $reference = [
                array("UUID", $response['id']),
            ];
            $return = array(
                'status' => true,
                'response' => $response['response'],
                'product' => $this->readProductsByReference($moderator, $table, $reference, $fields, $type)
            );
        } else {
            $return = array(
                'status' => false,
                'response' => 'Error adding Product',
                'User' => null
            );
        }
        return $return;
        exit();
    }
    public function readProductsByReference($moderator, $table, $reference, $fields, $type){
        $conn = $moderator->getConnection();

        $res =  $moderator->get_by_ref($fields, $table, $conn, $reference, $type);

        return $res;
    }
    public function deleteProduct($table, $type, $reference, $statement){
        $database = new AdminUser();
        $result = $database->deleteFromDatabase($table, $type, $reference, $statement);

        return $result;
    }
    public function updateProduct($conn,$table,$combination){
        
    }

}
