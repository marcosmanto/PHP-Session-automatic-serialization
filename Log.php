<?php 

class Log
{
    private $filename;
    private $fh;
    public $teste;
    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->open();
//        $this->teste = "**********[TESTE]***********";
    }
    public function open()
    {
        $this->fh = fopen($this->filename, 'a') or die("Can't open {$this->filename}");
    }
    public function write($note)
    {
        fwrite($this->fh, "{$note}\n");
    }
    public function read()
    {
        return join('', file($this->filename));
    }
    public function __wakeup()
    {
        $this->open();
    }
    public function __sleep()
    {
        // write information to the account file
        fclose($this->fh);
        return array("filename","teste");
    }
}
