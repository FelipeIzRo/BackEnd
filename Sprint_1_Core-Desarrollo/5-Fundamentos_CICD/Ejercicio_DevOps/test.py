import unittest
import operaciones as operaciones

class TestSumar (unittest.TestCase):
    def test_suma(self):
        # Prueba de sumar
        self.assertEqual(operaciones.suma(1,1),2)
        self.assertEqual(operaciones.suma(5,-1),4)
        self.assertEqual(operaciones.suma(-3,-3),-6)
        self.assertEqual(operaciones.suma(3,-4),-1)
        # Prueba parametros incorrectos
        self.assertEqual(operaciones.suma("a",-4),'error')
        self.assertEqual(operaciones.suma(True,-4),'error')

    def test_resta(self):
        # Prueba de restar
        self.assertEqual(operaciones.resta(1,1),0)
        self.assertEqual(operaciones.resta(5,-1),6)
        self.assertEqual(operaciones.resta(-1,-1),0)
        self.assertEqual(operaciones.resta(5,10),-5)
        # Prueba parametros incorrectos
        self.assertEqual(operaciones.resta("a",10),'error')
        self.assertEqual(operaciones.resta(True,10),'error')

    def test_multiplicacion(self):
        # Prueba de multiplicar
        self.assertEqual(operaciones.multiplicacion(1,1),1)
        self.assertEqual(operaciones.multiplicacion(2,5),10)
        self.assertEqual(operaciones.multiplicacion(3,-3),-9)
        self.assertEqual(operaciones.multiplicacion(20,0),0)
        # Prueba parametros incorrectos        
        self.assertEqual(operaciones.multiplicacion("a",2),'error')
        self.assertEqual(operaciones.multiplicacion(True,4),'error')

    def test_division(self):
        # Prueba de dividir
        self.assertEqual(operaciones.division(1,1),1.0)
        self.assertEqual(operaciones.division(5,2),2.5)
        self.assertEqual(operaciones.division(20,10),2.0)
        # Prueba parametros incorrectos
        self.assertEqual(operaciones.division(1,0),'error')
        self.assertEqual(operaciones.division("a",1),'error')
        self.assertEqual(operaciones.division(True,1),'error')
        
if __name__ == '__main__':
    unittest.main()
    