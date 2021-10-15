<?php
    class Validate
    {
        public function email_validate($email)
        {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return false; 
            }
            else{
                return true;
            } 
            
        }
        public function password_validate($password)
        {
            $password_pattern='/^(?=.*[A-Z]).{8,20}$/';
            if(!preg_match($password_pattern, $password)){
                return false;
            }
            else{
                return true;
            } 
            
        }
        public function phone_Validate($phone)
        {
            $phone_pattern = "/^(03)+([0-4]{1})+([0-9]{1})[-]([0-9]{7})$/";
            if(!preg_match($phone_pattern, $phone)){
                return false;
            }
            else{
                return true;
            } 
        }
        public function name_validate($name)
        {
            $name_pattern="/^[a-zA-Z ]*$/";
            if(!preg_match($name_pattern, $name)){
                return false;
            }
            else{
                return true;
            } 
        }
        public function cnic_validate($cnic)
        {
            $cnic_pattern="/^([0-9]{5})[-]([0-9]{7})[-]([0-9]{1})$/";
            if(!preg_match($cnic_pattern, $cnic)){
                return false;
            }
            else{
                return true;
            } 
        }
        public function dep_validate($department)
        {
            $department_pattern="/^[a-zA-Z]*+[0-9]*$/";
            if(!preg_match($department_pattern, $dep)){
                echo "invalid";
                return false;
            }
            else{
                return true;
            }
        }
    }
?>