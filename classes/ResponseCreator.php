<?php
/**
 * @author soumen pasari
 * @package static-response-creator
 */

 class ResponseCreator
 {
     /**
      * class variables
      */
     public static $response = [
         'status'=>true,
         'message'=>NULL,
         'httpResponseCode'=>200,
         'data'=>NULL
     ];

     /**
      * get response to assign in your own array var
      * @return array
      */
      public static function getDefaultResponse()
      {
          return [
            'status'=>true,
            'message'=>NULL,
            'httpResponseCode'=>200,
            'data'=>NULL
          ];
      }
      /**
       * set response array var
       * @param array - ['status'=>value,'message'=>value,'httpResponseCode'=>value,'data'=>value]
       * @return NULL
       */
      public static function setResponse($param = NULL)
      {
        if(!empty($param) || $param != NULL)
        {
            if(!empty($param['status']))
            {
                self::$response['status'] = $param['status'];
            }
            if(!empty($param['message']))
            {
                self::$response['message'] = $param['message'];
            }
            if(!empty($param['httpResponseCode']))
            {
                self::$response['httpResponseCode'] = $param['httpResponseCode'];
            }
            if(!empty($param['data']))
            {
                self::$response['data'] = $param['data'];
            }
        }
        return NULL;
      }
      /**
       * set error response
       */
      public static function error($message,$httpResponseCode,$data = NULL)
      {
        try
        {
            # checking mendatory params
            if($message != '' && $httpResponseCode != '')
            {
                self::$response['status'] = false;
                self::$response['message'] = $message;
                self::$response['httpResponseCode'] = $httpResponseCode;
                if($data != NULL)
                {
                    self::$response['data'] = $data;
                }
            }
            else
            {
                throw new Exception('Params not proper in - '.__METHOD__,400);
            }
        }
        catch(Exception $e)
        {
            self::$response['status'] = false;
            self::$response['message'] = $e->getMessage();
            self::$response['httpResponseCode'] = $e->getCode();
        }
      }
      /**
       * set success response
       */
      public static function success($message,$httpResponseCode,$data = NULL)
      {
        try
        {
            # checking mendatory params
            if($message != '' && $httpResponseCode != '')
            {
                self::$response['status'] = true;
                self::$response['message'] = $message;
                self::$response['httpResponseCode'] = $httpResponseCode;
                if($data != NULL)
                {
                    self::$response['data'] = $data;
                }
            }
            else
            {
                throw new Exception('Params not proper in - '.__METHOD__,400);
            }
        }
        catch(Exception $e)
        {
            self::$response['status'] = false;
            self::$response['message'] = $e->getMessage();
            self::$response['httpResponseCode'] = $e->getCode();
        }
      }
 }