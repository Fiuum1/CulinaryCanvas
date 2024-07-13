# Manuale di installazione
L'installazione di CulinarycCanvas non richiede l'uso di librerie esterne, ma necessita di una connessione a Internet per gestire alcuni elementi CSS importati nelle pagine. Le pagine del sistema devono essere ospitate su un server web, e possono essere recuperate dalla repository GitHub di Online T-Platform, che include tutti gli script necessari per gestire le richieste HTTP degli utenti. Per accedere alla pagina di login o ad altre pagine, basta inserire l'indirizzo del server (locale o remoto) e navigare tra le cartelle visualizzate. Tuttavia, questo metodo è sconsigliato perché tutte le pagine, eccetto quelle delle ricette e delle singole ricette, sono bloccate fino a quando non viene impostato un ID di sessione tramite il login. Il sistema è progettato per essere utilizzato attraverso le interfacce web fornite.

# Pagina index
È possibile accedere alla pagina index.php senza effettuare l'accesso. Su questa pagina è possibile scegliere a quale sezione si vuole essere reindirizzati cliccando sugli appositi bottoni sottostanti alle immagini, sui pulsanti dell'header in alto (sotto al titolo), oppure effettuare il Login o il Register.
<img width="1440" alt="Screenshot 2024-07-13 alle 15 34 52" src="https://github.com/user-attachments/assets/51c5e50e-fed6-4c1e-80a4-6588759ed1cd">

# Registrazione e Login
Cliccando sul pulsante Register, si accede alla pagina di registrazione, dove sarà necessario inserire i propri dati per iscriversi al sito web.
<img width="1440" alt="Screenshot 2024-07-13 alle 15 37 18" src="https://github.com/user-attachments/assets/152de925-8b1d-4da3-a97c-841c001ee2cf">

Una volta fatto ciò, si verrà direttamente reindirizzati alla pagina di Login per l'autenticazione.
<img width="1440" alt="Screenshot 2024-07-13 alle 15 38 25" src="https://github.com/user-attachments/assets/c7811f1e-f951-48be-9f61-d76dacffe664">

A questo punto si verrà reindirizzati alla pagina index, ma loggati con il proprio account.
<img width="1440" alt="Screenshot 2024-07-13 alle 15 39 04" src="https://github.com/user-attachments/assets/39639ce8-6783-4147-9943-e85119815a8f">
*P.S: L'utente può in qualunque momento effettuare il logout, cliccando sul pulsante rosso Logout in alto a destra.*

# Ricette
Nell'area dedicata alle ricette sono presenti un pulsante per l'aggiunta di una nuova ricetta e, ovviamente, le ricette già pubblicate, o meglio una loro preview: per ognuna abbiamo il titolo, l'autore, la foto, la difficoltà, il tempo di preparazione, il tempo di cottura e le porzioni. Maggiori dettagli li visualizzeremo cliccando sulla singola ricetta.
<img width="1440" alt="Screenshot 2024-07-13 alle 15 37 18" src="https://github.com/user-attachments/assets/d625594b-d4ff-47e9-ac44-a2221e28e4c9">

Per creare una ricetta, bisogna premere l'apposito pulsante.
Si verrà reindirizzati ad una pagina dove sarà necessario inserire le informazioni relative alla ricetta, come da foto.
<img width="1440" alt="Screenshot 2024-07-13 alle 16 01 52" src="https://github.com/user-attachments/assets/1d994a18-da2d-47e6-8081-9990148892eb">
*P.S: Dato che l'utente potrebbe inserire un ingrediente già presente nel DB, ma essere a conoscenza della categoria esatta, se l'utente dovesse inserire una categoria diversa da quella esistente, la sola categoria verrà ignorata.*

Fatto ciò, la ricetta sarà visibile nella sezione ricette.
<img width="1440" alt="Screenshot 2024-07-13 alle 16 03 28" src="https://github.com/user-attachments/assets/a5e109d4-db1e-4c77-b5ff-0630d07922bd">


Per la singola ricetta, possiamo vedere come la descrizione sia molto dettagliata: titolo e autore, foto, lista ingredienti, testo per la preparazione (descrizione), difficoltà, tempo di preparazione, tempo di cottura e porzioni, e più sotto la valutazione media. Notare la possibilità di aggiungere una valutazione e, soprattutto, di aggiungere tutti gli ingredienti della ricetta alla lista della spesa.
<img width="1440" alt="Screenshot 2024-07-13 alle 15 45 17" src="https://github.com/user-attachments/assets/7bd0822d-032e-4bdc-bc99-3bd7390d1b2e">
<img width="1440" alt="Screenshot 2024-07-13 alle 15 45 25" src="https://github.com/user-attachments/assets/6bacf30a-28a0-49a1-81d7-ac7211887e49">
<img width="1440" alt="Screenshot 2024-07-13 alle 15 45 32" src="https://github.com/user-attachments/assets/04e5a732-099e-4efd-829f-e074cb17965e">

**Aggiunta Recensione:**
Per aggiungere una recensione, è obbligatoria la valutazione, mentre il commento è facoltativo.
<img width="1440" alt="Screenshot 2024-07-13 alle 15 46 59" src="https://github.com/user-attachments/assets/ab4202e8-b316-4922-be4e-e9d4a947e92e">
<img width="1440" alt="Screenshot 2024-07-13 alle 15 47 13" src="https://github.com/user-attachments/assets/fa2eae4b-257a-40a8-b73b-f8eae3395055">

# Lista della spesa
È possibile aggiungere gli ingredienti alla lista della spesa direttamente dalla ricetta, cliccando sull'apposito pulsante 'Aggiungi alla lista della spesa'
<img width="1440" alt="Screenshot 2024-07-13 alle 15 48 15" src="https://github.com/user-attachments/assets/6cf6ebbf-a148-4a3b-a4ab-70970150bf48">

In questo modo, verranno visualizzati tutti gli ingredienti appena aggiunti all'interno della lista della spesa, insieme a quelli già presenti (qualora ce ne fossero), ovviamente sommando le quantità qualora ci fossero doppioni.
<img width="1440" alt="Screenshot 2024-07-13 alle 15 49 54" src="https://github.com/user-attachments/assets/e91569ee-5b05-48ab-8427-5a43dffc63e0">
*P.S: è possibile rimuovere ingredienti dalla lista della spesa premendo il pulsante 'Rimuovi' accanto al singolo ingrediente*

# Piani alimentari
I piani alimentari possono essere creati direttamente dalla sezione ad essi dedicati, dov'è possibile visualizzare anche i piani già esistenti. Cliccando sul pulsante 'Crea nuovo piano' è possibile creare un nuovo piano alimentare. 
<img width="1440" alt="Screenshot 2024-07-13 alle 15 51 35" src="https://github.com/user-attachments/assets/fd2fea3b-7203-4309-a84e-414a7ab9d52e">

Ad ogni piano è associato un numero, una data di inizio (non antecedente a quella attuale e non successiva a quella di fine) e una data di fine (non antecedente a quella attuale e non precedente a quella di inizio).
<img width="1440" alt="Screenshot 2024-07-13 alle 15 52 41" src="https://github.com/user-attachments/assets/7e3b4f23-d4cb-4131-b053-71a786ec6b3e">

Cliccando su aggiungi piano, esso verrà aggiunto alla lista dei piani alimentari, si verrà reindirizzati alla pagina dei piani alimentari e ne si potrà visualizzare una preview, con la possibilità di vedere il piano nel dettaglio premendo il pulsante 'Vedi piano', oppure di rimuoverlo con l'apposito pulsante.
<img width="1440" alt="Screenshot 2024-07-13 alle 15 53 57" src="https://github.com/user-attachments/assets/0b313446-c9c5-49c4-bfaf-f8a345fe3308">

Per aggiungere una ricetta ad un piano basta selezionarla da quelle esistenti, indicando in quale giorno la si vuole piazzare (non è possibile inserire la stessa ricetta più volte nello stesso giorno) e il momento della giornata durante il quale si vuole consumare il pasto (mattina, pranzo, snack, cena, dessert, ordinati in questo modo).
<img width="1440" alt="Screenshot 2024-07-13 alle 15 56 18" src="https://github.com/user-attachments/assets/bac524a2-0204-4528-abfa-e081ccebe2cd">

Fatto ciò, la ricetta sarà visualizzata sulla pagina. Cliccare sulla ricetta comporta il reindirizzamento alla sua pagina, ed è anche possibile rimuoverla dal piano alimentare direttamente dalla pagina del piano.
<img width="1440" alt="Screenshot 2024-07-13 alle 15 57 12" src="https://github.com/user-attachments/assets/fd05a291-9b2b-462d-91f4-8738b5b22c6a">


# Ricerca avanzata
CulinaryCanvas mette a disposizione dell'utente una funzionalità molto utile, ovvero quella della ricerca basata sugli ingredienti.
La pagina per la ricerca avanzata appare in questo modo.
<img width="1439" alt="Screenshot 2024-07-13 alle 16 04 53" src="https://github.com/user-attachments/assets/cd094618-ed51-45ce-a130-cbc6601ad44e">

L'utente può aggiungere tutti gli ingredienti che vuole per effettuare la ricerca, rimuoverli, e alla fine premere il pulsante 'Ricerca'.
<img width="1440" alt="Screenshot 2024-07-13 alle 16 05 39" src="https://github.com/user-attachments/assets/77355d41-9bf1-40cf-94d4-cb6bd3d8897f">

Nella sezione 'Risultati Ricerca' verranno visualizzate le ricette che posseggono gli ingredienti selezionati dall'utente.
<img width="1440" alt="Screenshot 2024-07-13 alle 16 06 39" src="https://github.com/user-attachments/assets/270f9df7-b258-463d-ba8f-521ad877b73d">
<img width="1440" alt="Screenshot 2024-07-13 alle 16 06 48" src="https://github.com/user-attachments/assets/88dcdc00-0e48-4e88-9c7c-1f6c9a6a8a4e">
<img width="1440" alt="Screenshot 2024-07-13 alle 16 06 56" src="https://github.com/user-attachments/assets/17157063-85cb-4aea-97af-2e333a83a52f">
<img width="1439" alt="Screenshot 2024-07-13 alle 16 07 05" src="https://github.com/user-attachments/assets/e84eb032-4930-4281-b6c9-a257cf8153b0">

# Area personale
Per accedere all'area personale, basta cliccare sull'icona di profilo dell'utente, e verranno visualizzati username, nome, cognome, email (con la possibilità di cambiarla) e le ricette da egli pubblicate. Sarà possibile rimuoverle manualmente.
