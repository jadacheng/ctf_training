#coding=utf-8
f=open('tests','r+')
f2=open('test2','w+')
temp=[]
for i in f.readlines():
    if "byte_" in i:
        if '+=' in i:
            i=i.replace('+=','-=')
        elif ('-=' in i):
            i=i.replace('-=','+=')
        temp.append(i)
for i in range(len(temp)):
        f2.write(temp[len(temp)-1-i])