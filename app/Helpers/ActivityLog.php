<?php

namespace App\Helpers;

use Request;
use App\Models\ActivityLog as ActivityLogModel;

class ActivityLog
{

	public static function addToLog($subject)
	{
		$log = [];
		$log['subject'] = $subject;
		$log['url'] = Request::fullUrl();
		$log['method'] = Request::method();
		$log['ip'] = Request::ip();
		$log['agent'] = Request::header('user-agent');
		ActivityLogModel::create($log);
	}
}
