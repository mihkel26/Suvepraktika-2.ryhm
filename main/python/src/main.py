# mbw_pm.py - using pymodbus in serial mode to read and write modbus command.
# both for Windows and Linux environment. ITvilla 2014
# parameters for reading: mba regadd count port
# parameters for writing (1 or 2 consecutive registers): mba regadd hexdata port
''' Test program to communicate with a modbus slave using ModbusRTU protocol over serial or over TCP '''

import sys
from pymodbus.client.sync import ModbusSerialClient as ModbusClient  # using serial modbusRTU

cmd = 0

argnum = len(sys.argv)
if argnum < 4:
    print('use arguments: mba regadd count_or_datahex host:port_or_port')
    exit()

mba = int(sys.argv[1])  # mb aadress
regaddr = int(sys.argv[2])  # address to read or hex data to write
port = sys.argv[4]

client = ModbusClient(method='rtu', stopbits=1, bytesize=8, parity='E', baudrate=19200, timeout=1, port=port)

if len(sys.argv[3]) == 4:  # write 1 register
    regcount = int(sys.argv[3], 16)  # data, hex kujul
    # print('writing single register data', regcount)
    cmd = 6
else:
    if len(sys.argv[3]) < 3:
        regcount = int(sys.argv[3])
        cmd = 3
    else:
        print('invalid length ' + str(len(sys.argv[3])) + ' for parameter 3!')

output = ''

if cmd == 3:  # read holding registers
    for i in range(3):
        result = client.read_holding_registers(address=regaddr, count=regcount, unit=mba)  # response=''  # pymodbus
    temps = result.registers

    if len(temps) == 3:
        temp1 = temps[0] * 5 / 80.0
        temp2 = temps[1] * 5 / 80.0
        temp3 = temps[2] * 5 / 80.0
        avg_temp = (temp1 + temp2 + temp3) / 3
        print(avg_temp)
    else:
        print(temps[0] * 5 / 80.0)


elif cmd == 6:  # kirjutamine, 1 register
    client.write_register(address=regaddr, value=regcount, unit=mba)  # only one regiter to write here
    if regcount == 65535:
        print("Device turned on")
    else:
        print("Device turned off")

else:
    print('failure, unknown function code', cmd)
