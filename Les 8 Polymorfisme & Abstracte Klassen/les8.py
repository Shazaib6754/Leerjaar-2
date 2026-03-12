from abc import ABC, abstractmethod

# Abstracte class
class Betaalmethode(ABC):
    def __init__(self, naam):
        self.naam = naam

    @abstractmethod
    def betaal(self, bedrag):
        pass


# Subclass: Pin
class PinBetaling(Betaalmethode):
    def __init__(self):
        super().__init__("Pin")

    def betaal(self, bedrag):
        return f"{self.naam}: Betaling van €{bedrag} is gepind."


# Subclass: Contant
class ContantBetaling(Betaalmethode):
    def __init__(self):
        super().__init__("Contant")

    def betaal(self, bedrag):
        return f"{self.naam}: €{bedrag} contant ontvangen."


# Subclass: Online
class OnlineBetaling(Betaalmethode):
    def __init__(self):
        super().__init__("Online")

    def betaal(self, bedrag):
        return f"{self.naam}: Online betaling van €{bedrag} verwerkt."


# Test met polymorfisme
methodes = [PinBetaling(), ContantBetaling(), OnlineBetaling()]

for methode in methodes:
    print(methode.betaal(49.95))