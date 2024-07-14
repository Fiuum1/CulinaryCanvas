Per completezza, di seguito sono riportati alcuni report statistici che ci consentono di ottenere informazioni rilevanti sul sistema in servizio.

# Report Statistici

**1. Numero di ricette per Utente**

  SELECT Utente, COUNT(*) AS NumeroRicette
  
  FROM Ricette
  
  GROUP BY Utente;

<br/><br/>
**2. Media delle valutazioni delle ricette per utente**

  SELECT R.Utente, AVG(RV.Valutazione) AS MediaValutazioni
  FROM Ricette AS R
  JOIN Recensioni AS REC ON R.ID_Ricetta = REC.Ricetta
  GROUP BY R.Utente;

<br/><br/>
**3. Numero di recensioni per ricetta**
  
  SELECT Ricetta, COUNT(*) AS NumeroRecensioni
  FROM Recensioni
  GROUP BY Ricetta;

<br/><br/>
**4. Media delle valutazioni per ricetta** 
  
  SELECT Ricetta, AVG(Valutazione) AS MediaValutazioni
  FROM Recensioni
  GROUP BY Ricetta;

<br/><br/>
**5. Numero di ingredienti utilizzati in tutte le ricette**

  SELECT COUNT(DISTINCT Ingrediente) AS NumeroIngredienti
  FROM Composizioni;

<br/><br/>
**6. Numero di pianti alimentari creati per utente**

  SELECT Utente, COUNT(*) AS NumeroPiani
  FROM Piani_alimentari
  GROUP BY Utente;

<br/><br/>
**7. Numero di ingredienti inclusi nella lista della spesa per utente**

  SELECT Utente, COUNT(*) AS NumeroIngredientiInclusi
  FROM Inclusioni
  GROUP BY Utente;

<br/><br/>
**8. Ricetta con il maggior numero di recensioni**

  SELECT Ricetta, COUNT(*) AS NumeroRecensioni
  FROM Recensioni
  GROUP BY Ricetta
  ORDER BY NumeroRecensioni DESC
  LIMIT 1;

<br/><br/>
**9. Utente con il maggior numero di ricette pubblicate**

  SELECT Utente, COUNT(*) AS NumeroRicette
  FROM Ricette
  GROUP BY Utente
  ORDER BY NumeroRicette DESC
  LIMIT 1;
