<?php

class ConvKitContainer {

    /**
     * @var ConvKitContainer[]
     */
    private static $instanceList = array();

    /**
     * @var object[]
     */
    private $serviceList = array();

    private function __construct(){
        //noop
    }

    /**
     * @param string $name
     * @return ConvKitContainer
     */
    public static function getInstance($name = 'main'){

        if( !isset(self::$instanceList[$name]) ){
            self::$instanceList[$name] = new ConvKitContainer();
        }

        return self::$instanceList[$name];
    }

    /**
     * @param string $name
     */
    public static function removeInstance($name = 'main'){
        if( !isset(self::$instanceList[$name]) ){
            unset(self::$instanceList[$name]);
        }
    }

    /**
     * @param string $name
     * @param object $service
     */
    public function set($name, $service){
        $this->serviceList[$name] = $service;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has($name){
        return isset($this->serviceList[$name]);
    }

    /**
     * @param string $name
     * @return object
     */
    public function get($name){
        if(isset($this->serviceList[$name])){
            return $this->serviceList[$name];
        }

        throw new InvalidArgumentException(sprintf(
            'The service (%s) not found in container!',
            $name
        ));
    }



}
