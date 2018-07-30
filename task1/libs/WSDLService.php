<?php

class WSDLService
{
    private $url;
    private $methodName;
    private $returnName;
    private $elementName;
    private $params;

    function __construct($url, $methodName, $returnName, $elementName, $params=[])
    {
        $this->url = $url;
        $this->methodName = $methodName;
        $this->returnName = $returnName;
        $this->elementName = $elementName;
        $this->params = $params;
    }

    function soapMethod()
    {
        $client = new SoapClient($this->url.'?WSDL');
        $methodName = $this->methodName;
        $returnName = $this->returnName;
        $elementName = $this->elementName;
        $result = $client->$methodName($this->params)->$retrunName;
        if ($elementName)
        {
            return $result->$elementName;
        }else
        {
            return $result;
        }
    }

    function curlMethod()
    {
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $this->url.'/'.$this->methodName);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if ($this->params)
        {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->params));
        }
        $result = curl_exec($ch); 
        curl_close($ch);  
        return simplexml_load_string($result);
    }

}

?>
