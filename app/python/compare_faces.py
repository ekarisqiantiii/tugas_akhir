import sys
import cv2
import face_recognition
import numpy as np
from PIL import Image

# Get the paths of the two images
image1_path = sys.argv[1]
image2_path = sys.argv[2]

# print(f"Image 1 path: {image1_path}")
# print(f"Image 2 path: {image2_path}")

# Check if images are opened correctly
try:
    img1 = Image.open(image1_path)
    img2 = Image.open(image2_path)
    img1.verify()
    img2.verify()
except (IOError, SyntaxError) as e:
    print(f"Error: {e}")
    sys.exit(1)

# print("Images are loaded correctly and verified.")

# Load the images using OpenCV
image1 = cv2.imread(image1_path)
image2 = cv2.imread(image2_path)

# Check if the images were loaded successfully
if image1 is None:
    print({"status":"200","msg":"Error: Could not load image 1."})
    sys.exit(1)
if image2 is None:
    print({"status":"200","msg":"Error: Could not load image 2."})
    sys.exit(1)

# Check the type and shape of the loaded images
# print(f"Image 1 type: {type(image1)}")
# print(f"Image 1 shape: {image1.shape if image1 is not None else 'None'}")
# print(f"Image 2 type: {type(image2)}")
# print(f"Image 2 shape: {image2.shape if image2 is not None else 'None'}")

# Convert images to RGB (OpenCV loads images in BGR by default)
rgb_image1 = cv2.cvtColor(image1, cv2.COLOR_BGR2RGB)
rgb_image2 = cv2.cvtColor(image2, cv2.COLOR_BGR2RGB)

# Check if the images are 8-bit and convert if necessary
if rgb_image1.dtype != 'uint8':
    rgb_image1 = np.uint8(rgb_image1)
if rgb_image2.dtype != 'uint8':
    rgb_image2 = np.uint8(rgb_image2)

# Check the type and shape of the RGB images
# print(f"RGB Image 1 type: {rgb_image1.dtype}")
# print(f"RGB Image 2 type: {rgb_image2.dtype}")

# Find the face locations and face encodings in both images
face_locations1 = face_recognition.face_locations(rgb_image1)
face_encodings1 = face_recognition.face_encodings(rgb_image1, face_locations1)
face_locations2 = face_recognition.face_locations(rgb_image2)
face_encodings2 = face_recognition.face_encodings(rgb_image2, face_locations2)

# print(f"Number of faces detected in image 1: {len(face_encodings1)}")
# print(f"Number of faces detected in image 2: {len(face_encodings2)}")

# Check if faces were found in both images
if len(face_encodings1) == 0:
    print({"status":"200","msg":"Error: No faces found in image 1."})
    sys.exit(1)
if len(face_encodings2) == 0:
    print({"status":"200","msg":"Error: No faces found in image 2."})
    sys.exit(1)

if len(face_encodings1) > 1:
    print({"status":"200","msg":"Error: There is more than one face detected in image 1."})
    sys.exit(1)

if len(face_encodings2) > 1:
    print({"status":"200","msg":"Error: There is more than one face detected in image 2."})
    sys.exit(1)


# mengecek Blur wajah
blur_tolerance = 30
image_blur1 = 0
image_blur2 = 0

face_cascade = cv2.CascadeClassifier(cv2.data.haarcascades + "haarcascade_frontalface_default.xml")
gray_frame1 = cv2.cvtColor(image1, cv2.COLOR_BGR2GRAY)
faces1 = face_cascade.detectMultiScale(gray_frame1, scaleFactor=1.1, minNeighbors=5, minSize=(50, 50))

gray_frame2 = cv2.cvtColor(image2, cv2.COLOR_BGR2GRAY)
faces2 = face_cascade.detectMultiScale(gray_frame2, scaleFactor=1.1, minNeighbors=5, minSize=(50, 50))

for (x, y, w, h) in faces1:
    face_roi1 = image1[y:y+h, x:x+w]
    image_blur1 = cv2.Laplacian(face_roi1, cv2.CV_64F).var()

for (x, y, w, h) in faces2:
    face_roi2 = image1[y:y+h, x:x+w]
    image_blur2 = cv2.Laplacian(face_roi2, cv2.CV_64F).var()

if image_blur1 < blur_tolerance:
    print({"status":"200","msg":"Error: Blur detected in image 1."})
    sys.exit(1)

if image_blur2 < blur_tolerance:
    print({"status":"200","msg":"Error: Blur detected in image 2."})
    sys.exit(1)

# Compare the first face encoding in each image
match = face_recognition.compare_faces([face_encodings1[0]], face_encodings2[0], tolerance=0.5)

# Print the result
if match[0]:
    print({"status":"201","msg":"Faces match"})
    print("Faces match")
else:
    print({"status":"202","msg":"Faces do not match"})