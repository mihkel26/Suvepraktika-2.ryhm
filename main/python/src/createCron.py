on_hours = "*"
on_minutes = "*"
on_day = "*"
on_month = "*"
off_day = "*"
off_month = "*"

f = open('userNeeds.txt')
lines = f.readlines()
off_hours, off_minutes = map(int, (lines[2].split(".")))
off_day, off_month = map(int, (lines[3].split(".")))
on_day, on_month = map(int, (lines[3].split(".")))

warming_time = "00.10"
warming_h, warming_m = map(int, (warming_time.split(".")))

print(warming_h)
print(warming_m)

on_hours = off_hours - warming_h
# fix with timedelta
if off_minutes == 00:
    on_minutes = 60 - warming_m

# /home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/
file = open("/home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/cron.txt", "w")

file.write(
    str(on_minutes) + " " + str(on_hours) + " " + str(on_day) + " " + str(
        on_month) + " * /usr/bin/python3 /home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/turnOn.py\n")
file.write(
    str(off_minutes) + " " + str(off_hours) + " " + str(off_day) + " " + str(
        off_month) + " * /usr/bin/python3 /home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/turnOff.py\n")

file.close()
