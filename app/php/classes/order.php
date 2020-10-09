<?php
class order extends System
{
    public function addOrderToDatabase($data, $moderator){
        $return = null;
        $dataset = $data;
        $conn = $moderator->getConnection();
        $table = 'tbl_orders';
        $type = 'sssidd';
        $val = '(?,?,?,?,?,?)';

        $response = $moderator->add_to_database($dataset, $table, $conn, $type, $val);

        $return = "";

        if ($response['status'] == true) {
            $table = 'tbl_orders';
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
                'product' => $this->readOrdersByReference($moderator, $table, $reference, $fields, $type)
            );
        } else {
            $return = array(
                'status' => false,
                'response' => 'Error adding Order',
                'User' => null
            );
        }
        return $return;
        exit();
    }

    public function readOrdersByReference($moderator, $table, $reference, $fields, $type)
    {
        $conn = $moderator->getConnection();

        $res =  $moderator->get_by_ref($fields, $table, $conn, $reference, $type);

        return $res;
    }

    public function addSubToDatabase($data, $moderator)
    {
        $return = null;
        $dataset = $data;
        $conn = $moderator->getConnection();
        $table = 'tbl_suborder';
        $type = 'siddii';
        $val = '(?,?,?,?,?,?)';

        $response = $moderator->add_to_database($dataset, $table, $conn, $type, $val);

        $return = "";

        if ($response['status'] == true) {
            $table = 'tbl_suborder';
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
                'product' => $this->readOrdersByReference($moderator, $table, $reference, $fields, $type)
            );
        } else {
            $return = array(
                'status' => false,
                'response' => 'Error adding Sub Order',
                'User' => null
            );
        }
        return $return;
        exit();
    }

    public function readAllOrders($moderator, $table ,$fields){

        $conn = $moderator->getConnection();

        $res =  $moderator->get_by_ref($fields, $table, $conn);

        return $res;
    }

    public function deleteOrder($moderator,$table = null,$ref = null){
        $res =  $moderator->delete();
        return $res;
    }
}
