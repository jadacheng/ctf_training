import signal
from Crypto.Util.number import *
import random

n = 21818737053296397075293557532026838317341224187973089076458415733610636552780808013315098765758243125184126227736024523676184317498035798411220546725192587095253703700420371338854565378916932253260533992881852510211375850037764645482694880990745957675572041753649938924321719396285647152490552827989035013470195700891098198243597017164296587041439272673787807948736013519011632547587627615851576933645554961670362822942324210754429071964986174075713939209663296457332027579945780917276248109965088308211931588984536106210445392359893387940224965056661904376650783808042603209084485261072752684555682439933912054084001L
e = 3 # small e for baby
bits = size(n)

with open("flag", "r") as f:
    flag = f.read().strip()
assert len(flag)<bits//8

def handler(signum, frame):
    print 'Time out!'
    exit()

def run(fin, fout):
    global n,e,flag
    #signal.signal(signal.SIGALRM, handler)
    #signal.alarm(5)
    cnt = 0
    try:
        while cnt < e:
            # e is small and we need padding
            # but you can choose the last byte of it
            padsize = 0
            while len(flag)<bits//8-1:
                flag += chr(random.randint(0,255))
                padsize += 1
            try:
                fout.write("last byte: ")
                fout.flush()
                line = fin.readline()[:4]
                s = int(line)%256
                flag += chr(s)
                m = bytes_to_long(flag)
                c = pow(m, e, n)
                fout.write(hex(c) + "\n")
                fout.flush()
                cnt += 1
            except Exception,er:
                pass
            flag = flag[:bits//8-padsize]
    except Exception,er:
        pass

if __name__ == "__main__":
    run(sys.stdin, sys.stdout)
