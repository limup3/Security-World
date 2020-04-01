import pymysql

# mariadb연동을 위한 모듈 import

# 컨넥트를 미리 만들어준다.

# 접속할 host, uesr, password, db, 인코딩 입력

conn = pymysql.connect (host='localhost', user='sw', password='P@ssw0rd',
                       db='sw', charset='utf8')

#커서 생성

curs = conn.cursor()

sql = "select * from sign_info"
curs.execute(sql)

data= curs.fetchall()
data[0]
data[1]
print(data[0])
print(data[1])
