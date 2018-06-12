import os
import main


def gettemps():
    for i in range(0, 3):
        if i == 2:
            os.system("sudo python main.py 1 600 3 /dev/ttyUSB0")
            result = main.client.read_holding_registers(address=main.regaddr, count=main.regcount, unit=main.mba)
            print(main.mba, main.regaddr, main.regcount, 'result', str(result.registers))
            temps = result.registers
            temp1 = temps[0] * 5 / 80
            temp2 = temps[1] * 5 / 80
            temp3 = temps[2] * 5 / 80
            print(temp1, temp2, temp3)
        else:
            os.system("sudo python main.py 1 600 3 /dev/ttyUSB0")


gettemps()
