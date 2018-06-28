#把多個圖檔轉成 PDF 檔
#需求 pip3 install img2pdf


import sys
import os
import img2pdf


flist=[]

#預設值
path ='.'
pdfname='out.pdf'

if len(sys.argv)==1:
    print ( '用法：python3 pic2pdf.py [path] [out.pdf] \n 無參數代表目前目錄中所圖檔轉成 out.pdf ')


if len(sys.argv)>1:
    path =sys.argv[1]
if len(sys.argv)>2:
    pdfname =sys.argv[2]


#輸出A4 大小
#a4inpt = (img2pdf.mm_to_pt(210),img2pdf.mm_to_pt(297))
#layout_fun = img2pdf.get_layout_fun(a4inpt)

#需要完整路徑
for i in os.listdir(path):
    if i.endswith((".png",".jpg","jpeg")):
        flist.append( path + '/' +  i)
        print('.' , end='' )
flist.sort()
#print(flist)

#多檔案轉成 pdf
if len(flist)>0:
    with open(pdfname,"wb") as f:
        #f.write(img2pdf.convert('test.jpg'))
        #f.write(img2pdf.convert( flist , layout_fun=layout_fun ))
        f.write(img2pdf.convert( flist  ))
    print('轉成pdf:' + pdfname )
