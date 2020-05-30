import cv2 as cv
import numpy as np

class Filter:
    def __init__(self,frame,outs):
        self.frame = frame
        self.outs = outs
        self.confThreshold = 0.5  #Confidence threshold
        self.nmsThreshold = 0.4 
        
    def drawPred(classId, conf, left, top, right, bottom):
    # Draw a bounding box.
    #    cv.rectangle(frame, (left, top), (right, bottom), (255, 178, 50), 3)
        cv.rectangle(frame, (left, top), (right, bottom), (0, 255, 0), 3)
    
        label = '%.2f' % conf
    
        # Get the label for the class name and its confidence
        if classes:
            assert(classId < len(classes))
            label = '%s:%s' % (classes[classId], label)
        
    def postprocess(self):
        frameHeight = self.frame.shape[0]
        frameWidth = self.frame.shape[1]
        outs=self.outs
        classIds = []
        confidences = []
        boxes = []
        classIds = []
        confidences = []
        boxes = []
        for out in outs:
            print("out.shape : ", out.shape)
            for detection in out:
                #if detection[4]>0.001:
                scores = detection[5:]
                classId = np.argmax(scores)
                #if scores[classId]>confThreshold:
                confidence = scores[classId]
                if detection[4]>self.confThreshold:
                    print(detection[4], " - ", scores[classId], " - th : ", self.confThreshold)
                    print(detection)
                if confidence > self.confThreshold:
                    center_x = int(detection[0] * frameWidth)
                    center_y = int(detection[1] * frameHeight)
                    width = int(detection[2] * frameWidth)
                    height = int(detection[3] * frameHeight)
                    left = int(center_x - width / 2)
                    top = int(center_y - height / 2)
                    classIds.append(classId)
                    confidences.append(float(confidence))
                    boxes.append([left, top, width, height])
        indices = cv.dnn.NMSBoxes(boxes, confidences, self.confThreshold, self.nmsThreshold)
        for i in indices:
            i = i[0]
            box = boxes[i]
            left = box[0]
            top = box[1]
            width = box[2]
            height = box[3]
            self.drawPred(classIds[i], confidences[i], left, top, left + width, top + height)