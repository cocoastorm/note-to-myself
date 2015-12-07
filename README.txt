Note to Myself Clone

Khoa Nguyen	A00926551
Jon Deluz	A00849398
URL: notetomyself.herokuapp.com

NOTE: Database on Heroku is too small so image uploading fails! 

Step    Score   Implementation
1       5       When signing up no duplicate usernames are allowed, the username must
                be an email address. And the passwords are hashed when stored in the database.

2       5       Implemented recaptcha from google.

3		4       Resets passwords by sending an email with a token. Once the user clicks on the link
                They can change their password after reconfirming their email.

4		5       After a successful registration, the user has to activate their account
                via email before being able to login to the system.

5		3       When a user fails three times in a row, they are unable to login into the system
                until a minute has passed.

6       5       Upon loading the page, we are grabbing the user's notes via the
                NotesController and searching for the corresponding data in the database.
				
7       5       Upon loading the page, we are grabbing the user's tbd via the
                NotesController and searching for the corresponding data in the database.
				
8       5       Upon loading the page, we are grabbing the user's websites via the
                NotesController which is searching in the websites database for all websites
                that belong to the user.
				
9       5       Upon loading the page, we are grabbing the images via the NotesController
                which is searching in the Pictures database for all images that belong
                to the user. We are storing the images as medium blobs.
				
10      5       When the user edits their notes and hits save, it will trigger NotesController@update
                to update the database with the new changes.
				
11      5       When the user edits their tbd and hits save, it will trigger NotesController@update
                to update the database with the new changes.
				
12      5       When the user edits their websites and hits save, it will send an array of websites to
                the NotesController and update the database with the new changes.
				
13      5       Before an image is added, it is checked against an if statement in the NotesController@update.
                If there are less than 4 images, image will be added but if there are more than 4 a message
                will be displayed "Maximum 4 images".
				
14      5       We used a validator on the image only accepting jpg,jpeg or gif. $rules = ['i' => 'mimes:jpg,gif,jpeg'];

15      5       When the user wants to delete an image or images, they will check the checkbox beside the corresponding
                image and hit save. Upon hitting save the NotesController@update will be called and will grab the array
                of checkboxes to determine which image(s) to delete. It will then loop through the array searching for
                the image in the database to delete.
				
16		5       Images are saved and retrieved on the database.

17		5       Logout works.

18		4       Only those who are logged in are allowed to see the pages. If they are not then they are redirected to the
                login page. There are no cookies to populate the login username.

19      0       Not implemented

20      5       Build into laravel, modified the config/Session.php by changing the 'lifetime' to 20
