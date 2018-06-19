def device_heat_time():
    index = 10
    temp_file = open("/home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/temptest.txt", "r")
    temp_change = float(temp_file.readline())
    temp_file.close()
    user_needs_file = open('userNeeds.txt', "r")
    lines = user_needs_file.readlines()
    user_time_input = lines[1]
    user_temp_input = lines[3]
    user_needs_file.close()
    hour, minute = map(int, (user_time_input.split(".")))
    user_temp_minutes = (hour * 60) + minute
    data_file = open("/home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/data.txt", "r")
    data_file_lines = data_file.readlines()
    device_temp = int(data_file_lines[1])
    room_temp = int(data_file_lines[2])
    data_file.close()
    time_found = True
    test_time = user_time_input
    test_hour, test_minute = map(int, (test_time.split(".")))
    while time_found:
        if test_minute > 0:
            test_minute = test_minute - index
        if test_minute == 0:
            test_hour = test_hour - 1
            test_minute = 50
        temp_raise = (device_temp + temp_change) - (0.05 * (device_temp - room_temp))
        temp_change = int(user_temp_input) - device_temp
        heating_time = temp_change / temp_raise * 10 # mitu min kulub
        if user_temp_minutes - ((test_hour * 60) + test_minute) < heating_time:
            index += 10
            time_found = True
        else:
            time_found = False  # siin test_time on aeg, mis kulub seadme temperatuuri viimiseks soovitud ajani ilma muud arvestamata
    return str(test_hour) + "." + str(test_minute)

print(device_heat_time)