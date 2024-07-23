from datetime import datetime
def calcularTicket(Ticket):
    total=0
    fecha = datetime.today().strftime('%Y-%m-%d')
    
    for i in Ticket:               
        cantidad = i.split('-')[0]
        # nombre = i.split('-')[1]
        precio = i.split('-')[2].replace(',','.')
        
        if not cantidad:
            cantidad = int(i.split('-')[1]) * -1
            precio = i.split('-')[3].replace(',','.')
            
        total+=(float(precio) * float(cantidad))
    
    print(f'Total: {round(total,2)}')    
    print(f'IVA {round((total * 0.16),2)}')      
    
    print(f'\nTotal a pagar: {round(total + (total * 0.16),2)}')
    print(f'Fecha de compra: {fecha}')    


print('INICIO')

oneTicket = [
 '1 - filete de ternera - 30,23',
 '4 - coca cola - 4,20',
 '-2 - coca cola - 1,40',
 '1 - pan - 0,90']  

calcularTicket(oneTicket)

print('FIN DEL PROGRAMA')