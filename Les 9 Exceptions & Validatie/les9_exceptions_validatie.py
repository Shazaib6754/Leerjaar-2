# =========================
# Stap 2 — vraag_int()
# =========================
def vraag_int(prompt):
    while True:
        try:
            waarde = int(input(prompt))
            return waarde
        except ValueError:
            print("Ongeldige invoer, probeer opnieuw")


# =========================
# Stap 3 — delen()
# =========================
def delen(a, b):
    if b == 0:
        raise ZeroDivisionError("Delen door 0 mag niet")
    return a / b


# =========================
# Stap 4 + 5 — Menu + foutafhandeling
# =========================
while True:
    try:
        print("\n--- MENU ---")
        print("1: Optellen")
        print("2: Delen")
        print("0: Stoppen")

        keuze = vraag_int("Kies: ")

        if keuze == 0:
            print("Programma gestopt.")
            break

        elif keuze == 1:
            a = vraag_int("Geef eerste getal: ")
            b = vraag_int("Geef tweede getal: ")
            resultaat = a + b
            print("Uitkomst:", resultaat)

        elif keuze == 2:
            a = vraag_int("Geef eerste getal: ")
            b = vraag_int("Geef tweede getal: ")
            resultaat = delen(a, b)
            print("Uitkomst:", resultaat)

        else:
            print("Ongeldige keuze")

    except ZeroDivisionError as e:
        print(f"Fout: {e}")

    finally:
        print("Terug naar menu...")