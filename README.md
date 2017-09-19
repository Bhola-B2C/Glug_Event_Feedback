# About the App
A Laravel app to get feedback from users regarding events

# Dependencies and Installation
After cloning the Project. Run "composer install" in your terminal(without qoutes). Be sure to change directory to Glug_Event_Feedback.
If .env file is not generated then create one and copy the content from .env.example and run "php artisan key:generate" (without qoutes). 

# Building and Running
For database feature to take effect, you need to have database in your system(mysql, sqlite, etc.) <br>
Make sure to create a database<br>
Run "mysql -u root -p" (or whatever username u have)<br>
Then Enter Password:<br>
create database database_name;<br>
above cmd will create database with name given<br>

For mysql enter following in env file<br>
DB_CONNECTION=mysql<br>
DB_HOST=127.0.0.1<br>
DB_PORT=3306<br>
DB_DATABASE=database_name<br>
DB_USERNAME=database_username<br>
DB_PASSWORD=database_password<br><br>
Then run "php artisan migrate" in your terminal.<br><br>
For Password reset feature and mail to take place enter following in .env file<br>
MAIL_DRIVER=smtp<br>
MAIL_HOST=smtp.gmail.com<br>
MAIL_PORT=587<br>
MAIL_USERNAME=your_user_name(gmail)<br>
MAIL_PASSWORD=your_gmail_password<br>
MAIL_ENCRYPTION=tls<br>

Run "php artisan serve" in terminal<br>

# For Admin Regisration

Run "php artisan tinker"<br>
And type following:<br>
$admin=new App\User<br>
$admin->name="user_name"<br>
$admin->email="your email" (make sure to enter valid email, in case u forgot ur password, it will help)<br>
$admin->password=Hash::make('your_password')<br>
$admin->save() <br>
