# Mass SMS

CONCEPT #1 (REVISED) The additional details of the project were added as RED text below
I want to be able to download a CSV file that lists every number that was ever sent an SMS from the program you created and the text they sent to my twilio number 561-444-0444, and the reply my program sent them from my 561-444-0444 number.  See an example of what the CSV file would look like attached as "SAMPLE EXPORT"
This is going to be a separate project from the twi-sms folder in the way that I can upload any CSV and send a mass sms.  
The only reason I need you to export the twi-sms information is so I can target them with marketing messages from time to time but I will also send to phone numbers in other lists that I purchase which is why I prefer the upload CSV feature rather than integrating with the twi-sms project completely.  The new project will be using a different twilio number all together.  Use the twilio number 561-475-2885 in my twilio control panel for this project.  Every SMS sent in this program will be sent from 561-475-2885.  I also need this number to receive replies where I can view and reply to each SMS if I want to.  As the recipients reply to each message, I want you to scan each reply and look for any of these keywords below.  If you see any of these keywords in the message, please add them to the DO NOT TEXT list that you will use to scrub every CSV I upload to send before sending.  This list should be searchable and able to have numbers manually added and removed also.  This must be separate from the 561-44r4-0444 project because I never want anyone to not receive a text with that program.  That program is only for auto-replies so there should never be a reason for someone to say STOP in a reply to that number.   The keywords I want you to search for in all replies for the new project are:
stop
STOP
Stop
"stop"
"STOP"
"Stop"
Anytime I upload a CSV file to send a mass message too, you will remove from sending any of the numbers contained in the DO NOT TEXT database before sending. 
You are only going to check the DO NOT TEXTdatabase for this new project, never check it with the twi-sms 5614440444 project.  
The only thing you need to add to that project is the ability to download a CSV file as discussed below.  
I assume that this number will be marked as SPAM from time to time, so please make it so I can change the twilio number easily if I need too.  I don't know how you would design that, but if you can do it in a user-friendly way, I would appreciate it.  Use the same password recovery SMTP information that you did today for my other project... The twilio@nbob.org email address.


## Deployment

1. First clone this repository to your own server and `cd` into it.

2. Open the .env file and update all the fields whose prefix is "MAIL" with your smtp email information.

3. Configure Twilio to call your webhooks.

  You will also need to configure Twilio to call your application when calls are received
  on your _Twilio Number_. The **SMS & MMS Request URL** should look something like this:

  ```
  http://yourdomain/directory/incomingSmsHandling
  ```

### How To Demo

1. Navigate to http://yourdomain/home

2. Login using Email: ahmed.hany.fawzy4@gmail.com and password: 123456

3. You can change email address from the settings after login.

4. You can change password by following the forgot password link which appears in the login page.

5. You can manage the sms marketing & sms logs after logging.


For Further information or help, please contact me on:
1. ahmed.hany.fawzy@hotmail.com
2. ahmed.hany.fawzy4@gmail.com