<?php

//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell
//  File name   : constants.php

// Random Salt
DEFINE('CSPRING', "c9e8d47ac7109567b29253b74ccbbc36aa3fafc40498aa528db0d83e105804bd");

// Database info
DEFINE('DBHOST', "localhost");
DEFINE('DBNAME', "group15_db");
DEFINE('DBUSER', "group15_admin");
DEFINE('DBPASS', "YouTheMan69");

// Cookie Timeout
DEFINE('TIMEOUT', 2592000); // 30 days

// Account Type Identification
DEFINE('ADMIN', "S");
DEFINE('AGENT', "A");
DEFINE('PENDING_AGENT', "P");
DEFINE('CLIENT', "C");
DEFINE('SUSPENDED_USER', "X");

// Define contact method
DEFINE('EMAIL', "e");
DEFINE('PHONE', "p");
DEFINE('POSTED_MAIL', "l");

// Define listing status
DEFINE('OPEN', "o");
DEFINE('CLOSED', "c");
DEFINE('SOLD', "s");
DEFINE('HIDDEN', "h");

//Max listings results for listing preview
DEFINE('MAX_RESULTS', 10);

// Image upload constants
DEFINE('MAX_IMAGE_UPLOAD', 5);
DEFINE('MAX_FILE_SIZE', 1024*200); //200kb - Easy to add images