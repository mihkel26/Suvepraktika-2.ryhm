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

def device_heat_time(device_temp, room_temp, user_temp_input, user_time_input):
    index = 10
    time_found = True

    while time_found:
        time_found = False
        test_time = user_time_input - index
        temp_raise = (device_temp + 0.67 * (0.98 - 0.005)) - ((0.05 * 1.02) * (device_temp-room_temp))
        temp_change = user_temp_input - device_temp
        heating_time = temp_change / temp_raise
        if user_temp_input - test_time < heating_time:
            index += 10
            time_found = True
        else:
            test_time
            # siin test_time on aeg, mis kulub seadme temperatuuri viimiseks soovitud ajani ilma muud arvestamata
    return test_time


def devic_optimal_heat_time():
    over_index = 10
    while heating_found:
    temp_10minute_decrease = device_temp - 0.05 * (device_temp - room_temp)
    heating_time_found -= over_index
    heating_found = True
    for i in range (1, 31):
        for j in range (1, 31):
            if user_temp_input + (temp_10minute_raise * i) - (j * temp_decrease):
                test_time_for_

