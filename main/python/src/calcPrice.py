import prices
import powerUsage
import datetime


now = datetime.datetime.now()


def price_market(start_hour, end_hour):
    time = end_hour - start_hour
    today_price = prices.getTodayPrice()
    price = 0
    for i in range(time):
        price += today_price[start_hour+i] * powerUsage.get_mwh()
    return price

print(price_market(12, 16))


