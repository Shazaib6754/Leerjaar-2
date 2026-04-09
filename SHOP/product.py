class Product:
    def __init__(self, naam, prijs, voorraad):
        self.naam = naam
        self.prijs = prijs
        self._voorraad = voorraad

    def toon_info(self):
        print(f"{self.naam} - €{self.prijs} (Voorraad: {self._voorraad})")

    def is_op_voorraad(self, aantal=1):
        return self._voorraad >= aantal

    def verlaag_voorraad(self, aantal):
        if self.is_op_voorraad(aantal):
            self._voorraad -= aantal
            return True
        else:
            print(f"Niet genoeg voorraad van {self.naam}")
            return False