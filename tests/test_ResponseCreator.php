<?php

use \soumenpasari\responseCreator\ResponseCreator as rpc;

class blank_response extends PHPUnit\Framework\TestCase
{
    public function test_response()
    {
        $response = rpc::getResponse();

        $responseToCheck = [
            'status'=>true,
            'message'=>null,
            'httpResponseCode'=>200,
            'data'=>null
        ];

        $this->assertEquals($response,$responseToCheck);
    }
}

?>