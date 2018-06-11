import csv
import urllib.request
import urllib.error
import datetime



url = 'https://dashboard.elering.ee/et/api/nps?type=price&start=startdate+21%3A00%3A00&end=enddate+21%3A00%3A00&format=csv'
data = []


today = datetime.date.today()
startdate = (datetime.datetime.now() - datetime.timedelta(days=7)).date()

url = "https://dashboard.elering.ee/et/api/nps?type=price&start=" + str(startdate) + "+21%3A00%3A00&end=" + str(today) +"+21%3A00%3A00&format=csv"


def getPrices():
    #Download electricity market price
    try:
        urllib.request.urlretrieve(url, 'output.csv')
    except urllib.error.HTTPError as ex:
        print('Problem:', ex)

    #Read data from file
    with open('output.csv') as csvfile:
        reader = csv.reader(csvfile, delimiter=';')
        for row in reader:
            if row[0] == 'ee':

                data.append([int(datetime.datetime.fromtimestamp(int(row[1])).strftime('%H')), float(row[2].replace(",", "."))])

    return(print(data))




getPrices()
