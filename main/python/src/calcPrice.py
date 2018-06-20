import prices
import powerUsage
import datetime

now = datetime.datetime.now()


def market_fee(start_hour, end_hour):
    time = end_hour - start_hour
    today_price = prices.get_today_price()
    price = 0
    for i in range(time):
        price += today_price[start_hour + i] * powerUsage.get_mwh()
    return price


def network_fee(day_fee, night_fee, start_hour, end_hour):
    # 8-12 / 12-8 winter 7-11 / 11-7

    fee = 0.0
    time = end_hour - start_hour

    for i in range(time):

        current_hour = start_hour + i
        # summertime
        if 4 <= now.month <= 9:

            if 8 <= current_hour <= 23:

                fee += day_fee

            else:
                fee += night_fee

        else:
            # wintertime
            if 7 <= current_hour <= 22:

                fee += day_fee

            else:
                fee += night_fee

    return fee


def const_fee(fee, start_hour, end_hour):
    time = end_hour - start_hour
    sum_m = fee * time

    return sum_m


def current_market():
    market = prices.get_today_price()
    return str(market[now.hour])


def device_const_heat_time():
    index = 10
    # temp_file = open('/home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/temptest.txt', "r")
    # temp_change = float(temp_file.readline())
    # temp_file.close()
    user_needs_file = open('/var/www/html/userNeeds.txt', "r")
    lines = user_needs_file.readlines()
    user_time_input = lines[1]
    user_temp_input = lines[3]
    user_needs_file.close()
    hour, minute = map(int, (user_time_input.split(".")))
    user_temp_minutes = (hour * 60) + minute
    data_file = open('/home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/data.txt', "r")
    data_file_lines = data_file.readlines()
    device_temp = float(data_file_lines[1])
    room_temp = float(data_file_lines[2])
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
        temp_raise = (device_temp + 0.5) - (0.05 * (device_temp - room_temp))
        temp_change = int(user_temp_input) - device_temp
        heating_time = temp_change / temp_raise * 10  # mitu min kulub
        if user_temp_minutes - ((test_hour * 60) + test_minute) < heating_time:
            index += 10
            time_found = True
        else:
            time_found = False  # siin test_time on aeg, mis kulub seadme temperatuuri viimiseks soovitud ajani ilma muud arvestamata
    return str(test_hour) + "." + str(test_minute)


def device_market_heat_time():
    index = 10
    start_minute = 0
    start_hour = 0
    switch_on_off = ""
    # temp_file = open('/home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/temptest.txt', "r")
    # temp_change = float(temp_file.readline())
    # temp_file.close()
    user_needs_file = open('/var/www/html/userNeeds.txt', "r")
    lines = user_needs_file.readlines()
    user_time_input = lines[1]
    user_temp_input = lines[3]
    user_needs_file.close()
    hour, minute = map(int, (user_time_input.split(".")))
    user_temp_minutes = (hour * 60) + minute
    data_file = open('/home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/data.txt', "r")
    data_file_lines = data_file.readlines()
    device_temp = float(data_file_lines[1])
    room_temp = float(data_file_lines[2])
    data_file.close()
    test_time = user_time_input
    prices_array = prices.get_today_price()
    test_hour, test_minute = map(int, (test_time.split(".")))
    total_heating_cost = 10000
    calculating_heating_price = 0
    time_found = True
    switch_on = ""
    switch_off = ""
    while time_found:
        if test_minute > 0:
            test_minute = test_minute - index
        if test_minute == 0:
            test_hour = test_hour - 1
            test_minute = 50
        temp_raise = (device_temp + 0.5) - (0.05 * (device_temp - room_temp))
        temp_change = int(user_temp_input) - device_temp
        heating_time = temp_change / temp_raise * 10  # mitu min kulub
        if user_temp_minutes - ((test_hour * 60) + test_minute) < heating_time:
            index += 10
            time_found = True
        else:
            time_found = False
            min_nearby_value = prices_array[test_hour]
            for i in range(1, 5):
                if prices_array[test_hour - i] < min_nearby_value:
                    min_nearby_value = prices_array[test_hour - i]
                    # min_nearby_time = test_hour - i
            if min_nearby_value == prices_array[test_hour]:
                if minute > test_minute:
                    start_minute = minute - test_minute
                    start_hour = hour - test_hour
                else:
                    start_hour = hour - 1 - test_hour
                    start_minute = minute + 60 - test_minute
                switch_on = str(start_hour) + "." + str(start_minute)
                switch_off = str(hour) + "." + str(minute)
            else:
                finding_start_minutes = start_minute
                finding_start_hours = start_hour
                finding_heating_minutes = test_minute
                finding_heating_hours = test_hour
                finding_total_minutes_for_heating = (start_hour * 60) + start_minute
                total_minutes = finding_total_minutes_for_heating
                for j in range(1, 9):
                    finding_total_minutes_for_heating += 10
                    if finding_start_minutes >= 30:
                        finding_start_minutes = finding_start_minutes - 30
                        if finding_heating_minutes <= 40:
                            finding_heating_minutes = finding_heating_minutes + 10
                        if finding_heating_minutes == 50:
                            finding_heating_minutes = 0
                            finding_heating_hours = finding_heating_hours + 1
                    if finding_start_minutes < 30:
                        finding_start_minutes = 60 - (30 - finding_start_minutes)
                        finding_start_hours = finding_start_hours - 1
                    while finding_total_minutes_for_heating > 0:
                        if finding_start_minutes > 0:
                            finding_total_minutes_for_heating - (60 - finding_start_minutes)
                            first_minutes = 60 - finding_start_minutes
                            calculating_heating_price = prices_array[finding_start_hours] * 60 / first_minutes
                            full_hours = finding_total_minutes_for_heating / 60
                            finding_total_minutes_for_heating = finding_total_minutes_for_heating - full_hours * 60
                            for a in range(1, full_hours + 1):
                                calculating_heating_price += prices_array[finding_start_hours + 1 + a]
                            if finding_total_minutes_for_heating > 0:
                                calculating_heating_price += prices_array[
                                                                 finding_start_hours + 1 + full_hours] * 60 / finding_total_minutes_for_heating
                            if calculating_heating_price < total_heating_cost:
                                total_heating_cost = calculating_heating_price
                                best_starting_hours = finding_start_hours
                                best_starting_minutes = finding_start_minutes
                                switch_on = str(best_starting_hours) + "." + str(best_starting_minutes)
                                switch_off_hours = total_minutes / 60
                                switch_off_minutes = total_minutes % 60
                                switch_off = str(switch_off_hours) + "." + str(switch_off_minutes)
                        else:
                            full_hours = finding_total_minutes_for_heating / 60
                            finding_total_minutes_for_heating = finding_total_minutes_for_heating - full_hours * 60
                            for a in range(1, full_hours + 1):
                                calculating_heating_price += prices_array[finding_start_hours + 1 + a]
                            if finding_total_minutes_for_heating > 0:
                                calculating_heating_price += prices_array[
                                                                 finding_start_hours + 1 + full_hours] * 60 / finding_total_minutes_for_heating
                            if calculating_heating_price < total_heating_cost:
                                total_heating_cost = calculating_heating_price
                                best_starting_hours = finding_start_hours
                                best_starting_minutes = finding_start_minutes
                                switch_on = str(best_starting_hours) + "." + str(best_starting_minutes)
                                switch_off_hours = total_minutes / 60
                                switch_off_minutes = total_minutes % 60
                                switch_off = str(switch_off_hours) + "." + str(switch_off_minutes)
    return switch_on + "," + switch_off
