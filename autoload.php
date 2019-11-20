<?php
/**
  * loading other required class files
  */
  function autoloadClass($className) {
        $filename = 'classes/'.$className . ".php";
        if (is_readable($filename)) {
            require $filename;
        }
    }

    spl_autoload_register("autoloadClass");