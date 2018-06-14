def read_user_needs():
    packet = file.readLine(1)
    #1- kosntante
    #2- ainult börsihind
    #3- ainult võrgutasudest
    #4- elektri börsihinnast ning võrgutasudest
    time = file.readLine(2)
    temp = file.readLine(3)
    return packet, time, temp


file = open("userNeeds.txt", "r")

