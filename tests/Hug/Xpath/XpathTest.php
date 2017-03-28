<?php

# For PHP7
// declare(strict_types=1);

// namespace Hug\Tests\Xpath;

use PHPUnit\Framework\TestCase;

use Hug\Xpath\Xpath as Xpath;

/**
 *
 */
final class XpathTest extends TestCase
{

    public $html;
    // public $html_invalid;
    public $html_iframe;

    function __construct()
    {
        $data = realpath(__DIR__ . '/../../../data/');
        $this->html = file_get_contents($data . '/free.fr.html');
        // $this->html_invalid = file_get_contents($data . 'free.fr-invalid.html');
        $this->html_iframe = file_get_contents($data . '/iframe.html');
    }

    /* ************************************************* */
    /* *************** Xpath::extract_all ************** */
    /* ************************************************* */

    /**
     *
     */
    public function testCanExtractAllWirthValidHtml()
    {
        $query = '//a';
        $test = Xpath::extract_all($this->html, $query);
        $this->assertInternalType('array', $test);
    }

    /**
     *
     */
    // public function testCannotExtractAllWirthInvalidHtml()
    // {
    //     $test = Xpath::extract_all($this->html_invalid, $query);
    //     $this->assertInternalType('boolean', $test);
    //     $this->assertFalse($test);
    // }

    /* ************************************************* */
    /* ************** Xpath::extract_first ************* */
    /* ************************************************* */

    /**
     *
     */
    public function testCanExtractFirstWithValidHtml()
    {
        $query = '//body//h3';
        $test = Xpath::extract_first($this->html, $query);
        $this->assertInternalType('string', $test);
    }

    /**
     *
     */
    // public function testCannotExtractFirstWithInvalidHtml()
    // {
    //     $test = Xpath::extract_first($this->html, $query);
    //     $this->assertInternalType('null', $test);
    // }

    /* ************************************************* */
    /* **************** Xpath::get_body **************** */
    /* ************************************************* */

    /**
     *
     */
    public function testCanGetBodyWithValidHtml()
    {
        $test = Xpath::get_body($this->html);
        $this->assertInternalType('string', $test);
    }

    /**
     *
     */
    // public function testCannotGetBodyWithInvalidHtml()
    // {
    //     $test = Xpath::get_body($html);
    //     $this->assertInternalType('array', $test);
    // }

    /* ************************************************* */
    /* ************** Xpath::replace_body ************** */
    /* ************************************************* */

    /**
     *
     */
    public function testCanReplaceBodyWithValidHtml()
    {
        $new_body = '<div>coucou toi</div>';
        $test = Xpath::replace_body($this->html, $new_body);
        $this->assertInternalType('string', $test);
    }

    /**
     *
     */
    // public function testCannotReplaceBodyWithInalidHtml()
    // {
    //     $test = Xpath::replace_body($html, $new_body);
    //     $this->assertInternalType('string', $test);
    // }

    /* ************************************************* */
    /* ************** Xpath::extract_style ************* */
    /* ************************************************* */

    /**
     *
     */
    public function testCanExtractStyleWithValidQuery()
    {
        $query = '//body//div[@class="inscriptionadsl"]';
        $style_property = 'height';
        $test = Xpath::extract_style($this->html, $query, $style_property);
        $this->assertInternalType('array', $test);
    }


    /* ************************************************* */
    /* ************* Xpath::extract_iframe ************* */
    /* ************************************************* */

    /**
     *
     */
    public function testCanExtractIframeWithValidDomain()
    {
        $domain = 'hugo.maugey.fr';
        $test = Xpath::extract_iframe($this->html_iframe, $domain);
        $this->assertInternalType('string', $test);
    }

    /**
     *
     */
    // public function testCannotExtractIframeWithInalidDomain()
    // {
    //     $test = Xpath::extract_iframe($this->html, 'www.fraa.fr');
    //     $this->assertInternalType('null', $test);
    // }

}

