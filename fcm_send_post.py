#
# fcm転送
# date : 2020/02/19
# python requests
# https://qiita.com/hththt/items/14bfc2bf23192b020371
#
import requests
import json
import pprint
import datetime
import threading
import time
import sys
import traceback

mNG_CODE=0
mOK_CODE=1
FCM_SERVER_KEY = " "

#
def fcm_send_push(  token, body ):
    try:
        response = requests.post(
            'https://fcm.googleapis.com/fcm/send',
            json.dumps({
                "notification":{
                    "title": "title-1",
                    "body": body,
                    "icon": "firebase-logo.png",
                    "click_action": "http://localhost:8081"						
                },
                "to": token
            }),
            headers={
                "Content-Type": "application/json",
                "Authorization": "key=" +FCM_SERVER_KEY
            }				
        )
        print(response.status_code)
        sText= response.text
        print( sText)
    except:
        print( "Error, send_push")
        raise
    finally:
        print( "End , send_push")
    return

#
def get_chat_members():
    chat_id ="1"
    mail = "aaa@hoge.com"
    #body = "body-0220a4"
    body = "10時になりました。お茶の時間です！！！"
    try:
        response = requests.post(
            'http://localhost:8000/api/apichats/get_send_members',
            {
                "chat_id": chat_id,
                "mail": mail
            }
        )
        print(response.status_code)
#        sText= response.text
#        print( sText)
        dec = json.loads(response.text)
        if(dec["member"]):
            fcm_send_push( dec["member"]["token"] , body )
#            print("token: " + dec["member"]["token"])
    except:
        print( "Error, get_chat_members")
        raise
    finally:
        print( "End , get_chat_members")
    return

#
if __name__ == "__main__":
    get_chat_members()
    quit()
