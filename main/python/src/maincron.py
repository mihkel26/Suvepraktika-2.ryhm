import datetime
import os
import main
import time
now = datetime.datetime.now()
hour_now = now.hour
min_now = now.minute
sec_now = now.second

if hour_now < 10:
    hour_now = "0" + str(hour_now)
else:
    hour_now = str(hour_now)

if min_now < 10:
    min_now = "0" + str(min_now)
else:
    min_now = str(min_now)

if sec_now < 10:
    sec_now = "0" + str(sec_now)
else:
    sec_now = str(sec_now)

time_now = hour_now + "." + min_now + "." + sec_now
time_hour_min = hour_now + "." + min_now

print(time_now)
print(time_hour_min)

def measure_device_temps():
    os.system("sudo python main.py 1 600 3 /dev/ttyUSB0")
    result = main.client.read_holding_registers(address=main.regaddr, count=main.regcount, unit=main.mba)
    print(main.mba, main.regaddr, main.regcount, 'result', str(result.registers))
    device_temps = result.registers
    device_temp1 = device_temps[0] * 5 / 80
    device_temp2 = device_temps[1] * 5 / 80
    device_temp3 = device_temps[2] * 5 / 80
    print(device_temp1, device_temp2, device_temp3)
    avg_device_temp = (device_temp1 + device_temp2 + device_temp3) / 3

    return avg_device_temp

def measure_room_temps():
    os.system("sudo python main.py  /dev/ttyUSB0")
    result = main.client.read_holding_registers(address=main.regaddr, count=main.regcount, unit=main.mba)
    print(main.mba, main.regaddr, main.regcount, 'result', str(result.registers))
    room_temps = result.registers
    room_temp1 = room_temps[0] * 5 / 80
    room_temp2 = room_temps[1] * 5 / 80
    room_temp3 = room_temps[2] * 5 / 80
    print(room_temp1, room_temp2, room_temp3)
    avg_room_temp = (room_temp1 + room_temp2 + room_temp3) / 3

    return avg_room_temp

def turn_device_on():
    os.system("sudo python main.py 1 0 FFFF /dev/ttyUSB0")

def turn_device_off():
    os.system("sudo python main.py 1 0 0000 /dev/ttyUSB0")

if min_now == 30 or min_now == 0:
    device_temperature = measure_device_temps()
    room_tempertaute = measure_room_temps()

if time_hour_min == "11.25":
    turn_device_on()
    time_sleep_seconds = 3000
    time.sleep(time_sleep_seconds)
    turn_device_off()