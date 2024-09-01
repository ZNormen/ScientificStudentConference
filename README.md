# Scientific Student Conference website
A dynamic website for a Scientific Student Conference featuring user registration, login, and role-based access for presenters and guests, 
with capabilities for presenters to upload projects and presentations with real-time status tracking, 
a PHP-based contact page for direct email communication with organizers, and an interactive FAQ page using jQuery-based accordion functionality.

![image](https://github.com/user-attachments/assets/4972d352-04a2-499e-8b69-2a142d8925ae)



## How does it works?

When making this project, I used XAMPP with Apache and MySQL to host the website locally and to thest the features.
It is mandatory to create a database inside MtSQL, called ConferneceDB.

When signing up/registering, you may choose two types of users: Presenter and Guest
* there are differnet page layouts created for Admin users as well, but those roles are assigned from the DB
* for the registering, the creation of a 'confuser' table is required



## Features:

- Countdown timer
- sign up/ sign in options
- option to change password, if forgotten
- Contact page, whit option to send emails to the organizers, with the help of PHP-based email protocol
- FAQ page using JQuery's accordion style animated cards
- options for presenters to upload their projects and check the status of the revisoning of their work



## TO-DO:

- Change language from Hungarian to English for better understanding
- Try to add the DB to the files for others to access
- organize files into folders for more clarity
