# Web Server Codes here

The ```post-sensor-data.php``` file will be dumped onto you Apache2 or NGINX server working directory. 

>Working directory of Apache2 Web Server is: /var/www/html

>The working directory can be edited by going to ```/etc/apache/conf```

Remember to assign a static IP to your web server to avoid unncecessary not found errors

Also the website codes can be dumped in an folder named ```patient-monitoring``` and the Apache2 server can be setup to by default go to this directory first page.

>Be sure to edit your database name, host, username and password wherever seen in the PHP files to enable database communication

>You also need composer to be installed. Composer will be used to install PHPMailer, Symfony Mailer and Google SMTP Mailer to be used to send activation links to users. >Also, be sure to enable less secure app access in your google account settings to allow PHPMailer to send mails using that mail ID.

>To generate PDF Format of reports, please install TCPDF in your working HTML directory.

References for PHPMailer and TCPDF:

* https://netcorecloud.com/tutorials/send-an-email-via-gmail-smtp-server-using-php/
* https://tcpdf.org/
* https://github.com/tecnickcom/TCPDF

For installing composer:

* https://getcomposer.org/doc/00-intro.md
* https://www.javatpoint.com/how-to-install-composer-on-windows
* https://linuxize.com/post/how-to-install-and-use-composer-on-ubuntu-18-04/
