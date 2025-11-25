<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Zadania na lipiec</title>
    <link rel="stylesheet" href="styl6.css">
</head>

<body>
    <header>
        <section id="header1">
            <img src="logo1.png" alt="lipiec">

        </section>
        <section id="header2">
            <h1>TERMINARZ</h1>
            <p>najbliższe zadania:
                <?php

                $con = new mysqli("localhost", "root", "", "wyprawy");

                $q = "SELECT DISTINCT wpis FROM zadania WHERE dataZadania BETWEEN '2020-07-01' AND '2020-07-07' AND wpis != '';";
                $res = $con->query($q);
                if ($res && $res->num_rows > 0) {
                    while ($row = $res->fetch_assoc()) {
                        echo "{$row['wpis']}; ";
                    }
                }
                ?>



            </p>
        </section>
    </header>
    <main>
        <?php
        $q = "SELECT dataZadania, wpis FROM zadania WHERE MONTH(dataZadania) = 7;";
        $res = $con->query($q);
        if ($res && $res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                
                echo "<section class='calendar'>
                    <h6>{$row['dataZadania']}</h6>
                    <p>{$row['wpis']}</p>
                    </section>";
            }
        }
        $con->close();
        ?>
    </main>
    <footer>
        <a href="sierpien.html">Terminarz na sierpień</a>
        <p>Stronę wykonał: Adam Pukaluk</p>
    </footer>
</body>

</html>
