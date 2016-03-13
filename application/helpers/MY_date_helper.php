<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Date Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/helpers/array_helper.html
 */

// ------------------------------------------------------------------------

if ( ! function_exists('formatElapseTime'))
{
	function formatElapseTime($date)
	{
		$time = strtotime($date);
		$diff = $_SERVER['REQUEST_TIME'] - $time;

        $year = floor($diff / 60 / 60 / 24 / 365);

        $diff -= $year * 60 * 60 * 24 * 365;

        $month = floor($diff / 60 / 60 / 24 / 30);

        $diff -= $month * 60 * 60 * 24 * 30;

        $week = floor($diff / 60 / 60 / 24 / 7);

        $diff -= $week * 60 * 60 * 24 * 7;

        $day = floor($diff / 60 / 60 / 24);

        $diff -= $day * 60 * 60 * 24;

        $hour = floor($diff / 60 / 60);

        $diff -= $hour * 60 * 60;

        $minute = floor($diff / 60);

        $diff -= $minute * 60;

        $second = $diff;

        $unitMsgArr = array(
            'year' => $year.'年前 ('.date('Y-m-d', $time).')',
            'month' => $month.'个月前 ('.date('m-d', $time).')',
            'week' => $week.'周前 ('.date('m-d', $time).')',
            'day' => $day.'天前 ('.date('m-d', $time).')',
            'hour' => $hour.'小时前',
            'minute' => $minute.'分钟前',
            'second' => '刚刚'
        );

        foreach ( $unitMsgArr as $label => $msg )
        {
            if ( $$label > 0 )
            {
                $elapse = $unitMsgArr[$label];
                break;
            }
        }

        return $elapse;


    }
}
