<?php

namespace App;

class Validation{
    
    public function RegisterUsernameValidate($user) {
        $flag = 0;        
        // Check if Username is empty
        if(empty($user) ){
            //$this->user_err = "Please enter a Username.";
        } 
        // Check if Username is not following rules
        elseif(!preg_match("/^\w{2,45}$/", $user) ){
            //$this->user_err = "Please enter a valid Username.";
        }
        else{
            $flag++;
        }

        return $flag;
    }

    public function RegisterPasswordValidate($pass) {
        $flag=0;    

        // Check if Password is empty
        if(empty($pass) ){
            //$this->pass_err = "Please enter a Password.";
        } 
        // Check if Password is not following rules
        elseif(!preg_match("/^.{2,45}$/", $pass) ){
            //$this->pass_err = "Please enter a valid Password.";
        }
        else{
            $flag++;
        }

        return $flag;
    }

    public function LoginUsernameValidate($user) {
        $flag = 0;    
        
        // Check if Username is empty
        if(empty($user) ){
            //$this->user_err = "Please enter a Username.";
        } 
        // Check if Username is not following rules
        elseif(!preg_match("/^\w{2,45}$/", $user) ){
            //$this->user_err = "Please enter a valid Username.";
        }
        else{
            $flag++;
        }

        return $flag;
    }

    public function LoginPasswordValidate($pass) {
        $flag=0;
        
        // Check if Password is empty
        if(empty($pass) ){
            //$this->pass_err = "Please enter a Password.";
        } 
        // Check if Password is not following rules
        elseif(!preg_match("/^.{2,45}$/", $pass) ){
            //$this->pass_err = "Please enter a valid Password.";
        }
        else{
            $flag++;
        }

        return $flag;
    }

    public function RegisterNameValidate($name) {
        $flag = 0;

        // Check if Name is empty
        if(empty($name) ){
            //$this->name_err = "Please enter a Name.";
        } 
        // Check if Name is not following rules
        elseif(!preg_match("/^.{1,50}$/", $name) ){
            //$this->name_err = "Please enter a valid Name.";
        }
        else{
            $flag++;
        }

        return $flag;
    }

    public function RegisterAddressOneValidate($add1) {
        $flag=0;
        
        // Check if Add1 is empty
        if(empty($add1) ){
            //$this->add1_err = "Please enter an Address.";
        } 
        // Check if Add1 is not following rules
        elseif(!preg_match("/^.{1,100}$/", $add1) ){
            //$this->add1_err = "Please enter a valid Address.";
        }
        else{
            $flag++;
        }

        return $flag;
    }

    public function RegisterAddressTwoValidate($add2) {
        $flag=0;
        
        // Check if Add2 is not following rules
        if(!preg_match("/^.{0,100}$/", $add2) ){
            //$this->add2_err = "Please enter a valid Secondary Address.";
        }
        else{
            $flag++;
        }

        return $flag;
    }

    public function RegisterCityValidate($city) {
        $flag=0;
        
        // Check if City is empty
        if(empty($city) ){
            //$this->city_err = "Please enter a City.";
        } 
        // Check if Name is not following rules
        elseif(!preg_match("/^.{1,50}$/", $city) ){
            //$this->city_err = "Please enter a valid City.";
        }
        else{
            $flag++;
        }

        return $flag;
    }

    public function RegisterStateValidate($state) {
        $flag=0;
        
        // Check if State is empty
        if(empty($state) ){
            //$this->state_err = "Please select a State.";
        } 
        // Check if State is not following rules
        elseif(!preg_match("/^\w{2}$/", $state) ){
            //$this->state_err = "Please enter a valid State.";
        }
        else{
            $flag++;
        }

        return $flag;
    }

    public function RegisterZipcodeValidate($zip) {
        $flag=0;
        
        // Check if Zip is empty
        if(empty($zip) ){
            //$this->zip_err = "Please enter a Zip.";
        } 
        // Check if Zip is not following rules
        elseif(!preg_match("/^\b\d{5}(?:-\d{4})?\b$/", $zip) ){
            //$this->zip_err = "Please enter a valid Zip.";
        }
        else{
            $flag++;
        }    

        return $flag;
    }

    public function GallonsValidate($gallons) {
        $flag=0;

        if(empty($gallons)) {
            //$this->gallons_err = "Please enter a gallon amount.";
        }
        elseif(!preg_match("/^\d+(?:\.\d{1,2})?$/", $gallons)) {
            //$this->gallons_err = "Please enter a valid gallon amount.";
        }
        else{
            $flag++;
        }

        return $flag;
    }
    
    public function DeliveryDateValidate($delivery) {
        $flag=0;

        if(empty($delivery)) {
            //$this->delivery_err = "Please enter a delivery date.";
        }
        elseif(!preg_match("/^\d{4}\-\d{2}\-\d{2}$/", $delivery)) {
            //$this->delivery_err = "Please enter a valid delivery date.";
        }
        else{
            $flag++;
        }

        return $flag;
    }

    public function Calculate($gal) {    
        // test if total cost calculation is correct    
        $this->costpergal = 10.32;
        $this->total = $this->costpergal * $gal;
        return $this->total;
    }
}
