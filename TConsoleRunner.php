<?php
/**
 * A component for execute console command of Yii console application
 *
 * @author yohan
 */
class TConsoleRunner extends CComponent
{
    private $_consoleFile;
    
    /**
     * Construction function that assign console application file path that will executed
     * @param string $consoleFile filename for console application in root directory
     */
    public function __construct($consoleFile) {
        $this->_consoleFile=$consoleFile;
    }
    
    /**
     * Running console command on background
     * @param string $cmd argument that passed to console application
     * @return boolean
     */
    public function run($cmd)
    {
        $cmd=PHP_BINDIR."/php ".Yii::app()->basePath.'/../'.$this->_consoleFile.' '.$cmd;
        if($this->isWindows())
            pclose(popen('start /b '.$cmd, 'r'));
        else 
            pclose(popen($cmd.' /dev/null &', 'r'));
        return true;
    }
    
    /**
     * Function to check operating system
     */
    protected function isWindows()
    {
        if(PHP_OS == 'WINNT' || PHP_OS == 'WIN32')
            return true;
        else 
            return false;
    }
}
?>