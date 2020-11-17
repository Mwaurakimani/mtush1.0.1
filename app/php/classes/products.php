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
    public function list_products($data){
        $offset = $data['offset'];
        $Response[0] = false;
        $temp_arry = [];
        $conn = $data['conn']->getconnection();
        
        if ($stmt = $conn->prepare("SELECT * FROM tbl_products ORDER BY productName ASC LIMIT 25 OFFSET $offset")) {
            $stmt->execute();
            $result = $stmt->get_result();

            while ($data = $result->fetch_assoc()) {
                array_push($temp_arry, $data);
                $Response[0] = true;
            }
            $stmt->close();
            array_push($Response, $temp_arry);
        }

        return $Response;
    }
    public function product_counter($moderator){
        $conn = $moderator->getconnection();
        if ($stmt = $conn->prepare("SELECT COUNT(*) FROM tbl_products")) {
            $stmt->execute();
            $result = $stmt->get_result();

            while ($data = $result->fetch_assoc()) {
                return $data;
            }
        }
    }

}
