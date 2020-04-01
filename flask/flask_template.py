from flask import Flask, render_template
app = Flask(__name__)

#!C:\Python 3.8\python.exe
#-*- coding: utf-8 -*-

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

# print(title)

#title에서 text 부분만 뽑아서 print
#
#
# for i in title:
# 	print(i.text)



@app.route("/")
def template_test():
    return render_template(
                'index.html',                      #렌더링 html 파일명
                title="Flask Template Test",       #title 텍스트 바인딩1
                my_str=title,             #my_str 텍스트 바인딩2
                my_list=[x + 1 for x in range(30)] #30개 리스트 선언(1~30)
            )


if __name__ == '__main__':
    app.run(debug=True)
