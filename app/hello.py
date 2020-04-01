import requests
from bs4 import BeautifulSoup
import re

import sys

import io

sys.stdout = io.TextIOWrapper(sys.stdout.detach(), encoding = 'utf-8')

sys.stderr = io.TextIOWrapper(sys.stderr.detach(), encoding = 'utf-8')

# req = requests.get('https://www.boannews.com/media/t_list.asp')
req = requests.get('https://www.boannews.com/media/t_list.asp')

html = req.content
soup = BeautifulSoup(html, 'lxml') # pip install lxml


#headline0을 id로 가진 div 아래 있는 li 크롤링
title = soup.find('div', id='news_area').find_all('div')


#title에서 text 부분만 뽑아서 print
# for i in title:
# 	print(i.text)

from flask import Flask
app = Flask(__name__)

@app.route('/')
def hello_world():


    for i in title:
    	# print(i.text)
        news = i.text
    return news

if __name__ == '__main__':
    app.run()
