import math

import cv2
import dlib

import sys

oldpic = sys.argv[1]

detector = dlib.get_frontal_face_detector()
landmark_predictor = dlib.shape_predictor('shape_predictor_68_face_landmarks.dat')
img = cv2.imread(oldpic)
faces = detector(img,1)
dx = []
dy = []
if (len(faces) > 0):
    for k,d in enumerate(faces):
        cv2.rectangle(img,(d.left(),d.top()),(d.right(),d.bottom()),(255,255,255))
        shape = landmark_predictor(img,d)
        for i in range(68):
            print(i)
            dx.append(shape.part(i).x)
            dy.append(shape.part(i).y)
            cv2.circle(img, (shape.part(i).x, shape.part(i).y),5,(0,255,0), -1, 8)
            cv2.putText(img,str(i),(shape.part(i).x,shape.part(i).y),cv2.FONT_HERSHEY_SIMPLEX,0.5,(255,255,255))
#cv2.imshow('Frame',img)
#cv2.waitKey(0)


newpic = oldpic.replace('face.', 'face_68points.') 

cv2.imwrite(newpic,img)

def getlenof2(x1,y1,x2,y2):  #计算两点之间的距离
    result = math.sqrt(math.pow(x1-x2,2)+math.pow(y1-y2,2))
    return result

lenof2_36_45 = getlenof2(dx[36],dy[36],dx[45],dy[45])
lenof2_39_42 = getlenof2(dx[39],dy[39],dx[42],dy[42])
lenof2_27_33 = getlenof2(dx[27],dy[27],dx[33],dy[33])
lenof2_31_35 = getlenof2(dx[31],dy[31],dx[35],dy[35])
lenof2_0_16 = getlenof2(dx[0],dy[0],dx[16],dy[16])
lenof2_33_51 = getlenof2(dx[33],dy[33],dx[51],dy[51])
lenof2_57_8 = getlenof2(dx[57],dy[57],dx[8],dy[8])
lenof2_48_54 = getlenof2(dx[48],dy[48],dx[54],dy[54])
lenof2_51_57 = getlenof2(dx[51],dy[51],dx[57],dy[57])
lenof2_66_33 = getlenof2(dx[66],dy[66],dx[33],dy[33])
lenof2_36_45 = getlenof2(dx[36],dy[36],dx[45],dy[45])

Ap1 = int((lenof2_36_45*10)//lenof2_39_42)
Ap2 = int((lenof2_27_33*10)//lenof2_31_35)
#Ap3 = int((lenof2_39_42*10)//lenof2_27_33)
#Ap4 = int((lenof2_0_16*10)//lenof2_39_42)
#Ap5 = int((lenof2_33_51*10)//lenof2_57_8)
#Ap6 = int((lenof2_48_54*10)//lenof2_51_57)
#Ap7 = int((lenof2_66_33*10)//lenof2_36_45)

#Ap = str(Ap1)+'_'+str(Ap2)+'_'+str(Ap3)+'_'+str(Ap4)+'_'+str(Ap5)+'_'+str(Ap6)+'_'+str(Ap7)

Ap = str(Ap1)+'_'+str(Ap2)

print(Ap)







