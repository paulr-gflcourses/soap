<?php

class WSDLService
{
    private $url;
    private $methodName;
    private $returnName;
    private $elementName;
    private $params;

    public function __construct($url, $methodName, $returnName, $elementName, $params=[])
    {
        $this->url = $url;
        $this->methodName = $methodName;
        $this->returnName = $returnName;
        $this->elementName = $elementName;
        $this->params = $params;
    }

    public function soapMethod()
    {
        try
        {
            $client = new SoapClient($this->url.'?WSDL');
            $methodName = $this->methodName;
            $returnName = $this->returnName;
            $elementName = $this->elementName;
            $result = $client->$methodName($this->params)->$returnName;

        }catch (SoapFault $e)
        {
            throw new Exception(ERR_SENDING."({$e->faultstring})");
        }
        if ($elementName)
        {
            return $result->$elementName;
        }else
        {
            return $result;
        }
    }

    public function curlMethod()
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
        $err = curl_error($ch);
        curl_close($ch);  
        if ($err)
        {
            throw new Exception(ERR_SENDING."($err)");
        }
        return simplexml_load_string($result);
    }

}

?>
