import datetime

off_day = "*"
off_month = "*"
year = datetime.date.today().year

f = open('userNeeds.txt')
lines = f.readlines()
off_hours, off_minutes = map(int, (lines[2].split(".")))
off_day, off_month = map(int, (lines[3].split(".")))
on_day, on_month = map(int, (lines[3].split(".")))

warming_time = "1.45"
warming_h, warming_m = map(int, (warming_time.split(".")))

off = datetime.datetime(year, off_month, off_day, off_hours, off_minutes)
print(off)
on = off - datetime.timedelta(hours=warming_h, minutes=warming_m)
print(on.month)

# /home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/
file = open("cron.txt", "w")

file.write(
    str(on.minute) + " " + str(on.hour) + " " + str(on.day) + " " + str(
        on.month) + " * /usr/bin/python3 /home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/turnOn.py\n")
file.write(
    str(off_minutes) + " " + str(off_hours) + " " + str(off_day) + " " + str(
        off_month) + " * /usr/bin/python3 /home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/turnOff.py\n")

file.close()
