<?php

use PHPUnit\Framework\TestCase;

class BackendTest extends TestCase{
    public function testRegisterUsernameValidate(){        
        $test = new App\Validation;
        $result = $test->RegisterUsernameValidate('Test');
        
        $this->assertEquals(1, $result);
    }

    public function testRegisterPasswordValidate(){
        $test = new App\Validation;
        $result = $test->RegisterPasswordValidate('test');                    
        
        $this->assertEquals(1, $result);
    }

    public function testLoginUsernameValidate(){        
        $test = new App\Validation;
        $result = $test->LoginUsernameValidate('Test');
        

        $this->assertEquals(1, $result);
    }

    public function testLoginPasswordValidate(){
        $test = new App\Validation;
        $result = $test->LoginPasswordValidate('test');

        $this->assertEquals(1, $result);
    }

    public function testRegisterNameValidate(){
        $test = new App\Validation;
        $result = $test->RegisterNameValidate('Miguel Helguero');

        $this->assertEquals(1, $result);
    }

    public function testRegisterAddressOneValidate(){
        $test = new App\Validation;
        $result = $test->RegisterAddressOneValidate('123456 Oceanview Drive');

        $this->assertEquals(1, $result);
    }

    public function testRegisterAddressTwoValidate(){
        $test = new App\Validation;
        $result = $test->RegisterAddressTwoValidate('987654 Main St.');

        $this->assertEquals(1, $result);
    }

    public function testRegisterCityValidate(){
        $test = new App\Validation;
        $result = $test->RegisterCityValidate('Houston');

        $this->assertEquals(1, $result);
    }

    public function testRegisterStateValidate(){
        $test = new App\Validation;
        $result = $test->RegisterStateValidate('TX');

        $this->assertEquals(1, $result);
    }

    public function testRegisterZipcodeValidate(){
        $test = new App\Validation;
        $result = $test->RegisterZipcodeValidate('77450');

        $this->assertEquals(1, $result);
    }
    
    public function testGallonsValidate(){
        $test = new App\Validation;
        $result = $test->GallonsValidate("400.55");

        $this->assertEquals(1, $result);
    }

    public function testDeliveryDateValidate(){
        $test = new App\Validation;
        $result = $test->DeliveryDateValidate("2021-08-16");

        $this->assertEquals(1, $result);
    }
}