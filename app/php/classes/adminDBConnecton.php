<?php

/**Object Oriented Database Connection
 *
 */
trait  adminDBConnecton
{
    protected $connection;

    function conn(){
        $this->connection = new mysqli(ROOT_DB_HOST, ROOT_DB_USERNAME, ROOT_DB_PASSWORD, ROOT_DB_NAME);

        return $this->connection;
    }

    function getConnection(){
        return $this->connection;
    }

    /**
     * This function passes data to the data base
     * @param dataset -> combination of key:values with the key being the database
     * field name and the value being the data to be passed.
     * @param table -> should be the name of the table to be inserted data into
     * @param conn -> the data base connection
     * @param type -> data type for sql @example (s,i,d)
     * @param val -> these are the value holders to be passed @example (?,?,?)
     */
    public function add_to_database($dataset,$table,$conn,$type = null,$val = null){
        $response = array(
            'status'=>false,
            'response'=>"No action done",
            'id'=>null
        );
        $fields = array();
        $values = array();

        foreach($dataset as $key => $value){
            array_push($fields, $key);
            array_push($values, $value); 
        }

        if(isset($val)){
            $val = $val;
        }else{
            $val = "(?,?)";
        }

        $statement = implode("`,`", $fields);

        $stmt = $conn->prepare("INSERT INTO $table (`$statement`) VALUES $val");

        if (false === $stmt) {
            $response['status'] = false;
            $response['response'] = 'prepare() failed: ' . htmlspecialchars($conn->error);
            return $response;
        }

        $rc = $stmt->bind_param($type, ...$values);
        if (false === $rc) {
            $response['status'] = false;
            $response['response'] = 'bind_param() failed: ' . htmlspecialchars($stmt->error);
            return $response;
        }

        $rc = $stmt->execute();
        if (false === $rc) {
            $response['status'] = false;
            $response['response'] = 'execute() failed: ' . htmlspecialchars($stmt->error);
            return $response;
        }

        $response['id'] = $conn->insert_id;
        $response['status'] = true;
        $response['response'] = 'Added Successfully';
        $stmt->close();

        
        return $response;
    }

    public function get_by_ref($fields, $table, $conn, $ref = null, $type = null ,$limit = null){
        $is_array = is_array($fields);
        $Response = [
            false,
        ];
        $temp_arry = array();

        if ($is_array) {
            $array_count = count($fields);

            if ($array_count > 0) {
                $fields_combined = implode(",", $fields);

                if (isset($ref)) {
                    $keys = [];
                    $values = [];

                    foreach ($ref as &$val) {
                        array_push($keys, $val[0] . " = ?");
                        $myVal = $val[1];
                        array_push($values, $myVal);
                    }

                    $keys_combined = implode(" AND ", $keys);

                    if ($stmt = $conn->prepare("SELECT $fields_combined FROM $table WHERE $keys_combined ")) {

                        $stmt->bind_param($type, ...$values);

                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($data = $result->fetch_assoc()) {
                            array_push($temp_arry, $data);
                            $Response[0] = true;
                        }
                        $stmt->close();



                        array_push($Response, $temp_arry);
                    }
                } else {
                    if ($stmt = $conn->prepare("SELECT $fields_combined FROM $table")) {
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($data = $result->fetch_assoc()) {
                            array_push($temp_arry, $data);
                            $Response[0] = true;
                        }
                        $stmt->close();


                        array_push($Response, $temp_arry);
                    }
                }
            }
        } else {
            if ($fields == "*") {

                if (isset($ref)) {
                    $keys = [];
                    $values = [];

                    foreach ($ref as &$val) {
                        array_push($keys, $val[0] . " = ?");
                        $myVal = $val[1];
                        array_push($values, $myVal);
                    }

                    $keys_combined = implode(" AND ", $keys);

                    $statement = "select * from tbl_products where ".$keys_combined;

                    echo $statement;
                    exit();

                    if ($stmt = $conn->prepare("SELECT * FROM $table WHERE $keys_combined ")) {

                        $stmt->bind_param($type, ...$values);

                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($data = $result->fetch_assoc()) {
                            array_push($temp_arry, $data);
                            $Response[0] = true;
                        }
                        $stmt->close();



                        array_push($Response, $temp_arry);
                    }
                } else {
                    if ($stmt = $conn->prepare("SELECT * FROM $table")) {
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($data = $result->fetch_assoc()) {
                            array_push($temp_arry, $data);
                            $Response[0] = true;
                        }
                        $stmt->close();


                        array_push($Response, $temp_arry);
                    }
                }
            }
        }
        return $Response;
    }

    public function updateDatabase($dataset, $table, $conn,$id){
        $response = array(
            'status'=>null,
            'response'=>null
        );
        foreach($dataset as $key => $value){
            $stmt = $conn->prepare("UPDATE $table SET $key=? WHERE UUID = ?");

            if (false === $stmt) {
                $response['status'] = false;
                $response['response'] = 'prepare() failed: ' . htmlspecialchars($conn->error);
                return $response;
            }

            $rc = $stmt->bind_param('si', $value,$id);
            if (false === $rc) {
                $response['status'] = false;
                $response['response'] = 'bind_param() failed: ' . htmlspecialchars($stmt->error);
                return $response;
            }
            $rc = $stmt->execute();
            if (false === $rc) {
                $response['status'] = false;
                $response['response'] = 'execute() failed: ' . htmlspecialchars($stmt->error);
                return $response;
            }
        }
        $response = array(
            'status'=>true,
            'response' => "Update Successful"
        );

        return $response;
    }

    public function deleteFromDatabase($table, $type, $reference ,$statement){
        $connection = $this->getConnection();

        $stmt = $connection->prepare("DELETE FROM $table WHERE $statement");

        if (false === $stmt) {
            error_log('mysqli prepare() failed: ');
            // Since all the following operations need a valid/ready statement object
            // it doesn't make sense to go on
            exit();
        }


        $bind = $stmt->bind_param($type, ...$reference);
        if (false === $bind) {
            error_log('bind_param() failed:');
            error_log(print_r(htmlspecialchars($stmt->error), true));
            exit();
        }
        // Execute the query

        $exec = $stmt->execute();

        // Check if execute() failed. 
        // execute() can fail for various reasons. And may it be as stupid as someone tripping over the network cable

        if (false === $exec) {
            error_log('mysqli execute() failed: ');
            error_log(print_r(htmlspecialchars($stmt->error), true));
        }

        $stmt->close();

        $response = array(
            "status"=>true,
            "response" => "deletion successful"
        );

        return $response;
    }

    public function searcher($table,$statement,$type,$values){
        $conn = $this->getConnection();
        $temp_arry = [];
        $Response = [false];

        if ($stmt = $conn->prepare("SELECT * FROM $table WHERE $statement")) {

            $stmt->bind_param($type, ...$values);

            $stmt->execute();
            $result = $stmt->get_result();

            while ($data = $result->fetch_assoc()) {
                array_push($temp_arry, $data);
                $Response[0] = true;
            }

            $stmt->close();
        }

        array_push($Response,$temp_arry);

        return $Response;
    }
}