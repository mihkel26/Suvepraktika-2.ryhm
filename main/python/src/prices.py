import csv
import urllib.request
import urllib.error

url = 'https://dashboard.elering.ee/et/api/nps?type=price&format=csv'
data = []

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
            data.append([row[1], row[2]])


print(data)