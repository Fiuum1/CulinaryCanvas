# Manuale di installazione
L'installazione di CulinarycCanvas non richiede l'uso di librerie esterne, ma necessita di una connessione a Internet per gestire alcuni elementi CSS importati nelle pagine. Le pagine del sistema devono essere ospitate su un server web, e possono essere recuperate dalla repository GitHub di Online T-Platform, che include tutti gli script necessari per gestire le richieste HTTP degli utenti. Per accedere alla pagina di login o ad altre pagine, basta inserire l'indirizzo del server (locale o remoto) e navigare tra le cartelle visualizzate. Tuttavia, questo metodo è sconsigliato perché tutte le pagine, eccetto quelle delle ricette, delle singole ricette e della ricerca avanzata, sono bloccate fino a quando non viene impostato un ID di sessione tramite il login. Il sistema è progettato per essere utilizzato attraverso le interfacce web fornite.

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

Fatto ciò, si verrà reindirizzati alla pagina delle ricette, dove la nuova ricetta sarà visibile.
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

Ad ogni piano è associato un numero, una data di inizio (non antecedente a quella attuale e non successiva a quella di fine) e una data di fine (non antecedente a quella di inizio).
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
<img width="1440" alt="Screenshot 2024-07-13 alle 16 09 20" src="https://github.com/user-attachments/assets/9614a551-6ce2-48ce-a57d-6d149ec04654">

<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
# Test funzionali
Per garantire il rispetto dei requisiti di sicurezza e delle regole di business, sono stati fatti diversi test manuali per verificare la correttezza delle risposte del sistema a situazioni anomale.

# Test di registrazione e login
a. Parametri di registrazione non validi: il sistema mostra correttamente all'utente gli errori da lui commessi, impedendo il proseguimento.
<img width="558" alt="Screenshot 2024-07-13 alle 16 14 14" src="https://github.com/user-attachments/assets/84639b28-d584-4600-8d87-bc1b21ca4019">
<img width="478" alt="Screenshot 2024-07-13 alle 16 17 54" src="https://github.com/user-attachments/assets/0d123e69-b8db-4be3-b5af-7451fb1b84f8">

b. Registrazione con email o username già in uso: il sistema mostra correttamente all'utente che l'username e/o l'email sono già in uso, impedendo il proseguimento.
<img width="415" alt="Screenshot 2024-07-13 alle 16 21 52" src="https://github.com/user-attachments/assets/37db3840-b895-4f5b-8d05-d01d5b1c27bc">

c. Login con password errata o email inesistente: il sistema mostra correttamente all'utente gli errori, impedendo il proseguimento.
<img width="515" alt="Screenshot 2024-07-13 alle 16 24 12" src="https://github.com/user-attachments/assets/39bfdf4d-4bde-4a22-b366-5bb5339559d0">
<img width="523" alt="Screenshot 2024-07-13 alle 16 23 51" src="https://github.com/user-attachments/assets/555a94c9-6a7a-48e6-85df-ba0b223dae1f">

# Test sezione Ricette
a. Tentativo di aggiunta recensione senza aver effettuato il Login: il sistema risponde correttamente, andando ad avvisare l'utente che non è loggato con un pop-up, e al click del pulsante 'Ok' lo reindirizza correttamente alla pagina di Login.
<img width="1440" alt="Screenshot 2024-07-13 alle 16 27 53" src="https://github.com/user-attachments/assets/0f6ef550-fe2a-4d01-b497-70162e26acd6">
<img width="1440" alt="Screenshot 2024-07-13 alle 16 25 33" src="https://github.com/user-attachments/assets/d43b9f16-ffd5-4276-bcbe-d4f25faf7d04">

b. Tentativo di aggiunta di un ingrediente in una nuova ricetta con unità di misura numerica (inesistente): il sistema non consente il proseguimento, avvisando correttamente l'utente.
<img width="561" alt="Screenshot 2024-07-13 alle 16 30 14" src="https://github.com/user-attachments/assets/9149f2d8-0748-4e85-b004-6ead1c06802a">

c. Tentativo di aggiunta di una ricetta omettendo i campi obbligatori: il sistema risponde correttamente, notificando l'utente sulla necessità di inserire i campi obbligatori mancanti e bloccando l'aggiunta della ricetta.
<img width="491" alt="Screenshot 2024-07-13 alle 16 32 02" src="https://github.com/user-attachments/assets/c756240c-2b39-4c86-acb3-b2d1cfc2a810">
<img width="499" alt="Screenshot 2024-07-13 alle 16 32 46" src="https://github.com/user-attachments/assets/358cd9f6-edd6-4850-9c48-a62badcfe80e">
<img width="499" alt="Screenshot 2024-07-13 alle 16 33 17" src="https://github.com/user-attachments/assets/218d86d0-b11e-4c20-a7e9-7a65917271f5">
<img width="505" alt="Screenshot 2024-07-13 alle 16 33 33" src="https://github.com/user-attachments/assets/05066939-23c7-4baa-a452-d577c78d6078">
<img width="498" alt="Screenshot 2024-07-13 alle 16 33 40" src="https://github.com/user-attachments/assets/9f45cc17-9ef7-454c-9c5d-4f17f78611a3">
<img width="501" alt="Screenshot 2024-07-13 alle 16 33 48" src="https://github.com/user-attachments/assets/06590ca8-1406-4734-943c-1554edab51f1">
<img width="495" alt="Screenshot 2024-07-13 alle 16 34 11" src="https://github.com/user-attachments/assets/42cf4348-2322-4e58-8a0f-6822fdf5af60">
<img width="504" alt="Screenshot 2024-07-13 alle 16 34 19" src="https://github.com/user-attachments/assets/8488d604-02de-4fe4-a6dd-1e5be544d01d">
<img width="502" alt="Screenshot 2024-07-13 alle 16 34 28" src="https://github.com/user-attachments/assets/0f09a12f-e30b-46a2-91f6-8df72f6cda7b">
<img width="505" alt="Screenshot 2024-07-13 alle 16 34 47" src="https://github.com/user-attachments/assets/46b19957-d22e-463d-820d-19e0ba8107c1">

d. Un utente che non ha effettuato l'accesso preme il pulsante per aggiungere tutti gli ingredienti della ricetta alla lista della spesa: il sistema risponde correttamente, reindirizzando l'utente alla pagina di Login.

# Test sezione Piani alimentari
a. Tentativo di accesso alla pagina senza aver effettuato l'accesso al sito Web: il sistema risponde correttamente alla richiesta, reindirizzando l'utente alla pagina di Login.

b. Tentativo di inserimento di un piano alimentare con informazioni non consentite: il sistema risponde correttamente a tutte le casistiche, restituendo all'utente informazioni relative a ciò che non è corretto nel suo tentativo di creazione.
<img width="659" alt="Screenshot 2024-07-13 alle 16 38 46" src="https://github.com/user-attachments/assets/8dfc9d78-7375-44d4-a107-7b9ed354163e">
<img width="664" alt="Screenshot 2024-07-13 alle 16 38 55" src="https://github.com/user-attachments/assets/5888bf33-86c8-40c3-bb2b-0b07159dabb0">
<img width="661" alt="Screenshot 2024-07-13 alle 16 39 21" src="https://github.com/user-attachments/assets/a199cdf9-3c63-4599-8a69-9b30b6de4180">
<img width="1440" alt="Screenshot 2024-07-13 alle 16 39 50" src="https://github.com/user-attachments/assets/dcde0164-7c02-43a4-8ebf-c2cd4063bb0f">
<img width="1440" alt="Screenshot 2024-07-13 alle 16 40 00" src="https://github.com/user-attachments/assets/0dfc6c56-a25f-48e4-8a96-b4b9ccbe428e">

c. Aggiunta di una ricetta ad un giorno in cui è già presente: il sistema risponde correttamente, reindirizzando l'utente ad una pagina che gli mostra l'errore.

# Test sezione Lista della spesa
a. Tentativo di accesso alla pagina senza aver effettuato l'accesso al sito Web: il sistema risponde correttamente alla richiesta, reindirizzando l'utente alla pagina di Login.

# Test sezione Ricerca avanzata
a. L'utente inserisce più volte lo stesso ingrediente: il sistema risponde correttamente alla richiesta, interpretando gli ingredienti come un unico utente e restituendo i risultati della ricerca.
<img width="882" alt="Screenshot 2024-07-13 alle 16 49 45" src="https://github.com/user-attachments/assets/ba4bbc72-df3e-437b-af05-8e9079376a85">
<img width="1438" alt="Screenshot 2024-07-13 alle 16 49 55" src="https://github.com/user-attachments/assets/4b3aa32e-a39b-4599-adae-f11b24eccf1c">
