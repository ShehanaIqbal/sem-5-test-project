class Drawer:
  def __init__(self, classId, conf, left, top, right, bottom):
    self.classId = classId
    self.conf = conf
    self.left = left
    self.top = top
    self.right = right
    self.bottom = bottom
    
    def drawPred(self):
    # Draw a bounding box.
    #    cv.rectangle(frame, (left, top), (right, bottom), (255, 178, 50), 3)
        cv.rectangle(frame, (self.left, self.top), (self.right, self.bottom), (0, 255, 0), 3)

        label = '%.2f' % conf
    
        # Get the label for the class name and its confidence
        if classes:
            assert(self.classId < len(classes))
            label = '%s:%s' % (classes[classId], label)