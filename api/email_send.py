import smtplib
from email.mime.text import MIMEText

import os
import sys
from dotenv import load_dotenv

load_dotenv()

def email_send(sender, message):

    # set up smtp Server
    server = smtplib.SMTP('smtp.gmail.com', 587)
    server.starttls()

    # login to account
    server.login('toby2494.development@gmail.com', os.getenv('APP_PASS'))

    # build message 'Subject: {}\n\n{}'.format(SUBJECT, TEXT)
    msg = MIMEText(f"Subject: New Order/Message from: {sender} \n\n {message}")
    msg['Subject'] = f"New Order/Message from: {sender}"
    msg['From'] = f"{sender}"
    msg["To"] = "toby2494.development@gmail.com"

    server.sendmail(f"{sender}", ['toby2494@gmail.com', 'toby2494.development@gmail.com'], msg.as_string())
    server.quit()

    return "message sent"

