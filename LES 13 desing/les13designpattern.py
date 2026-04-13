class Product:
    def __init__(self, naam, prijs):
        self.naam = naam
        self.prijs = prijs


# Factory Pattern
class ProductFactory:
    @staticmethod
    def maak_product(soort):
        soort = soort.lower()

        if soort == "laptop":
            return Product("Laptop", 899)
        elif soort == "muis":
            return Product("Muis", 25)
        elif soort == "toetsenbord":
            return Product("Toetsenbord", 59)
        else:
            raise ValueError(f"Onbekend product: {soort}")


# Strategy Pattern (interface)
class KortingRegel:
    def pas_toe(self, totaal):
        raise NotImplementedError("Subclasses moeten pas_toe implementeren")


class GeenKorting(KortingRegel):
    def pas_toe(self, totaal):
        return 0


class TienProcentBoven500(KortingRegel):
    def pas_toe(self, totaal):
        if totaal > 500:
            return totaal * 0.10
        return 0


class Kassa:
    def __init__(self, korting_regel):
        self.producten = []
        self.korting_regel = korting_regel

    def voeg_toe(self, product):
        self.producten.append(product)

    def totaal(self):
        return sum(p.prijs for p in self.producten)

    def korting(self):
        totaal = self.totaal()
        return self.korting_regel.pas_toe(totaal)

    def eindbedrag(self):
        return self.totaal() - self.korting()