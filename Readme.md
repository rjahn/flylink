FlyLink
=======

This project contains the Testlink integration for Flyspray 0.9.x

License
-------

Apache 2.0 (http://www.apache.org/licenses/)


Installation instructions (Testlink)
------------------------------------

1. Modify config.inc.php:

  <pre>
  // ----------------------------------------------------------------------------
  /* [Bug Tracking systems] */
  /**
   * TestLink collaborates with bug tracking systems to check if displayed bugs resolved,
   * verified, and closed reports.
   *
   * Note: Use this option to check if a bug interface is enabled, if so every
   * page using bug tracking MUST include int_bugtracking.php to make the
   * connection. The variable bugInterfaceOn is only set when a connection is made
   *
   * @var string $g_interface_bugs = [
   * 'NO'        : no bug tracking system integration (DEFAULT)
   * 'BUGZILLA'  : edit configuration in TL_ABS_PATH/cfg/bugzilla.cfg.php
   * 'MANTIS'    : edit configuration in TL_ABS_PATH/cfg/mantis.cfg.php
   * 'JIRA'      : edit configuration in TL_ABS_PATH/cfg/jira.cfg.php
   * 'JIRASOAP'  : edit configuration in TL_ABS_PATH/cfg/jira.cfg.php
   * 'TRACKPLUS' : edit configuration in TL_ABS_PATH/cfg/trackplus.cfg.php
   * 'EVENTUM'   : edit configuration in TL_ABS_PATH/cfg/eventum.cfg.php
   * 'SEAPINE'   : edit configuration in TL_ABS_PATH/cfg/seapine.cfg.php
   * 'GFORGE'    : edit configuration in TL_ABS_PATH/cfg/gforge.cfg.php
   * 'FOGBUGZ'   : edit configuration in TL_ABS_PATH/cfg/fogbugz.cfg.php
   * 'YOUTRACK'  : edit configuration in TL_ABS_PATH/cfg/youtrack.cfg.php
   * 'POLARION'  : edit configuration in TL_ABS_PATH/cfg/polarion.cfg.php
   * 'FLYSPRAY'  : edit configuration in TL_ABS_PATH/cfg/flyspray.cfg.php
   * ]
   */
  //$g_interface_bugs = 'NO';
  $g_interface_bugs = 'FLYSPRAY';
  </pre>

2. Copy cfg/flyspray.cfg.php and change pre-configured values
3. Modify lib/bugtracking/int_bugtracking.php

  <pre>
  $btslist = array('BUGZILLA','MANTIS','JIRA', 'JIRASOAP', 'TRACKPLUS','POLARION',
  		    	 'EVENTUM','TRAC','SEAPINE','REDMINE','GFORGE','FOGBUGZ','YOUTRACK', 'FLYSPRAY');

  </pre>

4. Copy lib/bugtracking/int_flyspray.php

  Change pre-configured status colors, if needed:

  <pre>private $status_color</pre>


Support
-------

Use https://forum.sibvisions.com or send an email to support@sibvisions.com



Have fun!
