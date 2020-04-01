import pymysql

import requests
from bs4 import BeautifulSoup
import re

import sys
import os
import io

# mariadb연동을 위한 모듈 import

# 컨넥트를 미리 만들어준다.

# 접속할 host, uesr, password, db, 인코딩 입력

conn = pymysql.connect (host='localhost', user='sw', password='P@ssw0rd',
                       db='sw', charset='utf8')

#커서 생성

curs = conn.cursor()



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

curs.execute("insert into news content values (\"%s\")",(title3))

curs.connection.commit()
