import prices

tempInput = int(35)
timeInput = float(8.00)

data = prices.getPrices()
print(data)

fin = open('asd.txt', 'r')
data_from_file = fin.read()
data_from_file = data_from_file.split()