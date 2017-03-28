<?php

namespace Hug\Xpath;

use Hug\Http\Http;

/**
 *
 */
class Xpath
{
    /**
     * Extracts all elements matching query
     *
     * @param string $text Text to search in
     * @param string $query XPATH query
     *
     * @return array
     */
    public static function extract_all($text, $query)
    {
        $Results = [];

        $my_dom = new \DOMDocument();
        @$my_dom->loadHTML($text);
        $xpath = new \DOMXPath($my_dom);
        
        $QueryResults = $xpath->query($query);
        foreach ($QueryResults as $QueryResult)
        {
            $Results[] = $QueryResult->nodeValue;
        }
        
        unset($xpath);
        unset($my_dom);

        return $Results;
    }

    /**
     * Extracts first element matching query
     *
     * @param string $text Text to search in
     * @param string $query XPATH query
     *
     * @return string $result
     */
    public static function extract_first($text, $query)
    {
        $my_dom = new \DOMDocument();
        @$my_dom->loadHTML($text);
        $xpath = new \DOMXPath($my_dom);
        
        $Results = $xpath->query($query)->item(0);
        if(isset($Results->nodeValue))
        {
            return $Results->nodeValue;//nodeValue / value
        }
        else
        {
            return false;
        }
    }

    /**
     * Extracts body of HTML document
     *
     * @param string $html Text to search in
     *
     * @return string $body
     */
    public static function get_body($html)
    {
        $my_dom = new \DOMDocument();
        @$my_dom->loadHTML($html);
        $xpath = new \DOMXPath($my_dom);

        $nodes = $xpath->query("/html/body");
        $body = "";
        foreach($nodes as $node)
        {
            $body .= $node->nodeValue;
        }   
        return $body; 
    }

    /**
     * Replaces body of HTML document
     *
     * @link http://stackoverflow.com/questions/4614434/how-can-i-use-xpath-and-dom-to-replace-a-node-element-in-php
     * 
     * @param string $html
     * @param string $new_body
     *
     * @return string $html New html with replaced body
     */
    public static function replace_body($html, $new_body)
    {
        $my_dom = new \DOMDocument();
        @$my_dom->loadHTML($html);
        $xpath = new \DOMXPath($my_dom);
        
        //create replacement
        $replacement  = $my_dom->createDocumentFragment();
        $replacement->appendXML('<body>'.$new_body.'</body>');
        
        //make replacement
        $oldNode = $xpath->query('/html/body')->item(0);
        $oldNode->parentNode->replaceChild($replacement  , $oldNode);
        //save html output
        $new_html = $my_dom->saveHTML($my_dom->documentElement);

        if($new_html!==FALSE)
        {
            $html = $new_html;
        }

        return $html;
    }


    /**
     * XPath fails at extracting html tags style attributes content
     *
     * @param string $text
     * @param string $query XPath Query
     * @param string $style_property Style property to extract (CSS name)
     *
     * @return array $Results styles attributes/value
     */
    public static function extract_style($text, $query, $style_property)
    {
        $Results = [];

        $my_dom = new \DOMDocument();
        @$my_dom->loadHTML($text);
        $xpath = new \DOMXPath($my_dom);
        
        $QueryResults = $xpath->query($query);
        foreach ($QueryResults as $QueryResult)
        {
            $style = $QueryResult->getAttribute('style');
            $style = array_filter( explode(';',$style) );
            $styles = array();
            foreach ($style as $one_style)
            {
                $one_style = explode(':', $one_style);
                $styles[$one_style[0]] = $one_style[1]; 
            }
            //print_r($styles);
            if( isset($styles[$style_property]) )
            {
                $Results[] = $styles[$style_property];
            }
        }
        return $Results;
    }


    /**
     * Extracts an iframe from a webpage
     *
     * @param string $html webpage HTML
     * @param string $domain
     *
     * @return mixed iframe
     *
     */
    public static function extract_iframe($html, $domain)
    {
        $iframe = null;

        $xpath_query = '//body//iframe//@src';
        $items = Xpath::extract_all($html, $xpath_query);
        foreach ($items as $item)
        {
            if(Http::extract_domain_from_url($item)===$domain)
            {
                $iframe = $item;
                break;
            }
        }

        return $iframe;
    }

}
