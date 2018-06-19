import time
import Controller

Controller.turn_on()

time.sleep(600)

f = open('/home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/data.txt')
lines = f.readlines()
file = open("/home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/temptest.txt", "w")
file.write(lines[1])
file.close()

Controller.turn_off()
