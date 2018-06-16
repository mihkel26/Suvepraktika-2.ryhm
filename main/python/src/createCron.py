import datetime
import Controller

year = datetime.date.today().year

f = open('userNeeds.txt')
lines = f.readlines()

off_hours, off_minutes = map(int, (lines[2].split(".")))
off_day, off_month = map(int, (lines[3].split(".")))
on_day, on_month = map(int, (lines[3].split(".")))
timer_on_h, timer_on_m = map(int, (lines[2].split(".")))
timer_off_h, timer_off_m = map(int, (lines[5].split(".")))
mode = lines[1].strip("\n")

warming_time = "1.45"
warming_h, warming_m = map(int, (warming_time.split(".")))

if mode == "0":
    off = datetime.datetime(year, off_month, off_day, off_hours, off_minutes)
    on = off - datetime.timedelta(hours=warming_h, minutes=warming_m)
elif mode == "2":

    on = datetime.datetime(year, off_month, off_day, timer_on_h, timer_on_m)
    off = datetime.datetime(year, off_month, off_day, timer_off_h, timer_off_m)
    print(on)
    print(off)

elif mode == "3":
    if Controller.get_room_temp() < 4:
        on = datetime.datetime.now() + datetime.timedelta(minutes=1)
    elif Controller.get_room_temp() > 8:
        off = datetime.datetime.now() + datetime.timedelta(minutes=1)

# /home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/
file = open("cron.txt", "w")

file.write(
    str(on.minute) + " " + str(on.hour) + " " + str(on.day) + " " + str(
        on.month) + " * /usr/bin/python3 /home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/turnOn.py\n")
file.write(
    str(off_minutes) + " " + str(off_hours) + " " + str(off_day) + " " + str(
        off_month) + " * /usr/bin/python3 /home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/turnOff.py\n")

file.close()
