<?php
$conn = new mysqli("localhost", "root", "", "wyprawy");





?>


<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biuro turystyczne</title>
    <link rel="stylesheet" href="styl.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="wczasy.html">Wczasy</a></li>
                <li><a href="wycieczki.html">Wycieczki</a></li>
                <li><a href="allinclusive.html">All inclusive</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <aside>
            <h3>Twój cel wyprawy</h3>
            <form method="post" action="index.php">
                <label>
                    Miejsce wycieczki:<br>
                    <select id="select" name="select">
                        <?php
                        $sql1 = "SELECT nazwa FROM miejsca ORDER BY nazwa ASC;";
                        $result = $conn->query($sql1);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "
                                <option value='{$row['nazwa']}'>{$row['nazwa']}</option>
                                ";
                            }
                        }

                        ?>
                    </select>
                </label>
                <label>
                    Ile dorosłych?<br>
                    <input type="number" name="adults" id="adults">
                </label><br>
                <label>
                    Ile dzieci?<br>
                    <input type="number" name="childrens" id="childrens">
                </label><br>
                <label>
                    Termin<br>
                    <input type="date" name="date" id="date">
                </label><br>
                <button type="submit">Symulacja ceny</button>
            </form>
            <h4>Koszt wycieczki</h4>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $select = (String) $_POST['select'];
                $adults = (String) $_POST['adults'];
                $childrens = (String) $_POST['childrens'];
                $date = (String) $_POST['date'];

                $sql2 = "SELECT cena FROM miejsca WHERE nazwa = '$select';";

                $result = $conn->query($sql2);
                $row = $result->fetch_assoc();

                $price = $row["cena"] * ($adults + $childrens / 2);
                echo "
                    <p>W dniu: $date</p> 
                    <p>$price złotych</p>
                ";

            }


            ?>
        </aside>
        <section>
            <h3>Wycieczki</h3>
            <?php
            $sql3 = "SELECT nazwa, cena, link_obraz FROM miejsca WHERE link_obraz LIKE '0%';";
            $result = $conn->query($sql3);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <div class='wycieczka'>
                        <img src='{$row['link_obraz']}' alt='zdjęcie z wycieczki'>
                        <h2>{$row['nazwa']}</h2>
                        <p>{$row['cena']}</p>
                    </div>
";

                }
            }

            ?>

        </section>
    </main>
    <footer>
        <p>Autor: 09291305232</p>
    </footer>
</body>

</html>

<?php


$conn->close();

?>