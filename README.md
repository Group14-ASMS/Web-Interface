# Web-Interface
Web interface for ASMS.


Design Docs:
  Initial https://docs.google.com/document/d/1fOcg5NmX5L1_GK_bQBfCMleIVmHGeQEUO592Lf4Cu18/edit 




Useful things:
How to connect to AWS Instance with PHPMYADMIN:
Find config.ini.php file (search it)
Add the code block:
/*
 * If your config.ini.php file doesn't increment $i after the bulk of setting up servers add increment
 *$i++;
 */
$cfg['Servers'][$i]['auth_type'] = 'HTTP';
    $cfg['Servers'][$i]['hide_db'] = '(mysql|information_schema|phpmyadmin)';
    /* Server parameters */
    $cfg['Servers'][$i]['host'] = 'xxxxx.l2kj35ncj3.us-east-1.rds.amazonaws.com';
Replace the 'host' with the endpoint url on the AWS RDS instance.
here's in depth tutorial:
http://blog.benkuhl.com/2010/12/how-to-remotely-manage-an-amazon-rds-instance-with-phpmyadmin/ 

Lynda Essential MySQL PHP Course: http://www.lynda.com/MySQL-tutorials/PHP-MySQL-Essential-Training/119003-2.html?srchtrk=index:1%0Alinktypeid:2%0Aq:skoglund%0Apage:1%0As:relevance%0Asa:true%0Aproducttypeid:2

