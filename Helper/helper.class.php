<?php

class Helper 
{

    public function checkNum(array $num_arry) : array
    {
        $check = $this->checkNull($num_arry);
        if ($check['state'] !== 'success') {
            return $check;
        }

        $key = array_keys($num_arry)[0];
        $value = array_values($num_arry)[0];

        if (!is_numeric($value)) {
        return array(
                'state' => 'fail',
                'message' => "Invalid '".$key. "' value. It should be a number"
            ); 
            
        } else {
        return array(
                'state' => 'success',
            ); 
        }
    }


    public function checkString(array $str_arr, int $len=0) : array
    {
        $check = $this->checkNull($str_arr);
        if ($check['state'] !== 'success') {
            return $check;
        }

        $key = array_keys($str_arr)[0];
        $value = array_values($str_arr)[0];

        if (strlen($value) > $len) {
        return array(
                'state' => 'fail',
                'message' => "'".$key. "' too long. It should be within ". $len ." characters"
            ); 
        } else {
            return array(
                'state' => 'success',
            ); 
        }
    }

    public function checkType(array $str_arr) : array
    {
        $value = array_values($str_arr)[0];
        $allowed_types = array("DVD","Book","Furniture");

        if (in_array($value, $allowed_types)) {
            return array(
                'state' => 'success',
            ); 
        } else {
            return array(
                'state' => 'fail',
                'message' => "Invalid 'Type'. Only 'DVD','Book', or 'Furniture' allowed "
            ); 
        }
    }

    public function checkNull(array $arr) : array
    {
        $key = array_keys($arr)[0];
        $value = array_values($arr)[0];
        
        if (is_null($value) or strlen(str_replace(" ","",$value)) <= 0 ) {
            return array(
                'state' => 'fail',
                'message' => "'".$key. "' should not be Null"
            ); 
        } else {
        return array(
                'state' => 'success',
            ); 
        }
    }

    public function checkNoOfRowInDB(string $data, string $table, string $colnum, object $db) : Int
    {
            // Database involved function
            $sql = "SELECT * FROM $table WHERE $colnum='$data'";
            $fetch = $db->query($sql);
            return $fetch->num_rows;
            
    }

    public static function jsendFormatter(string $status, array $content) : string 
    {
        /** Use JSend specification to return result.
         * If status = error, only $content[0] (error msg) is returned.
        */

        $return = [];
        switch ($status) {
            case "success":
                $return = array(
                    "status" => $status,
                    "data" => $content
                );
                break;

            case "fail":
                $return = array(
                    "status" => $status,
                    "data" => $content
                );
                break;

            case "error":
                $return = array(
                    "status" => $status,
                    "message" => $content[0]
                );
                break;

            default:
                return $return;      
        };

        return json_encode($return);
    }
}

?>