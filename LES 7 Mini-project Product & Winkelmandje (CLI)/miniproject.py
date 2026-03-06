# ================================
# MINI WEBSHOP - TERMINAL PROJECT
# ================================


# ----------------
# CLASS: Product
# ----------------
class Product:
    def __init__(self, naam, prijs, voorraad):
        self.naam = naam
        self.prijs = prijs
        self._voorraad = voorraad   # interne voorraad (niet direct aanpassen)

    # Toon productinformatie
    def toon_info(self):
        print(f"{self.naam} - €{self.prijs} (voorraad: {self._voorraad})")

    # Controleer of product op voorraad is
    def is_op_voorraad(self):
        return self._voorraad > 0

    # Verlaag voorraad met checks
    def verlaag_voorraad(self, aantal):
        if aantal <= 0:
            print("Aantal moet groter zijn dan 0")
            return False

        if aantal > self._voorraad:
            print(f"Niet genoeg voorraad voor {self.naam}")
            return False

        self._voorraad -= aantal
        return True


# ----------------
# CLASS: Winkelmandje
# ----------------
class Winkelmandje:
    def __init__(self):
        self.items = []

    # Product toevoegen
    def voeg_toe(self, product):
        self.items.append(product)
        print(f"Toegevoegd: {product.naam}")

    # Mandje tonen
    def toon_mandje(self):
        if not self.items:
            print("Mandje is leeg")
            return

        print("\n--- Winkelmandje ---")

        for item in self.items:
            print(f"{item.naam} - €{item.prijs}")

    # Totaalprijs berekenen
    def totaal_prijs(self):
        totaal = 0

        for item in self.items:
            totaal += item.prijs

        return totaal


# ----------------
# STARTPRODUCTEN
# ----------------
producten = [
    Product("Laptop", 899, 3),
    Product("Muis", 25, 10),
    Product("Toetsenbord", 59, 5),
]

# Winkelmandje maken
mandje = Winkelmandje()


# ----------------
# MENU LOOP
# ----------------
while True:

    print("\n================")
    print(" MINI WEBSHOP")
    print("================")
    print("1. Producten bekijken")
    print("2. Product toevoegen")
    print("3. Mandje bekijken")
    print("4. Afrekenen")
    print("0. Stoppen")

    keuze = input("Kies: ")

    # ----------------
    # PRODUCTEN TONEN
    # ----------------
    if keuze == "1":

        print("\nProducten:")

        for i, product in enumerate(producten):
            print(f"{i+1}. ", end="")
            product.toon_info()

    # ----------------
    # PRODUCT TOEVOEGEN
    # ----------------
    elif keuze == "2":

        print("\nKies een product:")

        for i, product in enumerate(producten):
            print(f"{i+1}. {product.naam}")

        try:
            nummer = int(input("Productnummer: ")) - 1

            if 0 <= nummer < len(producten):
                gekozen_product = producten[nummer]

                if gekozen_product.is_op_voorraad():
                    mandje.voeg_toe(gekozen_product)
                else:
                    print("Dit product is niet op voorraad")

            else:
                print("Ongeldig productnummer")

        except ValueError:
            print("Voer een geldig nummer in")

    # ----------------
    # MANDJE BEKIJKEN
    # ----------------
    elif keuze == "3":

        mandje.toon_mandje()

        totaal = mandje.totaal_prijs()
        print(f"Totaal: €{totaal}")

    # ----------------
    # AFREKENEN
    # ----------------
    elif keuze == "4":

        if not mandje.items:
            print("Mandje is leeg")
            continue

        print("\nAfrekenen...")

        alles_gelukt = True

        for product in mandje.items:

            if not product.verlaag_voorraad(1):
                alles_gelukt = False

        if alles_gelukt:

            totaal = mandje.totaal_prijs()

            print(f"Totaal te betalen: €{totaal}")
            print("Bedankt voor je aankoop!")

            mandje.items = []

        else:
            print("Afrekenen mislukt door voorraadprobleem")

    # ----------------
    # STOPPEN
    # ----------------
    elif keuze == "0":
        print("Programma gestopt")
        break

    else:
        print("Ongeldige keuze")