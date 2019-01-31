# PHP's Session serialization

Under the hood, PHP's session handle the process of serialization an unserialization of objects stored in it.

## Purpose of serialization
Serialization means convert an object to a bytestream to be stored in a file or database.  
If you want make objects persistent, **serialize()** and **unserialize()** are the functions.
```
$encoded = serialize(something);
$something = unserialize(encoded);
```

## Load classes definitions before unserialize
In this project a log object was injected in PHP Session logger variable.  
In the 'next.php' page is vital to load the Log class before session initialization.
```
include_once "Log.php"; // load class definitions first
session_start();        // then boot the session
?>
<html>...
```

## Tell PHP which variables to keep track when packing the object
PHP provides two hooks for classes that notify their objects that they're being serialized.  
These are the functions **__wakeup()** and **__ sleep() **.
### Sleep Hook
Called just before serialization. It's the opportunity to perform cleanups, close database connections, etc.
It should return an array containing the names of the object's properties that you want to be written into the bytestream.
An empty array results in no data being written.
In this project this hook was used to write and close the log text file and select two properties of object.
```
public function __sleep()
{
    fclose($this->fh); // write information to the log file
    // persist filename and teste properties of object
    // case just filename is put in the array only this property is stored
    return array("filename","teste"); 
}
```
### Wakeup Hook
Called immediately after an object is created from a bytestream. A good opportunity for initialization tasks like opening database connections, etc.  
In this project the hook reopens the log text file.