#coding: utf8
import web
import os
import re
import sys
import sqlite3
from web.contrib.template import render_mako

abspath = os.path.dirname(__file__)
sys.path.append(abspath)
#os.chdir(abspath)
urls = (
    '/', 'index',
    '/news-(.+).html', 'news',
    # webpy URI route line by line.
)

app = web.application(urls, globals(), autoreload=True)

web.config.debug = True


def my_loadhook():
    web.header('content-type', 'text/html;charset=utf-8', unique=True)


app.add_processor(web.loadhook(my_loadhook))


def notfound():
    return web.notfound('404')


def internalerror():
    return web.internalerror('404')


app.notfound = notfound
app.internalerror = internalerror

render = render_mako(
    directories=[abspath + '/templates'],
    input_encoding='utf-8',
    output_encoding='utf-8',
)

def codesafe(n):
    if re.search("select", n) or re.search(" ", n) or re.search("where", n) or re.search("=", n) or re.search("'", n):
        return False
    else:
        return True




class index:
    def GET(self):

        try:
            conn = sqlite3.connect(abspath + '/db/data.db')
        except:
            conn = sqlite3.connect('db/data.db')
        cur = conn.cursor()
        a = cur.execute('select id,title from news order by id asc').fetchall()
        cur.close()
        conn.close()
        return render.index(list=a)


class news:
    def GET(self, id):
        # try:
        #    id = web.input()['id']
        # except:
        #    raise web.seeother('/')
        if not codesafe(id):
            return 'Hacker?'
        try:
            conn = sqlite3.connect(abspath + '/db/data.db')
        except:
            conn = sqlite3.connect('db/data.db')
        cur = conn.cursor()
        sql = 'select title,content from news where id = {0}'.format(id)
        a = cur.execute(sql).fetchall()
        cur.close()
        conn.close()
        return render.news(title=a[0][0], content=a[0][1])


if __name__ == '__main__':
    app.run()
else:
    application = app.wsgifunc()