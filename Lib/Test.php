<?php
/**
 * Test.php
 * This file is for testing purposes
 *
 * @author  Michael Pratt <pratt@hablarmierda.net>
 * @link http://www.michael-pratt.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

if (function_exists('date_default_timezone_set'))
    date_default_timezone_set('America/Bogota');

function SimpleLifestreamOutput($m, $die = false) { echo "${m} \n"; if ($die) die('Fatal Error!'); }

require(dirname(__FILE__) . '/SimpleLifestream.php');
SimpleLifestreamOutput('Testing The Simple Life(stream) Library');

if (function_exists('curl_init'))
    SimpleLifestreamOutput('CURL OK');
else
    SimpleLifestreamOutput('Need to have CURL',true);

if (function_exists('json_decode'))
    SimpleLifestreamOutput('JSON OK');
else
    SimpleLifestreamOutput('Need to have JSON', true);

$testArray = array('Github'  => array('Github' => array('username' => 'mpratt')),
                   'Twitter' => array('Twitter' => array('username' => 'parishilton')),
                   'Youtube' => array('Youtube' => array('username' => 'mtppratt')),
                   'StackOverflow' => array('StackOverflow' => array('username' => '430087')),
                   'FacebookPages' => array('FacebookPages' => array('username' => '27469195051')));

SimpleLifestreamOutput(' ');
foreach($testArray as $title => $config)
{
    SimpleLifestreamOutput('Testing ' . $title);

    try {
        $lifestream = new SimpleLifestream($config);
        $output = $lifestream->getLifestream();

        if (!is_array($output))
            SimpleLifestreamOutput('Wrong format returned', true);
        else if (empty($output))
            SimpleLifestreamOutput('Empty array returned', true);

        SimpleLifestreamOutput('Validating ' . $title . ' output');
        foreach ($output as $k => $o)
        {
            if (empty($o['html']) || !is_string($o['html']))
                SimpleLifestreamOutput('Html key number ' . $k . ' is in the wrong format', true);
            else if (empty($o['date']) || !is_numeric($o['date']))
                SimpleLifestreamOutput('Date key number ' . $k . ' is in the wrong format', true);
            else if (empty($o['service']) || $o['service'] != strtolower($title))
                SimpleLifestreamOutput('Wrong Service key number ' . $k, true);
        }

        unset($lifestream);
        SimpleLifestreamOutput($title . ' Test Passed');
        SimpleLifestreamOutput(' ');
    } catch (Exception $e) { SimpleLifestreamOutput('Library Exception - ' . $e->getMessage(), true); }
}

?>