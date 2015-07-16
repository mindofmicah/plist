<?php
namespace MindOfMicah\Plist;

use DomDocument;
class Parser
{
    public static function parseXML($string, $root_element = null)
    {
        return (new self(DomDocument::loadXML($string), $root_element))->parse();
    }

    protected function __construct(DomDocument $document, $root_element = null)
    {
        if (!$root_element) {
            $this->rootElement = $document->documentElement;
        } else {
            $this->root_element = $document->getElementsByTagName($root_element)->item(0);
        }
    }

    public function parse()
    {
        $r = [];
        for ($i = 1; $i<$this->root_element->childNodes->length; $i+=4) {
            $key = $this->root_element->childNodes->item($i)->firstChild->data;
            $r[$key] = $this->determineValue($this->root_element->childNodes->item($i+2)); 
        }
        return $r;
    }
private function determineValue($a)
{
    switch($a->nodeName) {
    case 'integer':
        return intval($a->childNodes->item(0)->data);
    case 'data':
    case 'string':
        return ($a->childNodes->item(0)->data);
    case 'array':
        $b = [];
        for ($i =1; $i < $a->childNodes->length; $i+=2) {
            $b[] = $this->determineValue($a->childNodes->item($i));
        }
        return $b;
    }

    return $a->childNodes->item(0)->data;
}
}
