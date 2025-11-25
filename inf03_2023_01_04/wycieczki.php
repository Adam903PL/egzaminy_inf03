<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Wycieczki po Europie</title>
    <link rel="stylesheet" href="styl4.css">
</head>

<body>
    <header>
        <h1>BIURO TURYSTYCZNE</h1>
    </header>
    <section id="data">
        <h3>Wycieczki, na które są wolne miejsca</h3>
        <ul>
            <?php
            $conn = new mysqli("localhost", "root", "", "wyprawy");

            

            $sql1 = "SELECT id, dataWyjazdu, cel, cena FROM wycieczki WHERE dostepna = 1;";
            $result1 = $conn->query($sql1);

            if ($result1 && $result1->num_rows > 0) {
                while ($row = $result1->fetch_assoc()) {
                    echo "<li>{$row['id']}. dnia {$row['dataWyjazdu']} jedziemy do {$row['cel']}, cena: {$row['cena']}</li>";
                }
            }
            ?>
        </ul>
    </section>
    <main>
        <section id="left">
            <h2>Bestselery</h2>
            <table>
                <tr>
                    <td>Wenecja</td>
                    <td>kwiecie&#324;</td>
                </tr>
                <tr>
                    <td>Londyn</td>
                    <td>lipiec</td>
                </tr>
                <tr>
                    <td>Rzym</td>
                    <td>wrzesie&#324;</td>
                </tr>
            </table>
        </section>
        <section id="center">
            <h2>Nasze zdj&#281;cia</h2>
            <?php
            $photosSql = "SELECT nazwaPliku, podpis FROM zdjecia ORDER BY podpis DESC;";
            $photosResult = $conn->query($photosSql);

            if ($photosResult && $photosResult->num_rows > 0) {
                while ($photo = $photosResult->fetch_assoc()) {
                    echo "<img src='{$photo['nazwaPliku']}' alt='{$photo['podpis']}' />";
                }
            }
            $conn->close();
            ?>
        </section>
        <section id="right">
            <h2>Skontaktuj się</h2>
            <a href="mailto:turysta@wycieczki.pl">napisz do nas</a>
            <p>telefon: 111222333</p>
        </section>
    </main>
    <footer>
        <p>Stronę wykonał Adam Pukaluk</p>
    </footer>
</body>

</html>
