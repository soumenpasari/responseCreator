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
     protected static $response = [
         'master'=>[
             'status'=>true,
             'message'=>null,
             'httpResponseCode'=>200,
             'data'=>null
         ]
     ];
     /**
      * get response variable according to the register key if defined
      * @param string $registerKey - register key for response array
      * @param string $type - type of response array ie array or json
      * @return array $response
      */
     public static function getResponse($registerKey = null,$type = 'array')
     {
         if($registerKey != null)
         {
             return self::getResponseByType(self::$response[$registerKey],$type);
         }
         else
         {
            return self::getResponseByType(self::$response['master'],$type);
         }
     }
     /**
      * return response according to the type
      */
      public static function getResponseByType($response,$type)
      {
        if($type == 'array')
        {
            return self::$response;
        }
        else if($type == 'json')
        {
            return json_encode(self::$response);
        }
        else
        {
            self::error('master','Improper response type mentioned! - '.__METHOD__);
            return self::$response;
        }
      }
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
       * set error response
       * @param string $registerKey - key or array response
       * @param string $message - your resposne message
       * @param int [$httpResponseCode] - process's http response code to set
       * @param mixed[] [$data] - generally any data related to process is stored here
       * @return null
       */
      public static function error($registerKey,$message,$httpResponseCode = 400,$data = NULL)
      {
        try
        {
            # checking mendatory params
            if($message != '' && $httpResponseCode != '' && $registerKey != '')
            {
                self::$response[$registerKey]['status'] = false;
                self::$response[$registerKey]['message'] = $message;
                self::$response[$registerKey]['httpResponseCode'] = $httpResponseCode;
                if($data != NULL)
                {
                    self::$response[$registerKey]['data'] = $data;
                }
                http_response_code($httpResponseCode);
            }
            else
            {
                throw new Exception('Params not proper in - '.__METHOD__,400);
            }
        }
        catch(Exception $e)
        {
            self::$response['master']['status'] = false;
            self::$response['master']['message'] = $e->getMessage();
            self::$response['master']['httpResponseCode'] = $e->getCode();
            http_response_code($e->getCode());
        }
        return null;
      }
      /**
       * set success response as per the registerKey
       * @param string $registerKey - key or array response
       * @param string $message - your resposne message
       * @param int $httpResponseCode - process http response code to set
       * @param mixed [$data] - generally any data related to process is stored here
       * @return null
       */
      public static function success($registerKey,$message,$httpResponseCode,$data = NULL)
      {
        try
        {
            # checking mendatory params
            if($message != '' && $httpResponseCode != '' && $registerKey != '')
            {
                self::$response[$registerKey]['status'] = true;
                self::$response[$registerKey]['message'] = $message;
                self::$response[$registerKey]['httpResponseCode'] = $httpResponseCode;
                if($data != NULL)
                {
                    self::$response[$registerKey]['data'] = $data;
                }
                http_response_code($httpResponseCode);
            }
            else
            {
                throw new Exception('Params not proper in - '.__METHOD__,400);
            }
        }
        catch(Exception $e)
        {
            self::$response['master']['status'] = false;
            self::$response['master']['message'] = $e->getMessage();
            self::$response['master']['httpResponseCode'] = $e->getCode();
            http_response_code($e->getCode());
        }
        return null;
      }
      /**
       * merge registered key case to master registry
       * @param string $fromRegisterKey - register key which needs to be merged in master
       * @param string [$toRegisterKey] - the registry to which data is going to be merged
       * @param boolean [$unsetRegistry] - flag for unsetting registry which is going to be merged
       * @return null
       */
      public static function merge($fromRegisterKey = null,$toRegisterKey = 'master',$unsetRegistry = true)
      {
          try
          {
            if($fromRegisterKey != null)
            {
                if(array_key_exists($fromRegisterKey,self::$response) && array_key_exists($toRegisterKey,self::$response))
                {
                    # copying user defined registry to master registry
                    self::$response[$toRegisterKey] = self::$response[$fromRegisterKey];
                    # setting data of merged from which registry
                    self::$response[$toRegisterKey]['mergedFrom'] = $fromRegisterKey;
                    # unsetting registry
                    if($unsetRegistry)
                    {
                        # remove user defined registry
                        unset(self::$response[$fromRegisterKey]);
                    }
                    # setting page's https response code
                    http_response_code(self::$response[$toRegisterKey]['httpResponseCode']);
                }
                else
                {
                    throw new Exception('Registry not created!',400);
                }                
            }
            else
            {
                throw new Exception('No registry given for merge!',400);
            }
          }
          catch(Exception $e)
          {
            self::$response['master']['status'] = false;
            self::$response['master']['message'] = $e->getMessage();
            self::$response['master']['httpResponseCode'] = $e->getCode();
            http_response_code($e->getCode());
          }
          return null;
      }
      /**
       * method to reset response to default response
       * @param $registerKey - registry key in response to response
       */
      public static function reset($registerKey = null)
      {
          if($registerKey == null)
          {
            self::$response = [
                'master'=>self::getDefaultResponse()
            ];
          }
          else
          {
            if(array_key_exists($registerKey,self::$response))
            {
              self::$response[$registerKey] = self::getDefaultResponse();
            }
          }
          http_response_code(200);
          return null;
      }
 }