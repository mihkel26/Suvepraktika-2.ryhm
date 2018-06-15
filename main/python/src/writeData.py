import Controller
import calcPrice


def file_write():
    file = open("/home/pi/suvepraktika/Suvepraktika-2.ryhm/main/python/src/data.txt", "w")

    file.write(Controller.check_state() + "\n")
    file.write(Controller.get_dev_temp())
    file.write(Controller.get_room_temp())
    file.write(calcPrice.current_market())

    file.close()

    return

