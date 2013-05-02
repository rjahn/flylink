<?php
/*
 * Copyright 2012 SIB Visions GmbH
 * 
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 * 
 * http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 *
 *
 * History
 *
 * 17.09.2012 - [GS] - creation
 */

/** Interface name */
define('BUG_INTERFACE_CLASSNAME', "flysprayInterface");

class flysprayInterface extends bugtrackingInterface
{
	//members to store the bugtracking information
	var $dbHost      = BUG_TRACK_DB_HOST;
	var $dbName      = BUG_TRACK_DB_NAME;
	var $dbPrefix    = BUG_TRACK_DB_PREFIX;
	var $dbUser      = BUG_TRACK_DB_USER;
	var $dbPass      = BUG_TRACK_DB_PASS;
	var $dbType      = BUG_TRACK_DB_TYPE;
	var $showBugURL  = BUG_TRACK_HREF;
	var $enterBugURL = BUG_TRACK_ENTER_BUG_HREF;

	private $status_color = array(
    'Unconfirmed'         => '#ffa0a0', # red,
    'New'                 => '#ffa0a0', # red,
    'Feedback'            => '#ff50a8', # purple
    'Researching'         => '#ff50a8', # purple
    'Waiting on Customer' => '#ff50a8', # purple
    'Acknowledged'        => '#ffd850', # orange
    'Confirmed'           => '#ffffb0', # yellow
    'Assigned'            => '#c8c8ff', # blue
    'Resolved'            => '#cceedd', # buish-green
    'Requires testing'    => '#cceedd', # buish-green
    'Closed'              => '#eeeeee'); # light gray
	/**
	 * Return the URL to the bugtracking page for viewing 
	 * the bug with the given id. 
	 *
	 * @param int id the bug id
	 * 
	 * @return string returns a complete URL to view the bug
	 **/
	function buildViewBugURL($id)
	{
		return $this->showBugURL.urlencode($id);
	}
	
	/**
	 * Returns the status of the bug with the given id
	 * this function is not directly called by TestLink. 
	 *
	 * @return string returns the status of the given bug (if found in the db), or false else
	 **/
	function getBugStatus($id)
	{
		if (!$this->isConnected())
		{
			return false;
		}
		
		$status = false;
		$query
      = "SELECT ls.status_name, t.is_closed
        FROM " . $this->dbPrefix . "tasks t, " . $this->dbPrefix . "list_status ls
        WHERE t.item_status = ls.status_id
          AND t.task_id='" . $id . "'";

		$result = $this->dbConnection->exec_query($query);
		if ($result)
		{
			$status_rs = $this->dbConnection->fetch_array($result);
			$status = null;
			if ($status_rs)
			{
			    if ($status_rs['is_closed'] == 1)
			    {
				$status = 'Closed';
			    }
			    else
			    {
				$status = $status_rs['status_name'];
			    }
			}	
		}
		
		
		return utf8_encode($status);
		
	}
		
	/**
	 * Returns the status in a readable form (HTML context) for the bug with the given id
	 *
	 * @param int id the bug id
	 * 
	 * @return string returns the status (in a readable form) of the given bug if the bug
	 * 		was found , else false
	 **/
	function getBugStatusString($id)
	{
		$status = $this->getBugStatus($id);
		
		$str = htmlspecialchars($id);
		// if the bug wasn't found the status is null and we simply display the bugID
		if ($status !== false)
		{
      $str = htmlspecialchars("[" . $status . "] " . $id);
		}
		return $str;
	}
	/**
	 * Fetches the bug summary from the BTS db
	 *
	 * @param int id the bug id
	 * 
	 * @return string returns the bug summary if bug is found, else false
	 **/
	function getBugSummaryString($id)
	{
		if (!$this->isConnected())
			return false;

		$status = null;
		$query = "SELECT t.item_summary FROM " . $this->dbPrefix . "tasks t WHERE t.task_id='" . $id . "'";
		
		$result = $this->dbConnection->exec_query($query);
		if ($result)
		{
			$rs_summary = $this->dbConnection->fetch_array($result);
      $summary = null;
			if ($rs_summary)
      {
				$summary = $rs_summary['item_summary'];
      }
		}
		
		return utf8_encode($summary);
	}

 
  	/**
	 * checks is bug id is present on BTS
	 * 
	 * @return integer returns 1 if the bug with the given id exists 
	 **/
	function checkBugID_existence($id)
	{
		$status_ok = 0;
		$query = "SELECT t.item_status FROM " . $this->dbPrefix . "tasks t WHERE t.task_id='" . $id."'";

		$result = $this->dbConnection->exec_query($query);
		if ($result && ($this->dbConnection->num_rows($result) == 1))
		{
      		$status_ok = 1;    
    	}
		return $status_ok;
	}	
	
	// Contribution
	function buildViewBugLink($bugID,$bWithSummary = false)
  	{
      $s = parent::buildViewBugLink($bugID, $bWithSummary);
      $status = $this->getBugStatus($bugID);

      $color = isset($this->status_color[$status]) ? $this->status_color[$status] : 'white';
      $title = lang_get('access_to_bts');  
      return "<div  title=\"{$title}\" style=\"display: inline; background: $color;\">$s</div>";
  	}
}
?>
