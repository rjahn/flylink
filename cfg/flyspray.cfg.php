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

/** The DB host to use when connecting to the flyspray db */
// define('BUG_TRACK_DB_HOST', '[CONFIGURE_BUG_TRACK_DB_HOST]');
define('BUG_TRACK_DB_HOST', 'localhost');

/** The name of the database that contains the flyspray tables */
//define('BUG_TRACK_DB_NAME', '[CONFIGURE_BUG_TRACK_DB_NAME]');
define('BUG_TRACK_DB_NAME', 'flyspray');

/** The prefix of the flyspray tables */
//define('BUG_TRACK_DB_PREFIX', '[CONFIGURE_BUG_TRACK_DB_PREFIX]');
define('BUG_TRACK_DB_PREFIX', 'flyspray_');

/** The DB type being used by flyspray */
//define('BUG_TRACK_DB_TYPE', '[CONFIGURE_BUG_TRACK_DB_TYPE]');
define('BUG_TRACK_DB_TYPE', 'mysqli');

/** The DB password to use for connecting to the flyspray db */
define('BUG_TRACK_DB_USER', 'flyspray_user');
define('BUG_TRACK_DB_PASS', 'flyspray_password');

/* link of the web server for flyspray */
define('BUG_TRACK_HREF', "https://flyspray/index.php?do=details&task_id=");

/** link to the bugtracking system, for entering new bugs */
define('BUG_TRACK_ENTER_BUG_HREF',"https://flyspray/index.php?do=newtask");
?>