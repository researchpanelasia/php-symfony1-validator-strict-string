<?php

require_once dirname(__FILE__) . '/../vendor/symfony/symfony1/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class sfValidatorStrictStringTest extends \PHPUnit_Framework_TestCase
{
    public $v;

    protected function setUp()
    {
        $this->v = new sfValidatorStrictString(array('required' => true, 'max_length' => 4));
    }

    public function testOK()
    {
        $ok = array(
            'a',
            'aaaa',
        );

        foreach ($ok as $str) {
            try {
                $this->v->clean($str);

                $this->assertTrue(TRUE);
            }
            catch (Exception $e) {
                $this->assertTrue(FALSE);
            }
        }
    }

    public function testNG()
    {
        $ng = array(
            ' ',

            ' aaa',
            'aaa ',
            ' aa ',

            "\taaa",
            "aaa\t",
            "\taa\t",

            "\naaa",
            "aaa\n",
            "\naa\n",

            "\raaa",
            "aaa\r",
            "\raa\r",
        );

        foreach ($ng as $str) {
            try {
                $this->v->clean($str);

                $this->assertTrue(FALSE);
            }
            catch (Exception $e) {
                $this->assertEquals($e->getCode(), 'invalid');
            }
        }
    }
}
