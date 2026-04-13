import unittest
from les12_logic import Product, Winkelmandje


class TestProduct(unittest.TestCase):

    def test_verlaag_voorraad_geldig(self):
        p = Product("Muis", 25, 10)
        resultaat = p.verlaag_voorraad(3)

        self.assertTrue(resultaat)
        self.assertEqual(p.voorraad, 7)

    def test_verlaag_voorraad_teveel(self):
        p = Product("Muis", 25, 2)
        resultaat = p.verlaag_voorraad(5)

        self.assertFalse(resultaat)
        self.assertEqual(p.voorraad, 2)

    def test_verlaag_voorraad_negatief(self):
        p = Product("Muis", 25, 5)
        resultaat = p.verlaag_voorraad(-1)

        self.assertFalse(resultaat)
        self.assertEqual(p.voorraad, 5)


class TestWinkelmandje(unittest.TestCase):

    def test_totaal_prijs_meerdere_items(self):
        p1 = Product("Muis", 25, 10)
        p2 = Product("Toetsenbord", 59, 5)

        mandje = Winkelmandje()

        mandje.voeg_toe(p1, 2)
        mandje.voeg_toe(p2, 1)

        self.assertEqual(mandje.totaal_prijs(), 109)

    def test_voeg_toe_teveel_voorraad(self):
        p = Product("Laptop", 899, 1)

        mandje = Winkelmandje()
        resultaat = mandje.voeg_toe(p, 3)

        self.assertFalse(resultaat)
        self.assertEqual(mandje.totaal_prijs(), 0)


if __name__ == "__main__":
    unittest.main()