# How to install the script

1 / To install the script you have to upload it to your server. Create a database and import the sql file to your database. SQL file is located to **database/** directory.

2 / Configuring database, smtp and other information. You have to open **inc/config.php** file and edit it to your requirements. _(I commented the more instructions to config.php file)_.

# How to use this tool

This is a advanced email marketing tool created for personal use. And, below are the documentation of how you can use it.

## Creating a user

To create a user you can use PHPMyAdmin open your **Database** -> **users** table. Then, click on to create a new entry. And fill email _name_, _email_, _username_ and a hashed password in _password_.
![Creating User](https://i.ibb.co/VpPmjmr/image.png)

### Hashing a password

To create a hashed password you can use a online tool called [PHPPasswordHash](https://phppasswordhash.com/).
![Hashing a password](https://i.ibb.co/Ln20dcg/image.png)

## Login to your account

Open app URL where you installed the script to log in your account and use the Dashboard.

## Dashboard

You can see Statistics in your **Dashboard**
![Dashboard](https://i.ibb.co/WnWZmcG/image.png)

## Uploading a template

Uploading a template is very easy. To upload a email template you will need a _index.html_ and if you have images you can put them to _images/_ directory. Then, make all that a zip. And, finally, you can open **Dashboard** > **Upload Template** then enter your template name in Name field then upload your template zip file.
![Upload Template](https://i.ibb.co/5TG8Pzk/image.png)

## Creating a email template

To create a email template you can open **Dashboard** > **Template Builder** this will open a email template builder website you can build a email template from there and export that in HTML.

## Sending Email

To sending email you have to create a template first what is showed above. After create and upload a template, you can open **Dashboard** > **Send Email**. Then fill all the required fields, such as Subject, Email list in Emails field or you can upload a CSV or XLSX file with a list of email. Then select your template. Finally, you can click on _Send Emails_ button to send all the emails. Once all email is sent you can see logs for which emails is sent and failed.
![Sending Email](https://i.ibb.co/0XhgdK9/image.png)

## Packages used for the project

[PHPMailer](https://github.com/PHPMailer/PHPMailer) - To send emails with SMTP server
[PhpSpreadsheet](https://github.com/PHPOffice/PhpSpreadsheet) - To read csv/xlsx file data
