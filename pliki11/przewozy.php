<?php


$conn = new mysqli("localhost", "root", "", "przewozy");



if($_SERVER['REQUEST_METHOD'] == "POST"){
    $date = (String)$_POST['calendar'];
    $task = (String)$_POST['task'];
    $sql2 = "INSERT INTO zadania VALUES (NULL, '$task', '$date', 1);";

    $result2 = $conn -> query($sql2);
    header("location: przewozy.php");

}



?>




<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firma Przewozowa</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <h1>Firma przewozowa Półdarmo</h1>
    </header>
    <nav>
        <a href="auto.png">kwerenda1</a>
        <a href="auto.png">kwerenda2</a>
        <a href="auto.png">kwerenda3</a>
        <a href="auto.png">kwerenda4</a>
    </nav>
    <main>
        <div id="left">
            <h2>Zadania do wykonania</h2>
            <table>
                <tr>
                    <th>Zadanie do wykonania</th>
                    <th>Data realizacji</th>
                    <th>Akcja</th>
                </tr>
                <?php

                $sql1 = "SELECT id_zadania, zadanie, data FROM zadania";
                $result = $conn->query($sql1);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>{$row['zadanie']}</td>
                            <td>{$row['data']}</td>
                            <td><a href='przewozy.php?id_zadania={$row['id_zadania']}'>Usuń</a></td>
                    
                        </tr>
                        
                        ";
                    }
                }
                ?>
            </table>
            <?php
            if (isset($_GET['id_zadania'])) {
                $id = $_GET['id_zadania'];
                $sql3 = "DELETE FROM zadania WHERE id_zadania = $id;";
                $result3 = $conn->query($sql3);
                header("location: przewozy.php");
            }


            ?>
            <form method="post" action="">
                <label for="task">Zadanie do wykonania: </label>
                <input type="text" id="task" name="task">
                </br>

                <label for="date">Data realizacji: </label>
                <input type="date" id="calendar" name="calendar">

                <button type="submit">Dodaj</button>

            </form>


        </div>
        <div id="right">
            <img src="auto.png" alt="auto firmowe">
            <h3>Nasza specjalność</h3>
            <ul>
                <li>
                    Przeprowadzki
                </li>
                <li>
                    Przewóz mebli

                </li>
                <li>
                    Przesyłki gabarytowe
                </li>
                <li>
                    Wynajem pojazdów
                </li>
                <li>
                    Zakupy towarów
                </li>
            </ul>
        </div>
    </main>
    <footer>
        <p>Stronę wykonał:Adam :3</p>
    </footer>
</body>

</html>


<?php

$conn->close();


?>