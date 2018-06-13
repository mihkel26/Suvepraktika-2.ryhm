amps = 12
volts = 220


def get_kw():
    kw = amps * volts / 1000
    return kw


def get_mwh():
    time = 1
    mwh = get_kw() * time / 1000
    return mwh
