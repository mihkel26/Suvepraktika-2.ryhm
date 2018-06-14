import Controller


def file_write():

    file = open("data.txt", "w")

    file.write(Controller.check_state())
    file.write(Controller.get_dev_temp())
    file.write(Controller.get_room_temp())

    file.close()

    return

file_write()
