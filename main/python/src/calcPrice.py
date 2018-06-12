import prices
import powerUsage
import datetime

now = datetime.datetime.now()


def price_market():
    today_price = prices.getTodayPrice()
    price = today_price[now.hour] * powerUsage.get_mwh(1)
    return price


