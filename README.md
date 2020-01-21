# RESPONSE CREATOR
---
![](https://img.shields.io/github/issues/soumenpasari/responseCreator) ![](https://img.shields.io/github/languages/code-size/soumenpasari/responseCreator) ![](https://img.shields.io/packagist/v/soumenpasari/response-creator) ![](https://img.shields.io/github/license/soumenpasari/responseCreator)

This is a response manager library, basically used to manage response of your code and program for later use or use cases. It helps in managing responses of several module withing your code and return the response according to your needs.
This is a static library so you don't need to create any object of it.

### Features!
* Manages response of your code or API.
* Multiple branch of response can be created and managed.
* Different branches can be merged
* Return or get response in two formats ie; either array or json format.
* Helps to maintain http response code of your program.

### Installation via compser
```sh
composer require soumenpasari/response-creator
```

### Configuration required
Works with PHP v5.6 or above

---

## Documentation

>This guide will help you understand how to use this static library.
>This is a __static library__, you don't have to create an object of it.

### Baisc usage
```
<?php
    use \soumenpasari\responseCreator\ResponseCreator as rpc;
    
    /**
    *   if success to be recorded
    **/
    rpc::success('abc_module','some message to record',200,[1,2,3,4]);
    
    /**
    *   fetch response of abc_module
    **/
    $abc_module_response = rpc::getResponse('array','abc_module');

    /**
    *   fetch all response
    **/
    $whole_response = rpc::getResponse('json');

?>
```

#### Alaising the namespace (if you need it)
```
use \soumenpasari\responseCreator\ResponseCreator as rpc;
```

#### Understanding the branches
By default there is only one branch ie; master branch of your whole response, and whatever you record is recorded or stored under your master branch of response. \
__Why do you need to create branches__ : Suppose the application or software or API that you are working on have different modules and you want to track responses of multiple modules that your code goes through in a single run. For example like when a log in module is executed there is are several modules like:
* backend validation of user input data
* checking user id exist or not
* checking password for that user is valid or not
* creating session if user credentials are valid and then redirecting

So, there are different modules for which you can create a different branch of response and analyse and let you make your code act accordingly ie; if it passed or not and if it fails then what was the message of it. All these information according to your branch can be fetched and managed.

#### Logging success
```
rpc::success(branch_name,message_to_log,http_response_code,data_to_log)
```
* branch_name - *string* -name of your branch, if its master branch then you have to mention it. (__required__)
* message_to_log - *string* -message to log in that branch. (requried)
* http_response_code - *int* - http response code of your code to be set (in here mostly is 200). (__required__)
* data_to_log - *array* -array or any other data to log within your respective branch. (__optional__)

#### Logging error
```
rpc::error(branch_name,message_to_log,http_response_code,data_to_log)
```
* branch_name - *string* - name of your branch, if its master branch then you have to mention it. (__required__)
* message_to_log - *string* - message to log in that branch. (__required__)
* http_response_code - *int* - http response code of your code to be set (default value : 400) (__optional__)
* data_to_log - *array* - array or any other data to log within your respective branch. (__optional__)

#### Merging two branches
```
rpc::merge(branch_that_to_merge,branch_to_be_merged_into,delete_merged_branch)
```
* branch_that_to_merge - *string* - name of the branch that to be merged. (__required__)
* branch_to_be_merged_into - *string* - name of the branch that the other branch to be merged to. (**default value : master**)(__optional__)
* delete_merged_branch - *boolean* - set true if you want to delete the merged branch after it get merged. (**default value : true**) (__optional__)

#### Reset response values of any branch
```
rpc::reset(branch_name)
```
* branch_name - *string* - name of the branch to reset. (**default value : master**). (__optional__)

#### Get response
```
rpc::getResponse(type_of_response,branch_name)
```
* type_of_response - *string* - type of response to fetch ie; array or json. (**default value : array**). (__optional__).
    * array - if you want response to be in the form of array then parameter will be array.
    * json - if you want the response to be fetched in the form of json.
* branch_name - *string* - name of the branch to fetch the response of. By default if no parameter is passed then all branches response will be fetched. (__optional__)

## License
responseCreator is licensed under MIT License - see the ```License``` for details.