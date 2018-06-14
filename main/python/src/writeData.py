import Controller
import calcPrice


def file_write():
    file = open("data.txt", "w")

    file.write(Controller.check_state() + "\n")
    file.write(Controller.get_dev_temp())
    file.write(Controller.get_room_temp())
    file.write(calcPrice.current_market())

    file.close()

    return
