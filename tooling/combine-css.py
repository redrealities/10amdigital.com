#!/usr/bin/env python
# encoding: utf-8
import os
import re
import pathlib

CSS_ROOT_FILE_PATH = 'styles/'
CSS_ROOT_FILE_NAME = 'all.css'
CSS_RESULT_FILE_PATH = 'styles/combined.css'

total_css = ''

with open(CSS_ROOT_FILE_PATH + CSS_ROOT_FILE_NAME) as file:
    data = file.read()
    imports = re.findall(r'\@import \'(.+)\';', data)

    for imp in imports:
        stylesheet_path = CSS_ROOT_FILE_PATH + imp
        imp_dir = imp.replace(pathlib.PurePath(imp).name, '')
        with open(stylesheet_path) as stylesheet:
            content = stylesheet.read() #.replace("url(../", "url(")
            urls = re.findall(r'url\((.+)\)', content)
            if len(urls) > 0:
                #print(imp_dir)
                #print(urls)
                for url in urls:
                    content = content.replace('url(' + url + ')', 'url(' + imp_dir + url + ')')
            total_css = total_css + "\n" + content

    #print(data)
    #print(imports)

#print(total_css)
with open(CSS_RESULT_FILE_PATH, 'w+') as result_file:
    result_file.write(total_css)
