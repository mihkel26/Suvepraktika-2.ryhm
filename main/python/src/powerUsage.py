amps = 12
volts = 220


def get_kw():
    kw = amps * volts / 1000
    return kw


def get_mwh(time):
    mwh = get_kw() * time / 1000
    return mwh
