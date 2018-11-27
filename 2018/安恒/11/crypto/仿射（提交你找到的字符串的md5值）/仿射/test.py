#coding=utf-8
code="achjbnpdfherebjsw"
b=7

for i in range(1,200):
	flag=""
	for j in range(len(code)):
		flag+=chr(i*(ord(code[j])-ord('a')-b)%26+ord('a'))
	print flag