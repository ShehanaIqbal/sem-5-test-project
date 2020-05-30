from google.cloud import vision
import os,io
os.environ['GOOGLE_APPLICATION_CREDENTIALS']=r"api1.json"


def extract_text():
    r_texts=[]
    client = vision.ImageAnnotatorClient()
    
    with io.open(r"cropped.jpg", 'rb') as image_file:
         content = image_file.read()
     
    image = vision.types.Image(content=content)
     
    response = client.text_detection(image=image)
    texts = response.text_annotations
    print('Texts:')
     
    for text in texts:
         print(str(format(text.description)))
         r_texts.append(str(format(text.description)))
         vertices = (['({},{})'.format(vertex.x, vertex.y)
                     for vertex in text.bounding_poly.vertices])
     
         print('bounds: {}'.format(','.join(vertices)))
     
    if response.error.message:
         raise Exception(
             '{}\nFor more info on error messages, check: '
             'https://cloud.google.com/apis/design/errors'.format(
                 response.error.message))
    return(str(r_texts[0]))

extract_text()
