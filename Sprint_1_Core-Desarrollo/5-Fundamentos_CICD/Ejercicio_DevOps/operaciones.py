def suma (a,b):
    try:
        if type(a) == bool or type(b) == bool:
            return 'error'
        return float(a) + float(b)
    except:
        return 'error'
def resta (a,b):
    try:
        if type(a) == bool or type(b) == bool:
            return 'error'
        return float(a) - float(b)
    except:
        return 'error'

def multiplicacion(a,b):
    try:
        if type(a) == bool or type(b) == bool:
            return 'error'
        return float(a) * float(b)
    except:
        return 'error'
def division(a,b):
    try:
        if type(a) == bool or type(b) == bool:
            return 'error'
        return float(a) / float(b)
    except:
        return 'error'

