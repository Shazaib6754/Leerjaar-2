from shop.product import Product
from shop.mandje import Winkelmandje


def toon_producten(producten):
    print("\n--- Producten ---")
    for i, product in enumerate(producten, start=1):
        print(f"{i}. ", end="")
        product.toon_info()


def main():
    producten = [
        Product("Laptop", 899, 3),
        Product("Muis", 25, 10),
        Product("Toetsenbord", 59, 5)
    ]

    mandje = Winkelmandje()

    while True:
        print("\n1. Toon producten")
        print("2. Voeg toe aan mandje")
        print("3. Toon mandje")
        print("4. Stoppen")

        keuze = input("Kies een optie: ")

        if keuze == "1":
            toon_producten(producten)

        elif keuze == "2":
            toon_producten(producten)
            try:
                index = int(input("Kies productnummer: ")) - 1
                aantal = int(input("Aantal: "))

                if 0 <= index < len(producten):
                    mandje.voeg_toe(producten[index], aantal)
                else:
                    print("Ongeldig productnummer.")
            except ValueError:
                print("Voer geldige cijfers in.")

        elif keuze == "3":
            mandje.toon()

        elif keuze == "4":
            print("Programma gestopt.")
            break

        else:
            print("Ongeldige keuze.")


if __name__ == "__main__":
    main()