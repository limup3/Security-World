#!C:\Python 3.8\python.exe
#-*- coding: utf-8 -*-

import requests
from bs4 import BeautifulSoup
import re

import sys
import os
import io

sys.stdout = io.TextIOWrapper(sys.stdout.detach(), encoding = 'utf-8')

sys.stderr = io.TextIOWrapper(sys.stderr.detach(), encoding = 'utf-8')

# req = requests.get('https://www.boannews.com/media/t_list.asp')
req = requests.get('https://www.boannews.com/media/t_list.asp')

html = req.content
soup = BeautifulSoup(html, 'lxml') # pip install lxml


#headline0을 id로 가진 div 아래 있는 li 크롤링
title = soup.find('div', id='news_area').find_all('div')

# test = title.replace('/media','https://www.boannews.com/media')
title2 = str(title)
#

title3 = title2.replace('/media','https://www.boannews.com/media')

print(title3)


#title에서 text 부분만 뽑아서 print
#
#
# for i in title:
# 	print(i.text)
