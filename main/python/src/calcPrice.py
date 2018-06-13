import prices
import powerUsage
import datetime

now = datetime.datetime.now()


def price_market(start_hour, end_hour):
    time = end_hour - start_hour
    today_price = prices.getTodayPrice()
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

        if now.month >= 4 and now.month <= 9:

            if current_hour >= 8 and current_hour <= 23:

                fee += day_fee

            else:
                fee += night_fee

        else:

            if current_hour >= 7 and current_hour <= 22:

                fee += day_fee

            else:
                fee += night_fee

    return fee


def const_fee(fee, start_hour, end_hour):
    sum = 0.0
    time = end_hour - start_hour
    sum = fee * time

    return sum


print(network_fee(0.0445, 0.033, 7, 10))
