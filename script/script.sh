#!/bin/bash

IP=`ip addr | grep en | grep inet | awk '{print $2}'`
IP=`echo ${IP%%/*}`
date=`mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;select now()"`
date=`echo ${date:6}`
mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into InspectionDate(ip,os,reg_date) values('$IP','linux','$date');"
no=`mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;select no from InspectionDate where reg_date='$date';" | grep -o '[0-9]*'`



# check priv
if [ "$EUID" -ne 0 ]
	then echo "root 권한으로 스크립트를 실행하여 주십시오."
	exit
fi




list=01

if [ -z "`grep 'pts\?' /etc/securetty`" ]
	then
		contents=`echo " 콘솔 로그인만 가능합니다. "`
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
	else
		contents=`echo " 콘솔 로그인 이외의 로그인이 가능합니다. "`
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
fi



list=02

len=`cat /etc/security/pwquality.conf | grep minlen`
class=`cat /etc/security/pwquality.conf | grep minclass`
AGE=`cat /etc/login.defs | grep PASS_WARN_AGE | awk '{print $2}' | sed '1d'`
MIN=`cat /etc/login.defs | grep PASS_MIN_LEN | awk '{print $2}' | sed '1d'`
MAX=`cat /etc/login.defs | grep PASS_MAX_DAYS | awk '{print $2}' | sed '1d'`


contents=`echo "비밀번호 최소 허용 크기 : "$len`
contents+='<br>'
contents=$contents`echo "        비밀번호 문자 클래스의 최수 수 : "$class`
contents+='<br>'
contents=$contents`echo "        패스워드 기간 만료 경고 : ";cat /etc/login.defs | grep PASS_WARN_AGE | awk '{print $2}'`
contents+='<br>'
contents=$contents`echo "        최소 패스워드 변경 기간 설정 : ";cat /etc/login.defs | grep PASS_MIN_LEN | awk '{print $2}'`
contents+='<br>'
contents=$contents`echo "        최대 패스워드 사용 기간 설정 : ";cat /etc/login.defs | grep PASS_MAX_DAYS | awk '{print $2}'`


if [[ $len = "minlen = 8" && $class = "minclass = 3" && $AGE -eq "7" && $MIN -ge "1" && $MAX -le "60" ]]
	then
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
	else
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
fi




list=03

TI=`cat /etc/pam.d/password-auth | grep deny= | sed '1d' | awk '{print $6}' | awk -F "=" '{print $2}'`

if [ "`grep deny= /etc/pam.d/password-auth`" ]
	then
		contents=`echo " "$TI"번 로그인 실패시 계정이 잠김니다. "`
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
	else
		contents=`echo " 계정 잠금 정책이 설정되어 있지 않습니다. "`
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
fi




list=04

PS=`cat /etc/passwd | grep "root" | awk -F: '{print $2}' | sed -n '1p'`

contents=`echo "   패스워드 시스템 : " $PS`
contents+='<br>'

if [ "`cat /etc/passwd | grep "root" | awk -F: '{print $2}' | sed -n '1p'`" = x ]
	then
		if test -r /etc/shadow
			then
				contents=$contents`echo " Shadow 패스워드 시스템을 사용중입니다. "`
				mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
			else
				contents=$contents`echo " Passwd 패스워드 시스템을 사용중입니다. "`
				mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
		fi
fi


list=05

test=`cat /etc/passwd | grep root | sed -n '1p' | awk -F: '{print $6}'`
GRDP=`ls -ald $test | awk '{print $1}'`
RDP=dr-xr-x---

contents=`echo "        PATH 디렉터리 : "; env | grep PATH | awk -F= '{print $2}'`
contents+='<br>'

if test $GRDP=$RDP
	then
		contents=$contents`echo "  root 홈 디렉터리 권한 : " $GRDP `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
	else
		contents=$contents`echo "  root 홈 권한 : " $GRDP`
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
fi



list=06

if test -f `find / \( -nouser -o -nogroup \) -xdev -ls 2>/dev/null`
	then
		contents=`echo "  소유자 혹은 그룹이 없는 파일 및 디렉터리가 존재하지 않습니다. "`
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
    else
		contents=`echo "  소유자 혹은 그룹이 없는 파일 및 디렉터리가 존재합니다. "`
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
fi



list=07

PP=`ls -l /etc/passwd 2>/dev/null  | awk {'print $1'}`
PO=`ls -l /etc/passwd 2>/dev/null  | awk {'print $3'}`
PG=`ls -l /etc/passwd 2>/dev/null  | awk {'print $4'}`
PQ=`ls -l /etc/passwd 2>/dev/null  | awk {'print $1,$3,$4'}`

if [[ $PP = -.--.--.--. || -..-.--.--. && $PO = root && $PG = root ]];
	then
		contents=`echo "      권한, 소유자, 그룹"  $PQ`
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
	else
		contents=`echo "      권한, 소유자, 그룹"  $PQ`
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
fi

list=08

OP=`ls -l /etc/shadow 2>/dev/null  | awk {'print $1'}`
OO=`ls -l /etc/shadow 2>/dev/null  | awk {'print $3'}`
OG=`ls -l /etc/shadow 2>/dev/null  | awk {'print $4'}`
OQ=`ls -l /etc/shadow 2>/dev/null  | awk {'print $1,$3,$4'}`

if [[ $OP = -.--------. || ----------. && $OO = root && $OG = root ]];
	then
		contents=`echo "  권한, 소유자, 그룹"  $OQ`
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"

	else
		contents=`echo "  권한, 소유자, 그룹"  $OQ`
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
fi




list=09

HO=`ls -l /etc/hosts 2>/dev/null  | awk '{print $3}'`
HP=`ls -l /etc/hosts 2>/dev/null  | awk '{print $1}'`
HQ=`ls -l /etc/hosts 2>/dev/null  | awk '{print $1,$3}'`

if [[ $HO = root && $HP = -rw-------. || $HP = -..-------. ]];
	then
		contents=`echo "  hosts 파일 소유자, 권한 : " $HQ`
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
	else
		contents=`echo "  hosts 파일 소유자, 권한 : " $HQ `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
fi

list=10

if [[ `find /etc/xinetd.conf 2>/dev/null` || `find /etc/xinetd.d/* 2>/dev/null` ]]
then
	CO=`ls -l /etc/xinetd.conf 2>/dev/null | awk '{print $3}'`
	CP=`ls -l /etc/xinetd.conf 2>/dev/null | awk '{print $1}'`
	CX=`ls -l /etc/xinetd.conf 2>/dev/null | awk '{print $3,$1}'`
	BO=`ls -al /etc/xinetd.d/* 2>/dev/null | awk '{print $3}'`
	BP=`ls -al /etc/xinetd.d/* 2>/dev/null | awk '{print $1}'`
	BX=`ls -al /etc/xinetd.d/* 2>/dev/null | awk '{print $3,$1}'`
	QQ="root -rw-------."
	QW="root -..-------."
	if [ `find /etc/xinetd.conf 2>/dev/null` ]
	then
		if [[ $CX = $QQ || $CX = $QW ]]
		then
			contents=`echo "      xinetd.conf 파일 소유자, 권한 : " $CX`
			mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
		else
			contents=`echo "      xinetd.conf 파일 소유자, 권한 : " $CX`
			mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
		fi
	fi
	if [ `find /etc/xinetd.d/* 2>/dev/null` ]
	then
		if [[ $BX = $QQ || $BX = $QW ]]
		then
			contents=`echo "      xinetd.d 하위 모든 파일, 권한 : " $BX`
			mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
		else
			contents=`echo "      xinetd.d 하위 모든 파일, 권한 : " $BX`
			mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
		fi
	fi

else
	contents=`echo "         파일이 존재하지 않습니다"`
	mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"

fi


list=11


if test -f /etc/rsyslog.conf
		then
		contents=`echo "          rsyslog.conf 파일이 존재합니다"`
		IO=`ls -l /etc/rsyslog.conf | awk '{print $3}'`
		IP=`ls -l /etc/rsyslog.conf | awk '{print $1}'`
		XP=`ls -l /etc/rsyslog.conf | awk '{print $3,$1}'`
		if [[ $IO = root && $IP = -rw-r--r--. || $IP = -..-.--.--. ]]
			then
				contents=`echo "      rsyslog.conf 파일 소유자, 권한 : " $XP`
				mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
			else
				contents=`echo "      rsyslog.conf 파일 소유자, 권한 : " $XP`
				mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
		fi

else
	contents=`echo "           rsyslog.conf 파일이 존재하지 않습니다"`

fi



list=12

SO=`ls -l /etc/services | awk '{print $3}'`
SP=`ls -l /etc/services | awk '{print $1}'`
SQ=`ls -l /etc/services | awk '{print $3,$1}'`

if [[ $SO = root && $SP = -rw-r--r--. || $SP = -..-.--.--. ]]
	then
		contents=`echo "  services 파일 소유자, 권한 : " $SQ `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
	else
		contents=`echo "  services 파일 소유자, 권한 : " $SQ `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
fi



list=13

SF=`/ -user root -perm -4000 2>/dev/null`
SG=`/ -user root -perm -2000 2>/dev/null`
SB=`/ -user root -perm -1000 2>/dev/null`

contents=`echo "        수동적인 체크 필요"`
contents+='<br>'
if ["$SF" -f ] && ["$SG" -f ] && ["$SB" -f ]
	then
		contents=$contents`echo "  불필요한 설정 파일이 있습니다." `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
	else
		contents=$contents`echo "  불필요한 설정 파일이 없습니다." `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"

fi






list=14

contents=`echo "서버 환경마다 파일들이 다르기 때문에 이를 스크립트로 체크할 경우 오탐 발생이 높음 따라서 수동적인 체크가 필요"`
mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"

list=15

contents=`echo "서버 환경마다 파일들이 다르기 때문에 이를 스크립트로 체크할 경우 오탐 발생이 높음 따라서 수동적인 체크가 필요"`
mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"

list=16

contents=`echo "서버 환경마다 파일들이 다르기 때문에 이를 스크립트로 체크할 경우 오탐 발생이 높음 따라서 수동적인 체크가 필요"`
mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"


list=17

if test -f `ls -l $HOME/.rhosts 2>/dev/null`
	then
		if test -f `ls -l hosts.equiv 2>/dev/null`
			then
				contents=`echo "  해당 서비스가 활성화 되어 있지 않습니다" `
				mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
			else
				contents=`echo "  해당 서비스가 활성화 되어 있습니다"`
				mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
				RH=ls -al /etc/hosts.equiv | awk '{print $3,$1}'
				contents+='<br>'
				contents+=`echo "    파일 소유자,권한 : " $RH`
		fi
	else
		contents=`echo "  해당 서비스가 활성화 되어 있습니다" `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
fi


list=18
contents=`echo " cat /etc/hosts.allow 2>/dev/null, cat /etc/hosts.deny 명령어 참조"`
mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"

list=19

if test -f /etc/xinetd.d/finger
	then
		if [ "`cat /etc/xinetd.d/finger  | grep disable | awk '{print $3}'`" = yes ]
			then
				contents=`echo "  finger 서비스가 설치되어 있으나 비활성화 되어 있습니다" `
				mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
			else
				contents=`echo "  finger 서비스가 설치되어 있고, 활성화 되어 있습니다" `
				mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
		fi
	else
		contents=`echo "  finger 서비스가 설치되어 있지 않습니다" `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
fi

list=20

if test -f /etc/vsftpd/vsftpd.conf
	then
		if [ "`cat /etc/vsftpd/vsftpd.conf | grep anonymous_enable | awk -F= '{print $2}'`" = NO ]
			then
				contents=`echo "  FTP에 익명 접속이 불가능합니다" `
				mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
			else
				contents=`echo "  FTP에 익명 접속이 가능합니다" `
				mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
		fi
	else
		contents=`echo "  FTP 서비스가 설치되어 있지 않습니다" `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
fi


list=21

if test -f /etc/xinetd.d/rlogin
	then
		if [ "`cat /etc/xinetd.d/rlogin | grep disable | awk '{print $3}'`" = yes ]
			then
				contents=`echo "  rlogin 서비스가 설치되어 있으나 비활성화 되어 있습니다"`
				mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
			else
				contents=`echo "  rlogin 서비스가 설치되어 있고, 활성화 되어 있습니다"  `
				mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
		fi
	else
		contents=`echo "  rlogin 서비스가 설치되어 있지 않습니다" `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
fi



list=22

if [[ `find /etc/cron.allow 2>/dev/null` || `find /etc/cron.deny 2>/dev/null` ]]
then
	CO=`ls -l /etc/cron.allow 2>/dev/null | awk '{print $3}'`
	CP=`ls -l /etc/cron.allow 2>/dev/null | awk '{print $1}'`
	CX=`ls -l /etc/cron.allow 2>/dev/null | awk '{print $3,$1}'`
	BO=`ls -l /etc/cron.deny 2>/dev/null | awk '{print $3}'`
	BP=`ls -l /etc/cron.deny 2>/dev/null | awk '{print $1}'`
	BX=`ls -l /etc/cron.deny 2>/dev/null | awk '{print $3,$1}'`
	QQ="root -rw-r-----."
	QW="root -..-.-----."
	if [ `find /etc/cron.allow 2>/dev/null` ]
	then
		if [[ $CX=$QQ || $CX=$QW ]]
		then
			contents=`echo "      cron.allow 파일 소유자, 권한 : " $CX`
			mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
		else
			contents=`echo "      cron.allow 파일 소유자, 권한 : " $CX`
			mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
		fi
	fi
	if [ `find /etc/cron.deny 2>/dev/null` ]
	then
		if [[ $BX=$QQ || $BX=$QW ]]
		then
			contents=`echo "      cron.deny 파일, 권한 : " $BX`
			mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
		else
			contents=`echo "      cron.deny 파일, 권한 : " $BX`
			mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
		fi
	fi

else
	contents=`echo "         파일이 존재하지 않습니다"`
	mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"

fi

list=23

ET=`cat /etc/services | grep echo | sed -n '1p' | awk '{print $1}'`
DT=`cat /etc/services | grep discard | sed -n '1p' | awk '{print $1}'`
TT=`cat /etc/services | grep daytime | sed -n '1p' | awk '{print $1}'`
CT=`cat /etc/services | grep chargen | sed -n '1p' | awk '{print $1}'`


if [[ $ET = \#echo && $DT = \#discard && $TT = \#daytime && $ET = \#chargen ]]
	then
		contents=`echo "  echo, discard, daytime, chargen    서비스가 비활성화 되어 있습니다"  `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"

elif [ $ET = \#echo ]
	then
		contents=`echo "  echo    서비스가 비활성화 되어 있습니다"  `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
elif [ $DT = \#discard ]
	then
		contents=`echo "  discard    서비스가 비활성화 되어 있습니다"  `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
elif [ $TT = \#daytime ]
	then
		contents=`echo "  daytime    서비스가 비활성화 되어 있습니다" `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
elif [ $ET = \#chargen ]
	then
		contents=`echo "  chargen    서비스가 비활성화 되어 있습니다"  `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
else
	contents=`echo "  echo, discard, daytime, chargen    서비스가 활성화 되어 있습니다"  `
	mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
fi

list=24

NC=`systemctl is-enabled nfs 2>/dev/null`

if [[ "enable" == "$NC" ]]
	then
		contents=`echo " NFS 서비스가 활성화 되어 있습니다"  `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"

elif [[ "disable" == "$NC" ]]
	then
		contents=`echo "  NFS 서비스가 비활성화 되어 있습니다"  `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
else
	contents=`echo "  NFS 서비스가 설치 되어 있지 않습니다"  `
	mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
fi


list=25


contents=`echo " [권장] 해당 공유 디렉터리의 권한이 적절한지 수동으로 체크"  `
mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"


list=26

contents=`echo "    본 항목은 리눅스가 아닌 유닉스에만 존재함"  `
mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"


list=27

contents=`echo " [권장] 최신 버전의 패치 권장 수동적인 작업필요" `
mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"

list=28

contents=`echo " [권장] NIS 보다 데이터 인증이 강화된 NIS+ 사용"  `
mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"

list=29

TP=`cat /etc/services | grep tftp | sed -n '1p' | awk '{print $1}'`
TK=`cat /etc/services | grep talk | sed -n '1p' | awk '{print $1}'`
if [[ $TP = \#tftp && $TK = \#talk ]]
	then
		contents=`echo "  tftp,talk 서비스가 비활성화 되어 있습니다"  `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
elif [ $TP = \#tftp ]
	then
		contents=`echo "  tftp 서비스가 활성화 되어 있습니다"  `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
elif [ $TK = \#talk ]
	then
		contents=`echo "  talk 서비스가 활성화 되어 있습니다" `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
else
	contents=`echo "  tftp,talk 서비스가 활성화 되어 있습니다" `
	mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"

fi


list=30
SI=`rpm -qa sendmail`

if [ $SI ]
	then
		SV=`echo \$Z | /usr/lib/sendmail -bt -d0 | sed -n '1p' | awk '{print $2}'`

		contents=`echo " [권장] 설치된 sendmail의 버전은 $SV 입니다. 최신 버전의 아닐경우 설치권장"  `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
	else
		contents=`echo "  sendmail이 설치되어 있지 않습니다 "  `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
fi



list=31

if [ $SI ]
	then
		SP=`ls -l /etc/mail/access | awk '{print $1}'`
		if [ $SP ]
			then
				SP=`ls -l /etc/mail/access | awk '{print $1}'`
				contents=`echo "  스팸 메일 관련 설정 사항이 저장된 파일이 존재합니다"  `
				mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"

		else
				contents=`echo "  스팸 메일 관련 설정 사항이 명시 된 파일이 존재하지 않습니다"  `
				mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
		fi
	else
		contents=`echo "  sendmail이 설치되어 있지 않습니다"  `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
fi




list=32

SV=`cat /etc/mail/sendmail.cf 2>/dev/null | grep PrivacyOptions | awk -F= '{print $2}'`

if [ "$SV" = "authwarnings,novrfy,noexpn,restrictqrun" ]
then
	contents=`echo "  일반사용자의 sendmail 실행 방지가 설정되어 있습니다"  `
	mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
else
	contents=`echo "  일반사용자의 sendmail 실행 방지가 설정되어 있지 않습니다" `
	mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
fi

list=33

DS=`dig +short @168.126.63.1 porttest.dns-oarc.net TXT | awk -Fis '{print $2}' | awk -F: {'print $1'} | sed '1d' | awk '{print $1}'`

if [ $DS=GOOD -o GREAT ]
	then
		contents=`echo "  DNS 보안 패치가 최신 버전입니다"  `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
	else
		contents=`echo "  DNS 보안 패치가 구 버전입니다"  `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"

fi


list=34

contents=`echo " [권장] DNS Zone Transfer를 허가된 사용자에게만 허용"  `
contents+='<br>'
contents=$contents`echo "   DNS Zone Transfer를 모든 사용자에게 허용했을 경우 취약하다고 판단" `
mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
contents+='<br>'


list=35

GV=`cat /etc/httpd/conf/httpd.conf 2>/dev/null | grep Options | sed -n '1p'`

if [[ $GV == *Indexes* ]]
	then
		contents=`echo "  디렉터리 리스팅이 설정되어 있습니다"  `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
	else
		contents=`echo "  디렉터리 리스팅이 설정되어 있지 않습니다"  `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
fi


list=36

UP=`cat /etc/httpd/conf/httpd.conf 2>/dev/null | grep User | sed -n '2p' | awk '{print $2}'`
GP=`cat /etc/httpd/conf/httpd.conf 2>/dev/null | grep Group | sed -n '2p' | awk '{print $2}'`

if [[ "$UP" != root && "$GP" != root ]]
	then
		contents=`echo "  현재 설정된 웹 프로세스 User, Group 권한 :" $UP,$GP  `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
elif [ "$UP" = root]
	then
		contents=`echo "  현재 설정된 웹 프로세스 User 권한 :" $UP  `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
elif [ "$GP" = root]
	then
		contents=`echo "  현재 설정된 웹 프로세스 User 권한 :" $UP  `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"

else
	contents=`echo "  현재 설정된 웹 프로세스 User, Group 권한 :" $UP,$GP  `
	mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
fi



list=37

GC=`cat /etc/httpd/conf/httpd.conf 2>/dev/null | grep AllowOverride | sed -n '1p' | awk '{print $2}'`

if [[ $GC = "AuthConfig" ]]
	then
		contents=`echo "  디렉터리별 사용자 인증이 설정되어 있습니다"`
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
		contents+='<br>'
		contents+=`echo "아이디 및 패스워드 따로 생성필요"`

	else
		contents=`echo "   디렉터리별 사용자 인증이 설정되어 있지 않습니다" `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
fi



list=38

contents=`echo " [권장] 웹 서버를 정기적으로 검사하여 불필요한 파일을 제거"  `
mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"

list=39

if [[ $GV == *FollowSymLinks* ]]
	then
		contents=`echo "  Apache 상에서 심볼릭 링크 사용이 설정되어 있습니다"  `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
	else
		contents=`echo "  Apache 상에서 심볼릭 링크 사용이 설정되어 있지 않습니다"  `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
fi

list=40

US=`cat /etc/php.ini 2>/dev/null |  grep post_max_size | awk '{print $3}'`
DS=`cat /etc/httpd/conf/httpd.conf 2>/dev/null 2>/dev/null | grep LimitRequestBody`

if [ -n "`grep LimitRequestBody /etc/httpd/conf/httpd.conf 2>/dev/null`" ]
	then
		contents=`echo "      다운로드 가능한 파일의 최대 용량 : "$DS`
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"

	else
		contents=`echo "      다운로드 가능한 파일의 최대 용량 : 제한없음"`
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"


fi

list=41

DR=`cat /etc/httpd/conf/httpd.conf 2>/dev/null | grep DocumentRoot | sed -n '2p' | awk '{print $2}'`
DD="/var/www/html"

if [ $DR=$DD ]
	then
		contents=`echo "  DocumentRoot에 설정된 디렉터리 : $DR"  `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
	else
		contents=`echo "  DocumentRoot에 설정된 디렉터리 : $DR"  `
		mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','o','$contents');"
fi


list=42

contents=`echo " [권장] yum update (-y) 최신 패치를 설치 권장"`
mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"



list=43

contents=`echo " 로그 기록에 대해 정기적 검토, 분석, 이에 대한 리포트 작성 및 보고" `
mysql -h192.168.233.151 -uclient -pP@ssw0rd -e "use checkVulnerabilities;insert into details values('$no','$list','x','$contents');"
