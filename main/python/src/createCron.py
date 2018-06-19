import datetime
import Controller
import subprocess

year = datetime.date.today().year

f = open('userNeeds.txt')
lines = f.readlines()

off_hours, off_minutes = map(int, (lines[1].split(".")))
off_day, off_month = map(int, (lines[2].split(".")))
on_day, on_month = map(int, (lines[2].split(".")))
timer_on_h, timer_on_m = map(int, (lines[1].split(".")))
timer_off_h, timer_off_m = map(int, (lines[4].split(".")))
mode = lines[0].strip("\n")
min_temp = lines[5].strip("\n")
max_temp = lines[6].strip("\n")

warming_time = "1.45"
warming_h, warming_m = map(int, (warming_time.split(".")))


def write_on_off():
    # /home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/
    file = open("/home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/cron.txt", "w")

    file.write("* * * * * /usr/bin/python3 /home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/writeData.py\n")
    file.write("10 * * * * /usr/bin/python3 /home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/createCron.py\n")
    file.write(
        str(on.minute) + " " + str(on.hour) + " " + str(on.day) + " " + str(
            on.month) + " * /usr/bin/python3 /home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/turnOn.py\n")
    file.write(
        str(off.minute) + " " + str(off.hour) + " " + str(off.day) + " " + str(
            off.month) + " * /usr/bin/python3 /home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/turnOff.py\n")

    file.close()
    return


def write_on():
    # /home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/
    file = open("/home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/cron.txt", "w")

    file.write("* * * * * /usr/bin/python3 /home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/writeData.py\n")
    file.write("10 * * * * /usr/bin/python3 /home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/createCron.py\n")
    file.write(
        str(on.minute) + " " + str(on.hour) + " " + str(on.day) + " " + str(
            on.month) + " * /usr/bin/python3 /home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/turnOn.py\n")

    file.close()
    return


def write_off():
    # /home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/
    file = open("/home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/cron.txt", "w")
    file.write("* * * * * /usr/bin/python3 /home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/writeData.py\n")
    file.write("10 * * * * /usr/bin/python3 /home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/createCron.py\n")
    file.write(
        str(off.minute) + " " + str(off.hour) + " " + str(off.day) + " " + str(
            off.month) + " * /usr/bin/python3 /home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/turnOff.py\n")

    file.close()
    return


if mode == "0":
    off = datetime.datetime(year, off_month, off_day, off_hours, off_minutes)
    on = off - datetime.timedelta(hours=warming_h, minutes=warming_m)
    write_on_off()

elif mode == "2":
    on = datetime.datetime(year, off_month, off_day, timer_on_h, timer_on_m)
    off = datetime.datetime(year, off_month, off_day, timer_off_h, timer_off_m)
    write_on_off()

elif mode == "3":
    if float(Controller.get_room_temp()) <= float(min_temp):
        on = datetime.datetime.now() + datetime.timedelta(minutes=2)
        write_on()
    elif float(Controller.get_room_temp()) >= float(max_temp):
        off = datetime.datetime.now() + datetime.timedelta(minutes=2)
        write_off()

subprocess.call(["sudo", "crontab", "/home/pi/suvepraktika/Suveprakitka-2.ryhm/main/python/src/cron.txt"])
