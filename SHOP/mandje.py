from .product import Product


class Winkelmandje:
    def __init__(self):
        self.items = []  # lijst van tuples (product, aantal)

    def voeg_toe(self, product, aantal):
        if product.is_op_voorraad(aantal):
            product.verlaag_voorraad(aantal)
            self.items.append((product, aantal))
            print(f"{aantal}x {product.naam} toegevoegd aan mandje.")
        else:
            print("Toevoegen mislukt.")

    def totaal_prijs(self):
        totaal = 0
        for product, aantal in self.items:
            totaal += product.prijs * aantal
        return totaal

    def toon(self):
        if not self.items:
            print("Mandje is leeg.")
            return

        print("\n--- Winkelmandje ---")
        for product, aantal in self.items:
            print(f"{product.naam} x{aantal} = €{product.prijs * aantal}")
        print(f"Totaal: €{self.totaal_prijs()}")