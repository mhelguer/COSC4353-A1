<?php

namespace App;

class Validation{
    
    public function RegisterUsernameEmptyValidate($user) {
        return empty($user);       
    }

    public function RegisterUsernameRegexValidate($user) {
        return preg_match("/^\w{2,45}$/", $user);        
    }


    public function RegisterPasswordEmptyValidate($pass) {     
        // Check if Password is empty
        return empty($pass);
    }
            
    public function RegisterPasswordRegexValidate($pass) {     
        // Check if Password follows rules
        return preg_match("/^.{2,45}$/", $pass);
    }                

    

    public function LoginUsernameEmptyValidate($user) {
        return empty($user);       
    }

    public function LoginUsernameRegexValidate($user) {
        return preg_match("/^\w{2,45}$/", $user);        
    }
    

    public function LoginPasswordEmptyValidate($pass) {     
        // Check if Password is empty
        return empty($pass);
    }
            
    public function LoginPasswordRegexValidate($pass) {     
        // Check if Password follows rules
        return preg_match("/^.{2,45}$/", $pass);
    }   

    public function RegisterNameEmptyValidate($name) {    
        // Check if Name is empty
        return empty($name);
    }

    public function RegisterNameRegexValidate($name){
        // Check if Name does not follow rules
        return preg_match("/^.{1,50}$/", $name);    
    }
        

    public function RegisterAddressOneEmptyValidate($add1) {
        return empty($add1);
    }

    public function RegisterAddressOneRegexValidate($add1){
        return preg_match("/^.{1,100}$/", $add1);
    }
            

    public function RegisterAddressTwoRegexValidate($add2) {       
        // Check if Add2 is not following rules
        return preg_match("/^.{0,100}$/", $add2);            
    }

    public function RegisterCityEmptyValidate($city) {            
        // Check if City is empty
        return empty($city);        
    } 
    
    public function RegisterCityRegexValidate($city) {            
        // Check if Name is not following rules
        return preg_match("/^.{1,50}$/", $city);            
    }

    public function RegisterStateEmptyValidate($state) {            
        // Check if State is empty
        return empty($state);
    }

    public function RegisterStateRegexValidate($state) {            
        return preg_match("/^\w{2}$/", $state);
    }
     

    public function RegisterZipcodeEmptyValidate($zip) {
        // Check if zip is empty
        return empty($zip);
    }

    public function RegisterZipcodeRegexValidate($zip) {
        // Check if zip is not following rules
        return preg_match("/^\b\d{5}(?:-\d{4})?\b$/", $zip);
    }
        

    public function GallonsEmptyValidate($gallons) {
        return empty($gallons);
    }
    
    public function GallonsRegexValidate($gal){
        return preg_match("/^\d{1,10}$/", $gal);
    }

    public function DeliveryDateEmptyValidate($delivery) {
        return empty($delivery);
    }

    public function DeliveryDateRegexValidate($delivery) {
        return preg_match("/^\d{4}\-\d{2}\-\d{2}$/", $delivery);
    }
        

    public function CalculateTotal($gal) {    
        // test if total cost calculation is correct    
        $this->costpergal = 10.32;
        $this->total = $this->costpergal * $gal;
        return $this->total;
    }

    public function Connect($link){
        return $link -> connect_errno;        
    }

    public function GetPassword($link, $user){
        $sql = "SELECT Password FROM login WHERE Username = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $stmt->store_result();

        
        $stmt->bind_result($password);
        $stmt->fetch();   
        return $password;                
        
    
    }

    public function GetAddresses($link, $user){
        $sql = "SELECT address1, address2 FROM client_info WHERE Username = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("s", $user );

        $stmt->execute();
        $stmt->store_result();        
        // Store data in variable
        $stmt->bind_result($addr1, $addr2);
        $stmt->fetch();     
        return [$addr1, $addr2];
        
        
    
    }

    public function InsertClient($link, $user, $fullname, $addr1, $addr2, $city, $state, $zip){
        
        
        $sql = "INSERT INTO client_info (Username, fullname, address1, address2, city, state, zipcode)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("sssssss", $user , $fullname, $addr1 , $addr2, $city, $state, $zip);
        
        return $stmt->execute();
    }
    

    public function Order($link, $user, $gal, $addr1, $date, $pricepergal, $total_due){
        $sql = "INSERT INTO fuel_orders (User, gallons, delivery_address, delivery_date, pricepergal, total_due)
                VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $link->prepare($sql);
            $stmt->bind_param("sssssd", $user , $gal, $addr1 , $date, $pricepergal, $total_due);
            
            return $stmt->execute();
            
    }
    public function UpdateAccType($link, $user){
        $sql =  "UPDATE login SET Acc_Type = 1 WHERE Username = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("s", $user );
        
        return $stmt->execute();
    }
    public function EditPasswordEmptyValidate($pass) {
        return empty($pass);       
    }

    public function EditPasswordRegexValidate($pass) {
        return preg_match("/^.{2,45}$/", $pass);

    }

    public function EditNameEmptyValidate($name){
        return empty($name);
    }

    public function EditNameRegexValidate($name){
        return preg_match("/^.{1,50}$/", $name);
    }

    public function EditAddressOneEmptyValidate($addr1){
        return empty($addr1);
    }

    public function EditAddressOneRegexValidate($addr1){
        return preg_match("/^.{1,100}$/", $addr1);
    }

    public function EditAddressTwoRegexValidate($addr2){
        return preg_match("/^.{0,100}$/", $addr2);
    }

    public function EditCityEmptyValidate($city){
        return empty($city);
    }

    public function EditCityRegexValidate($city){
        return preg_match("/^.{1,50}$/", $city);
    }
    
    public function EditStateEmptyValidate($state){
        return empty($state);
    }

    public function EditStateRegexValidate($state){
        return preg_match("/^\w{2}$/", $state);
    }

    public function EditZipcodeEmptyValidate($zip){
        return empty($zip);
    }

    public function EditZipcodeRegexValidate($zip){
        return preg_match("/^\b\d{5}(?:-\d{4})?\b$/", $zip);
    }

    public function EditSetPassword($link, $user, $pass){
        $phash = password_hash($pass, PASSWORD_DEFAULT);
        $sql =  "UPDATE login SET Password = ? WHERE Username = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("ss", $phash, $user);

        return $stmt->execute();
    }

    public function EditSetClientInfo($link, $name, $addr1, $addr2, $city, $state, $zip, $user){
        $sql = "UPDATE client_info SET fullname = ?, address1 = ?, address2 = ?, city = ?, state = ?, zipcode = ? WHERE Username = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("sssssss", $name, $addr1, $addr2, $city, $state, $zip, $user);

        return $stmt->execute();
    }

    public function EditShowAccount($link){
        $sql = "SELECT L.Password, C.fullname, C.address1, C.address2, C.city, C.state, C.zipcode FROM login L JOIN client_info C ON L.Username = C.Username";
        $stmt = $link->prepare($sql);

        return $stmt->execute();
    }

    public function ShowHistory($link, $user){
        $sql = "SELECT gallons, delivery_address, delivery_date, pricepergal, total_due FROM fuel_orders WHERE User = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("s", $user);

        return $stmt->execute();
    }

    
}